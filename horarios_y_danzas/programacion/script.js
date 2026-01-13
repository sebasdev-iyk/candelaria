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
    if(tabName !== 'programacion') {
        window.location.href = `../${tabName}/index.html`;
    }
}

// ===== ESTADO =====
let activeTab = 'programacion';
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
    renderEvents();
    generateCalendar();
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

    // Search
    document.getElementById('search-input').addEventListener('input', function() {
        searchTerm = this.value;
        currentPage = 1;
        renderEvents();
    });

    // Filter toggle
    document.getElementById('filter-toggle').addEventListener('click', function() {
        showFilters = !showFilters;
        const calendar = document.getElementById('calendar');
        const chevron = this.querySelector('.chevron');
        calendar.classList.toggle('active');
        chevron.classList.toggle('rotated');
    });

    // Calendar navigation
    document.getElementById('prev-month').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        generateCalendar();
    });

    document.getElementById('next-month').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        generateCalendar();
    });

    document.getElementById('clear-date').addEventListener('click', () => {
        selectedDate = null;
        currentPage = 1;
        renderEvents();
        generateCalendar();
    });

    document.getElementById('today-btn').addEventListener('click', () => {
        const today = new Date();
        currentMonth = today.getMonth();
        currentYear = today.getFullYear();
        generateCalendar();
    });

    // Query search
    document.getElementById('query-input').addEventListener('input', function() {
        renderFAQ(this.value);
    });

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

        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const result = await response.json();

        // Handle both paginated and non-paginated responses for compatibility
        const dances = Array.isArray(result) ? result : result.data || [];
        dancesPaginationData = result.pagination || null;

        const dancesTable = document.getElementById('dances-table');
        dancesTable.innerHTML = '';

        // Create table rows for each dance
        dances.forEach(danza => {
            const categoria = danza.categoria || 'N/A';
            let categoryClass = 'traditional';
            if (categoria && categoria.includes('LUCE')) categoryClass = 'lights';  // Covers 'TRAJE DE LUCES', 'LUCE', etc.
            else if (categoria && categoria.includes('ORIGIN')) categoryClass = 'originary';  // Covers 'ORIGINARIAS', 'ORIGINARIO', etc.
            else if (categoria && categoria.includes('TRADICION')) categoryClass = 'traditional';  // Covers 'TRADICIONAL', 'TRADICION', etc.
            else if (categoria && (categoria === 'PARADA' || categoria === 'CIERRE / FIESTA' || categoria === 'RELIGIOSO')) categoryClass = 'traditional';  // Default category for other types

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${danza.conjunto}</td>
                <td>
                    <span class="category-badge ${categoryClass}">${categoria}</span>
                </td>
                <td>${danza.orden_concurso}</td>
                <td>
                    <button onclick="alert('Detalles de: ${danza.conjunto}')">Más Información</button>
                </td>
            `;
            dancesTable.appendChild(row);
        });

        // If no results found
        if (dances.length === 0 && query) {
            const noResultsRow = document.createElement('tr');
            noResultsRow.innerHTML = `<td colspan="4">No se encontraron dansas que coincidan con "${query}"</td>`;
            dancesTable.appendChild(noResultsRow);
        }

        // Update current state
        currentPage = page;

        // Update pagination controls
        renderPagination();

    } catch (error) {
        console.error('Error loading dances:', error);
        document.getElementById('dances-table').innerHTML = '<tr><td colspan="4">Error al cargar las dansas</td></tr>';
    }
}

function renderPagination() {
    const pagination = document.getElementById('pagination');

    if (!dancesPaginationData) {
        pagination.innerHTML = '';
        return;
    }

    const { page, totalPages, hasNext, hasPrev } = dancesPaginationData;
    currentPage = page;

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