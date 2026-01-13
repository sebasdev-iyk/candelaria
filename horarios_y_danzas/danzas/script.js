// ===== DATOS =====
const eventos = [
    { id: 1, fecha: '24 ENE', dia: 'VIE', banda: 'Inicio de Novena', genero: 'RELIGIOSO', hora: '19:00', imagen: 'https://files.hozana.org/203582-novena-a-santa-rita-de-cascia!990x427.webp', color: 'linear-gradient(to bottom right, #eab308, #b45309)' },
    { id: 2, fecha: '25 ENE', dia: 'SÁB', banda: 'Segundo día de Novena', genero: 'RELIGIOSO', hora: '19:00', imagen: 'https://files.hozana.org/198364-hermosa-novena-a-la-inmaculada-concepcion-en-audio!448x200.webp', color: 'linear-gradient(to bottom right, #ca8a04, #b45309)' },
    { id: 3, fecha: '28 ENE', dia: 'MAR', banda: 'Entrada de Qhʼapuas y Ceremonia Andina', genero: 'TRADICIONAL', hora: '08:00', imagen: 'https://www.caminosalkantay.com/blog/wp-content/uploads/2023/06/La-ceremonia-de-la-boda-andina.jpg', color: 'linear-gradient(to bottom right, #dc2626, #ea580c)' },
    { id: 4, fecha: '1 FEB', dia: 'SÁB', banda: 'Concurso de Danzas Originarias – Día 1', genero: 'ORIGINARIAS', hora: '08:00 - 18:00', imagen: 'https://imgmedia.larepublica.pe/1000x590/larepublica/original/2025/02/03/67a12120a8e33d5aa110b300.webp', color: 'linear-gradient(to bottom right, #16a34a, #15803d)' },
    { id: 5, fecha: '2 FEB', dia: 'DOM', banda: 'Concurso de Danzas Originarias – Día 2', genero: 'ORIGINARIAS', hora: '08:00 - 18:00', imagen: 'https://vivecandelaria.com/wp-content/uploads/2025/02/wifala_san_francisco_javier_de_munani.jpg', color: 'linear-gradient(to bottom right, #2563eb, #1e3a8a)' },
    { id: 6, fecha: '3 FEB', dia: 'LUN', banda: 'Parada de Veneración – Danzas Originarias', genero: 'PARADA', hora: '08:00 - 16:00', imagen: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRq_qLzzu8qaFxNMO0QpWjNK1BBVkkCtG5gLcohW922qb2idRtVIa1xoYMnMr8HBuJgdn0&usqp=CAU', color: 'linear-gradient(to bottom right, #0d9488, #15803d)' },
    { id: 7, fecha: '8 FEB', dia: 'SÁB', banda: 'Concurso de Danzas con Traje de Luces – Día 1', genero: 'TRAJE DE LUCES', hora: '08:00 - 18:00', imagen: 'https://domiruthperutravel.com/es/wp-content/uploads/2021/09/domiruthperutravel-itinerario-puno-candelaria-3.jpg', color: 'linear-gradient(to bottom right, #9333ea, #be185d)' },
    { id: 8, fecha: '9 FEB', dia: 'DOM', banda: 'Concurso de Danzas con Traje de Luces – Día 2', genero: 'TRAJE DE LUCES', hora: '08:00 - 18:00', imagen: 'https://radioondaazul.com/wp-content/uploads/2024/11/Trajes-de-Luces.jpg', color: 'linear-gradient(to bottom right, #ec4899, #be185d)' },
    { id: 9, fecha: '10 FEB', dia: 'LUN', banda: 'Parada de Veneración – Traje de Luces (Gran día)', genero: 'PARADA', hora: '08:00 - 20:00', imagen: 'https://diariocorreo.pe/resizer/YSZRetm186Lzt5YSt17DbtPGn_c=/1200x900/smart/filters:format(jpeg):quality(75)/arc-anglerfish-arc2-prod-elcomercio.s3.amazonaws.com/public/RIBVOYVJMJCCDKMBU7W25RRPJU.jpg', color: 'linear-gradient(to bottom right, #b91c1c, #7f1d1d)' },
    { id: 10, fecha: '11 FEB', dia: 'MAR', banda: 'Procesión de la Octava', genero: 'RELIGIOSO', hora: '14:00', imagen: 'https://radioondaazul.com/wp-content/uploads/2024/02/procesion-por-la-octava-de-la-Virgen-de-la-Candelaria.jpg', color: 'linear-gradient(to bottom right, #b45309, #fbbf24)' },
    { id: 11, fecha: '12 FEB', dia: 'MIÉ', banda: 'Misa Mayor de la Octava', genero: 'RELIGIOSO', hora: '10:00', imagen: 'https://radioondaazul.com/wp-content/uploads/2021/02/Misa-de-Fiesta-Festividad-Virgen-de-la-Candelaria-2021-1.jpg', color: 'linear-gradient(to bottom right, #4b5563, #1f2937)' },
    { id: 12, fecha: '15 FEB', dia: 'SÁB', banda: 'Cacharpaya – Despedida de la Festividad', genero: 'CIERRE / FIESTA', hora: '12:00', imagen: 'https://www.incasperu.com/wp-content/uploads/2020/08/viaje-a-puno-virgen-candelaria-1280x720.jpg', color: 'linear-gradient(to bottom right, #1e40af, #1e3a8a)' }
];

// danzas will be loaded from the API service
let danzas = [];

const faqs = [
    { id: 1, question: "¿Cuáles son los horarios del evento?", answer: "El evento se desarrolla durante dos meses, con actividades diarias. Consulta la pestaña de Programación para ver los horarios específicos de cada día." },
    { id: 2, question: "¿Cómo puedo obtener entradas?", answer: "Las entradas están disponibles en las taquillas principales y a través de nuestra plataforma en línea. Consulta con nuestro equipo de contacto para más detalles." },
    { id: 3, question: "¿Dónde se realiza el evento?", answer: "El evento se realiza en múltiples escenarios del salón. Consulta la pestaña de Mapa para ver la ubicación de cada presentación." },
    { id: 4, question: "¿Puedo participar como danzante?", answer: "Sí, se aceptan nuevos grupos de danzas. Contacta a nuestro equipo para conocer los requisitos y el proceso de inscripción." },
    { id: 5, question: "¿Hay estacionamiento disponible?", answer: "Sí, contamos con estacionamiento gratuito para todos nuestros visitantes. Consulta con el personal de seguridad para ubicar las áreas disponibles." }
];

// Función para establecer pestaña activa (nueva compatibilidad con servicios estilo)
function setActiveTab(tabName) {
    // Actualizar UI de pestañas
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-candelaria-purple', 'text-candelaria-purple', 'text-gray-900');
        btn.classList.add('border-transparent', 'text-gray-500');
    });

    const activeBtn = document.getElementById(`tab-${tabName}`);
    if (activeBtn) {
        activeBtn.classList.remove('border-transparent', 'text-gray-500');
        activeBtn.classList.add('border-candelaria-purple', 'text-candelaria-purple', 'text-gray-900');
    }

    // Redirigir a la pestaña correspondiente
    if(tabName !== 'danzas') {
        window.location.href = `../${tabName}/index.html`;
    }
}

// ===== ESTADO =====
let activeTab = 'lista';
let selectedDate = null;
let searchTerm = '';
let showFilters = false;
let currentMonth = 0;
let currentYear = 2025;
let currentPage = 1;
const ITEMS_PER_PAGE = 10;

// ===== INICIALIZACIÓN =====
document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
    // Only load dances for the standalone danzas page, not events
    loadDances('');  // Load all dances when page loads
    renderFAQ();
});

// ===== EVENT LISTENERS =====
function setupEventListeners() {
    // Tabs
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            switchTab(tabId);
        });
    });

    // Search - only add event listener if element exists (for compatibility with danzas page)
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            searchTerm = this.value;
            currentPage = 1;
            renderEvents();
        });
    }

    // Filter toggle - only add event listener if element exists (for compatibility with danzas page)
    const filterToggle = document.getElementById('filter-toggle');
    if (filterToggle) {
        filterToggle.addEventListener('click', function() {
            showFilters = !showFilters;
            const calendar = document.getElementById('calendar');
            if (calendar) {
                const chevron = this.querySelector('.chevron');
                calendar.classList.toggle('active');
                if (chevron) chevron.classList.toggle('rotated');
            }
        });
    }

    // Calendar navigation - only add event listeners if elements exist (for compatibility with danzas page)
    const prevMonthBtn = document.getElementById('prev-month');
    if (prevMonthBtn) {
        prevMonthBtn.addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            generateCalendar();
        });
    }

    const nextMonthBtn = document.getElementById('next-month');
    if (nextMonthBtn) {
        nextMonthBtn.addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar();
        });
    }

    const clearDateBtn = document.getElementById('clear-date');
    if (clearDateBtn) {
        clearDateBtn.addEventListener('click', () => {
            selectedDate = null;
            currentPage = 1;
            renderEvents();
            generateCalendar();
        });
    }

    const todayBtn = document.getElementById('today-btn');
    if (todayBtn) {
        todayBtn.addEventListener('click', () => {
            const today = new Date();
            currentMonth = today.getMonth();
            currentYear = today.getFullYear();
            generateCalendar();
        });
    }

    // Query search - only add event listener if element exists (for compatibility with danzas page)
    const queryInput = document.getElementById('query-input');
    if (queryInput) {
        queryInput.addEventListener('input', function() {
            renderFAQ(this.value);
        });
    }

    // Dances search
    document.getElementById('dances-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const query = document.getElementById('danza-search-input').value;
        currentPage = 1;
        loadDances(query, 1);  // Reset to page 1 on new search
    });
}

// ===== TAB SWITCHING =====
function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    document.getElementById(tabId).classList.add('active');

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');

    activeTab = tabId;
}

// ===== CALENDAR =====
function generateCalendar() {
    const monthNames = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    const calendarDays = document.getElementById('calendar-days');
    const currentMonthElement = document.getElementById('current-month');

    currentMonthElement.textContent = `${monthNames[currentMonth]} ${currentYear}`;

    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    calendarDays.innerHTML = '';

    for (let i = 0; i < firstDay; i++) {
        const emptyDay = document.createElement('div');
        emptyDay.className = 'calendar-day';
        calendarDays.appendChild(emptyDay);
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const dayElement = document.createElement('button');
        dayElement.className = 'calendar-day';
        dayElement.type = 'button';

        const formattedDate = `${day} ${monthNames[currentMonth].substring(0, 3).toUpperCase()}`;
        const hasEvents = eventos.some(evento => evento.fecha === formattedDate);

        if (hasEvents) {
            dayElement.classList.add('has-events');
        }

        if (selectedDate === formattedDate) {
            dayElement.classList.add('selected');
        }

        dayElement.textContent = day;
        dayElement.addEventListener('click', function() {
            selectedDate = formattedDate;
            currentPage = 1;
            renderEvents();
            generateCalendar();
        });

        calendarDays.appendChild(dayElement);
    }
}

// ===== EVENTS =====
function renderEvents() {
    const eventsGrid = document.getElementById('events-grid');
    const noEvents = document.getElementById('no-events');
    const eventCount = document.getElementById('event-count');
    const currentPeriod = document.getElementById('current-period');

    const filteredEvents = eventos.filter(evento => {
        const matchDate = selectedDate === null || evento.fecha === selectedDate;
        const matchSearch = evento.banda.toLowerCase().includes(searchTerm.toLowerCase()) ||
                           evento.genero.toLowerCase().includes(searchTerm.toLowerCase());
        return matchDate && matchSearch;
    });

    eventCount.textContent = `(${filteredEvents.length} eventos)`;

    if (selectedDate) {
        currentPeriod.textContent = `Eventos del ${selectedDate}`;
    } else {
        currentPeriod.textContent = 'Enero - Febrero 2025';
    }

    if (filteredEvents.length === 0) {
        eventsGrid.style.display = 'none';
        noEvents.classList.add('active');
        return;
    }

    eventsGrid.style.display = 'grid';
    noEvents.classList.remove('active');

    eventsGrid.innerHTML = filteredEvents.map(evento => {
        const [dateNum, dateMonth] = evento.fecha.split(' ');
        return `
            <div class="event-card">
                <div class="event-gradient" style="background: ${evento.color};"></div>
                <div class="event-image-container">
                    <img class="event-image" src="${evento.imagen}" alt="${evento.banda}" onerror="this.onerror=null; this.src='https://placehold.co/400x300?text=Imagen+no+disponible';">
                </div>
                <div class="event-date-badge">
                    <div class="event-date-number">${dateNum}</div>
                    <div class="event-date-month">${dateMonth}</div>
                    <div class="event-date-day">${evento.dia}</div>
                </div>
                <div class="event-content">
                    <div class="event-genre">${evento.genero}</div>
                    <h3 class="event-title">${evento.banda}</h3>
                    <div class="event-time">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        ${evento.hora}
                    </div>
                    <button class="event-btn">Más Información</button>
                </div>
            </div>
        `;
    }).join('');
}

// ===== FAQ =====
function renderFAQ(searchQuery = '') {
    const faqList = document.getElementById('faq-list');
    const filteredFAQs = faqs.filter(faq =>
        faq.question.toLowerCase().includes(searchQuery.toLowerCase()) ||
        faq.answer.toLowerCase().includes(searchQuery.toLowerCase())
    );

    faqList.innerHTML = filteredFAQs.map(faq => `
        <div class="faq-item">
            <button class="faq-question" onclick="toggleFAQ(this)">
                <span>${faq.question}</span>
                <svg class="faq-toggle" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>
            <div class="faq-answer">
                <p>${faq.answer}</p>
            </div>
        </div>
    `).join('');
}

function toggleFAQ(button) {
    const item = button.parentElement;
    item.classList.toggle('active');
}

// ===== DANCES =====
let dancesPaginationData = null;

async function loadDances(query = '', page = 1) {
    try {
        let url = `/api/concursos?page=${page}&pageSize=${ITEMS_PER_PAGE}`;
        if (query) {
            url = `/api/concursos/search?q=${encodeURIComponent(query)}&page=${page}&pageSize=${ITEMS_PER_PAGE}`;
        }

        console.log('Fetching URL:', url); // Debug logging
        const response = await fetch(url);
        console.log('Response status:', response.status); // Debug logging
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const result = await response.json();
        console.log('API Response:', result); // Debug logging

        // Handle both paginated and non-paginated responses for compatibility
        console.log('Raw API result:', result); // Debug logging
        const dances = Array.isArray(result) ? result : result.data || [];
        console.log('Dances array:', dances); // Debug logging
        dancesPaginationData = result.pagination || null;
        console.log('Pagination data:', dancesPaginationData); // Debug logging

        // Render dances in both card and table formats
        renderDancesAsCards(dances);
        renderDancesAsTable(dances, query);

        // Update current state
        currentPage = page;

        // Update pagination controls
        renderPagination();

    } catch (error) {
        console.error('Error loading dances:', error);
        console.error('Error details:', error.message, error.stack); // More detailed error logging
        const dancesTable = document.getElementById('dances-table');
        if (dancesTable) {
            dancesTable.innerHTML = '<tr><td colspan="4">Error al cargar las dansas: ' + error.message + '</td></tr>';
        } else {
            console.error('Could not update dances table - element not found');
        }

        const dancesGrid = document.getElementById('dances-grid');
        if (dancesGrid) {
            dancesGrid.innerHTML = '<div class="text-center py-8 text-gray-500">Error al cargar las dansas: ' + error.message + '</div>';
        }
    }
}

function renderDancesAsCards(dances) {
    const dancesGrid = document.getElementById('dances-grid');
    if (!dancesGrid) {
        console.error('dances-grid element not found!');
        return;
    }

    if (!dances || dances.length === 0) {
        dancesGrid.innerHTML = '<div class="text-center py-8 text-gray-500 col-span-full">No se encontraron dansas en la base de datos</div>';
        return;
    }

    dancesGrid.innerHTML = '';

    dances.forEach(danza => {
        console.log('Processing danza for card:', danza); // Debug logging

        const categoria = danza.categoria || 'N/A';
        const descripcion = danza.descripcion || 'Descripción no disponible';
        const hora = danza.hora || 'Hora no especificada';
        const detalles = danza.detalles || 'Detalles no disponibles';
        // Using the foto field from the danza record if available, otherwise use a default image
        const imagen = danza.foto || 'https://placehold.co/400x300?text=Imagen+no+disponible';

        let categoryClass = 'traditional';
        if (categoria && categoria.includes('LUCE')) categoryClass = 'lights';
        else if (categoria && categoria.includes('ORIGIN')) categoryClass = 'originary';
        else if (categoria && categoria.includes('TRADICION')) categoryClass = 'traditional';
        else if (categoria && (categoria === 'PARADA' || categoria === 'CIERRE / FIESTA' || categoria === 'RELIGIOSO')) categoryClass = 'traditional';

        // Assign colors based on category
        let categoryBgColor = 'bg-purple-100';
        let categoryTextColor = 'text-purple-800';
        if (categoria && categoria.includes('LUCE')) {
            categoryBgColor = 'bg-yellow-100';
            categoryTextColor = 'text-yellow-800';
        } else if (categoria && categoria.includes('ORIGIN')) {
            categoryBgColor = 'bg-green-100';
            categoryTextColor = 'text-green-800';
        } else if (categoria && categoria.includes('TRADICION')) {
            categoryBgColor = 'bg-blue-100';
            categoryTextColor = 'text-blue-800';
        } else if (categoria && categoria === 'PARADA') {
            categoryBgColor = 'bg-red-100';
            categoryTextColor = 'text-red-800';
        } else if (categoria && categoria === 'RELIGIOSO') {
            categoryBgColor = 'bg-purple-100';
            categoryTextColor = 'text-purple-800';
        }

        const card = document.createElement('div');
        card.className = 'bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl';
        card.innerHTML = `
            <div class="flex flex-col">
                <div class="w-full h-48 flex-shrink-0 overflow-hidden">
                    <img src="${imagen}"
                         alt="${danza.conjunto}"
                         class="w-full h-full object-cover"
                         onerror="this.onerror=null; this.src='https://placehold.co/400x300?text=Imagen+no+disponible';">
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-bold text-gray-900">${danza.conjunto}</h3>
                            <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full ${categoryBgColor} ${categoryTextColor}">
                                ${categoria}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            <span class="dance-order bg-candelaria-gold text-candelaria-purple px-2 py-1 rounded-full font-bold text-xs">
                                #${danza.orden_concurso}
                            </span>
                            ${danza.orden_veneracion ? ' | Veneración #' + danza.orden_veneracion : ''}
                        </p>
                        <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                            ${descripcion}
                        </p>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                        <button class="px-4 py-2 bg-candelaria-purple text-white rounded-lg text-sm font-medium hover:bg-purple-600 transition-colors"
                                onclick="showDanzaDetails(${danza.id}, '${danza.conjunto}', '${descripcion}', '${categoria}', '${hora}', '${danza.orden_concurso}', '${danza.orden_veneracion || 'N/A'}', '${detalles}')">
                            Ver Detalles
                        </button>
                        <div class="flex items-center text-sm text-gray-500">
                            <i data-lucide="clock" class="w-4 h-4 mr-1"></i>
                            <span>${hora}</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        dancesGrid.appendChild(card);
    });

    // Initialize lucide icons after adding new elements
    lucide.createIcons();
}

function renderDancesAsTable(dances, query = '') {
    const dancesTable = document.getElementById('dances-table');
    if (!dancesTable) {
        console.error('dances-table element not found!');
        return;
    }

    dancesTable.innerHTML = '';

    // Check if we have dances to display
    if (dances.length === 0) {
        console.log('No dances found in API response');
        const noDancesRow = document.createElement('tr');
        if (query) {
            noDancesRow.innerHTML = `<td colspan="4">No se encontraron dansas que coincidan con "${query}"</td>`;
        } else {
            noDancesRow.innerHTML = '<td colspan="4">No se encontraron dansas en la base de datos</td>';
        }
        dancesTable.appendChild(noDancesRow);
        return;
    }

    // Create table rows for each dance
    dances.forEach(danza => {
        console.log('Processing danza for table:', danza); // Debug logging
        const categoria = danza.categoria || 'N/A';

        // Assign colors based on category for the table
        let categoryBgColor = 'bg-purple-100';
        let categoryTextColor = 'text-purple-800';
        if (categoria && categoria.includes('LUCE')) {
            categoryBgColor = 'bg-yellow-100';
            categoryTextColor = 'text-yellow-800';
        } else if (categoria && categoria.includes('ORIGIN')) {
            categoryBgColor = 'bg-green-100';
            categoryTextColor = 'text-green-800';
        } else if (categoria && categoria.includes('TRADICION')) {
            categoryBgColor = 'bg-blue-100';
            categoryTextColor = 'text-blue-800';
        } else if (categoria && categoria === 'PARADA') {
            categoryBgColor = 'bg-red-100';
            categoryTextColor = 'text-red-800';
        } else if (categoria && categoria === 'RELIGIOSO') {
            categoryBgColor = 'bg-purple-100';
            categoryTextColor = 'text-purple-800';
        }

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <div class="flex items-center">
                    <img src="${danza.foto || 'https://placehold.co/50x50?text=No+Foto'}"
                         alt="${danza.conjunto}"
                         class="w-10 h-10 rounded object-cover mr-3"
                         onerror="this.onerror=null; this.src='https://placehold.co/50x50?text=No+Foto';">
                    ${danza.conjunto}
                </div>
            </td>
            <td>
                <span class="category-badge ${categoryBgColor} ${categoryTextColor} px-2.5 py-0.5 rounded-full text-xs font-semibold">${categoria}</span>
            </td>
            <td>${danza.orden_concurso}</td>
            <td>
                <button onclick="showDanzaDetails(${danza.id})">Más Información</button>
            </td>
        `;
        dancesTable.appendChild(row);
    });
}

function showDanzaDetails(danzaId) {
    // This function will be called when user clicks "Ver Detalles" or "Más Información"
    alert(`Mostrando detalles para la danza con ID: ${danzaId}\n\nEn una implementación completa, aquí se mostraría una vista detallada de la danza.`);
}


function renderPagination() {
    const pagination = document.getElementById('pagination');
    if (!pagination) {
        console.error('Pagination element not found!');
        return;
    }

    console.log('Rendering pagination with data:', dancesPaginationData); // Debug logging

    if (!dancesPaginationData) {
        console.log('No pagination data available, clearing pagination'); // Debug logging
        pagination.innerHTML = '<div class="text-sm text-gray-700">No hay datos de paginación disponibles</div>';
        return;
    }

    const { page, totalPages, hasNext, hasPrev, total } = dancesPaginationData;
    currentPage = page;

    // Update results info
    const resultsInfo = document.getElementById('results-info');
    if (resultsInfo) {
        const start = (page - 1) * ITEMS_PER_PAGE + 1;
        const end = Math.min(page * ITEMS_PER_PAGE, total);
        resultsInfo.textContent = `Mostrando ${start} a ${end} de ${total} resultados`;
    }

    let html = '';

    if (hasPrev) {
        html += `<button class="prev" onclick="changePage(${page - 1})">← Anterior</button>`;
    } else {
        html += `<button class="prev disabled" disabled>← Anterior</button>`;
    }

    // Calculate the range of pages to show
    const maxVisiblePages = 5; // Show 5 page numbers at most
    let startPage = Math.max(1, page - Math.floor(maxVisiblePages / 2));
    let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    // Adjust startPage if we're near the end
    if (endPage - startPage + 1 < maxVisiblePages) {
        startPage = Math.max(1, endPage - maxVisiblePages + 1);
    }

    // Add first page if not already included and we have more than the max visible pages
    if (startPage > 1) {
        html += `<button onclick="changePage(1)">1</button>`;
        if (startPage > 2) {
            html += '<span class="ellipsis">...</span>';
        }
    }

    // Add the page numbers in the range
    for (let i = startPage; i <= endPage; i++) {
        if (i === page) {
            html += `<button class="page active">${i}</button>`;
        } else {
            html += `<button class="page" onclick="changePage(${i})">${i}</button>`;
        }
    }

    // Add last page if not already included and we have more pages
    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            html += '<span class="ellipsis">...</span>';
        }
        html += `<button onclick="changePage(${totalPages})">${totalPages}</button>`;
    }

    if (hasNext) {
        html += `<button class="next" onclick="changePage(${page + 1})">Siguiente →</button>`;
    } else {
        html += `<button class="next disabled" disabled>Siguiente →</button>`;
    }

    pagination.innerHTML = html;
}

function changePage(page) {
    const searchInput = document.getElementById('danza-search-input');
    const query = searchInput ? searchInput.value : '';
    loadDances(query, page);
}

// Helper function to show danza details in a modal
function showDanzaDetails(id, conjunto, descripcion, categoria, hora, ordenConcurso, ordenVeneracion, detalles) {
    // Get the current danza to access the photo
    const danza = danzas.find(d => d.id === id);
    const fotoUrl = danza ? danza.foto : null;

    // Create modal HTML
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50';
    modal.innerHTML = `
        <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">${conjunto}</h2>
                    <button class="text-gray-500 hover:text-gray-700 text-2xl" onclick="this.closest('.fixed').remove()">&times;</button>
                </div>

                ${fotoUrl ? `
                <div class="mb-6">
                    <img src="${fotoUrl}" alt="${conjunto}" class="w-full h-48 object-cover rounded-lg" onerror="this.onerror=null; this.src='https://placehold.co/400x200?text=Imagen+no+disponible';">
                </div>
                ` : ''}

                <div class="mb-6">
                    <span class="px-3 py-1 bg-candelaria-gold/20 text-candelaria-gold rounded-full text-sm font-medium inline-block">
                        ${categoria}
                    </span>
                </div>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Descripción</h3>
                        <p class="mt-1 text-gray-900">${descripcion}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Orden Concurso</h3>
                            <p class="mt-1 text-gray-900 font-medium">#${ordenConcurso}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Orden Veneración</h3>
                            <p class="mt-1 text-gray-900 font-medium">${ordenVeneracion}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Hora</h3>
                        <p class="mt-1 text-gray-900">${hora}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Detalles</h3>
                        <p class="mt-1 text-gray-900">${detalles}</p>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button class="px-6 py-3 bg-candelaria-purple text-white rounded-lg font-medium hover:bg-purple-600 transition-colors"
                            onclick="this.closest('.fixed').remove()">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    `;

    // Add the modal to the document
    document.body.appendChild(modal);
}