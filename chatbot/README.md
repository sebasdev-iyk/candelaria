# Módulo Chatbot - Asistente Candelaria 🤖

Este módulo implementa un asistente virtual inteligente integrado directamente en la página principal como un widget flotante.

## 🚀 Características

- **Widget Flotante**: Integrado en la esquina inferior izquierda.
- **Inteligencia Artificial**: Usa Groq (Llama 3.3) para respuestas naturales.
- **Datos Reales**: Conectado a la base de datos `mipuno_candelaria`.
- **Video Avatar Transparente**: Procesamiento en tiempo real con Canvas para eliminar fondos blancos.
- **Diseño Glassmorphism**: Estética moderna y coherente con el sitio.

## 📁 Estructura

El chatbot vive principalmente en `chatbot/` pero se inyecta en `index.php`.

```
chatbot/
├── style.css           # Estilos del widget
├── script.js           # Lógica del widget y video canvas
├── assets/
│   └── chatbot-avatar.webm  # TU VIDEO AQUÍ
├── api/
│   ├── chat.php        # Endpoint de comunicación
│   ├── GroqService.php # Lógica de IA
│   └── DatabaseService.php # Consultas BD
└── config/
    └── config.php      # Configuración general
```

## 📹 Configuración del Video

El chatbot usa un sistema avanzado de **Chroma Key en Canvas** que elimina automáticamente el color blanco del fondo del video.

1. Coloca tu video en: `chatbot/assets/chatbot-avatar.webm`
2. El sistema eliminará el fondo blanco automáticamente.
3. **Requisito**: El video debe tener fondo blanco sólido (#FFFFFF) o muy claro para mejor resultado.

## 🛠️ Personalización

### Posición del Widget
Para cambiar la posición (ej. a la derecha), edita `chatbot/style.css`:

```css
.chatbot-widget, .chatbot-trigger {
    left: auto;
    right: 30px; /* Cambiar left por right */
}
```

### Tolerancia de Transparencia
Si el fondo no se borra bien, ajusta la tolerancia en `chatbot/script.js` (línea ~80):

```javascript
/* R, G, B mínimos para considerar "blanco" */
const tolerance = { r: 200, g: 200, b: 200 }; 
```
- Valores más bajos (ej. 150) = Borra más colores claros.
- Valores más altos (ej. 240) = Borra solo el blanco puro.

## 🧪 Solución de Problemas

- **El video no se reproduce**: Chrome requiere interacción del usuario (un click en la página) para permitir autoplay con sonido (aunque está muteado por defecto, a veces el navegador bloquea).
- **El chatbot no abre**: Verifica la consola del navegador (F12) por errores de JavaScript.
- **Error de API**: Revisa que `chatbot/config/config.php` tenga la API Key correcta.
