<?php
// API Endpoint for Social Auth / Session Management
header('Content-Type: application/json');
require_once __DIR__ . '/../src/Config/Database.php';

use Config\Database;

// 1. Get JSON Input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

// 2. Extract User Data
$email = $input['email'] ?? '';
$name = $input['name'] ?? '';
$picture = $input['picture'] ?? '';
$provider = $input['provider'] ?? 'email'; // google, facebook
$oauth_uid = $input['id'] ?? ''; // Optional: Provider user ID if available

if (empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Email is required']);
    exit;
}

try {
    // 3. Connect to DB
    $database = new Database();
    $db = $database->connect('mipuno_candelaria');

    if (!$db) {
        throw new Exception("Database connection failed");
    }

    // 4. Check if user exists
    $stmt = $db->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // UPDATE existing user
        $updateStmt = $db->prepare("UPDATE users SET name = :name, picture = :picture, oauth_provider = :provider, updated_at = NOW() WHERE id = :id");
        $updateStmt->execute([
            ':name' => $name, 
            ':picture' => $picture, 
            ':provider' => $provider,
            ':id' => $user['id']
        ]);
        $userId = $user['id'];
    } else {
        // INSERT new user
        // Note: oauth_uid might be null or generated. For now we use email as main key if uid missing.
        $uid = $oauth_uid ?: uniqid('user_'); 
        
        $insertStmt = $db->prepare("INSERT INTO users (name, email, picture, oauth_provider, oauth_uid) VALUES (:name, :email, :picture, :provider, :uid)");
        $insertStmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':picture' => $picture,
            ':provider' => $provider,
            ':uid' => $uid
        ]);
        $userId = $db->lastInsertId();
    }

    // 5. Start Session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['user_id'] = $userId;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;
    $_SESSION['logged_in'] = true;

    // Log activity
    require_once __DIR__ . '/../includes/ActivityLogger.php';
    $logger = new ActivityLogger();
    $logger->log($userId, 'login', 'Inicio de sesión con ' . $provider, ['provider' => $provider]);

    // Update last login
    $db->prepare("UPDATE users SET last_login_at = NOW() WHERE id = :id")->execute([':id' => $userId]);

    echo json_encode([
        'success' => true, 
        'message' => 'Session created',
        'user_id' => $userId
    ]);

} catch (Exception $e) {
    error_log("Auth Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
?>
