<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/Config/Database.php';
use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if ($db) {
    try {
        $hospedaje_id = isset($_GET['hospedaje_id']) ? intval($_GET['hospedaje_id']) : null;

        if ($hospedaje_id) {
            // Get rooms for a specific hospedaje
            $query = "SELECT * FROM habitaciones WHERE hospedaje_id = :hospedaje_id AND activo = TRUE ORDER BY precio_noche ASC";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':hospedaje_id', $hospedaje_id, PDO::PARAM_INT);
        } else {
            // Get all rooms
            $query = "SELECT h.*, ho.nombre as hospedaje_nombre FROM habitaciones h 
                      JOIN hospedajes ho ON h.hospedaje_id = ho.id 
                      WHERE h.activo = TRUE ORDER BY h.hospedaje_id, h.precio_noche ASC";
            $stmt = $db->prepare($query);
        }

        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Decode JSON fields
        foreach ($items as &$item) {
            if (isset($item['amenidades']) && is_string($item['amenidades'])) {
                $decoded = json_decode($item['amenidades']);
                $item['amenidades'] = $decoded !== null ? $decoded : [];
            }
            if (isset($item['imagenes']) && is_string($item['imagenes'])) {
                $decoded = json_decode($item['imagenes']);
                $item['imagenes'] = $decoded !== null ? $decoded : [];
            }
        }

        echo json_encode($items);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $e->getMessage()]);
    }
} else {
    http_response_code(500);
    echo json_encode(["message" => "Error de conexión a BD"]);
}
