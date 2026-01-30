<!-- Grok Chatbot Widget -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<div id="candelaria-bot-widget" class="candelaria-bot-widget">
    <!-- Header -->
    <div class="chat-header">
        <div class="header-content">
            <div class="bot-avatar">
                <i class="fas fa-robot"></i>
            </div>
            <div class="bot-info">
                <h1>Asistente Candelaria</h1>
                <p class="status"><span class="status-dot"></span> En línea</p>
            </div>
        </div>
        <button class="close-btn" onclick="toggleChatbot()" title="Minimizar">
            <i class="fas fa-chevron-down"></i>
        </button>
    </div>

    <!-- Messages Area -->
    <div class="chat-messages" id="chatMessages">
        <div class="message bot-message">
            <div class="message-avatar"><i class="fas fa-robot"></i></div>
            <div class="message-content">
                <div class="message-bubble">
                    <p>¡Hola! 👋 Soy tu asistente virtual de la Festividad de la Virgen de la Candelaria 2026.</p>
                    <p>Puedo ayudarte con información sobre:</p>
                    <ul>
                        <li>📅 <strong>Eventos y Programación</strong> - Horarios, fechas importantes</li>
                        <li>🎭 <strong>Danzas y Conjuntos</strong> - Categorías, participantes, concursos</li>
                        <li>🏨 <strong>Servicios</strong> - Hospedajes, restaurantes, transporte</li>
                        <li>📍 <strong>Ubicaciones</strong> - Lugares importantes, mapas</li>
                        <li>📖 <strong>Historia y Cultura</strong> - Tradiciones, origen de la festividad</li>
                        <li>📰 <strong>Noticias</strong> - Últimas actualizaciones del evento</li>
                    </ul>
                    <p>¿En qué puedo ayudarte hoy?</p>
                </div>
                <span class="message-time">Ahora</span>
            </div>
        </div>
    </div>

    <!-- Typing Indicator -->
    <div class="typing-indicator" id="typingIndicator" style="display: none;">
        <div class="message-avatar"><i class="fas fa-robot"></i></div>
        <div class="typing-dots"><span></span><span></span><span></span></div>
    </div>

    <!-- Input Area -->
    <div class="chat-input">
        <form id="chatForm" onsubmit="sendMessage(event)">
            <div class="input-wrapper">
                <textarea id="messageInput" placeholder="Escribe tu pregunta aquí..." rows="1" maxlength="500"
                    required></textarea>
                <button type="submit" class="send-btn" id="sendBtn"><i class="fas fa-paper-plane"></i></button>
            </div>
        </form>
    </div>

    <!-- Video Avatar (Canvas for Transparency) -->
    <div class="video-avatar-container">
        <canvas id="video-canvas" width="250" height="300"></canvas>
        <video id="source-video" src="<?= $basePath ?>chatbot/assets/chatbotggs.mp4" loop muted playsinline
            crossorigin="anonymous" style="display: none;"></video>
    </div>
</div>

<!-- Chatbot Floating Button -->
<button id="candelariaTriggerBtn" class="candelaria-bot-trigger" title="Asistente Virtual">
    <!-- Canvas para el video preview en el botón -->
    <canvas id="trigger-video-canvas" width="100" height="100"></canvas>
</button>

<!-- Thought Bubbles Container -->
<div class="thought-bubble-container"></div>

<!-- Chatbot Styles & Script -->
<link rel="stylesheet" href="<?= $basePath ?>chatbot/style.css?v=<?= time() ?>">
<script>
    // Define Global Base Path for JS
    window.CANDELARIA_BASE_PATH = "<?= $basePath ?>";
</script>
<script src="<?= $basePath ?>chatbot/script.js?v=<?= time() ?>"></script>