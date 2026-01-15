<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once '../src/Config/Database.php';
use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if (!$db) {
    http_response_code(500);
    echo json_encode(["message" => "Error de conexión a BD"]);
    exit();
}

// Get parameters
$hospedaje_id = isset($_GET['hospedaje_id']) ? intval($_GET['hospedaje_id']) : null;
$fecha_entrada = isset($_GET['fecha_entrada']) ? $_GET['fecha_entrada'] : null;
$fecha_salida = isset($_GET['fecha_salida']) ? $_GET['fecha_salida'] : null;
$huespedes = isset($_GET['huespedes']) ? intval($_GET['huespedes']) : 1;

if (!$hospedaje_id) {
    http_response_code(400);
    echo json_encode(["message" => "Se requiere hospedaje_id"]);
    exit();
}

try {
    // Get all rooms for this hospedaje
    $query = "SELECT h.*, 
              (SELECT COUNT(*) FROM reservaciones r 
               WHERE r.habitacion_id = h.id 
               AND r.estado IN ('pendiente', 'confirmada')
               AND (
                   (r.fecha_entrada <= :fecha_salida AND r.fecha_salida >= :fecha_entrada)
               )) as reservaciones_activas
              FROM habitaciones h 
              WHERE h.hospedaje_id = :hospedaje_id 
              AND h.activo = TRUE
              AND h.capacidad >= :huespedes
              ORDER BY h.precio_noche ASC";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':hospedaje_id', $hospedaje_id, PDO::PARAM_INT);
    $stmt->bindParam(':huespedes', $huespedes, PDO::PARAM_INT);

    // If dates are provided, check availability
    if ($fecha_entrada && $fecha_salida) {
        $stmt->bindParam(':fecha_entrada', $fecha_entrada);
        $stmt->bindParam(':fecha_salida', $fecha_salida);
    } else {
        // Default dates (today to tomorrow)
        $hoy = date('Y-m-d');
        $manana = date('Y-m-d', strtotime('+1 day'));
        $stmt->bindParam(':fecha_entrada', $hoy);
        $stmt->bindParam(':fecha_salida', $manana);
    }

    $stmt->execute();
    $habitaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process each room to add availability info
    $result = [];
    foreach ($habitaciones as $hab) {
        // Decode JSON fields
        if (isset($hab['amenidades']) && is_string($hab['amenidades'])) {
            $decoded = json_decode($hab['amenidades']);
            $hab['amenidades'] = $decoded !== null ? $decoded : [];
        }
        if (isset($hab['imagenes']) && is_string($hab['imagenes'])) {
            $decoded = json_decode($hab['imagenes']);
            $hab['imagenes'] = $decoded !== null ? $decoded : [];
        }

        // Calculate availability
        $reservadas = intval($hab['reservaciones_activas']);
        $total = intval($hab['cantidad_total']);
        $disponibles = max(0, $total - $reservadas);

        $hab['disponibles'] = $disponibles;
        $hab['disponible'] = $disponibles > 0;

        // Calculate total price if dates provided
        if ($fecha_entrada && $fecha_salida) {
            $entrada = new DateTime($fecha_entrada);
            $salida = new DateTime($fecha_salida);
            $noches = $entrada->diff($salida)->days;
            $hab['noches'] = $noches;
            $hab['precio_total'] = floatval($hab['precio_noche']) * $noches;
        }

        unset($hab['reservaciones_activas']);
        $result[] = $hab;
    }

    echo json_encode([
        "hospedaje_id" => $hospedaje_id,
        "fecha_entrada" => $fecha_entrada,
        "fecha_salida" => $fecha_salida,
        "huespedes" => $huespedes,
        "habitaciones" => $result
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Error: " . $e->getMessage()]);
}
