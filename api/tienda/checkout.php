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

// --- EXTREME DEBUGGING ---
error_log("🔥 [CHECKOUT API] Hit received.");
$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? '';
error_log("🔥 [CHECKOUT API] Auth Header: " . $authHeader);

// 2. Auth Check (Bearer Token)
$token = '';
if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    $token = $matches[1];
}

// Check PHP Session first
if (session_status() === PHP_SESSION_NONE)
    session_start();
$userId = $_SESSION['user_id'] ?? null;
error_log("🔥 [CHECKOUT API] Session UserID: " . ($userId ?? 'NULL'));

// Fallback: Decode Supabase JWT
if (!$userId && $token) {
    try {
        $parts = explode('.', $token);
        if (count($parts) === 3) {
            $payload = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', $parts[1]))), true);
            if (isset($payload['sub'])) {
                error_log("🔥 [CHECKOUT API] JWT Decoded. UserID found: " . $payload['sub']);
                $userId = $payload['sub'];
            }
        }
    } catch (Exception $e) {
        error_log("🔥 [CHECKOUT API] JWT Error: " . $e->getMessage());
    }
}

if (!$userId) {
    error_log("🔥 [CHECKOUT API] CRITICAL: Unauthorized access attempt.");
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