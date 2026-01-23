<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "Starting debug...<br>";

$dbPath = '../src/Config/Database.php';
echo "Checking DB Path: " . (file_exists($dbPath) ? "EXISTS" : "MISSING") . "<br>";
include_once $dbPath;

$mwPath = '../includes/supabase-middleware.php';
echo "Checking Middleware Path: " . (file_exists($mwPath) ? "EXISTS" : "MISSING") . "<br>";
include_once $mwPath;

echo "Classes loaded. Connecting DB...<br>";
use Config\Database;
$database = new Database();
$db = $database->connect('mipuno_candelaria');

if (!$db) {
    die("DB Connection failed");
}
echo "DB Connected.<br>";

// Test Auth
echo "Calling requireAuth()...<br>";
try {
    $user = requireAuth();
    echo "Auth Successful. User ID: " . $user['id'] . "<br>";

    // Test Query
    echo "Testing Query...<br>";
    $userId = $user['id'];
    $query = "SELECT r.*, h.nombre as habitacion_nombre, ho.nombre as hospedaje_nombre, ho.imagen as hospedaje_imagen
              FROM reservaciones r
              JOIN habitaciones h ON r.habitacion_id = h.id
              JOIN hospedajes ho ON r.hospedaje_id = ho.id
              WHERE r.user_id = :user_id
              ORDER BY r.created_at DESC";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Query Successful. Found " . count($res) . " rows.<br>";

} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "<br>";
} catch (Error $e) {
    echo "Fatal Error: " . $e->getMessage() . "<br>";
}

echo "Done.";
?>