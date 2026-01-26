# 🤖 Chatbot Asistente Candelaria - Documentación Completa

## 📋 Índice
1. [Introducción](#introducción)
2. [Arquitectura General](#arquitectura-general)
3. [Componentes Principales](#componentes-principales)
4. [Funcionamiento del Chatbot](#funcionamiento-del-chatbot)
5. [Integración con la Base de Datos](#integración-con-la-base-de-datos)
6. [API del Chatbot](#api-del-chatbot)
7. [Características Avanzadas](#características-avanzadas)
8. [Configuración y Personalización](#configuración-y-personalización)
9. [Seguridad y Autenticación](#seguridad-y-autenticación)
10. [Solución de Problemas](#solución-de-problemas)

## Introducción

El **Asistente Candelaria** es un chatbot de inteligencia artificial integrado en la plataforma web de la Festividad de la Virgen de la Candelaria en Puno, Perú. Este chatbot utiliza tecnología de vanguardia como Groq AI (modelo Llama 3.3) y procesamiento de video en tiempo real para ofrecer una experiencia interactiva y personalizada a los usuarios.

### Características Principales
- Widget flotante integrado en la esquina inferior izquierda
- Inteligencia artificial basada en Groq (modelo Llama 3.3)
- Conexión directa con la base de datos `mipuno_candelaria`
- Video avatar con sistema de transparencia (Chroma Key) en tiempo real
- Diseño moderno con efectos de glassmorphism
- Capacidad para responder preguntas sobre eventos, danzas, servicios, historia y más

## Arquitectura General

```
┌─────────────────┐    ┌──────────────────┐    ┌─────────────────┐
│   Frontend      │    │   Backend API    │    │   Inteligencia │
│   (index.php)   │◄──►│   (chat.php)     │◄──►│   Artificial   │
│                 │    │                  │    │   (Groq API)    │
│  ┌─────────────┐│    │  ┌─────────────┐ │    │                 │
│  │Chatbot UI   ││    │  │Database     │ │    │  ┌─────────────┐│
│  │(script.js)  ││    │  │Service      │ │    │  │Groq Service ││
│  │             ││    │  │             │ │    │  │             ││
│  │Video Canvas ││    │  │(Database-   │ │    │  │(GroqService││
│  │(Chroma Key) ││    │  │Service.php) │ │    │  │.php)        ││
│  └─────────────┘│    │  └─────────────┘ │    │  └─────────────┘│
└─────────────────┘    └──────────────────┘    └─────────────────┘
```

## Componentes Principales

### Directorios y Archivos

```
chatbot/
├── README.md                    # Documentación general del módulo
├── TROUBLESHOOTING.md          # Guía de solución de problemas
├── VIDEO_INSTRUCTIONS.md       # Instrucciones para video avatar
├── style.css                   # Estilos del widget
├── script.js                   # Lógica del widget y video canvas
├── test.html                   # Pruebas del chatbot
├── test-simple.html            # Pruebas simples
├── assets/
│   └── chatbot-avatar.webm     # Video avatar del chatbot
├── api/
│   ├── chat.php               # Endpoint principal de comunicación
│   ├── GroqService.php        # Lógica de integración con IA
│   └── DatabaseService.php    # Consultas a la base de datos
└── config/
    └── config.php             # Configuración general
```

### Archivos Importantes

1. **`includes/grok-chatbot.php`** - Inclusión del chatbot en index.php
2. **`chatbot/script.js`** - Lógica del cliente (frontend)
3. **`chatbot/api/chat.php`** - Endpoint principal del backend
4. **`chatbot/api/GroqService.php`** - Servicio de inteligencia artificial
5. **`chatbot/api/DatabaseService.php`** - Servicio de base de datos
6. **`chatbot/config/config.php`** - Configuración del chatbot

## Funcionamiento del Chatbot

### Flujo de Interacción

1. **Usuario envía mensaje**: El usuario escribe una pregunta en el campo de texto del chatbot
2. **Cliente envía solicitud**: El script JavaScript envía una petición POST a `chat.php`
3. **Servidor procesa mensaje**: El backend recibe el mensaje y lo procesa
4. **Consulta a base de datos**: Se obtiene contexto relevante de la base de datos
5. **Generación de respuesta**: Se envía el mensaje y contexto a Groq AI
6. **Respuesta al cliente**: La respuesta se devuelve al frontend
7. **Visualización**: El mensaje de respuesta se muestra en el chat

### Procesamiento de Mensajes

El chatbot sigue este proceso para cada mensaje:

```php
function processMessage($message) {
    // 1. Validar mensaje
    if (empty($message)) throw new Exception(ERROR_EMPTY_MESSAGE);
    
    // 2. Inicializar servicios
    $dbService = new DatabaseService();
    $groqService = new GroqService();
    
    // 3. Obtener contexto de la base de datos
    $context = $dbService->buildContext($message);
    
    // 4. Generar respuesta con Groq
    $response = $groqService->generateResponse($message, $context);
    
    return ['success' => true, 'message' => $response];
}
```

## Integración con la Base de Datos

### Servicio de Base de Datos (`DatabaseService.php`)

El chatbot puede acceder a múltiples tablas de la base de datos para proporcionar información contextual:

#### Tablas Consultadas
- `candela_list` - Información sobre danzas y conjuntos
- `hospedajes` - Información sobre alojamientos
- `candela_comida` - Información sobre restaurantes
- `transporte` - Información sobre transporte
- `turismo` - Lugares turísticos
- `noticias` - Noticias recientes
- `events`, `programacion`, `schedule` - Eventos y programación

#### Detección de Intenciones

El servicio analiza el mensaje del usuario para determinar la intención:

```php
$isAskingAboutEvents = $this->containsKeywords($messageLower, ['evento', 'programación', 'horario', 'cuándo', 'fecha', 'día']);
$isAskingAboutDances = $this->containsKeywords($messageLower, ['danza', 'baile', 'conjunto', 'traje']);
$isAskingAboutLocation = $this->containsKeywords($messageLower, ['dónde', 'ubicación', 'lugar', 'dirección', 'mapa']);
// ... más detecciones
```

#### Contextualización

Dependiendo de la intención detectada, el servicio construye un contexto relevante que se envía junto con el mensaje al modelo de IA.

## API del Chatbot

### Endpoint Principal: `chat.php`

**Método**: POST  
**URL**: `/chatbot/api/chat.php`  
**Headers**: `Content-Type: application/json`  

**Petición**:
```json
{
  "message": "¿Cuáles son los eventos principales de la festividad?"
}
```

**Respuesta Exitosa**:
```json
{
  "success": true,
  "message": "Los eventos principales de la Festividad de la Virgen de la Candelaria...",
  "timestamp": "2026-01-26 15:30:45"
}
```

**Respuesta con Error**:
```json
{
  "success": false,
  "error": "Mensaje vacío",
  "timestamp": "2026-01-26 15:30:45"
}
```

### Servicio de Groq (`GroqService.php`)

El servicio de Groq se encarga de comunicarse con la API de Groq para generar respuestas inteligentes:

#### Configuración
- **Modelo**: `llama-3.3-70b-versatile`
- **Temperatura**: 0.7 (equilibrio entre creatividad y precisión)
- **Tokens máximos**: 500
- **URL de API**: `https://api.groq.com/openai/v1/chat/completions`

#### Prompt del Sistema

El chatbot utiliza un prompt del sistema predefinido que establece su personalidad y comportamiento:

```
Eres un asistente virtual amigable y conocedor de la Festividad de la Virgen de la Candelaria en Puno, Perú.

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
```

## Características Avanzadas

### Video Avatar con Chroma Key

El chatbot incluye una característica innovadora de video avatar con eliminación de fondo en tiempo real:

#### Procesamiento en Canvas
1. **Renderizado de video**: El video se dibuja en un canvas HTML5
2. **Obtención de píxeles**: Se obtienen los datos de imagen del canvas
3. **Eliminación de fondo**: Se analiza cada píxel y se hace transparente si coincide con el color de fondo (negro oscuro por defecto)
4. **Actualización en tiempo real**: El proceso se repite para cada frame del video

#### Configuración de Tolerancia
```javascript
const TOLERANCE = { r: 40, g: 40, b: 40 }; // Tolerancia para fondo NEGRO
```

Se pueden ajustar estos valores para mejorar la detección del fondo según las condiciones del video.

### Diseño Responsivo

El chatbot está diseñado para funcionar en dispositivos móviles y de escritorio:

- **Desktop**: Widget flotante de 380x600px
- **Mobile**: Toma toda la pantalla para mejor experiencia

### Interfaz de Usuario

- **Avatar del bot**: Icono de robot con nombre "Asistente Candelaria"
- **Indicador de estado**: Muestra "En línea" con punto verde
- **Área de mensajes**: Historial de conversación con diferenciación de usuario y bot
- **Indicador de escritura**: Animación mientras el bot procesa la respuesta
- **Campo de entrada**: Área de texto con soporte para múltiples líneas

## Configuración y Personalización

### Archivo de Configuración (`config.php`)

#### Configuración de Groq
```php
define('GROQ_API_KEY', ''); // Clave API de Groq (requerida)
define('GROQ_API_URL', 'https://api.groq.com/openai/v1/chat/completions');
define('GROQ_MODEL', 'llama-3.3-70b-versatile');
```

#### Configuración de Base de Datos
```php
define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3306');
define('DB_NAME', 'mipuno_candelaria');
define('DB_USER', 'mipuno_candelaria_user');
define('DB_PASS', 'mipuno_candelaria');
```

#### Configuración del Chatbot
```php
define('CHATBOT_NAME', 'Asistente Candelaria');
define('CHATBOT_WELCOME_MESSAGE', '¡Hola! Soy tu asistente virtual...');
define('MAX_MESSAGE_LENGTH', 500); // Caracteres máximos por mensaje
define('RESPONSE_TIMEOUT', 30); // Tiempo de espera en segundos
```

### Personalización Visual

#### Posición del Widget
Para cambiar la posición del widget (por ejemplo, a la derecha):
```css
.chatbot-widget, .chatbot-trigger {
    left: auto;
    right: 30px; /* Cambiar left por right */
}
```

#### Tolerancia de Transparencia
Si el fondo no se borra bien, ajusta la tolerancia en `script.js`:
```javascript
const TOLERANCE = { r: 200, g: 200, b: 200 }; // Valores más altos = solo blanco puro
```

### Personalización del Video Avatar
1. Colocar el video en: `chatbot/assets/chatbot-avatar.webm`
2. El sistema eliminará el fondo blanco automáticamente
3. **Requisito**: El video debe tener fondo blanco sólido (#FFFFFF) o muy claro para mejor resultado

## Seguridad y Autenticación

### Actual Estado de Seguridad
- **Sin autenticación requerida**: El chatbot actualmente no requiere autenticación para enviar mensajes
- **Registro de errores**: Los errores se registran en los logs del servidor
- **Validación de entrada**: Se verifica la longitud máxima del mensaje (500 caracteres)

### Consideraciones de Seguridad
- **API Key de Groq**: Debe mantenerse segura y no exponerse en el cliente
- **Validación de entradas**: El sistema valida que los mensajes no estén vacíos ni excedan el límite
- **Control de acceso**: Actualmente no hay control de acceso específico para el chatbot

## Solución de Problemas

### Problemas Comunes

#### El video no se reproduce
- **Causa**: Chrome requiere interacción del usuario para permitir autoplay con sonido
- **Solución**: Asegurarse de que haya una interacción previa con la página

#### El chatbot no abre
- **Causa**: Errores de JavaScript o problemas de carga
- **Solución**: Verificar la consola del navegador (F12) por errores de JavaScript

#### Error de API
- **Causa**: Fallo en la conexión con Groq API o base de datos
- **Solución**: Verificar que `chatbot/config/config.php` tenga la API Key correcta

#### El fondo del video no se borra bien
- **Causa**: Configuración incorrecta de tolerancia
- **Solución**: Ajustar los valores de tolerancia en `script.js` según sea necesario

### Depuración

#### Habilitar Logging
Los errores se registran automáticamente usando `error_log()` en los siguientes archivos:
- `GroqService.php` - Errores de conexión con Groq
- `DatabaseService.php` - Errores de base de datos
- `chat.php` - Errores generales del chat

#### Pruebas
- `test.html` - Prueba completa de funcionalidades
- `test-simple.html` - Prueba simple para diagnóstico

## Despliegue y Mantenimiento

### Requisitos del Sistema
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Soporte para extensiones PHP: PDO, cURL
- Clave API válida de Groq

### Pasos para Despliegue
1. Copiar los archivos del directorio `chatbot/` al servidor
2. Configurar la clave API de Groq en `config/config.php`
3. Asegurar la conexión con la base de datos
4. Verificar permisos de lectura/escritura si se usan logs
5. Probar la funcionalidad con `test.html`

### Monitoreo
- Supervisar el uso de la API de Groq (cuotas y costos)
- Revisar logs de errores periódicamente
- Verificar la disponibilidad del servicio

## Futuras Mejoras

### Características Planeadas
- Integración opcional con autenticación para seguimiento de conversaciones
- Historial de conversaciones por usuario
- Soporte para multimedia (imágenes, documentos)
- Mejoras en el procesamiento del video (detección de bordes más precisa)
- Sistema de feedback para mejorar las respuestas

### Optimizaciones Potenciales
- Caché de respuestas frecuentes para reducir llamadas a la API
- Compresión de contexto para mejorar tiempos de respuesta
- Mejora en la detección de intenciones con técnicas de NLP avanzadas

---

**Desarrollado para la Festividad de la Virgen de la Candelaria 2026**  
*Puno, Perú - Patrimonio Cultural Inmaterial de la Humanidad*