// State Management
let currentDay = 2;
let allDanzas = [];
let filteredDanzas = [];
let displayedCount = 10;
let currentLiveIndex = -1;

// Initialize
document.addEventListener('DOMContentLoaded', async () => {
    await loadDanzas();
    setupSearch();
    updateStats();
    renderTimeline();
    
    // Auto-refresh every 30 seconds
    setInterval(async () => {
        await loadDanzas();
        updateStats();
        renderTimeline();
    }, 30000);
});

// Load danzas from API
async function loadDanzas() {
    try {
        const response = await fetch('../../api/danzas.php');
        if (!response.ok) throw new Error('Error al cargar danzas');
        
        const data = await response.json();
        allDanzas = Array.isArray(data) ? data : (data.data || []);
        
        // Filter by day (assuming day 2 is Trajes de Luces)
        filteredDanzas = allDanzas.filter(d => {
            const categoria = (d.categoria || '').toUpperCase();
            if (currentDay === 2) {
                return categoria.includes('LUCE') || categoria.includes('TRAJE DE LUCES') || categoria.includes('LUCES');
            } else if (currentDay === 1) {
                return categoria.includes('ORIGIN') || categoria.includes('ORIGINARIAS');
            }
            // Day 3 or default: show all
            return true;
        });
        
        // Sort by orden_concurso
        filteredDanzas.sort((a, b) => {
            const ordenA = parseInt(a.orden_concurso) || 999;
            const ordenB = parseInt(b.orden_concurso) || 999;
            return ordenA - ordenB;
        });
        
        // Determine current live performance
        updateLiveStatus();
        
    } catch (error) {
        console.error('Error loading danzas:', error);
        allDanzas = [];
        filteredDanzas = [];
    }
}

// Update live status based on current time
function updateLiveStatus() {
    const now = new Date();
    const currentHour = now.getHours();
    const currentMinute = now.getMinutes();
    const currentTime = currentHour * 60 + currentMinute;
    
    // Assuming schedule starts at 7:00 AM (420 minutes)
    const startTime = 420; // 7:00 AM
    const avgDuration = 30; // 30 minutes per group
    
    currentLiveIndex = -1;
    
    // For demo purposes, set first few as past, one as live, rest as upcoming
    // In production, this would use actual timestamps from the database
    if (filteredDanzas.length > 0) {
        // Simulate: first 2 are past, 3rd is live, rest are upcoming
        const simulatedLiveIndex = Math.min(2, Math.floor(filteredDanzas.length / 3));
        currentLiveIndex = simulatedLiveIndex;
    }
    
    // Real implementation would be:
    // filteredDanzas.forEach((danza, index) => {
    //     const scheduledTime = startTime + (index * avgDuration);
    //     const actualTime = scheduledTime + (danza.delay || 0);
    //     if (currentTime >= actualTime && currentTime < actualTime + avgDuration) {
    //         currentLiveIndex = index;
    //     }
    // });
}

// Setup search functionality
function setupSearch() {
    const searchInput = document.getElementById('search-input');
    const searchInputMobile = document.getElementById('search-input-mobile');
    
    const handleSearch = (value) => {
        const searchTerm = value.toLowerCase().trim();
        if (searchTerm === '') {
            renderTimeline();
            return;
        }
        
        const filtered = filteredDanzas.filter(d => 
            (d.conjunto || '').toLowerCase().includes(searchTerm)
        );
        
        renderTimeline(filtered);
    };
    
    if (searchInput) {
        searchInput.addEventListener('input', (e) => handleSearch(e.target.value));
    }
    
    if (searchInputMobile) {
        searchInputMobile.addEventListener('input', (e) => handleSearch(e.target.value));
    }
}

// Change day
function changeDay(day) {
    currentDay = day;
    
    // Update button states
    document.querySelectorAll('.day-btn').forEach(btn => {
        const btnDay = parseInt(btn.dataset.day);
        if (btnDay === day) {
            btn.classList.add('bg-primary', 'text-white', 'shadow-md');
            btn.classList.remove('text-text-muted');
        } else {
            btn.classList.remove('bg-primary', 'text-white', 'shadow-md');
            btn.classList.add('text-text-muted');
        }
    });
    
    loadDanzas().then(() => {
        updateStats();
        renderTimeline();
    });
}

// Update statistics
function updateStats() {
    const performed = currentLiveIndex >= 0 ? currentLiveIndex : 0;
    const total = filteredDanzas.length;
    
    const performedEl = document.getElementById('performed-count');
    const totalEl = document.getElementById('total-count');
    if (performedEl) performedEl.textContent = performed;
    if (totalEl) totalEl.textContent = total;
    
    // Calculate average delay (simulated for demo)
    const avgDelay = performed > 0 ? Math.floor(Math.random() * 25) + 5 : 0;
    
    const delayEl = document.getElementById('avg-delay');
    if (delayEl) {
        delayEl.textContent = avgDelay > 0 ? `+${avgDelay} min` : 'A tiempo';
        delayEl.className = avgDelay > 0 
            ? 'text-accent text-3xl font-bold'
            : 'text-green-400 text-3xl font-bold';
    }
}

// Render timeline
function renderTimeline(danzasToRender = null) {
    const container = document.getElementById('timeline-container');
    if (!container) return;
    
    const danzas = danzasToRender || filteredDanzas.slice(0, displayedCount);
    
    container.innerHTML = '';
    
    danzas.forEach((danza, localIndex) => {
        const globalIndex = filteredDanzas.indexOf(danza);
        const isLive = globalIndex === currentLiveIndex;
        const isPast = globalIndex < currentLiveIndex;
        const isUpcoming = globalIndex > currentLiveIndex;
        
        const card = createTimelineCard(danza, globalIndex, isLive, isPast, isUpcoming);
        container.appendChild(card);
    });
    
    // Show load more button if there are more items
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        const hasMore = filteredDanzas.length > displayedCount;
        loadMoreBtn.classList.toggle('hidden', !hasMore);
    }
}

// Create timeline card
function createTimelineCard(danza, index, isLive, isPast, isUpcoming) {
    const item = document.createElement('div');
    item.className = `timeline-item ${isPast ? 'past' : isUpcoming ? 'upcoming' : ''}`;
    
    // Calculate times
    const startTime = 420; // 7:00 AM
    const avgDuration = 30;
    const scheduledMinutes = startTime + (index * avgDuration);
    // Simulate delay for demo (in real app, this would come from API)
    const delay = isPast ? Math.floor(Math.random() * 20) : 0;
    const actualMinutes = scheduledMinutes + delay;
    
    const scheduledTime = formatTime(scheduledMinutes);
    const actualTime = formatTime(actualMinutes);
    const estimatedEnd = formatTime(actualMinutes + avgDuration);
    
    // Status
    let status = 'scheduled';
    let statusText = 'Programado';
    if (isPast) {
        status = 'finished';
        statusText = 'Finalizado';
    } else if (isLive) {
        status = 'performing';
        statusText = 'Presentándose Ahora';
    } else if (isUpcoming && index === currentLiveIndex + 1) {
        status = 'upnext';
        statusText = 'Siguiente';
    }
    
    // Node
    const node = document.createElement('div');
    node.className = `timeline-node ${isLive ? 'live' : ''}`;
    
    // Connector (if not last)
    let connector = '';
    if (index < filteredDanzas.length - 1) {
        connector = '<div class="timeline-connector"></div>';
    }
    
    // Card content
    let cardContent = '';
    
    if (isLive) {
        // Live card (expanded)
        cardContent = `
            <div class="timeline-card live">
                <div class="live-banner">
                    <div class="live-indicator">
                        <span class="live-dot"></span>
                        <span>En Vivo</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-lg">visibility</span>
                        <span class="text-gray-700 text-xs font-bold">12.5k viendo</span>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-7 flex flex-col justify-between gap-6">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-gray-600 font-mono text-sm">Programado: ${scheduledTime}</span>
                                <span class="status-badge performing">${statusText}</span>
                            </div>
                            <h2 class="text-3xl font-black text-gray-900 leading-tight mb-2">${escapeHtml(danza.conjunto || 'Sin nombre')}</h2>
                            <p class="text-gray-600 text-sm">${escapeHtml(danza.descripcion || 'Descripción no disponible')}</p>
                        </div>
                        <div class="stats-grid">
                            <div class="stat-box">
                                <div class="stat-label">Inicio Real</div>
                                <div class="stat-value">${actualTime}</div>
                            </div>
                            <div class="stat-box highlight">
                                <div class="stat-label">Retraso</div>
                                <div class="stat-value accent">${delay > 0 ? '+' + delay + 'm' : '0m'}</div>
                            </div>
                            <div class="stat-box">
                                <div class="stat-label">Fin Est.</div>
                                <div class="stat-value">${estimatedEnd}</div>
                            </div>
                        </div>
                        <div class="flex gap-3 mt-2">
                            <button class="flex-1 bg-primary text-white hover:bg-primary-light py-3 rounded-full font-bold text-sm transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-lg">play_circle</span>
                                Ver Transmisión
                            </button>
                            <button class="size-11 flex items-center justify-center rounded-full border border-gray-300 text-gray-600 hover:text-primary hover:border-primary transition-colors" title="Compartir">
                                <span class="material-symbols-outlined text-lg">share</span>
                            </button>
                        </div>
                    </div>
                    <div class="md:col-span-5 relative h-48 md:h-auto rounded-xl overflow-hidden bg-gray-100 border border-gray-200 group/video cursor-pointer">
                        <img alt="${escapeHtml(danza.conjunto || '')}" 
                             class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover/video:opacity-70 transition-opacity" 
                             src="${danza.foto || 'https://placehold.co/400x300/4c1d95/fbbf24?text=' + encodeURIComponent(danza.conjunto || 'Sin imagen')}"
                             onerror="this.src='https://placehold.co/400x300/4c1d95/fbbf24?text=Sin+imagen'">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/50 to-transparent"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="size-12 rounded-full bg-primary text-white flex items-center justify-center shadow-lg group-hover/video:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-2xl">play_arrow</span>
                            </div>
                        </div>
                        <div class="absolute bottom-3 left-3">
                            <p class="text-white text-xs font-bold">Transmisión en Vivo • Escenario Principal</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
    } else {
        // Regular card
        const delayText = delay > 0 ? `+${delay}m` : 'A tiempo';
        const delayClass = delay > 0 ? 'delayed' : 'on-time';
        
        cardContent = `
            <div class="timeline-card">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-3">
                            <span class="text-gray-600 font-mono text-sm">${scheduledTime}</span>
                            <span class="status-badge ${status}">${statusText}</span>
                        </div>
                        <h3 class="text-gray-900 text-lg font-bold leading-tight">${escapeHtml(danza.conjunto || 'Sin nombre')}</h3>
                        ${isUpcoming && index === currentLiveIndex + 1 ? `
                            <p class="text-gray-600 text-sm mt-1">${escapeHtml(danza.descripcion || '')}</p>
                        ` : ''}
                    </div>
                    ${isPast ? `
                        <div class="text-right sm:text-left">
                            <span class="delay-indicator ${delayClass}">${delayText}</span>
                        </div>
                    ` : isUpcoming && index === currentLiveIndex + 1 ? `
                        <div class="flex items-center gap-1 text-primary text-sm font-medium">
                            <span class="material-symbols-outlined text-base">warning</span>
                            <span>Est. ${delay > 0 ? '+' + delay + 'm' : 'A tiempo'}</span>
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
    }
    
    item.innerHTML = `
        ${node.outerHTML}
        ${connector}
        ${cardContent}
    `;
    
    return item;
}

// Format time from minutes since midnight
function formatTime(minutes) {
    const hours = Math.floor(minutes / 60);
    const mins = minutes % 60;
    const period = hours >= 12 ? 'PM' : 'AM';
    const displayHours = hours > 12 ? hours - 12 : (hours === 0 ? 12 : hours);
    return `${displayHours.toString().padStart(2, '0')}:${mins.toString().padStart(2, '0')} ${period}`;
}

// Load more groups
function loadMoreGroups() {
    displayedCount += 10;
    renderTimeline();
}

// Escape HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
