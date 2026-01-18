/* Live Platform Scripts - Real Chat */

// Variables que se inicializan después de DOMContentLoaded
let chatMessages = null;
let chatInput = null;
let streamId = 'default';
let lastMessageId = 0;
let chatIsAuthenticated = false;

// Use global currentUser from auth-header.php (don't redeclare!)
// let currentUser is already defined in auth-header.php

// API base path for chat (renamed to avoid conflict with auth API_BASE)
const CHAT_API_BASE = '../api/chat.php';

document.addEventListener('DOMContentLoaded', () => {
    // Inicializar elementos del DOM
    chatMessages = document.getElementById('chat-messages');
    chatInput = document.getElementById('chat-input');
    streamId = document.getElementById('stream-id')?.value || 'default';

    console.log('[Chat] Inicializando chat para stream:', streamId);
    console.log('[Chat] chatMessages elemento:', chatMessages ? 'OK' : 'NO ENCONTRADO');
    console.log('[Chat] chatInput elemento:', chatInput ? 'OK' : 'NO ENCONTRADO');

    initChat();
    initVideoControls();
});

// Check auth status from localStorage
function checkAuthStatus() {
    const token = localStorage.getItem('clientToken');
    const userData = localStorage.getItem('clientUser');

    if (token && userData) {
        chatIsAuthenticated = true;
        // Update global currentUser if not set
        if (typeof currentUser === 'undefined' || currentUser === null) {
            window.currentUser = JSON.parse(userData);
        }
        updateChatInputState(true);
    } else {
        chatIsAuthenticated = false;
        updateChatInputState(false);
    }
}

// Update chat input based on auth state
function updateChatInputState(loggedIn) {
    const charCounter = document.getElementById('char-counter');

    if (loggedIn && currentUser) {
        chatInput.placeholder = `Chatear como ${currentUser.nombre}...`;
        chatInput.disabled = false;
        chatInput.classList.remove('cursor-not-allowed', 'opacity-50');
    } else {
        chatInput.placeholder = 'Inicia sesión para chatear...';
        chatInput.disabled = false; // Keep enabled to trigger login modal
        chatInput.classList.add('cursor-pointer');
    }
}

function initChat() {
    checkAuthStatus();

    // Load initial messages
    loadMessages();

    // Poll for new messages every 2 seconds
    setInterval(() => {
        pollNewMessages();
    }, 2000);

    // Handle user input
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && chatInput.value.trim() !== '') {
            handleSendMessage();
        }
    });

    // If not logged in, clicking input opens auth modal
    chatInput.addEventListener('focus', () => {
        checkAuthStatus(); // Recheck in case user logged in

        if (!chatIsAuthenticated) {
            chatInput.blur();
            // Try to open auth modal
            if (typeof toggleAuthDropdown === 'function') {
                toggleAuthDropdown();
            }
        }
    });

    // Listen for auth changes
    window.addEventListener('storage', (e) => {
        if (e.key === 'clientToken' || e.key === 'clientUser') {
            checkAuthStatus();
        }
    });

    // Also check periodically for auth changes
    setInterval(checkAuthStatus, 3000);
}

// Load initial messages
async function loadMessages() {
    console.log('[Chat] loadMessages() llamado, streamId:', streamId);
    try {
        const url = `${CHAT_API_BASE}?action=messages&stream_id=${streamId}`;
        console.log('[Chat] Fetching:', url);
        const response = await fetch(url);
        const data = await response.json();
        console.log('[Chat] Respuesta loadMessages:', data);

        if (data.success && data.messages) {
            chatMessages.innerHTML = '';
            data.messages.forEach(msg => {
                addMessageToChat(msg);
                if (msg.id > lastMessageId) lastMessageId = msg.id;
            });
            scrollToBottom();
        }
    } catch (error) {
        console.error('Error loading messages:', error);
        // Show fallback messages on error
        addSystemMessage('Conectando al chat...');
    }
}

// Poll for new messages
async function pollNewMessages() {
    try {
        const url = `${CHAT_API_BASE}?action=messages&stream_id=${streamId}&last_id=${lastMessageId}`;
        const response = await fetch(url);
        const data = await response.json();

        // Solo log si hay mensajes nuevos
        if (data.success && data.messages && data.messages.length > 0) {
            console.log('[Chat] Nuevos mensajes recibidos:', data.messages.length);
            data.messages.forEach(msg => {
                addMessageToChat(msg);
                if (msg.id > lastMessageId) lastMessageId = msg.id;
            });
            scrollToBottom();
        }
    } catch (error) {
        console.error('Error polling messages:', error);
    }
}

// Send message
async function handleSendMessage() {
    const text = chatInput.value.trim();
    if (!text) return;

    console.log('[Chat] Enviando mensaje:', text);

    // Re-check auth
    checkAuthStatus();

    if (!chatIsAuthenticated) {
        console.log('[Chat] No autenticado, abriendo modal');
        if (typeof toggleAuthDropdown === 'function') {
            toggleAuthDropdown();
        }
        return;
    }

    const token = localStorage.getItem('clientToken');
    console.log('[Chat] Token presente:', !!token);

    try {
        const requestBody = {
            message: text,
            stream_id: streamId
        };
        console.log('[Chat] Request body:', requestBody);

        const response = await fetch(`${CHAT_API_BASE}?action=send`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(requestBody)
        });

        const data = await response.json();
        console.log('[Chat] Respuesta del servidor:', data, 'Status:', response.status);

        if (data.success && data.message) {
            // Message will appear via polling, but add immediately for responsiveness
            addMessageToChat(data.message, true);
            lastMessageId = data.message.id;
            chatInput.value = '';
            updateCharCounter(0);
            scrollToBottom();
        } else {
            // Show error
            if (data.message) {
                alert(data.message);
            }
            // If unauthorized, refresh auth state
            if (response.status === 401) {
                localStorage.removeItem('clientToken');
                localStorage.removeItem('clientUser');
                checkAuthStatus();
            }
        }
    } catch (error) {
        console.error('Error sending message:', error);
        alert('Error al enviar mensaje. Intenta de nuevo.');
    }
}

// Add message to chat display
function addMessageToChat(msg, isOwn = false) {
    const msgElement = document.createElement('div');
    msgElement.className = 'chat-message';
    msgElement.dataset.id = msg.id;

    if (isOwn || (currentUser && msg.user_id === currentUser.id)) {
        msgElement.style.background = 'rgba(251, 191, 36, 0.1)';
        msgElement.style.padding = '4px 8px';
        msgElement.style.borderRadius = '4px';
        msgElement.style.borderLeft = '2px solid #fbbf24';
    }

    const userColor = msg.color || '#fbbf24';
    msgElement.innerHTML = `<span class="chat-user" style="color:${userColor}">${escapeHtml(msg.user)}:</span> ${escapeHtml(msg.message)}`;

    chatMessages.appendChild(msgElement);
}

// Add system message
function addSystemMessage(text) {
    const msgElement = document.createElement('div');
    msgElement.className = 'chat-message';
    msgElement.style.color = '#94a3b8';
    msgElement.style.fontStyle = 'italic';
    msgElement.innerHTML = `<i class="fas fa-info-circle"></i> ${text}`;
    chatMessages.appendChild(msgElement);
}

// Escape HTML to prevent XSS
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Update character counter
function updateCharCounter(length) {
    const counter = document.getElementById('char-counter');
    if (counter) {
        counter.textContent = `${length}/200`;
        if (length > 180) {
            counter.style.color = '#ef4444';
        } else {
            counter.style.color = '#6b7280';
        }
    }
}

// Character counter on input
if (chatInput) {
    chatInput.addEventListener('input', (e) => {
        const length = e.target.value.length;
        if (length > 200) {
            e.target.value = e.target.value.substring(0, 200);
        }
        updateCharCounter(Math.min(length, 200));
    });
}

function scrollToBottom() {
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
}

/* --- Real Viewer Counter with Heartbeat --- */
function initVideoControls() {
    const viewerCount = document.getElementById('count-val');
    if (!viewerCount) return;

    console.log('[Viewers] Iniciando sistema de heartbeat para stream:', streamId);

    // Send heartbeat immediately and every 10 seconds
    sendHeartbeat();
    setInterval(sendHeartbeat, 10000);

    // Update viewer count display
    async function sendHeartbeat() {
        try {
            const response = await fetch(`${CHAT_API_BASE}?action=heartbeat&stream_id=${streamId}`);
            const data = await response.json();

            if (data.success && typeof data.viewers === 'number') {
                viewerCount.textContent = data.viewers.toLocaleString();
                console.log('[Viewers] Actualizado:', data.viewers);
            }
        } catch (error) {
            console.error('[Viewers] Error en heartbeat:', error);
        }
    }
}

/* --- Follow Button --- */
function toggleFollow(btn) {
    btn.classList.toggle('following');
    const isFollowing = btn.classList.contains('following');

    if (isFollowing) {
        btn.innerHTML = '<i class="fas fa-heart text-red-500"></i> Siguiendo';
        btn.classList.remove('bg-purple-600', 'hover:bg-purple-700');
        btn.classList.add('bg-gray-700', 'hover:bg-gray-600');
    } else {
        btn.innerHTML = '<i class="far fa-heart"></i> Seguir';
        btn.classList.remove('bg-gray-700', 'hover:bg-gray-600');
        btn.classList.add('bg-purple-600', 'hover:bg-purple-700');
    }
}
