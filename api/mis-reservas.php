<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    // 1. Include Database
    $dbFile = '../src/Config/Database.php';
    if (!file_exists($dbFile))
        throw new Exception("Database file missing");
    include_once $dbFile;

    // 2. Include Middleware
    $middlewareFile = '../includes/supabase-middleware.php';
    if (!file_exists($middlewareFile))
        throw new Exception("Middleware missing");
    include_once $middlewareFile;

    // 3. Connect DB
    $database = new \Config\Database();
    $db = $database->connect('mipuno_candelaria');

    if (!$db)
        throw new Exception("DB Connection error");

    // 4. Auth
    $user = requireAuth();
    if (!$user || !isset($user['id']))
        throw new Exception("Unauthorized");

    $userId = $user['id'];

    // 5. Query
    $query = "SELECT r.*, h.nombre as habitacion_nombre, ho.nombre as hospedaje_nombre, ho.imagenes
              FROM reservaciones r
              JOIN habitaciones h ON r.habitacion_id = h.id
              JOIN hospedajes ho ON r.hospedaje_id = ho.id
              WHERE r.user_id = :user_id
              ORDER BY r.created_at DESC";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $userId);

    if (!$stmt->execute())
        throw new Exception("Query failed");

    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Clean data (remove raw images since frontend isn't using them anymore)
    foreach ($reservations as &$res) {
        unset($res['imagenes']);
    }

    echo json_encode($reservations);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(["message" => "Server Error: " . $e->getMessage()]);
}
?>