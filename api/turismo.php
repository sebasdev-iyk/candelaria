<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/Config/Database.php';
use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if ($db) {
    try {
        $query = "SELECT * FROM turismo ORDER BY nombre ASC";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($items);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error: " . $e->getMessage()]);
    }
} else {
    http_response_code(500);
    echo json_encode(["message" => "Error de conexión a BD"]);
}
