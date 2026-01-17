/* Live Platform Scripts */

document.addEventListener('DOMContentLoaded', () => {
    initChat();
    initVideoControls();
});

/* --- Chat Simulation --- */
const chatMessages = document.getElementById('chat-messages');
const chatInput = document.getElementById('chat-input');

const users = [
    { name: 'JuanPerez', color: '#ef4444' },
    { name: 'MariaDanza', color: '#3b82f6' },
    { name: 'CandelariaFan', color: '#fbbf24' },
    { name: 'PunoTierraMia', color: '#10b981' },
    { name: 'CaporalW', color: '#8b5cf6' },
    { name: 'DiabladaKing', color: '#f59e0b' },
    { name: 'TuristaLima', color: '#ec4899' }
];

const messages = [
    "¡Qué hermosa entrada! 💃🕺",
    "Saludos desde Lima ❤️",
    "¡Viva la Virgen de la Candelaria! 🙏",
    "¿A qué hora sale la morenada?",
    "Increíble los trajes este año 👏",
    "Puno capital del folclore 🇵🇪",
    "¡Esoooo! Dale con todo",
    "Saludos a la familia Mamani en Juliaca",
    "¡Qué energía! 🔥",
    "La banda está espectacular 🎺"
];

function initChat() {
    // Add initial messages
    for (let i = 0; i < 5; i++) {
        addRandomMessage();
    }

    // Auto add messages
    setInterval(() => {
        if (Math.random() > 0.6) {
            addRandomMessage();
        }
    }, 2000);

    // Handle user input
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && chatInput.value.trim() !== '') {
            addUserMessage(chatInput.value);
            chatInput.value = '';
        }
    });

    // Scroll to bottom
    scrollToBottom();
}

function addRandomMessage() {
    const user = users[Math.floor(Math.random() * users.length)];
    const text = messages[Math.floor(Math.random() * messages.length)];
    
    const msgElement = document.createElement('div');
    msgElement.className = 'chat-message';
    msgElement.innerHTML = `<span class="chat-user" style="color:${user.color}">${user.name}:</span> ${text}`;
    
    chatMessages.appendChild(msgElement);
    scrollToBottom();
}

function addUserMessage(text) {
    const msgElement = document.createElement('div');
    msgElement.className = 'chat-message';
    msgElement.style.background = 'rgba(255,255,255,0.05)';
    msgElement.style.padding = '4px 8px';
    msgElement.style.borderRadius = '4px';
    // User is always gold/accent
    msgElement.innerHTML = `<span class="chat-user" style="color:#fbbf24">Tú:</span> ${text}`;
    
    chatMessages.appendChild(msgElement);
    scrollToBottom();
}

function scrollToBottom() {
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

/* --- Video Controls Mock --- */
function initVideoControls() {
    // Viewer count simulation
    const viewerCount = document.getElementById('viewer-count');
    let count = 15400;
    
    setInterval(() => {
        const change = Math.floor(Math.random() * 50) - 20;
        count += change;
        viewerCount.innerText = count.toLocaleString() + ' Viewers';
    }, 3000);
}
