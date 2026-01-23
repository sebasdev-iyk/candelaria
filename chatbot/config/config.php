<?php
/**
 * Configuración del Chatbot
 * 
 * Este archivo contiene todas las configuraciones necesarias para el chatbot,
 * incluyendo credenciales de Groq API y configuración de base de datos.
 */

// ============================================
// GROQ API CONFIGURATION
// ============================================
define('GROQ_API_KEY', '');
define('GROQ_API_URL', 'https://api.groq.com/openai/v1/chat/completions');
define('GROQ_MODEL', 'llama-3.3-70b-versatile'); // Modelo rápido y potente

// ============================================
// DATABASE CONFIGURATION
// ============================================
// Reutilizamos la configuración existente del proyecto
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'mipuno_candelaria');
define('DB_USER', 'mipuno_candelaria_user');
define('DB_PASS', 'mipuno_candelaria');
define('DB_CHARSET', 'utf8mb4');

// ============================================
// CHATBOT SETTINGS
// ============================================
define('CHATBOT_NAME', 'Asistente Candelaria');
define('CHATBOT_WELCOME_MESSAGE', '¡Hola! Soy tu asistente virtual de la Festividad de la Virgen de la Candelaria. ¿En qué puedo ayudarte hoy?');
define('MAX_MESSAGE_LENGTH', 500);
define('RESPONSE_TIMEOUT', 30); // segundos

// ============================================
// ERROR MESSAGES
// ============================================
define('ERROR_EMPTY_MESSAGE', 'Por favor, escribe un mensaje.');
define('ERROR_MESSAGE_TOO_LONG', 'El mensaje es demasiado largo. Máximo ' . MAX_MESSAGE_LENGTH . ' caracteres.');
define('ERROR_API_CONNECTION', 'No pude conectarme al servicio de inteligencia artificial. Por favor, intenta de nuevo.');
define('ERROR_DATABASE', 'Hubo un problema al consultar la información. Por favor, intenta de nuevo.');
define('ERROR_GENERAL', 'Ocurrió un error inesperado. Por favor, intenta de nuevo.');

// ============================================
// CORS SETTINGS (para desarrollo local)
// ============================================
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

// Manejar preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
