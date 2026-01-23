<?php
/**
 * Chat API Endpoint
 * 
 * Endpoint principal del chatbot que recibe mensajes del usuario,
 * obtiene contexto de la base de datos y genera respuestas con Groq.
 */

require_once __DIR__ . '/DatabaseService.php';
require_once __DIR__ . '/GroqService.php';

// Configurar headers (ya están en config.php)
require_once __DIR__ . '/../config/config.php';

/**
 * Función principal para procesar mensajes
 */
function processMessage($message) {
    try {
        // Validar mensaje
        if (empty($message)) {
            throw new Exception(ERROR_EMPTY_MESSAGE);
        }
        
        if (strlen($message) > MAX_MESSAGE_LENGTH) {
            throw new Exception(ERROR_MESSAGE_TOO_LONG);
        }
        
        // Inicializar servicios
        $dbService = new DatabaseService();
        $groqService = new GroqService();
        
        // Obtener contexto de la base de datos
        $context = $dbService->buildContext($message);
        
        // Generar respuesta con Groq
        $response = $groqService->generateResponse($message, $context);
        
        // Retornar respuesta exitosa
        return [
            'success' => true,
            'message' => $response,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
    } catch (Exception $e) {
        // Log del error
        error_log("Chat API Error: " . $e->getMessage());
        
        // Retornar error
        return [
            'success' => false,
            'error' => $e->getMessage(),
            'timestamp' => date('Y-m-d H:i:s')
        ];
    }
}

/**
 * Manejo de la solicitud
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del POST
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode([
            'success' => false,
            'error' => 'JSON inválido'
        ]);
        exit;
    }
    
    $message = $data['message'] ?? '';
    
    // Procesar mensaje
    $result = processMessage($message);
    
    // Retornar respuesta
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Endpoint de prueba
    echo json_encode([
        'success' => true,
        'message' => 'Chatbot API está funcionando correctamente',
        'version' => '1.0',
        'endpoints' => [
            'POST /chat.php' => 'Enviar mensaje al chatbot'
        ]
    ], JSON_UNESCAPED_UNICODE);
    
} else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Método no permitido'
    ]);
}
