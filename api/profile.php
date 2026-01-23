<?php
/**
 * Password Recovery & Profile Management API
 * Handles: forgot password, reset password, profile updates
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../src/Config/Database.php';

use Config\Database;

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

    // ===== FORGOT PASSWORD =====
    if ($action === 'forgot_password') {
        $email = trim($input['email'] ?? '');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Email inválido']);
            exit;
        }

        // Check if user exists
        $stmt = $db->prepare("SELECT id, name FROM users WHERE email = :email AND oauth_provider = 'email' LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Don't reveal if email exists (security)
            echo json_encode(['success' => true, 'message' => 'Si el email existe, recibirás instrucciones para recuperar tu contraseña']);
            exit;
        }

        // Generate reset token
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Save token
        $stmt = $db->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (:user_id, :token, :expires_at)");
        $stmt->execute([
            ':user_id' => $user['id'],
            ':token' => $token,
            ':expires_at' => $expiresAt
        ]);

        // Send email with reset link
        require_once __DIR__ . '/../includes/EmailService.php';
        $emailService = new EmailService();
        $resetLink = "http://localhost/candelaria/reset_password.php?token=" . $token;
        
        $emailSent = $emailService->sendPasswordReset($email, $user['name'], $resetLink);
        
        // Always return success (security: don't reveal if email exists)
        echo json_encode([
            'success' => true,
            'message' => 'Si el email existe, recibirás instrucciones para recuperar tu contraseña',
            'email_sent' => $emailSent,
            'debug_link' => $resetLink // Remove in production
        ]);
    }
    // ===== RESET PASSWORD =====
    elseif ($action === 'reset_password') {
        $token = $input['token'] ?? '';
        $newPassword = $input['password'] ?? '';

        if (empty($token) || empty($newPassword)) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            exit;
        }

        if (strlen($newPassword) < 6) {
            echo json_encode(['success' => false, 'message' => 'La contraseña debe tener al menos 6 caracteres']);
            exit;
        }

        // Verify token
        $stmt = $db->prepare("
            SELECT pr.id, pr.user_id, u.email 
            FROM password_resets pr
            JOIN users u ON pr.user_id = u.id
            WHERE pr.token = :token 
            AND pr.expires_at > NOW() 
            AND pr.used_at IS NULL
            LIMIT 1
        ");
        $stmt->execute([':token' => $token]);
        $reset = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$reset) {
            echo json_encode(['success' => false, 'message' => 'Token inválido o expirado']);
            exit;
        }

        // Update password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute([
            ':password' => $hashedPassword,
            ':id' => $reset['user_id']
        ]);

        // Mark token as used
        $stmt = $db->prepare("UPDATE password_resets SET used_at = NOW() WHERE id = :id");
        $stmt->execute([':id' => $reset['id']]);

        echo json_encode(['success' => true, 'message' => 'Contraseña actualizada correctamente']);
    }
    // ===== UPDATE PROFILE =====
    elseif ($action === 'update_profile') {
        $userId = $input['user_id'] ?? 0;
        $name = trim($input['name'] ?? '');

        if (!$userId || empty($name)) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            exit;
        }

        // Update name
        $stmt = $db->prepare("UPDATE users SET name = :name WHERE id = :id");
        $stmt->execute([
            ':name' => $name,
            ':id' => $userId
        ]);

        // Get updated user
        $stmt = $db->prepare("SELECT id, name, email, picture, oauth_provider FROM users WHERE id = :id");
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode([
            'success' => true,
            'message' => 'Perfil actualizado',
            'user' => [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'picture' => $user['picture'] ?: 'https://ui-avatars.com/api/?name=' . urlencode($user['name']),
                'provider' => $user['oauth_provider']
            ]
        ]);
    }
    // ===== CHANGE PASSWORD =====
    elseif ($action === 'change_password') {
        $userId = $input['user_id'] ?? 0;
        $currentPassword = $input['current_password'] ?? '';
        $newPassword = $input['new_password'] ?? '';

        if (!$userId || empty($currentPassword) || empty($newPassword)) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            exit;
        }

        if (strlen($newPassword) < 6) {
            echo json_encode(['success' => false, 'message' => 'La nueva contraseña debe tener al menos 6 caracteres']);
            exit;
        }

        // Get current password
        $stmt = $db->prepare("SELECT password FROM users WHERE id = :id AND oauth_provider = 'email'");
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($currentPassword, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Contraseña actual incorrecta']);
            exit;
        }

        // Update password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute([
            ':password' => $hashedPassword,
            ':id' => $userId
        ]);

        echo json_encode(['success' => true, 'message' => 'Contraseña cambiada correctamente']);
    }
    else {
        echo json_encode(['success' => false, 'message' => 'Acción no reconocida']);
    }

} catch (Exception $e) {
    error_log("Profile API Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
}
?>
