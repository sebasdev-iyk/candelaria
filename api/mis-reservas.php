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

try {
    // 1. Include Database
    $dbFile = '../src/Config/Database.php';
    if (!file_exists($dbFile))
        throw new Exception("Database file not found at: $dbFile");
    include_once $dbFile;

    // 2. Include Middleware
    $middlewareFile = '../includes/supabase-middleware.php';
    if (!file_exists($middlewareFile))
        throw new Exception("Middleware file not found at: $middlewareFile");
    include_once $middlewareFile;

    // Move 'use' to global scope if possible, but inside try it's okay IF it is followed by usage? 
    // Actually, 'use' import must be at file scope or namespace scope. 
    // To be safe, we will use fully qualified name or just rely on the previous fix (moving use up)
    // But since I am rewriting the file, I need to put use at top. 
    // Wait, I can't put 'use' at top if I include files inside try cache? 
    // Include files SHOULD be at top. Let's move them out of try/catch if we want to be safe, 
    // OR just use fully qualified names: new \Config\Database();

    // Lets restructure nicely.
    throw new Exception("Restarting Logic structure below...");

} catch (Exception $dummy) {
    // Just a placeholder to break flow, real code below
}
ob_end_clean(); // Clean buffer

// --- REAL SCRIPT START ---
ob_start();
try {
    // Includes
    if (!file_exists('../src/Config/Database.php'))
        throw new Exception("../src/Config/Database.php missing");
    include_once '../src/Config/Database.php';

    if (!file_exists('../includes/supabase-middleware.php'))
        throw new Exception("../includes/supabase-middleware.php missing");
    include_once '../includes/supabase-middleware.php';

    // Connect
    $database = new \Config\Database(); // Use FQCN to avoid 'use' placement issues
    $db = $database->connect('mipuno_candelaria');

    if (!$db) {
        throw new Exception("Database connection returned null");
    }

    // Auth
    $user = requireAuth();
    if (!$user || !isset($user['id'])) {
        throw new Exception("Authentication passed but no user ID found");
    }
    $userId = $user['id'];

    // Query - CORRECTED COLUMN NAME
    // Changed 'ho.imagen' to 'ho.imagenes'
    $query = "SELECT r.*, h.nombre as habitacion_nombre, ho.nombre as hospedaje_nombre, ho.imagenes
              FROM reservaciones r
              JOIN habitaciones h ON r.habitacion_id = h.id
              JOIN hospedajes ho ON r.hospedaje_id = ho.id
              WHERE r.user_id = :user_id
              ORDER BY r.created_at DESC";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $userId);

    if (!$stmt->execute()) {
        $err = $stmt->errorInfo();
        throw new Exception("Execute failed: " . $err[2]);
    }

    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Process images
    foreach ($reservations as &$res) {
        $img = null;
        // Parse 'imagenes' JSON
        if (isset($res['imagenes'])) {
            $decoded = json_decode($res['imagenes'], true);
            if (is_string($decoded))
                $decoded = json_decode($decoded, true); // Double parse check

            if (is_array($decoded) && count($decoded) > 0) {
                $img = $decoded[0]; // Take first image
            }
        }

        // Fix path if needed (logic from panel_hotel.php)
        if ($img) {
            // Ensure prefix
            if (!str_starts_with($img, 'http') && !str_starts_with($img, 'assets/')) {
                $img = 'assets/uploads/' . $img; // Fallback guess
            }
            // Actually, verify what frontend expects. 
            // Frontend uses: src="${r.hospedaje_imagen || 'assets/placeholder.png'}"
        }

        $res['hospedaje_imagen'] = $img;
        unset($res['imagenes']); // Clean up
    }

    ob_end_clean();
    echo json_encode($reservations);

} catch (Throwable $e) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode([
        "message" => "Internal Server Error",
        "error" => $e->getMessage(),
        "file" => basename($e->getFile()),
        "line" => $e->getLine()
    ]);
}
?>