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
    $stmt = $db->prepare("SELECT id FROM usuarios WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // UPDATE existing user (Sync Name)
        $updateStmt = $db->prepare("UPDATE usuarios SET full_name = :name WHERE id = :id");
        $updateStmt->execute([
            ':name' => $name,
            ':id' => $user['id']
        ]);
        $userId = $user['id'];
    } else {
        // INSERT new user
        // 'usuarios' table requires: email, password, full_name.
        // Since this is Social Login/Supabase, we generate a random password.
        $randomPass = bin2hex(random_bytes(16));
        $passHash = password_hash($randomPass, PASSWORD_DEFAULT);

        $insertStmt = $db->prepare("INSERT INTO usuarios (full_name, email, password) VALUES (:name, :email, :pass)");
        $insertStmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':pass' => $passHash
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

    // Log activity (Try/Catch to avoid crashing if Logger fails or table missing)
    try {
        if (file_exists(__DIR__ . '/../includes/ActivityLogger.php')) {
            require_once __DIR__ . '/../includes/ActivityLogger.php';
            $logger = new ActivityLogger();
            $logger->log($userId, 'login', 'Inicio de sesión (Sync) con ' . $provider);
        }
    } catch (Exception $logErr) {
        // Ignore logging errors
    }

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