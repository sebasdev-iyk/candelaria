<?php
// API Endpoint for User Profile Updates (Sync to Reservations History)
// Path: candelaria/api/user_update.php

header('Content-Type: application/json');

// 1. Error Reporting (Log only)
ini_set('display_errors', 0);
ini_set('log_errors', 1);

try {
    // 2. Load Dependencies
    $dbFile = '../src/Config/Database.php';
    $middlewareFile = '../includes/supabase-middleware.php';

    if (!file_exists($dbFile) || !file_exists($middlewareFile)) {
        throw new Exception("Server configuration error: Missing dependencies");
    }

    require_once $dbFile;
    require_once $middlewareFile;

    use Config\Database;

    // 3. Validate Request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Method not allowed', 405);
    }

    // 4. Authenticate via Supabase Middleware (Truth Source)
    // This checks the Bearer token or Cookie and returns the UUID
    $user = requireAuth(); 
    
    if (!$user || empty($user['id'])) {
        throw new Exception('Unauthorized', 401);
    }

    $supabaseId = $user['id']; // UUID

    // 5. Get Input
    $input = json_decode(file_get_contents('php://input'), true);
    $name = trim($input['name'] ?? '');
    // We don't sync picture toreservations as that table doesn't support it, 
    // but the API accepts it for future extensibility.

    if (empty($name)) {
        throw new Exception('Name cannot be empty', 400);
    }

    // 6. Connect to DB
    $database = new Database();
    $db = $database->connect('mipuno_candelaria');

    if (!$db) {
        throw new Exception("Database connection failed");
    }

    // 7. Sync Logic: Update history in 'reservaciones'
    // We update all references to this user's name in the reservations table
    $sql = "UPDATE reservaciones SET user_name = :name, updated_at = NOW() WHERE user_id = :uid";
    $stmt = $db->prepare($sql);
    
    $result = $stmt->execute([
        ':name' => $name,
        ':uid' => $supabaseId
    ]);

    // Optional: If you had a users/clientes sync, you would do it here.
    // For now, we only care about consistent reservation history.

    echo json_encode([
        'success' => true,
        'message' => 'Perfil y reservas actualizados',
        'affected_rows' => $stmt->rowCount()
    ]);

} catch (Exception $e) {
    $code = $e->getCode();
    http_response_code(is_int($code) && $code >= 400 && $code < 600 ? $code : 500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>
