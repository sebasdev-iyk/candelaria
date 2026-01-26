<?php
/**
 * Checkout API
 * Handles order creation from the Store Cart.
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../../src/Config/Database.php';

use Config\Database;

// 1. Validate Request Method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

// 2. Auth Check (Bearer Token)
$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? '';
$token = '';

if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    $token = $matches[1];
}

// 2.1 Verify Token (Simplified for V1: Check if user exists in DB via Supabase logic or Session)
// Ideally we verify Supabase JWT signature, but for velocity we'll trust the Client sending the ID 
// IF and ONLY IF we map it to our users table via the email/uid logic found in auth.php
// BUT better pattern: The client sends a Token. 
// A proper way: Decode token (if JWT) or just accept that the frontend authentication (Supabase) 
// has already happened and we are relying on the user_id sent in the body OR logic.
// HOWEVER, trusting body user_id is insecure. 
// Let's look at `api/reservar.php` approach (from hotel logic).
// Since I can't see `api/reservar.php`, I will implement a robust check:
// We will look up the user by the Supposed ID or Email if they are logged in via Session.

// Fallback: Check PHP Session
if (session_status() === PHP_SESSION_NONE)
    session_start();
$userId = $_SESSION['user_id'] ?? null;

// 3. Get Input Data
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON']);
    exit;
}

// If no session user, check if the input provides a way to validate (V2). 
// For now, we REQUIRE the user to be logged in (which sets $_SESSION via auth.php calls or Supabase sync).
// Wait, `auth.php` sets `$_SESSION['user_id']`. 
// If the JS `loginUser` was called, it hit `auth.php` and set the session.
// So `$_SESSION['user_id']` should be safe.

if (!$userId) {
    // Try to find user if token provided (advanced) or just fail.
    // Let's be strict for security.
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized. Please login.']);
    exit;
}

// 4. Validate Cart Data
$items = $input['items'] ?? [];
$total = $input['total'] ?? 0;
$contact = $input['contact'] ?? []; // Address, Phone

if (empty($items) || $total <= 0) {
    echo json_encode(['success' => false, 'message' => 'Cart is empty or invalid']);
    exit;
}

try {
    // 5. Connect DB
    $database = new Database();
    $db = $database->connect('mipuno_candelaria');

    // 6. Insert Order
    $query = "INSERT INTO tienda_pedidos (usuario_id, total, estado, metodo_pago, datos_contacto, items_json) 
              VALUES (:uid, :total, 'pendiente', 'yape_plin', :contact, :items)";

    $stmt = $db->prepare($query);
    $stmt->execute([
        ':uid' => $userId,
        ':total' => $total,
        ':contact' => json_encode($contact),
        ':items' => json_encode($items)
    ]);

    $orderId = $db->lastInsertId();

    // 7. Success Response
    echo json_encode([
        'success' => true,
        'message' => 'Order created successfully',
        'order_id' => $orderId
    ]);

} catch (Exception $e) {
    error_log("Checkout Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server Error: ' . $e->getMessage()]);
}
?>