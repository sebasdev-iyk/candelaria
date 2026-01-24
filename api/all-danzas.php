<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../src/Config/Database.php';

use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if ($db) {
    try {
        // Fetch ALL dances, ordered by ID or appropriate order
        // The user says "dependiendo el dia... tienen veneracion y estadio".
        // We select * to get all columns and figure out the grouping in frontend or here.
        // But for PDF we likely want them ordered by 'orden_concurso' or similar.

        $query = "SELECT * FROM candela_list ORDER BY orden_concurso ASC, conjunto ASC";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $danzas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($danzas);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["message" => "Error al obtener danzas: " . $e->getMessage()]);
    }
} else {
    http_response_code(500);
    echo json_encode(["message" => "No se pudo conectar a la base de datos."]);
}
