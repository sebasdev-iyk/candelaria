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
include_once '../includes/supabase-middleware.php';
use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if (!$db) {
    http_response_code(500);
    echo json_encode(["message" => "Error de conexión a BD"]);
    exit();
}

// Require Authentication
$user = requireAuth();
$userId = $user['id']; // Supabase UUID

try {
    $query = "SELECT r.*, h.nombre as habitacion_nombre, ho.nombre as hospedaje_nombre, ho.imagen as hospedaje_imagen
              FROM reservaciones r
              JOIN habitaciones h ON r.habitacion_id = h.id
              JOIN hospedajes ho ON r.hospedaje_id = ho.id
              WHERE r.user_id = :user_id
              ORDER BY r.created_at DESC";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($reservations);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["message" => "Error al obtener reservaciones: " . $e->getMessage()]);
}
?>