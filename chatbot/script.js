/**
 * Candelaria Chatbot - Video Avatar Edition
 * Script con IDs únicos para evitar conflictos
 */

// ============================================
// VARIABLES GLOBALES
// ============================================
let chatbotWidget, messageInput, chatMessages, typingIndicator, triggerBtn;
let videoSource, mainCanvas, triggerCanvas;
let mainCtx, triggerCtx;
let thoughtBubbleContainer, thoughtBubbleInterval;

// Configuración de Video
const HD_WIDTH = 1920;
const HD_HEIGHT = 1080;
const TOLERANCE = { r: 40, g: 40, b: 40 }; // Tolerancia para fondo NEGRO

// Configuración API
// Use global base path if available (defined in grok-chatbot.php), otherwise try to guess or use relative
const BASE_PATH = window.CANDELARIA_BASE_PATH || '';
const API_URL = BASE_PATH + 'chatbot/api/chat.php';

// Mensajes cute para las burbujas de pensamiento
const CUTE_MESSAGES = [
    "Estás en la cima... 🏔️",
    "¿Vienes por la Candelaria o te quedas por mí? 😉🎭",
    "Entre danzas y sonrisas… ¿bailamos una charla? 💃😏",
    "La Candelaria brilla, pero tu visita brilla más ✨",
    "Oye… ¿y si empezamos con un saludo coqueto? 😌",
    "Dicen que quien pregunta aquí, vuelve enamorado 💜🔥",
    "Cuidado… este chat tiene pasos prohibidos 💃😜",
    "Si la Candelaria es pasión, este chat también 🎉😉",
    "¿Buscas información o una buena conversación? Yo doy ambas 😏",
    "Te advierto algo: aquí se baila, se siente y se conversa 😄🎶",
    "Entre trajes, música y cultura… yo soy tu mejor guía 😎🗺️",
    "La fiesta comienza… y yo también estoy listo 🎊😏",
    "¿Sabías que la Candelaria enamora? Yo solo continúo la tradición 💘",
    "Si te gusta la fiesta, este chat te va a encantar 😍",
    "Danzas, historia… y un poquito de coqueteo cultural 💃✨",
    "No soy danza, pero sé cómo seguir tu ritmo 😜🎵",
    "Aquí no solo informamos… también sacamos sonrisas 😉",
    "¿Listo para vivir la Candelaria desde el chat? 🎭🔥",
    "Pregunta con confianza… prometo responder bonito 😌",
    "Si Puno es pasión, yo soy el detalle encantador 😏",
    "Este chat tiene más ritmo que una morenada 🎶😄",
    "La Virgen nos une… la conversación nos acerca 💜✨",
    "¿Te cuento un dato o te conquisto con cultura? 😜📚",
    "Advertencia: este asistente baila y conversa a la vez 💃🤖",
    "Entre folklore y encanto… aquí estoy para ti 😉",
    "Si buscas Candelaria, llegaste al chat correcto 😎🎉"
];


// Variable para controlar si es la primera vez
let isFirstThoughtBubble = true;

// ============================================
// INICIALIZACIÓN
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    console.log("🚀 Candelaria Chatbot - Iniciando...");

    // Referencias DOM con IDs ÚNICOS
    chatbotWidget = document.getElementById('candelaria-bot-widget');
    triggerBtn = document.getElementById('candelariaTriggerBtn');
    videoSource = document.getElementById('source-video');
    mainCanvas = document.getElementById('video-canvas');
    triggerCanvas = document.getElementById('trigger-video-canvas');
    messageInput = document.getElementById('messageInput');
    chatMessages = document.getElementById('chatMessages');
    typingIndicator = document.getElementById('typingIndicator');
    const chatForm = document.getElementById('chatForm');

    // Diagnóstico
    console.log('Widget:', chatbotWidget ? '✅' : '❌');
    console.log('Trigger:', triggerBtn ? '✅' : '❌');
    console.log('Video:', videoSource ? '✅' : '❌');

    // 1. Configurar Click Handler
    if (triggerBtn) {
        console.log('Asignando evento click al trigger...');

        triggerBtn.onclick = function (e) {
            console.log('🖱️ CLICK DETECTADO EN TRIGGER');
            e.preventDefault();
            e.stopPropagation();
            toggleChatbot();
        };

        triggerBtn.addEventListener('touchend', (e) => {
            console.log('📱 TOUCH DETECTADO');
            e.preventDefault();
            toggleChatbot();
        });

        console.log('✅ Eventos asignados correctamente');
    } else {
        console.error('❌ ERROR: No se encontró el botón trigger con ID "candelariaTriggerBtn"');
    }

    // 2. Inicializar Video
    if (videoSource) {
        initVideo();
    }

    // 3. Configurar Chat
    if (messageInput) {
        messageInput.addEventListener('input', () => {
            messageInput.style.height = 'auto';
            messageInput.style.height = Math.min(messageInput.scrollHeight, 100) + 'px';
        });

        messageInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                submitChat(e);
            }
        });
    }

    if (chatForm) {
        chatForm.onsubmit = submitChat;
    }

    // 4. Inicializar Burbujas de Pensamiento
    // DESACTIVADO: initThoughtBubbles(); // Burbujas flotantes desactivadas

    console.log('✅ Inicialización completa');
});

// ============================================
// TOGGLE CHATBOT
// ============================================
window.toggleChatbot = function () {
    console.log('toggleChatbot() ejecutada');

    if (!chatbotWidget) {
        console.error('❌ ERROR: Widget no encontrado');
        chatbotWidget = document.getElementById('candelaria-bot-widget');
        if (!chatbotWidget) {
            alert('Error: No se encuentra el widget del chatbot');
            return;
        }
    }

    const isVisible = chatbotWidget.classList.contains('active');
    console.log('Estado actual:', isVisible ? 'VISIBLE' : 'OCULTO');

    if (!isVisible) {
        // ABRIR
        console.log('➡️ Abriendo widget...');
        chatbotWidget.style.display = 'flex';

        requestAnimationFrame(() => {
            chatbotWidget.classList.add('active');
            console.log('✅ Widget abierto');
        });

        // Ocultar trigger suavemente
        if (triggerBtn) {
            triggerBtn.style.transition = 'opacity 0.2s ease';
            triggerBtn.style.pointerEvents = 'none';
            setTimeout(() => {
                triggerBtn.style.opacity = '0';
            }, 100);
        }

        // Detener burbujas de pensamiento
        stopThoughtBubbles();

        // Reproducir video
        if (videoSource && videoSource.paused) {
            videoSource.play().catch(e => console.log('Autoplay bloqueado:', e));
        }

        // Focus en input
        setTimeout(() => {
            if (messageInput) messageInput.focus();
        }, 150);

    } else {
        // CERRAR
        console.log('⬅️ Cerrando widget...');
        chatbotWidget.classList.remove('active');

        setTimeout(() => {
            if (!chatbotWidget.classList.contains('active')) {
                chatbotWidget.style.display = 'none';
                console.log('✅ Widget cerrado');
            }
        }, 300);

        // Mostrar trigger
        if (triggerBtn) {
            triggerBtn.style.opacity = '1';
            triggerBtn.style.pointerEvents = 'auto';
        }

        // Reanudar burbujas de pensamiento
        // DESACTIVADO: Burbujas flotantes desactivadas
        // setTimeout(() => {
        //     resumeThoughtBubbles();
        // }, 1000);
    }
};

// ============================================
// VIDEO ENGINE
// ============================================
function initVideo() {
    console.log('Inicializando video...');

    const setSize = (w, h) => {
        if (mainCanvas) { mainCanvas.width = w; mainCanvas.height = h; }
        if (triggerCanvas) { triggerCanvas.width = w; triggerCanvas.height = h; }
    };
    setSize(HD_WIDTH, HD_HEIGHT);

    mainCtx = mainCanvas ? mainCanvas.getContext('2d', { willReadFrequently: true }) : null;
    triggerCtx = triggerCanvas ? triggerCanvas.getContext('2d', { willReadFrequently: true }) : null;

    videoSource.addEventListener('loadedmetadata', () => {
        console.log(`Video: ${videoSource.videoWidth}x${videoSource.videoHeight}`);
        setSize(videoSource.videoWidth, videoSource.videoHeight);
    });

    const render = () => {
        if (!videoSource.paused && !videoSource.ended) {
            const isWidgetActive = chatbotWidget && chatbotWidget.classList.contains('active');

            if (isWidgetActive && mainCtx) {
                processFrame(mainCtx, mainCanvas, videoSource);
            } else if (triggerCtx) {
                processFrame(triggerCtx, triggerCanvas, videoSource);
            }
        }
        requestAnimationFrame(render);
    };

    videoSource.addEventListener('play', render);
    videoSource.load();
    videoSource.play().catch(() => {
        console.log('Esperando interacción para reproducir video');
        document.body.addEventListener('click', () => videoSource.play(), { once: true });
    });
}

function processFrame(ctx, canvas, video) {
    if (!ctx || !video) return;
    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Chroma Key - Eliminar fondo negro
    const frame = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const data = frame.data;

    for (let i = 0; i < data.length; i += 4) {
        const r = data[i];
        const g = data[i + 1];
        const b = data[i + 2];

        if (r < TOLERANCE.r && g < TOLERANCE.g && b < TOLERANCE.b) {
            data[i + 3] = 0; // Hacer transparente
        }
    }

    ctx.putImageData(frame, 0, 0);
}

// ============================================
// CHAT API
// ============================================
window.sendMessage = submitChat;

async function submitChat(event) {
    if (event) event.preventDefault();

    const message = messageInput.value.trim();
    if (!message) return;

    messageInput.value = '';
    messageInput.style.height = 'auto';
    messageInput.disabled = true;

    addMessage(message, 'user');
    showTyping();

    try {
        const response = await fetch(API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message: message })
        });

        const data = await response.json();
        hideTyping();

        if (data.success) {
            addMessage(data.message, 'bot');
        } else {
            console.error('API Error:', data);
            addMessage('Lo siento, tuve un problema técnico. ¿Podrías intentar de nuevo? 😅', 'bot');
        }

    } catch (error) {
        hideTyping();
        console.error('Network Error:', error);
        addMessage('Parece que hay problemas de conexión. Verifica tu internet. 🔌', 'bot');
    } finally {
        messageInput.disabled = false;
        messageInput.focus();
    }
}

function addMessage(text, sender) {
    if (!chatMessages) return;

    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${sender}-message`;

    const icon = sender === 'bot' ? 'fa-robot' : 'fa-user';
    const cleanText = formatText(text);

    messageDiv.innerHTML = `
        <div class="message-avatar"><i class="fas ${icon}"></i></div>
        <div class="message-content">
            <div class="message-bubble">${cleanText}</div>
            <span class="message-time">${new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</span>
        </div>
    `;

    chatMessages.appendChild(messageDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function formatText(text) {
    return text
        .replace(/\n\n/g, '<p style="margin: 8px 0"></p>')
        .replace(/\n/g, '<br>')
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
        // Parse Markdown Links [text](url)
        .replace(/\[(.*?)\]\((.*?)\)/g, '<a href="$2" target="_blank" style="color: #fbbf24; text-decoration: underline; font-weight: bold;">$1</a>');
}

function showTyping() {
    if (typingIndicator) {
        typingIndicator.style.display = 'flex';
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
}

function hideTyping() {
    if (typingIndicator) {
        typingIndicator.style.display = 'none';
    }
}

console.log('✅ Script cargado completamente');

// ============================================
// THOUGHT BUBBLES SYSTEM
// ============================================
function initThoughtBubbles() {
    console.log('🫧 Inicializando burbujas de pensamiento...');

    // Crear contenedor de burbujas si no existe
    thoughtBubbleContainer = document.querySelector('.thought-bubble-container');
    if (!thoughtBubbleContainer) {
        thoughtBubbleContainer = document.createElement('div');
        thoughtBubbleContainer.className = 'thought-bubble-container';
        document.body.appendChild(thoughtBubbleContainer);
    }

    // Asegurar que el primer mensaje sea especial
    isFirstThoughtBubble = true;

    // Iniciar ciclo de burbujas
    startThoughtBubbleCycle();
}

function startThoughtBubbleCycle() {
    // Mostrar primera burbuja después de 3 segundos
    setTimeout(() => {
        showRandomThoughtBubble();
    }, 3000);

    // Continuar mostrando burbujas cada 8-15 segundos
    thoughtBubbleInterval = setInterval(() => {
        // Solo mostrar si el chatbot no está abierto
        if (!chatbotWidget || !chatbotWidget.classList.contains('active')) {
            showRandomThoughtBubble();
        }
    }, getRandomInterval(8000, 15000));
}

function showRandomThoughtBubble() {
    if (!thoughtBubbleContainer) return;

    // Limpiar burbujas anteriores
    thoughtBubbleContainer.innerHTML = '';

    // Seleccionar mensaje - primer mensaje siempre es "Estás en la cima..."
    let randomMessage;
    if (isFirstThoughtBubble) {
        randomMessage = CUTE_MESSAGES[0]; // "Estás en la cima... 🏔️"
        isFirstThoughtBubble = false;
        console.log('💭 Mostrando primer mensaje especial');
    } else {
        // Seleccionar mensaje aleatorio (excluyendo el primero)
        const messageIndex = Math.floor(Math.random() * (CUTE_MESSAGES.length - 1)) + 1;
        randomMessage = CUTE_MESSAGES[messageIndex];
    }

    // Seleccionar posición aleatoria
    const positions = ['position-1', 'position-2', 'position-3', 'position-4', 'position-5'];
    const randomPosition = positions[Math.floor(Math.random() * positions.length)];

    // Crear la nube de pensamiento completa
    const cloud = document.createElement('div');
    cloud.className = `thought-cloud ${randomPosition}`;

    // Crear la burbuja principal
    const mainBubble = document.createElement('div');
    mainBubble.className = 'cloud-main';
    mainBubble.textContent = randomMessage;

    // Crear las burbujas pequeñas (cola de la nube)
    const bubble1 = document.createElement('div');
    bubble1.className = 'cloud-bubble cloud-bubble-1';

    const bubble2 = document.createElement('div');
    bubble2.className = 'cloud-bubble cloud-bubble-2';

    const bubble3 = document.createElement('div');
    bubble3.className = 'cloud-bubble cloud-bubble-3';

    // Ensamblar la nube
    cloud.appendChild(mainBubble);
    cloud.appendChild(bubble1);
    cloud.appendChild(bubble2);
    cloud.appendChild(bubble3);

    // Hacer la nube clickeable para abrir el chat
    cloud.addEventListener('click', () => {
        console.log('💭 Nube clickeada, abriendo chat...');
        if (!chatbotWidget || !chatbotWidget.classList.contains('active')) {
            toggleChatbot();
        }
    });

    // Agregar al contenedor
    thoughtBubbleContainer.appendChild(cloud);

    // Iniciar la animación de flotación después de que se dibuje
    setTimeout(() => {
        cloud.classList.add('animate');
    }, 100);

    // Remover después de la animación completa
    setTimeout(() => {
        if (cloud.parentNode) {
            cloud.parentNode.removeChild(cloud);
        }
    }, 5500); // 5s de animación + 0.5s de margen

    console.log(`💭 Nube mostrada: "${randomMessage}" en ${randomPosition}`);
}

function getRandomInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function stopThoughtBubbles() {
    if (thoughtBubbleInterval) {
        clearInterval(thoughtBubbleInterval);
        thoughtBubbleInterval = null;
    }

    if (thoughtBubbleContainer) {
        thoughtBubbleContainer.innerHTML = '';
    }
}

function resumeThoughtBubbles() {
    if (!thoughtBubbleInterval) {
        // Reiniciar para mostrar el primer mensaje especial
        isFirstThoughtBubble = true;
        startThoughtBubbleCycle();
    }
}
