<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include database and auth helpers
include_once '../src/Config/Database.php';
use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

// Chat messages file path
$chatFile = __DIR__ . '/../live-platform/data/chat_messages.json';

// Helper: Read chat messages
function readChatMessages($file)
{
    if (!file_exists($file)) {
        return [];
    }
    $content = file_get_contents($file);
    return json_decode($content, true) ?: [];
}

// Helper: Write chat messages
function writeChatMessages($file, $messages)
{
    file_put_contents($file, json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Helper: Validate token and get user
function validateToken($token, $db)
{
    if (!$token)
        return null;

    $decoded = base64_decode($token);
    $parts = explode(':', $decoded);

    if (count($parts) < 3)
        return null;

    $clientId = intval($parts[0]);

    $stmt = $db->prepare("SELECT id, nombre, email FROM clientes WHERE id = :id");
    $stmt->bindParam(':id', $clientId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Get Authorization header (with multiple fallback methods for shared hosting)
function getAuthHeader()
{
    $headers = null;

    // Method 1: Direct $_SERVER
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    // Method 2: HTTP_AUTHORIZATION (most common)
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    }
    // Method 3: REDIRECT_HTTP_AUTHORIZATION (for some Apache configs)
    else if (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
        $headers = trim($_SERVER["REDIRECT_HTTP_AUTHORIZATION"]);
    }
    // Method 4: apache_request_headers()
    else if (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        if ($requestHeaders) {
            foreach ($requestHeaders as $key => $value) {
                if (strtolower($key) === 'authorization') {
                    $headers = trim($value);
                    break;
                }
            }
        }
    }

    return $headers;
}

// Generate a random color for new users
function getUserColor($name)
{
    $colors = ['#ef4444', '#3b82f6', '#10b981', '#8b5cf6', '#f59e0b', '#ec4899', '#06b6d4', '#f97316'];
    $hash = crc32($name);
    return $colors[abs($hash) % count($colors)];
}

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($method === 'GET' && $action === 'messages') {
    // Get messages for a stream
    $streamId = isset($_GET['stream_id']) ? $_GET['stream_id'] : 'default';
    $lastId = isset($_GET['last_id']) ? intval($_GET['last_id']) : 0;

    $allMessages = readChatMessages($chatFile);
    $streamMessages = isset($allMessages[$streamId]) ? $allMessages[$streamId] : [];

    // Filter messages after lastId for polling
    if ($lastId > 0) {
        $streamMessages = array_filter($streamMessages, function ($msg) use ($lastId) {
            return $msg['id'] > $lastId;
        });
        $streamMessages = array_values($streamMessages);
    }

    // Return only last 50 messages (or new ones if polling)
    $streamMessages = array_slice($streamMessages, -50);

    echo json_encode([
        'success' => true,
        'messages' => $streamMessages
    ]);

} elseif ($method === 'POST' && $action === 'send') {
    // Send a message (requires auth)
    $authHeader = getAuthHeader();

    if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para enviar mensajes']);
        exit();
    }

    $user = validateToken($matches[1], $db);

    if (!$user) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Token inválido. Por favor inicia sesión nuevamente.']);
        exit();
    }

    // Parse request body
    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->message) || trim($data->message) === '') {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'El mensaje no puede estar vacío']);
        exit();
    }

    $streamId = isset($data->stream_id) ? $data->stream_id : 'default';
    $messageText = htmlspecialchars(trim($data->message));

    // Limit message length
    if (strlen($messageText) > 200) {
        $messageText = substr($messageText, 0, 200);
    }

    // Read existing messages
    $allMessages = readChatMessages($chatFile);

    if (!isset($allMessages[$streamId])) {
        $allMessages[$streamId] = [];
    }

    // Get last ID
    $lastId = 0;
    foreach ($allMessages as $stream => $msgs) {
        foreach ($msgs as $msg) {
            if ($msg['id'] > $lastId)
                $lastId = $msg['id'];
        }
    }

    // Create new message
    $newMessage = [
        'id' => $lastId + 1,
        'user_id' => $user['id'],
        'user' => $user['nombre'],
        'message' => $messageText,
        'color' => getUserColor($user['nombre']),
        'timestamp' => time()
    ];

    $allMessages[$streamId][] = $newMessage;

    // Keep only last 100 messages per stream
    if (count($allMessages[$streamId]) > 100) {
        $allMessages[$streamId] = array_slice($allMessages[$streamId], -100);
    }

    // Save messages
    writeChatMessages($chatFile, $allMessages);

    echo json_encode([
        'success' => true,
        'message' => $newMessage
    ]);

} elseif ($action === 'heartbeat') {
    // Register viewer presence (heartbeat)
    $streamId = isset($_GET['stream_id']) ? $_GET['stream_id'] : 'default';
    $viewersFile = __DIR__ . '/../live-platform/data/viewers.json';

    // Generate unique viewer ID from IP + User Agent
    $viewerId = md5($_SERVER['REMOTE_ADDR'] . ($_SERVER['HTTP_USER_AGENT'] ?? ''));

    // Read current viewers
    $viewers = [];
    if (file_exists($viewersFile)) {
        $content = file_get_contents($viewersFile);
        $viewers = json_decode($content, true) ?: [];
    }

    // Initialize stream viewers if not exists
    if (!isset($viewers[$streamId])) {
        $viewers[$streamId] = [];
    }

    // Update viewer timestamp
    $viewers[$streamId][$viewerId] = time();

    // Clean old viewers (inactive for more than 30 seconds)
    $cutoffTime = time() - 30;
    foreach ($viewers as $stream => &$streamViewers) {
        $streamViewers = array_filter($streamViewers, function ($timestamp) use ($cutoffTime) {
            return $timestamp > $cutoffTime;
        });
    }

    // Save viewers
    file_put_contents($viewersFile, json_encode($viewers, JSON_PRETTY_PRINT));

    // Count active viewers for this stream
    $activeCount = count($viewers[$streamId] ?? []);

    echo json_encode([
        'success' => true,
        'viewers' => $activeCount
    ]);

} elseif ($action === 'viewers') {
    // Get viewer count without registering
    $streamId = isset($_GET['stream_id']) ? $_GET['stream_id'] : 'default';
    $viewersFile = __DIR__ . '/../live-platform/data/viewers.json';

    $viewers = [];
    if (file_exists($viewersFile)) {
        $content = file_get_contents($viewersFile);
        $viewers = json_decode($content, true) ?: [];
    }

    // Clean old viewers
    $cutoffTime = time() - 30;
    if (isset($viewers[$streamId])) {
        $viewers[$streamId] = array_filter($viewers[$streamId], function ($timestamp) use ($cutoffTime) {
            return $timestamp > $cutoffTime;
        });
    }

    $activeCount = count($viewers[$streamId] ?? []);

    echo json_encode([
        'success' => true,
        'viewers' => $activeCount
    ]);

} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Acción no válida']);
}
