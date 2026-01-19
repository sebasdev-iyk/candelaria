
// Constants
const API_URL = 'api.php';
const DEFAULT_SIM_START = '08:30';
const DEFAULT_DAY = 'Day 2';
const ITEMS_PER_PAGE = 6;

// State
let allGroups = [];
let filteredGroups = [];
let visibleCount = ITEMS_PER_PAGE;
let activeDay = DEFAULT_DAY;
let simTime = null;
let isSimRunning = true; // Auto-run
let simSpeed = 1;
let intervalId = null;

// DOM Elements
const timelineContainer = document.getElementById('timeline-container');
const searchInput = document.getElementById('search-input');
const searchInputMobile = document.getElementById('search-input-mobile');
const statProgress = document.getElementById('stat-progress');
const statTotal = document.getElementById('stat-total');
const dayButtons = document.querySelectorAll('.day-btn');
const btnLoadMore = document.getElementById('btn-load-more');

// --- Initialization ---
document.addEventListener('DOMContentLoaded', async () => {
    await loadData();
    resetSimulation(false); // Set time to 08:30 without stopping
    startSimulation(); // Start clock
    setupEventListeners();
    applyFilters();
});

// --- Data Loading ---
async function loadData() {
    try {
        const response = await fetch(API_URL);
        allGroups = await response.json();
        // Parse time
        allGroups.forEach(g => {
            const [hours, minutes] = g.scheduled_time.split(':').map(Number);
            g.schedMinutes = hours * 60 + minutes;
        });
    } catch (error) {
        console.error("Failed to load data", error);
        if (timelineContainer) timelineContainer.innerHTML = `<p class="text-white text-center">Error loading schedule data.</p>`;
    }
}

// --- Event Listeners ---
function setupEventListeners() {
    // Search Sync
    if (searchInput) searchInput.addEventListener('input', (e) => {
        if (searchInputMobile) searchInputMobile.value = e.target.value;
        applyFilters(true);
    });
    if (searchInputMobile) searchInputMobile.addEventListener('input', (e) => {
        if (searchInput) searchInput.value = e.target.value;
        applyFilters(true);
    });

    // Day Buttons
    dayButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Reset Styles
            dayButtons.forEach(b => {
                b.className = 'day-btn px-5 py-2 rounded-full text-sm font-bold text-text-muted hover:text-white transition-colors cursor-pointer';
            });
            // Active Style
            btn.className = 'day-btn px-5 py-2 rounded-full bg-primary text-white shadow-md text-sm font-bold cursor-pointer';

            activeDay = btn.dataset.day;
            applyFilters(true);
        });
    });

    // Load More
    if (btnLoadMore) btnLoadMore.addEventListener('click', () => {
        visibleCount += 5;
        applyFilters(false);
    });
}

// --- Logic ---
function applyFilters(resetVisible = false) {
    if (resetVisible) visibleCount = ITEMS_PER_PAGE;

    const searchText = searchInput ? searchInput.value.toLowerCase() : '';

    filteredGroups = allGroups.filter(g => {
        const matchDay = g.day === activeDay; // Precise match
        const matchSearch = g.conjunto.toLowerCase().includes(searchText);
        return matchDay && matchSearch;
    });

    filteredGroups.sort((a, b) => a.schedMinutes - b.schedMinutes);

    if (statTotal) statTotal.textContent = filteredGroups.length;

    // Load More Button visibility
    if (btnLoadMore) {
        if (visibleCount >= filteredGroups.length) {
            btnLoadMore.style.display = 'none';
        } else {
            btnLoadMore.style.display = 'flex';
            const remaining = filteredGroups.length - visibleCount;
            btnLoadMore.querySelector('span').textContent = `Load remaining ${remaining} groups`;
        }
    }

    updateUI();
}

// --- Simulation Logic (Internal) ---
function resetSimulation(stop = true) {
    if (stop && intervalId) clearInterval(intervalId);
    const today = new Date();
    const [h, m] = DEFAULT_SIM_START.split(':');
    today.setHours(parseInt(h), parseInt(m), 0, 0);
    simTime = today;
    updateUI();
}

function startSimulation() {
    if (intervalId) return;
    isSimRunning = true;
    intervalId = setInterval(() => {
        simTime = new Date(simTime.getTime() + (1000 * simSpeed));
        // Update UI every 10 simulated seconds to avoid DOM thrashing
        if (simTime.getSeconds() % 10 === 0) {
            updateUI();
        }
    }, 1000);
}

// --- Rendering Logic ---
function updateUI() {
    if (!simTime) return;

    const currentMinutes = simTime.getHours() * 60 + simTime.getMinutes();
    let finishedCount = 0;

    const processedGroups = filteredGroups.map(group => {
        const delay = group.delay_minutes || 0;
        const start = group.schedMinutes + delay;
        const end = start + 20;

        let status = 'upcoming';
        if (currentMinutes >= end) {
            status = 'finished';
            finishedCount++;
        } else if (currentMinutes >= start) {
            status = 'live';
        }

        return { ...group, computedStatus: status };
    });

    if (statProgress) statProgress.textContent = finishedCount;

    const groupsToShow = processedGroups.slice(0, visibleCount);
    renderTimeline(groupsToShow);
}

function renderTimeline(groups) {
    if (groups.length === 0) {
        timelineContainer.innerHTML = '<p class="text-text-muted text-center py-4">No groups found for this criteria.</p>';
        return;
    }

    const html = groups.map((group, index) => {
        // --- FINISHED ITEM ---
        if (group.computedStatus === 'finished') {
            return `
            <div class="relative pl-20 group opacity-50 hover:opacity-80 transition-opacity">
                <!-- Node -->
                <div class="absolute left-[21px] top-2 size-3 bg-border-dark rounded-full ring-4 ring-background-dark"></div>
                 ${index < groups.length - 1 ? '<div class="absolute left-6 top-5 bottom-[-40px] w-px border-l border-border-dark"></div>' : ''}
                
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 rounded-xl border border-transparent hover:border-border-dark/50 hover:bg-surface-dark/30 transition-all">
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-3">
                            <span class="text-text-muted font-mono text-sm">${group.scheduled_time} AM</span>
                            <span class="px-2 py-0.5 rounded-full bg-surface-dark border border-border-dark text-[10px] font-bold text-text-muted uppercase tracking-wider">Finished</span>
                        </div>
                        <h3 class="text-white text-lg font-bold leading-tight">${group.conjunto}</h3>
                    </div>
                    <div class="text-right sm:text-left">
                        <span class="text-sm text-green-400 font-medium">On Time</span>
                    </div>
                </div>
            </div>`;
        }

        // --- LIVE ITEM ---
        else if (group.computedStatus === 'live') {
            return `
            <div class="relative pl-4 sm:pl-16 z-10 transition-all duration-500 ease-out">
                <!-- Custom Node for Live -->
                <div class="absolute left-[21px] top-1/2 -translate-y-1/2 hidden sm:block">
                    <span class="relative flex h-4 w-4">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-primary"></span>
                    </span>
                </div>
                <!-- Live Card -->
                <div class="bg-surface-dark rounded-2xl border border-primary/50 shadow-[0_0_30px_-5px_rgba(236,19,37,0.15)] overflow-hidden relative">
                    <div class="bg-primary/10 border-b border-primary/20 px-6 py-2 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-primary font-black tracking-wider text-sm uppercase">
                            <span class="material-symbols-outlined text-lg animate-pulse fill-1">circle</span>
                            Live Stage
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-lg">visibility</span>
                            <span class="text-white text-xs font-bold">12.5k watching</span>
                        </div>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-12 gap-6">
                        <!-- Info Column -->
                        <div class="md:col-span-7 flex flex-col justify-between gap-6">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-white/80 font-mono text-sm">Sched: ${group.scheduled_time} AM</span>
                                    <span class="px-3 py-1 rounded-full bg-primary text-white text-[10px] font-black uppercase tracking-wider shadow-sm">Performing Now</span>
                                </div>
                                <h2 class="text-3xl font-black text-white leading-tight mb-2">${group.conjunto}</h2>
                                <p class="text-text-muted text-sm">${group.description || 'Traditional dance performance.'}</p>
                            </div>
                            <div class="grid grid-cols-3 gap-2 mt-2">
                                <div class="bg-background-dark rounded-xl p-3 border border-border-dark">
                                    <p class="text-[10px] text-text-muted uppercase font-bold tracking-wider mb-1">Act. Start</p>
                                    <p class="text-white font-mono font-bold">${group.actual_start_time || group.scheduled_time}</p>
                                </div>
                                <div class="bg-background-dark rounded-xl p-3 border border-border-dark border-l-2 border-l-primary">
                                    <p class="text-[10px] text-text-muted uppercase font-bold tracking-wider mb-1">Delay</p>
                                    <p class="text-primary font-mono font-bold">+${group.delay_minutes}m</p>
                                </div>
                                <div class="bg-background-dark rounded-xl p-3 border border-border-dark">
                                    <p class="text-[10px] text-text-muted uppercase font-bold tracking-wider mb-1">Est. End</p>
                                    <p class="text-white font-mono font-bold">--:--</p>
                                </div>
                            </div>
                            <div class="flex gap-3 mt-2">
                                <button onclick="window.location.href='/candelaria/live-platform/index.php'" class="flex-1 bg-white text-background-dark hover:bg-gray-200 py-3 rounded-full font-bold text-sm transition-colors flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-lg">play_circle</span>
                                    Watch Stream
                                </button>
                                <button class="size-11 flex items-center justify-center rounded-full border border-border-dark text-text-muted hover:text-white hover:bg-white/5 transition-colors" title="Share">
                                    <span class="material-symbols-outlined text-lg">share</span>
                                </button>
                            </div>
                        </div>
                        <!-- Visual Column -->
                        <div class="md:col-span-5 relative h-48 md:h-auto rounded-xl overflow-hidden bg-black group/video cursor-pointer">
                            ${group.image ? `<img alt="${group.conjunto}" class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover/video:opacity-40 transition-opacity" src="${group.image}"/>` :
                    `<div class="absolute inset-0 bg-gray-800 flex items-center justify-center"><span class="material-symbols-outlined text-4xl text-gray-600">image</span></div>`}
                            <div class="absolute inset-0 bg-gradient-to-t from-background-dark/90 to-transparent"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="size-12 rounded-full bg-primary/90 text-white flex items-center justify-center shadow-lg group-hover/video:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-2xl">play_arrow</span>
                                </div>
                            </div>
                            <div class="absolute bottom-3 left-3">
                                <p class="text-white text-xs font-bold">Live Feed • Main Stage</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        }

        // --- UPCOMING ITEM ---
        else {
            return `
            <div class="relative pl-20 group">
                <!-- Node -->
                <div class="absolute left-[21px] top-6 size-3 bg-white rounded-full ring-4 ring-background-dark"></div>
                <!-- Connector (Dotted) -->
                ${index < groups.length - 1 ? '<div class="absolute left-6 top-9 bottom-[-40px] w-px border-l border-dashed border-text-muted/30"></div>' : ''}
                
                <div class="flex flex-col gap-3 p-4 rounded-xl hover:bg-surface-dark transition-colors border border-transparent hover:border-border-dark cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-white font-mono font-bold text-lg">${group.scheduled_time} AM</span>
                            <span class="px-2 py-0.5 rounded-full bg-surface-dark border border-border-dark text-[10px] font-bold text-white uppercase tracking-wider">Up Next</span>
                        </div>
                        <div class="flex items-center gap-1 text-primary text-sm font-medium">
                            <span class="material-symbols-outlined text-base">warning</span>
                            <span>Est. +${group.delay_minutes}m Late</span>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="size-12 rounded-full bg-surface-dark border border-border-dark flex-shrink-0 overflow-hidden">
                             ${group.image ? `<img src="${group.image}" class="w-full h-full object-cover">` :
                    `<div class="w-full h-full flex items-center justify-center text-text-muted font-bold text-xs">${group.conjunto.substring(0, 2)}</div>`}
                        </div>
                        <div>
                            <h3 class="text-white text-xl font-bold">${group.conjunto}</h3>
                             <p class="text-text-muted text-sm mt-1">Scheduled for ${group.day}</p>
                        </div>
                    </div>
                </div>
            </div>`;
        }
    }).join('');

    timelineContainer.innerHTML = html;
}
