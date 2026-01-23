<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// DEBUG LOGGING
function dbg($msg) {
    file_put_contents('debug_log.txt', date('[Y-m-d H:i:s] ') . $msg . "\n", FILE_APPEND);
}

dbg("Script started");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    dbg("Including files...");
    if (!file_exists('../src/Config/Database.php')) dbg("ERROR: ../src/Config/Database.php not found");
    include_once '../src/Config/Database.php';
    
    if (!file_exists('../includes/supabase-middleware.php')) dbg("ERROR: ../includes/supabase-middleware.php not found");
    include_once '../includes/supabase-middleware.php';
    
    use Config\Database;

    dbg("Connecting DB...");
    $database = new Database();
    $db = $database->connect('mipuno_candelaria');

    if (!$db) {
        dbg("DB Connection failed");
        http_response_code(500);
        echo json_encode(["message" => "Error de conexión a BD"]);
        exit();
    }
    dbg("DB Connected");

    // Require Authentication
    dbg("Checking Auth...");
    $user = requireAuth();
    if (!$user) {
        dbg("Auth failed or returned null");
        exit(); // requireAuth should handle exit, but just in case
    }
    
    $userId = $user['id']; // Supabase UUID
    dbg("Auth OK. UserID: " . $userId);

    $query = "SELECT r.*, h.nombre as habitacion_nombre, ho.nombre as hospedaje_nombre, ho.imagen as hospedaje_imagen
              FROM reservaciones r
              JOIN habitaciones h ON r.habitacion_id = h.id
              JOIN hospedajes ho ON r.hospedaje_id = ho.id
              WHERE r.user_id = :user_id
              ORDER BY r.created_at DESC";

    dbg("Preparing Statement...");
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $userId);
    
    dbg("Executing Query...");
    $stmt->execute();
    
    dbg("Fetching results...");
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    dbg("Found " . count($reservations) . " rows");

    echo json_encode($reservations);
    dbg("Done.");

} catch (Exception $e) {
    dbg("EXCEPTION: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["message" => "Error: " . $e->getMessage()]);
}
?>