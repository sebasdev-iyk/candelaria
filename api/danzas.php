<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/Config/Database.php';

use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if ($db) {
    try {
        $query = "SELECT * FROM candela_list ORDER BY conjunto ASC";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $danzas = $stmt->fetchAll();

        echo json_encode($danzas);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error al obtener danzas: " . $e->getMessage()]);
    }
} else {
    http_response_code(500);
    echo json_encode(["message" => "No se pudo conectar a la base de datos."]);
}
