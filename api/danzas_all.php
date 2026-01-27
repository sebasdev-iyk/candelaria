<?php
// api/danzas_all.php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: public, max-age=3600'); // Cachear por 1 hora en navegador/CDN

include_once '../src/Config/Database.php';

use Config\Database;

try {
    $database = new Database();
    $db = $database->connect('mipuno_candelaria'); // Aseguramos el nombre de la DB

    if ($db) {
        // NO usamos LIMIT ni WHERE. Traemos lo necesario para el listado.
        // Seleccionamos solo las comunas necesarias para reducir peso.
        $query = "SELECT id, conjunto, categoria, descripcion, foto, orden_concurso, dia_concurso, dia_veneracion, hora, detalles 
                  FROM candela_list 
                  ORDER BY orden_concurso ASC, conjunto ASC";

        $stmt = $db->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($data);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo conectar a la base de datos"]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Error en el servidor: " . $e->getMessage()]);
}
?>