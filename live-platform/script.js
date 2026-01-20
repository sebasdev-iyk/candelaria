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

/* --- Tabs & Rankings Logic --- */
const MOCK_SCORES = {
    autoctonos: [
        { name: "Asoc. Cultural Sikuris Claveles Rojos", parada: 85.50, estadio: 88.00, final: 86.75 },
        { name: "Conjunto de Zampoñas de Yunguyo", parada: 84.00, estadio: 86.50, final: 85.25 },
        { name: "Agrupación Zampoñistas del Altiplano", parada: 88.00, estadio: 89.50, final: 88.75 },
        { name: "Unión de Sikuris de Puno", parada: 82.50, estadio: 83.00, final: 82.75 },
        { name: "Asociación Juvenil Puno", parada: 87.00, estadio: 85.50, final: 86.25 },
        { name: "Sikuris Mañazo", parada: 89.50, estadio: 88.00, final: 88.75 },
        { name: "Juventud Obrera", parada: 83.50, estadio: 84.00, final: 83.75 },
        { name: "Sikuris 27 de Junio", parada: 86.00, estadio: 87.50, final: 86.75 }
    ],
    luces: [
        { name: "Morenada Laykakota", parada: 92.00, estadio: 94.50, final: 93.25 },
        { name: "Diablada Bellavista", parada: 95.00, estadio: 96.00, final: 95.50 },
        { name: "Caporales Centralistas", parada: 91.50, estadio: 92.00, final: 91.75 },
        { name: "Tinkus del Valle", parada: 89.00, estadio: 90.50, final: 89.75 },
        { name: "Waca Waca San Román", parada: 88.50, estadio: 87.00, final: 87.75 },
        { name: "Morenada Orkapata", parada: 90.00, estadio: 91.50, final: 90.75 },
        { name: "Diablada Azoguini", parada: 93.50, estadio: 92.00, final: 92.75 },
        { name: "Rey Caporal", parada: 88.00, estadio: 89.50, final: 88.75 }
    ]
};

// Start with a default render
document.addEventListener('DOMContentLoaded', () => {
    renderScores('autoctonos');
});

function switchView(viewName) {
    const liveView = document.getElementById('view-live');
    const scoresView = document.getElementById('view-scores');
    const mapView = document.getElementById('view-map');

    const tabLive = document.getElementById('tab-live');
    const tabScores = document.getElementById('tab-scores');
    const tabMap = document.getElementById('tab-map');

    const chatSidebar = document.getElementById('chat-sidebar');

    // Reset all
    liveView.classList.add('hidden');
    scoresView.classList.add('hidden');
    mapView.classList.add('hidden');

    tabLive.classList.remove('active');
    tabScores.classList.remove('active');
    tabMap.classList.remove('active');

    if (viewName === 'live') {
        liveView.classList.remove('hidden');
        tabLive.classList.add('active');
        if (chatSidebar) chatSidebar.style.display = 'flex'; // Show chat
    } else {
        if (chatSidebar) chatSidebar.style.display = 'none'; // Hide chat for other views

        if (viewName === 'scores') {
            scoresView.classList.remove('hidden');
            tabScores.classList.add('active');
        } else if (viewName === 'map') {
            mapView.classList.remove('hidden');
            tabMap.classList.add('active');
            // Initialize map if needed
            setTimeout(initMapLive, 200);
        }
    }
}

/* --- Real-Time Map Logic --- */
let map;
let routeLine = null;
let routePoints = [];
let dansas = [];
let totalRouteLength = 0;
let updateInterval;
let danceMarkers = {};
let mapInitialized = false;

// API Path relative to live-platform/index.php -> ../../php-admin/api/admin/mapa.php
const MAP_API_BASE = '../../php-admin/api/admin/mapa.php';

async function initMapLive() {
    if (mapInitialized) {
        map.invalidateSize(); // Fix leafet render issues when showing from hidden
        return;
    }

    const mapElement = document.getElementById('map-live-container');
    if (!mapElement) return;

    map = L.map('map-live-container').setView([-15.8407, -70.0214], 14); // Puno

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Load Data
    await loadRoute();
    await loadDances();

    // Start Polling
    if (updateInterval) clearInterval(updateInterval);
    updateInterval = setInterval(updateDancesState, 2000);

    mapInitialized = true;
}

async function loadRoute() {
    try {
        const response = await fetch(`${MAP_API_BASE}/route-points`);
        if (response.ok) {
            routePoints = await response.json();
            drawRoute();
        }
    } catch (error) {
        console.error('Error loading route:', error);
    }
}

function drawRoute() {
    if (!map) return;
    if (routeLine) map.removeLayer(routeLine);

    if (routePoints && routePoints.length >= 2) {
        const latlngs = routePoints.map(p => [p.lat, p.lng]);
        routeLine = L.polyline(latlngs, {
            color: '#4CAF50',
            weight: 6,
            opacity: 0.7,
            smoothFactor: 1,
            lineCap: 'round',
            lineJoin: 'round',
            dashArray: '10, 10'
        }).addTo(map);

        map.fitBounds(routeLine.getBounds(), { padding: [50, 50] });
    }
}

async function loadDances() {
    try {
        const response = await fetch(`${MAP_API_BASE}/dances`);
        if (response.ok) {
            dansas = await response.json();
            updateMapMarkers();
        }
    } catch (error) {
        console.error('Error loading dances:', error);
    }
}

async function updateDancesState() {
    try {
        const response = await fetch(`${MAP_API_BASE}/dances`);
        if (response.ok) {
            dansas = await response.json();
            updateMapMarkers();
        }
    } catch (error) {
        console.error('Error updating dances:', error);
    }
}

function updateMapMarkers() {
    if (!map) return;

    Object.keys(danceMarkers).forEach(markerId => {
        const stillExists = dansas.some(danza => danza.id === markerId);
        if (!stillExists) {
            if (map.hasLayer(danceMarkers[markerId])) map.removeLayer(danceMarkers[markerId]);
            delete danceMarkers[markerId];
        }
    });

    dansas.forEach(danza => {
        const shouldShowMarker = danza.started || (danza.distance_traveled > 0 && !danza.finished);

        if (danceMarkers[danza.id]) {
            if (shouldShowMarker) {
                const newLatLng = [danza.lat, danza.lng];
                danceMarkers[danza.id].setLatLng(newLatLng);
                danceMarkers[danza.id].setPopupContent(createPopupContent(danza));
                if (!map.hasLayer(danceMarkers[danza.id])) danceMarkers[danza.id].addTo(map);
            } else {
                if (map.hasLayer(danceMarkers[danza.id])) map.removeLayer(danceMarkers[danza.id]);
            }
        } else if (shouldShowMarker) {
            let iconHtml;

            // Use photo if available, otherwise fallback to emoji
            if (danza.foto && danza.foto.trim() !== '') {
                iconHtml = `
                    <div style="
                        width: 44px;
                        height: 44px;
                        border-radius: 50%;
                        border: 3px solid ${danza.color};
                        background-image: url('${danza.foto}');
                        background-size: cover;
                        background-position: center;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.4);
                    "></div>
                `;
            } else {
                // Fallback to emoji
                iconHtml = `<div style="font-size: 28px; color: ${danza.color}; text-shadow: 1px 1px 3px rgba(0,0,0,0.7);">${danza.icon || '💃'}</div>`;
            }

            const icon = L.divIcon({
                html: iconHtml,
                className: 'custom-dance-icon',
                iconSize: [44, 44],
                iconAnchor: [22, 22]
            });

            const marker = L.marker([danza.lat, danza.lng], { icon: icon }).addTo(map);
            marker.bindPopup(createPopupContent(danza));
            marker.on('click', function () { map.setView([danza.lat, danza.lng], map.getZoom()); });
            danceMarkers[danza.id] = marker;
        }
    });
}

function createPopupContent(danza) {
    const photoHtml = danza.foto && danza.foto.trim() !== ''
        ? `<img src="${danza.foto}" alt="${danza.name}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin: 0 auto 10px; display: block; border: 2px solid ${danza.color};">`
        : '';

    return `
        <div style="text-align: center; color: #333; min-width: 150px;">
            ${photoHtml}
            <h3 style="color: ${danza.color}; margin-bottom: 5px; font-weight: bold;">${danza.name}</h3>
            <p><strong>Tipo:</strong> ${danza.type}</p>
            <p><strong>Progreso:</strong> ${danza.progress.toFixed(1)}%</p>
            <p><strong>Distancia:</strong> ${danza.distance_traveled.toFixed(2)} km</p>
        </div>
    `;
}

function switchScoreType(type) {
    const btnAuto = document.getElementById('btn-autoctonos');
    const btnLuces = document.getElementById('btn-luces');

    const activeClass = ['bg-purple-600', 'text-white', 'shadow-lg'];
    // Classes for inactive state: transparent bg, lighter text
    const inactiveClass = ['text-gray-300', 'hover:text-white', 'bg-transparent', 'shadow-none'];

    // Helper to switch classes
    const setBtnState = (btn, isActive) => {
        // First remove everything to be safe
        btn.classList.remove('bg-purple-600', 'text-white', 'shadow-lg', 'text-gray-300', 'hover:text-white', 'bg-transparent', 'shadow-none');

        if (isActive) {
            btn.classList.add('bg-purple-600', 'text-white', 'shadow-lg');
        } else {
            btn.classList.add('text-gray-300', 'hover:text-white', 'bg-transparent', 'shadow-none');
        }
    };

    if (type === 'autoctonos') {
        setBtnState(btnAuto, true);
        setBtnState(btnLuces, false);
    } else {
        setBtnState(btnAuto, false);
        setBtnState(btnLuces, true);
    }

    renderScores(type);
}

function renderScores(type) {
    const listContainer = document.getElementById('scores-list');
    if (!listContainer) return;

    listContainer.innerHTML = '';
    const scores = MOCK_SCORES[type] || [];

    // Sort by final score desc
    scores.sort((a, b) => b.final - a.final);

    scores.forEach((item, index) => {
        const rank = index + 1;
        let rankColor = 'text-gray-400';
        let rowBg = 'hover:bg-gray-700/50';

        if (rank === 1) { rankColor = 'text-yellow-400'; rowBg = 'bg-yellow-900/10 hover:bg-yellow-900/20'; }
        if (rank === 2) { rankColor = 'text-gray-300'; }
        if (rank === 3) { rankColor = 'text-amber-600'; }

        const html = `
            <div class="grid grid-cols-12 p-5 items-center transition-colors ${rowBg}">
                <div class="col-span-6 md:col-span-5 flex items-center gap-4 pl-4">
                    <span class="text-2xl font-bold font-heading w-8 ${rankColor}">#${rank}</span>
                    <span class="font-medium text-gray-100">${item.name}</span>
                </div>
                <div class="col-span-2 text-center text-gray-400 hidden md:block font-mono bg-black/20 py-1 rounded mx-2">
                    ${item.parada.toFixed(2)}
                </div>
                <div class="col-span-2 text-center text-gray-400 hidden md:block font-mono bg-black/20 py-1 rounded mx-2">
                    ${item.estadio.toFixed(2)}
                </div>
                <div class="col-span-6 md:col-span-3 text-center">
                    <span class="text-xl font-bold text-candelaria-gold bg-yellow-400/10 px-3 py-1 rounded-lg border border-yellow-400/20">
                        ${item.final.toFixed(2)}
                    </span>
                </div>
            </div>
        `;
        listContainer.insertAdjacentHTML('beforeend', html);
    });
}
