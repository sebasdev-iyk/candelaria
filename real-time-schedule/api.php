<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// En un caso real, aquí conectaríamos a la base de datos MySQL
// Por ahora, leemos el archivo JSON local
$json_data = file_get_contents('data.json');

// Podríamos añadir lógica aquí para filtrar por día si fuera necesario
// $day = $_GET['day'] ?? 'all';

echo $json_data;
?>
