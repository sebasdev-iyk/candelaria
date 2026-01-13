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

const danzas = [
    { id: 1, conjunto: "Morenada Central Puno", categoria: "TRAJE DE LUCES", orden_concurso: 1 },
    { id: 2, conjunto: "Diablada Confraternidad", categoria: "TRAJE DE LUCES", orden_concurso: 2 },
    { id: 3, conjunto: "Wifalas San Francisco", categoria: "ORIGINARIAS", orden_concurso: 3 },
    { id: 4, conjunto: "Sikuris 27 de Junio", categoria: "ORIGINARIAS", orden_concurso: 4 },
    { id: 5, conjunto: "Caporales Vientos del Sur", categoria: "TRAJE DE LUCES", orden_concurso: 5 },
    { id: 6, conjunto: "Tinkus Machallata", categoria: "ORIGINARIAS", orden_concurso: 6 },
    { id: 7, conjunto: "Llamerada Collavic", categoria: "TRADICIONAL", orden_concurso: 7 },
    { id: 8, conjunto: "Kullawada Central", categoria: "TRADICIONAL", orden_concurso: 8 },
    { id: 9, conjunto: "Negritos Chacón", categoria: "TRADICIONAL", orden_concurso: 9 },
    { id: 10, conjunto: "Waca Waca Porteño", categoria: "TRADICIONAL", orden_concurso: 10 }
];

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
    if(tabName !== 'consultas') {
        window.location.href = `../${tabName}/index.html`;
    }
}

// ===== ESTADO =====
let activeTab = 'consultas';
let selectedDate = null;
let searchTerm = '';
let showFilters = false;
let currentMonth = 0;
let currentYear = 2025;
let currentPage = 1;
const ITEMS_PER_PAGE = 5;

// ===== INICIALIZACIÓN =====
document.addEventListener('DOMContentLoaded', function() {
    setupEventListeners();
    // Show only the active tab content on initial load
    setActiveTabOnLoad();
    // Initialize the content for the active tab
    if(activeTab === 'programacion') {
        renderEvents();
        generateCalendar();
    } else if(activeTab === 'consultas') {
        renderFAQ();
    } else if(activeTab === 'lista') {
        loadDances();
    }
});

// ===== INICIALIZACIÓN DE PESTAÑA ACTIVA =====
function setActiveTabOnLoad() {
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    document.getElementById(activeTab).classList.add('active');

    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    document.querySelector(`[data-tab="${activeTab}"]`).classList.add('active');
}

// ===== EVENT LISTENERS =====
function setupEventListeners() {
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
        loadDances(query);
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

    // Initialize the content for the new active tab
    if(tabId === 'programacion') {
        renderEvents();
        generateCalendar();
    } else if(tabId === 'consultas') {
        renderFAQ();
    } else if(tabId === 'lista') {
        loadDances();
    }
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
function loadDances(query = '') {
    const filteredDanzas = danzas.filter(danza =>
        danza.conjunto.toLowerCase().includes(query.toLowerCase()) ||
        danza.categoria.toLowerCase().includes(query.toLowerCase())
    );

    const totalPages = Math.ceil(filteredDanzas.length / ITEMS_PER_PAGE);
    const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
    const paginatedDanzas = filteredDanzas.slice(startIndex, startIndex + ITEMS_PER_PAGE);

    const dancesTable = document.getElementById('dances-table');
    dancesTable.innerHTML = paginatedDanzas.map(danza => {
        let categoryClass = 'traditional';
        if (danza.categoria === 'TRAJE DE LUCES') categoryClass = 'lights';
        else if (danza.categoria === 'ORIGINARIAS') categoryClass = 'originary';

        return `
            <tr>
                <td>${danza.conjunto}</td>
                <td>
                    <span class="category-badge ${categoryClass}">${danza.categoria}</span>
                </td>
                <td>${danza.orden_concurso}</td>
                <td>
                    <button onclick="alert('Detalles de: ${danza.conjunto}')">Más Información</button>
                </td>
            </tr>
        `;
    }).join('');

    renderPagination(totalPages, query);
}

function renderPagination(totalPages, query) {
    const pagination = document.getElementById('pagination');

    if (totalPages <= 1) {
        pagination.innerHTML = '';
        return;
    }

    let html = '';

    if (currentPage > 1) {
        html += `<button class="prev" onclick="changePage(${currentPage - 1}, '${query}')">← Anterior</button>`;
    }

    for (let i = 1; i <= totalPages; i++) {
        html += `<button class="page ${i === currentPage ? 'active' : ''}" onclick="changePage(${i}, '${query}')">${i}</button>`;
    }

    if (currentPage < totalPages) {
        html += `<button class="next" onclick="changePage(${currentPage + 1}, '${query}')">Siguiente →</button>`;
    }

    pagination.innerHTML = html;
}

function changePage(page, query) {
    currentPage = page;
    loadDances(query);
}