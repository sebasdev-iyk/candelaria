/**
 * Chatbot Widget - Festival de la Candelaria
 * Widget flotante para hacer preguntas sobre el festival
 */

(function () {
    'use strict';

    // Configuración
    const CONFIG = {
        apiUrl: '/api/chatbot/ask',
        welcomeMessage: '¡Hola! Soy tu asistente del Festival de la Candelaria. Puedo ayudarte con información sobre danzas, horarios y presentaciones. ¿Qué te gustaría saber?'
    };

    // Estado del chatbot
    let isOpen = false;
    let isTyping = false;
    let messageHistory = [];

    // Inicializar el widget cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initChatbot);
    } else {
        initChatbot();
    }

    function initChatbot() {
        createChatbotHTML();
        attachEventListeners();

        // Mensaje de bienvenida inicial
        if (messageHistory.length === 0) {
            addMessage('bot', CONFIG.welcomeMessage);
        }
    }

    function createChatbotHTML() {
        const container = document.getElementById('chatbot-widget');
        if (!container) {
            console.error('Chatbot widget container not found');
            return;
        }

        container.innerHTML = `
      <!-- Burbuja flotante -->
      <div class="chatbot-bubble" id="chatbot-bubble">
        <i class="fas fa-comments"></i>
      </div>

      <!-- Ventana de chat -->
      <div class="chatbot-window" id="chatbot-window">
        <!-- Header -->
        <div class="chatbot-header">
          <div class="chatbot-header-info">
            <div class="chatbot-avatar">
              <i class="fas fa-robot"></i>
            </div>
            <div class="chatbot-title">
              <h3>Asistente Candelaria</h3>
              <p>En línea</p>
            </div>
          </div>
          <button class="chatbot-close" id="chatbot-close">
            <i class="fas fa-times"></i>
          </button>
        </div>

        <!-- Mensajes -->
        <div class="chatbot-messages" id="chatbot-messages">
          <!-- Los mensajes se agregarán aquí dinámicamente -->
        </div>

        <!-- Input -->
        <div class="chatbot-input-container">
          <div class="chatbot-input-wrapper">
            <input 
              type="text" 
              class="chatbot-input" 
              id="chatbot-input" 
              placeholder="Escribe tu pregunta..."
              autocomplete="off"
            />
            <button class="chatbot-send-btn" id="chatbot-send-btn">
              <i class="fas fa-paper-plane"></i>
            </button>
          </div>
        </div>
      </div>
    `;
    }

    function attachEventListeners() {
        const bubble = document.getElementById('chatbot-bubble');
        const closeBtn = document.getElementById('chatbot-close');
        const sendBtn = document.getElementById('chatbot-send-btn');
        const input = document.getElementById('chatbot-input');

        if (bubble) {
            bubble.addEventListener('click', toggleChat);
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', toggleChat);
        }

        if (sendBtn) {
            sendBtn.addEventListener('click', sendMessage);
        }

        if (input) {
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });
        }
    }

    function toggleChat() {
        isOpen = !isOpen;
        const window = document.getElementById('chatbot-window');

        if (window) {
            if (isOpen) {
                window.classList.add('active');
                document.getElementById('chatbot-input')?.focus();
            } else {
                window.classList.remove('active');
            }
        }
    }

    function addMessage(type, content) {
        const messagesContainer = document.getElementById('chatbot-messages');
        if (!messagesContainer) return;

        const messageDiv = document.createElement('div');
        messageDiv.className = `chatbot-message ${type}`;

        const avatar = type === 'bot'
            ? '<i class="fas fa-robot"></i>'
            : '<i class="fas fa-user"></i>';

        messageDiv.innerHTML = `
      <div class="chatbot-message-avatar">
        ${avatar}
      </div>
      <div class="chatbot-message-content">
        ${escapeHtml(content)}
      </div>
    `;

        messagesContainer.appendChild(messageDiv);
        scrollToBottom();

        // Guardar en historial
        messageHistory.push({ type, content, timestamp: new Date() });
    }

    function showTypingIndicator() {
        const messagesContainer = document.getElementById('chatbot-messages');
        if (!messagesContainer) return;

        const typingDiv = document.createElement('div');
        typingDiv.className = 'chatbot-message bot';
        typingDiv.id = 'typing-indicator';

        typingDiv.innerHTML = `
      <div class="chatbot-message-avatar">
        <i class="fas fa-robot"></i>
      </div>
      <div class="chatbot-typing">
        <span></span>
        <span></span>
        <span></span>
      </div>
    `;

        messagesContainer.appendChild(typingDiv);
        scrollToBottom();
    }

    function hideTypingIndicator() {
        const typingIndicator = document.getElementById('typing-indicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    function scrollToBottom() {
        const messagesContainer = document.getElementById('chatbot-messages');
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    }

    async function sendMessage() {
        const input = document.getElementById('chatbot-input');
        const sendBtn = document.getElementById('chatbot-send-btn');

        if (!input || !sendBtn) return;

        const question = input.value.trim();

        if (!question || isTyping) return;

        // Agregar mensaje del usuario
        addMessage('user', question);
        input.value = '';

        // Deshabilitar input mientras se procesa
        isTyping = true;
        sendBtn.disabled = true;
        input.disabled = true;

        // Mostrar indicador de escritura
        showTypingIndicator();

        try {
            const response = await fetch(CONFIG.apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ question })
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            // Ocultar indicador de escritura
            hideTypingIndicator();

            // Agregar respuesta del bot
            if (data.answer) {
                addMessage('bot', data.answer);
            } else if (data.error) {
                addMessage('bot', `Lo siento, ocurrió un error: ${data.error}`);
            } else {
                addMessage('bot', 'Lo siento, no pude procesar tu pregunta. Por favor, intenta de nuevo.');
            }

        } catch (error) {
            console.error('Error al enviar mensaje:', error);
            hideTypingIndicator();
            addMessage('bot', 'Lo siento, hubo un problema al conectar con el servidor. Por favor, intenta de nuevo más tarde.');
        } finally {
            // Rehabilitar input
            isTyping = false;
            sendBtn.disabled = false;
            input.disabled = false;
            input.focus();
        }
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Exponer funciones globales si es necesario
    window.ChatbotWidget = {
        open: () => {
            if (!isOpen) toggleChat();
        },
        close: () => {
            if (isOpen) toggleChat();
        },
        sendMessage: (message) => {
            const input = document.getElementById('chatbot-input');
            if (input) {
                input.value = message;
                sendMessage();
            }
        }
    };

})();
