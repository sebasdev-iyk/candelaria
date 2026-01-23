<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't display, but log
ini_set('log_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Global exception handler
set_exception_handler(function ($e) {
    http_response_code(500);
    echo json_encode([
        "message" => "Error interno del servidor",
        "debug" => $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine()
    ]);
    exit();
});

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once '../src/Config/Database.php';
include_once '../includes/supabase-middleware.php';
use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if (!$db) {
    http_response_code(500);
    echo json_encode(["message" => "Error de conexión a BD"]);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Get reservation by ID (requires auth)
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($id) {
        try {
            $query = "SELECT r.*, h.nombre as habitacion_nombre, ho.nombre as hospedaje_nombre,
                      c.nombre as cliente_nombre, c.email as cliente_email, c.telefono as cliente_telefono
                      FROM reservaciones r
                      JOIN habitaciones h ON r.habitacion_id = h.id
                      JOIN hospedajes ho ON r.hospedaje_id = ho.id
                      JOIN clientes c ON r.cliente_id = c.id
                      WHERE r.id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $reserva = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($reserva) {
                echo json_encode($reserva);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Reservación no encontrada"]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["message" => "Error: " . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Se requiere id"]);
    }

} elseif ($method == 'POST') {
    // Require Supabase authentication
    $supabaseUser = requireAuth(); // Dies with 401 if not authenticated

    // $supabaseUser contains: id (UUID), email, name, picture, provider

    $data = json_decode(file_get_contents("php://input"));

    // Validate required fields
    if (
        !isset($data->habitacion_id) || !isset($data->hospedaje_id) ||
        !isset($data->fecha_entrada) || !isset($data->fecha_salida)
    ) {
        http_response_code(400);
        echo json_encode(["message" => "Datos incompletos. Se requiere: habitacion_id, hospedaje_id, fecha_entrada, fecha_salida"]);
        exit();
    }

    try {
        // Verify room exists and is active
        $checkRoom = $db->prepare("SELECT * FROM habitaciones WHERE id = :id AND activo = TRUE");
        $checkRoom->bindParam(':id', $data->habitacion_id, PDO::PARAM_INT);
        $checkRoom->execute();
        $room = $checkRoom->fetch(PDO::FETCH_ASSOC);

        if (!$room) {
            http_response_code(404);
            echo json_encode(["message" => "Habitación no encontrada o no disponible"]);
            exit();
        }

        // Check availability for the dates
        $checkAvail = $db->prepare("
            SELECT COUNT(*) as count FROM reservaciones 
            WHERE habitacion_id = :habitacion_id 
            AND estado IN ('pendiente', 'confirmada')
            AND fecha_entrada < :fecha_salida 
            AND fecha_salida > :fecha_entrada
        ");
        $checkAvail->bindParam(':habitacion_id', $data->habitacion_id, PDO::PARAM_INT);
        $checkAvail->bindParam(':fecha_entrada', $data->fecha_entrada);
        $checkAvail->bindParam(':fecha_salida', $data->fecha_salida);
        $checkAvail->execute();
        $reservasExistentes = $checkAvail->fetch(PDO::FETCH_ASSOC)['count'];

        if ($reservasExistentes >= $room['cantidad_total']) {
            http_response_code(409);
            echo json_encode(["message" => "No hay disponibilidad para las fechas seleccionadas"]);
            exit();
        }

        // Calculate total price
        $entrada = new DateTime($data->fecha_entrada);
        $salida = new DateTime($data->fecha_salida);
        $noches = $entrada->diff($salida)->days;

        if ($noches <= 0) {
            http_response_code(400);
            echo json_encode(["message" => "La fecha de salida debe ser posterior a la fecha de entrada"]);
            exit();
        }

        $precio_total = floatval($room['precio_noche']) * $noches;

        // Create reservation using Supabase user_id (UUID)
        $query = "INSERT INTO reservaciones 
                  (user_id, habitacion_id, hospedaje_id, fecha_entrada, fecha_salida, num_huespedes, precio_total, notas, estado, user_email, user_name)
                  VALUES 
                  (:user_id, :habitacion_id, :hospedaje_id, :fecha_entrada, :fecha_salida, :num_huespedes, :precio_total, :notas, 'pendiente', :user_email, :user_name)";

        $stmt = $db->prepare($query);

        $user_id = $supabaseUser['id']; // UUID string
        $user_email = $supabaseUser['email'];
        $user_name = $supabaseUser['name'];
        $habitacion_id = $data->habitacion_id;
        $hospedaje_id = $data->hospedaje_id;
        $fecha_entrada = $data->fecha_entrada;
        $fecha_salida = $data->fecha_salida;
        $num_huespedes = isset($data->num_huespedes) ? intval($data->num_huespedes) : 1;
        $notas = isset($data->notas) ? htmlspecialchars(strip_tags($data->notas)) : null;

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':habitacion_id', $habitacion_id, PDO::PARAM_INT);
        $stmt->bindParam(':hospedaje_id', $hospedaje_id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_entrada', $fecha_entrada);
        $stmt->bindParam(':fecha_salida', $fecha_salida);
        $stmt->bindParam(':num_huespedes', $num_huespedes, PDO::PARAM_INT);
        $stmt->bindParam(':precio_total', $precio_total);
        $stmt->bindParam(':notas', $notas);
        $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $reserva_id = $db->lastInsertId();
            http_response_code(201);
            echo json_encode([
                "message" => "Reservación creada exitosamente",
                "id" => $reserva_id,
                "precio_total" => $precio_total,
                "noches" => $noches,
                "estado" => "pendiente",
                "user" => [
                    "id" => $supabaseUser['id'],
                    "email" => $supabaseUser['email'],
                    "name" => $supabaseUser['name']
                ]
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Error al crear la reservación"]);
        }

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error de base de datos: " . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Método no permitido"]);
}
