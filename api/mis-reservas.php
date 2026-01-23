<?php
// Prevent any output before JSON
ob_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Enable error reporting but capture it
error_reporting(E_ALL);
ini_set('display_errors', 0); // Do NOT display errors to stdout, we will capture them

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$debug = [];

try {
    // 1. Include Database
    $dbFile = '../src/Config/Database.php';
    if (!file_exists($dbFile)) throw new Exception("Database file not found at: $dbFile");
    include_once $dbFile;
    
    // 2. Include Middleware
    $middlewareFile = '../includes/supabase-middleware.php';
    if (!file_exists($middlewareFile)) throw new Exception("Middleware file not found at: $middlewareFile");
    include_once $middlewareFile;
    
    use Config\Database;

    // 3. Connect DB
    $database = new Database();
    $db = $database->connect('mipuno_candelaria');

    if (!$db) {
        throw new Exception("Database connection returned null");
    }

    // 4. Auth
    // requireAuth() might exit(), so we rely on its behavior or wrapped it?
    // supabase-middleware.php's requireAuth exits on failure. We assume it works if we get past it.
    // However, if it fails, it returns 401 JSON.
    $user = requireAuth(); 
    
    if (!$user || !isset($user['id'])) {
        throw new Exception("Authentication passed but no user ID found");
    }
    
    $userId = $user['id'];

    // 5. Query
    $query = "SELECT r.*, h.nombre as habitacion_nombre, ho.nombre as hospedaje_nombre, ho.imagen as hospedaje_imagen
              FROM reservaciones r
              JOIN habitaciones h ON r.habitacion_id = h.id
              JOIN hospedajes ho ON r.hospedaje_id = ho.id
              WHERE r.user_id = :user_id
              ORDER BY r.created_at DESC";

    $stmt = $db->prepare($query);
    if(!$stmt) throw new Exception("Prepare failed: " . implode(" ", $db->errorInfo()));
    
    $stmt->bindParam(':user_id', $userId);
    
    if(!$stmt->execute()) throw new Exception("Execute failed: " . implode(" ", $stmt->errorInfo()));
    
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Success
    ob_end_clean(); // Discard any garbage (db connection warnings etc)
    echo json_encode($reservations);

} catch (Throwable $e) { // Catch Errors and Exceptions
    ob_end_clean(); // Clear buffer
    http_response_code(500);
    echo json_encode([
        "message" => "Internal Server Error",
        "error" => $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine()
    ]);
}
?>