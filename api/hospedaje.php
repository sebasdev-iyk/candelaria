<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/Config/Database.php';
use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if ($db) {
    try {
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;

        if ($id) {
            // Fetch single hospedaje by ID
            $query = "SELECT * FROM hospedajes WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $item = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($item) {
                // Decode JSON fields
                if (isset($item['servicios']) && is_string($item['servicios'])) {
                    $decoded = json_decode($item['servicios']);
                    $item['servicios'] = $decoded !== null ? $decoded : [];
                }
                if (isset($item['imagenes']) && is_string($item['imagenes'])) {
                    $decoded = json_decode($item['imagenes']);
                    $item['imagenes'] = $decoded !== null ? $decoded : [];
                }
                echo json_encode($item);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Hospedaje no encontrado"]);
            }
        } else {
            // Fetch all hospedajes
            $query = "SELECT * FROM hospedajes ORDER BY nombre ASC";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Decode JSON fields for each item
            foreach ($items as &$item) {
                if (isset($item['servicios']) && is_string($item['servicios'])) {
                    $decoded = json_decode($item['servicios']);
                    $item['servicios'] = $decoded !== null ? $decoded : [];
                }
                if (isset($item['imagenes']) && is_string($item['imagenes'])) {
                    $decoded = json_decode($item['imagenes']);
                    $item['imagenes'] = $decoded !== null ? $decoded : [];
                }
            }

            echo json_encode($items);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $e->getMessage()]);
    }
} else {
    http_response_code(500);
    echo json_encode(["message" => "Error de conexión a BD"]);
}
