<?php
/**
 * GroqService
 * 
 * Servicio para integración con Groq API.
 * Procesa mensajes del usuario y genera respuestas usando IA.
 */

require_once __DIR__ . '/../config/config.php';

class GroqService {
    private $apiKey;
    private $apiUrl;
    private $model;

    /**
     * Constructor
     */
    public function __construct() {
        $this->apiKey = GROQ_API_KEY;
        $this->apiUrl = GROQ_API_URL;
        $this->model = GROQ_MODEL;
    }

    /**
     * Genera una respuesta usando Groq API
     * 
     * @param string $userMessage Mensaje del usuario
     * @param string $context Contexto de la base de datos
     * @return string Respuesta generada
     */
    public function generateResponse($userMessage, $context = '') {
        try {
            // Construir el prompt del sistema
            $systemPrompt = $this->buildSystemPrompt();
            
            // Construir el mensaje del usuario con contexto
            $userPromptWithContext = $context . "\n\nPREGUNTA DEL USUARIO:\n" . $userMessage;
            
            // Preparar la solicitud
            $messages = [
                [
                    'role' => 'system',
                    'content' => $systemPrompt
                ],
                [
                    'role' => 'user',
                    'content' => $userPromptWithContext
                ]
            ];
            
            $requestData = [
                'model' => $this->model,
                'messages' => $messages,
                'temperature' => 0.7,
                'max_tokens' => 500,
                'top_p' => 1,
                'stream' => false
            ];
            
            // Realizar la solicitud HTTP
            $response = $this->makeHttpRequest($requestData);
            
            // Extraer la respuesta
            if (isset($response['choices'][0]['message']['content'])) {
                return trim($response['choices'][0]['message']['content']);
            } else {
                throw new Exception('Respuesta inválida de Groq API');
            }
            
        } catch (Exception $e) {
            error_log("Groq API Error: " . $e->getMessage());
            throw new Exception(ERROR_API_CONNECTION);
        }
    }

    /**
     * Construye el prompt del sistema que define el comportamiento del chatbot
     */
    private function buildSystemPrompt() {
        return "Eres un asistente virtual amigable y conocedor de la Festividad de la Virgen de la Candelaria en Puno, Perú.

TU PERSONALIDAD:
- Eres amable, respetuoso y entusiasta sobre la festividad
- Respondes en español de manera clara y concisa
- Usas un tono cálido y acogedor
- Eres culturalmente sensible y respetuoso con las tradiciones

TUS RESPONSABILIDADES:
- Responder preguntas sobre la festividad, eventos, danzas, horarios, historia y ubicación
- Usar SIEMPRE la información proporcionada de la base de datos cuando esté disponible
- Si no tienes información específica, indícalo claramente y ofrece información general
- Mantener respuestas concisas (máximo 3-4 párrafos)
- Ser preciso y veraz con las fechas, horarios y datos

REGLAS IMPORTANTES:
1. SIEMPRE prioriza la información de la base de datos sobre conocimiento general
2. Si la información de la BD está disponible, úsala textualmente
3. No inventes fechas, horarios o eventos que no estén en la información proporcionada
4. Si no sabes algo, admítelo honestamente
5. Mantén un tono festivo pero informativo

FORMATO DE RESPUESTAS:
- Usa párrafos cortos y claros
- Puedes usar emojis ocasionalmente para dar calidez (🎭, 🎉, 🙏, ⛪)
- Estructura la información con viñetas cuando sea apropiado
- Termina con una pregunta amigable si es relevante";
    }

    /**
     * Realiza una solicitud HTTP a Groq API
     */
    private function makeHttpRequest($data) {
        $ch = curl_init($this->apiUrl);
        
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ];
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, RESPONSE_TIMEOUT);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        if ($error) {
            throw new Exception("cURL Error: {$error}");
        }
        
        if ($httpCode !== 200) {
            $errorMsg = "HTTP Error {$httpCode}";
            if ($response) {
                $errorData = json_decode($response, true);
                if (isset($errorData['error']['message'])) {
                    $errorMsg .= ": " . $errorData['error']['message'];
                }
            }
            throw new Exception($errorMsg);
        }
        
        $decodedResponse = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("JSON Decode Error: " . json_last_error_msg());
        }
        
        return $decodedResponse;
    }

    /**
     * Test de conexión con Groq API
     */
    public function testConnection() {
        try {
            $testData = [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'user', 'content' => 'Hola']
                ],
                'max_tokens' => 10
            ];
            
            $response = $this->makeHttpRequest($testData);
            return isset($response['choices'][0]['message']['content']);
        } catch (Exception $e) {
            error_log("Groq test connection failed: " . $e->getMessage());
            return false;
        }
    }
}
