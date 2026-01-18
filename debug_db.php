<?php
use Config\Database;
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

echo json_encode(["step" => "Starting debug"]) . "\n";

try {
    include_once 'src/Config/Database.php';


    echo json_encode(["step" => "Database class loaded"]) . "\n";

    $database = new Database();
    echo json_encode(["step" => "Database object created"]) . "\n";

    $db = $database->connect('mipuno_candelaria');

    if (!$db) {
        echo json_encode(["error" => "Connection returned null"]) . "\n";
        exit();
    }

    echo json_encode(["step" => "Connected to database"]) . "\n";

    // Check tables
    $stmt = $db->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode(["tables" => $tables]) . "\n";

    // Check if clientes table exists
    $stmt = $db->query("DESCRIBE clientes");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode(["clientes_columns" => $columns]) . "\n";

    // Check reservaciones table
    $stmt = $db->query("DESCRIBE reservaciones");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode(["reservaciones_columns" => $columns]) . "\n";

    echo json_encode(["success" => true, "message" => "All checks passed!"]) . "\n";

} catch (Exception $e) {
    echo json_encode([
        "error" => $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine()
    ]) . "\n";
}
