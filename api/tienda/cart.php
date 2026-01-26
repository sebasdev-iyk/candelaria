<?php
/**
 * Cart Sync API
 * Sync local cart with database for persistent experience across devices.
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../../src/Config/Database.php';

use Config\Database;

// Auth Check
$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? '';
$token = '';
if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    $token = $matches[1];
}

// Simple Session Check as fallback/primary for V1
if (session_status() === PHP_SESSION_NONE)
    session_start();
$userId = $_SESSION['user_id'] ?? null;

// TODO: Validate Token against Supabase or DB if session is empty (omitted for speed, relying on known session pattern)

if (!$userId) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$database = new Database();
$db = $database->connect('mipuno_candelaria');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Load Cart
    try {
        $stmt = $db->prepare("
            SELECT c.producto_id as id, c.cantidad as qty, p.nombre, p.precio, p.imagen_principal as imagen 
            FROM tienda_carrito c
            JOIN tienda_productos p ON c.producto_id = p.id
            WHERE c.usuario_id = :uid
        ");
        $stmt->execute([':uid' => $userId]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cast types
        foreach ($items as &$item) {
            $item['id'] = (int) $item['id'];
            $item['qty'] = (int) $item['qty'];
            $item['precio'] = (float) $item['precio'];
        }

        echo json_encode(['success' => true, 'cart' => $items]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sync/Merge Cart
    // Input: Full Cart Array from Client
    $input = json_decode(file_get_contents('php://input'), true);
    $clientCart = $input['cart'] ?? [];

    if (!is_array($clientCart)) {
        echo json_encode(['success' => false, 'message' => 'Invalid Format']);
        exit;
    }

    try {
        $db->beginTransaction();

        // Strategy: Clear User's DB Cart and Rewrite (Easiest for sync integrity)
        // Optimization: Merging logic could be complex, overwriting serves the "Save my state" use case well if client is master.
        // Better Strategy for "Sync": 
        // 1. Delete all current items.
        // 2. Insert new items.

        $stmt = $db->prepare("DELETE FROM tienda_carrito WHERE usuario_id = :uid");
        $stmt->execute([':uid' => $userId]);

        $insertStmt = $db->prepare("INSERT INTO tienda_carrito (usuario_id, producto_id, cantidad) VALUES (:uid, :pid, :qty)");

        foreach ($clientCart as $item) {
            $pid = $item['id'];
            $qty = $item['qty'];
            if ($pid && $qty > 0) {
                $insertStmt->execute([':uid' => $userId, ':pid' => $pid, ':qty' => $qty]);
            }
        }

        $db->commit();
        echo json_encode(['success' => true, 'message' => 'Cart Synced']);

    } catch (Exception $e) {
        $db->rollBack();
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>