<?php
// Email/Password Authentication Endpoint
header('Content-Type: application/json');
require_once __DIR__ . '/../src/Config/Database.php';

use Config\Database;

// Get JSON Input
$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';

if (!$input || !$action) {
    echo json_encode(['success' => false, 'message' => 'Acción inválida']);
    exit;
}

try {
    $database = new Database();
    $db = $database->connect('mipuno_candelaria');

    if (!$db) {
        throw new Exception("Error de conexión a la base de datos");
    }

    // ===== REGISTER =====
    if ($action === 'register') {
        $name = trim($input['name'] ?? '');
        $email = trim($input['email'] ?? '');
        $password = $input['password'] ?? '';

        // Validation
        if (empty($name) || empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Email inválido']);
            exit;
        }

        if (strlen($password) < 6) {
            echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 6 caracteres']);
            exit;
        }

        // Check if email already exists
        $stmt = $db->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Este email ya está registrado']);
            exit;
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $insertStmt = $db->prepare("INSERT INTO users (name, email, password, oauth_provider, oauth_uid) VALUES (:name, :email, :password, 'email', :uid)");
        $insertStmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':uid' => uniqid('email_')
        ]);

        $userId = $db->lastInsertId();

        // Start session
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
        $logger->log($userId, 'register', 'Registro de nueva cuenta con email');

        // Update last login
        $db->prepare("UPDATE users SET last_login_at = NOW() WHERE id = :id")->execute([':id' => $userId]);

        echo json_encode([
            'success' => true,
            'message' => 'Cuenta creada exitosamente',
            'user' => [
                'id' => $userId,
                'name' => $name,
                'email' => $email,
                'picture' => 'https://ui-avatars.com/api/?name=' . urlencode($name),
                'provider' => 'email'
            ]
        ]);
    }
    // ===== LOGIN =====
    elseif ($action === 'login') {
        $email = trim($input['email'] ?? '');
        $password = $input['password'] ?? '';

        if (empty($email) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Email y contraseña son obligatorios']);
            exit;
        }

        // Find user
        $stmt = $db->prepare("SELECT id, name, email, password FROM users WHERE email = :email AND oauth_provider = 'email' LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo json_encode(['success' => false, 'message' => 'Email o contraseña incorrectos']);
            exit;
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Email o contraseña incorrectos']);
            exit;
        }

        // Start session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['logged_in'] = true;

        echo json_encode([
            'success' => true,
            'message' => 'Inicio de sesión exitoso',
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'picture' => 'https://ui-avatars.com/api/?name=' . urlencode($user['name']),
                'provider' => 'email'
            ]
        ]);
    }
    else {
        echo json_encode(['success' => false, 'message' => 'Acción no reconocida']);
    }

} catch (Exception $e) {
    error_log("Auth Email Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
}
?>
