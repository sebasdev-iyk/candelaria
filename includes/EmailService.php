<?php
/**
 * Email Utility for Sending Emails
 * Uses PHP mail() function (works with XAMPP Mercury or external SMTP)
 */

class EmailService {
    private $fromEmail = 'noreply@candelaria.pe';
    private $fromName = 'Candelaria 2026';
    
    /**
     * Send password reset email
     */
    public function sendPasswordReset($toEmail, $toName, $resetLink) {
        $subject = 'Recupera tu contraseña - Candelaria 2026';
        
        $message = $this->getPasswordResetTemplate($toName, $resetLink);
        
        $headers = $this->getHeaders();
        
        return $this->send($toEmail, $subject, $message, $headers);
    }
    
    /**
     * Send email verification
     */
    public function sendEmailVerification($toEmail, $toName, $verificationLink) {
        $subject = 'Verifica tu email - Candelaria 2026';
        
        $message = $this->getEmailVerificationTemplate($toName, $verificationLink);
        
        $headers = $this->getHeaders();
        
        return $this->send($toEmail, $subject, $message, $headers);
    }
    
    /**
     * Send welcome email
     */
    public function sendWelcome($toEmail, $toName) {
        $subject = '¡Bienvenido a Candelaria 2026!';
        
        $message = $this->getWelcomeTemplate($toName);
        
        $headers = $this->getHeaders();
        
        return $this->send($toEmail, $subject, $message, $headers);
    }
    
    /**
     * Generic send method
     */
    private function send($to, $subject, $message, $headers) {
        try {
            // For development: Log email instead of sending
            if ($_SERVER['SERVER_NAME'] === 'localhost') {
                $this->logEmail($to, $subject, $message);
                return true;
            }
            
            // Production: Actually send email
            return mail($to, $subject, $message, $headers);
        } catch (Exception $e) {
            error_log("Email Error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Log email to file (development mode)
     */
    private function logEmail($to, $subject, $message) {
        $logFile = __DIR__ . '/../logs/emails.log';
        $logDir = dirname($logFile);
        
        if (!file_exists($logDir)) {
            mkdir($logDir, 0777, true);
        }
        
        $logEntry = sprintf(
            "[%s] TO: %s | SUBJECT: %s\n%s\n%s\n\n",
            date('Y-m-d H:i:s'),
            $to,
            $subject,
            str_repeat('-', 80),
            strip_tags($message)
        );
        
        file_put_contents($logFile, $logEntry, FILE_APPEND);
    }
    
    /**
     * Get email headers
     */
    private function getHeaders() {
        $headers = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        $headers[] = 'From: ' . $this->fromName . ' <' . $this->fromEmail . '>';
        $headers[] = 'Reply-To: ' . $this->fromEmail;
        $headers[] = 'X-Mailer: PHP/' . phpversion();
        
        return implode("\r\n", $headers);
    }
    
    /**
     * Password reset email template
     */
    private function getPasswordResetTemplate($name, $resetLink) {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #4c1d95, #7c3aed); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px; }
        .button { display: inline-block; background: #7c3aed; color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 20px 0; }
        .footer { text-align: center; margin-top: 30px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Recuperación de Contraseña</h1>
        </div>
        <div class="content">
            <p>Hola <strong>{$name}</strong>,</p>
            <p>Recibimos una solicitud para restablecer la contraseña de tu cuenta en Candelaria 2026.</p>
            <p>Haz clic en el siguiente botón para crear una nueva contraseña:</p>
            <p style="text-align: center;">
                <a href="{$resetLink}" class="button">Restablecer Contraseña</a>
            </p>
            <p><small>O copia y pega este enlace en tu navegador:<br>{$resetLink}</small></p>
            <p><strong>⚠️ Este enlace expira en 1 hora.</strong></p>
            <p>Si no solicitaste este cambio, puedes ignorar este correo de forma segura.</p>
        </div>
        <div class="footer">
            <p>© 2026 Candelaria - Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html>
HTML;
    }
    
    /**
     * Email verification template
     */
    private function getEmailVerificationTemplate($name, $verificationLink) {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #4c1d95, #7c3aed); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px; }
        .button { display: inline-block; background: #10b981; color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; margin: 20px 0; }
        .footer { text-align: center; margin-top: 30px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✉️ Verifica tu Email</h1>
        </div>
        <div class="content">
            <p>Hola <strong>{$name}</strong>,</p>
            <p>¡Gracias por registrarte en Candelaria 2026!</p>
            <p>Para completar tu registro, por favor verifica tu dirección de correo electrónico:</p>
            <p style="text-align: center;">
                <a href="{$verificationLink}" class="button">Verificar Email</a>
            </p>
            <p><small>O copia y pega este enlace en tu navegador:<br>{$verificationLink}</small></p>
        </div>
        <div class="footer">
            <p>© 2026 Candelaria - Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html>
HTML;
    }
    
    /**
     * Welcome email template
     */
    private function getWelcomeTemplate($name) {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #4c1d95, #7c3aed); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f9fafb; padding: 30px; border-radius: 0 0 10px 10px; }
        .footer { text-align: center; margin-top: 30px; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 ¡Bienvenido!</h1>
        </div>
        <div class="content">
            <p>Hola <strong>{$name}</strong>,</p>
            <p>¡Bienvenido a la comunidad de Candelaria 2026!</p>
            <p>Estamos emocionados de tenerte con nosotros. Ahora puedes disfrutar de todas las funcionalidades de nuestra plataforma.</p>
            <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
            <p>¡Que disfrutes tu experiencia!</p>
        </div>
        <div class="footer">
            <p>© 2026 Candelaria - Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html>
HTML;
    }
}
?>
