<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candelaria 2026 | Horarios y Danzas</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&family=Manrope:wght@200..800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <!-- Configuración de Tailwind y Estilos Personalizados -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        candelaria: {
                            purple: '#4c1d95', // Color principal festivo
                            gold: '#fbbf24',   // Detalles premium
                            lake: '#0ea5e9',   // Lago Titicaca
                            light: '#f5f3ff',   // Fondos suaves
                            primary: '#ec1325', // Requested Primary Red
                            'background-light': '#f8f6f6',
                            'surface-light': '#ffffff'
                        }
                    },
                    fontFamily: {
                        sans: ['Open Sans', 'sans-serif'],
                        heading: ['Montserrat', 'sans-serif'],
                        display: ['Manrope', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Montserrat', sans-serif;
        }

        /* Animaciones suaves */
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scrollbar personalizado */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* Event card styles from ejm.html - for enhanced hover effect */
        .event-card {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -12px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            background: white;
            border: 1px solid #e5e7eb;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
            border-color: #fbbf24;
        }

        .event-gradient {
            position: absolute;
            inset: 0;
            opacity: 0.9;
            z-index: 1;
        }

        .event-image-container {
            position: relative;
            height: 16rem;
            overflow: hidden;
            z-index: 2;
        }

        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
            transition: all 0.5s ease;
        }

        .event-card:hover .event-image {
            opacity: 1;
            transform: scale(1.05);
        }

        .event-content {
            padding: 1.5rem;
            background: #ffffff;
            z-index: 3;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .event-genre {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: rgba(76, 29, 149, 0.1);
            border-radius: 9999px;
            color: #4c1d95;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            border: 1px solid rgba(76, 29, 149, 0.2);
            font-family: 'Montserrat', sans-serif;
            align-self: flex-start;
        }

        .event-title {
            color: #1f2937;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            transition: color 0.3s ease;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
        }

        .event-card:hover .event-title {
            color: #4c1d95;
        }

        .event-time {
            display: flex;
            align-items: center;
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .event-time svg {
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
            color: #f59e0b;
        }

        .event-btn {
            width: 100%;
            padding: 0.75rem 1rem;
            background: linear-gradient(to right, #fbbf24, #f59e0b);
            color: #4c1d95;
            border: none;
            border-radius: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: auto;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.875rem;
        }

        .event-btn:hover {
            background: linear-gradient(to right, #f59e0b, #d97706);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
        }

        /* Responsive Grid Layout from ejm.html */
        .danzas-grid,
        #danzas-grid,
        #events-container .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (min-width: 768px) {

            .danzas-grid,
            #danzas-grid,
            #events-container .grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {

            .danzas-grid,
            #danzas-grid,
            #events-container .grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }



        /* Modal Button Styles */
        .btn-modal-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border-radius: 8px;
            /* Slightly rounded as per image */
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            font-size: 0.9rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-modal-live {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            /* Red Gradient */
            color: white;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            animation: pulseLive 2s infinite;
        }

        .btn-modal-live:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 38, 38, 0.6);
        }

        .btn-modal-score {
            background: #fbbf24;
            /* Candelaria Gold */
            color: #4c1d95;
            /* Deep Purple Text */
        }

        .btn-modal-score:hover {
            background: #f59e0b;
            transform: translateY(-2px);
        }

        .btn-modal-map {
            background: #f59e0b;
            /* Orange/Amber */
            color: white;
        }

        .btn-modal-map:hover {
            background: #d97706;
            transform: translateY(-2px);
        }

        .btn-modal-share {
            background: white;
            color: #f59e0b;
            border: 2px solid #f59e0b;
        }

        .btn-modal-share:hover {
            background: #fffbeb;
            transform: translateY(-2px);
        }

        .btn-modal-recordarme {
            background: #4c1d95;
            /* Candelaria Purple */
            color: white;
        }

        .btn-modal-recordarme:hover {
            background: #5b21b6;
            transform: translateY(-2px);
        }

        .live-dot {
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            animation: blinkDot 1s infinite;
        }

        @keyframes blinkDot {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }
    </style>
    <!-- Spark Effect CSS -->
    <link rel="stylesheet" href="../assets/css/sparks.css">
    <!-- jsPDF & AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
</head>

<body class="bg-gray-50 text-gray-800">
    <?php include '../includes/auth-header.php'; ?>

    <!-- Header Section - Standardized with EN TIEMPO REAL Style -->
    <!-- Header Section - Standardized with EN TIEMPO REAL Style -->
    <?php
    $headerDepth = 1;
    $activePage = 'horarios';
    include '../includes/standard-header.php';
    ?>



    <!-- Navigation Tabs -->
    <nav class="flex space-x-1 border-b border-gray-200 mb-6 overflow-x-auto pb-1 scrollbar-hide" aria-label="Tabs">
        <div class="flex space-x-1 min-w-max mx-auto">
            <button onclick="setActiveTab('programacion')" id="tab-programacion"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2 border-candelaria-purple text-candelaria-purple text-gray-900">
                <i data-lucide="calendar" class="w-4 h-4"></i> Programación
            </button>
            <button onclick="setActiveTab('danzas')" id="tab-danzas"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2 border-transparent text-gray-500 hover:border-candelaria-purple hover:text-candelaria-purple transition-colors">
                <i data-lucide="users" class="w-4 h-4"></i> Danzas
            </button>
            <button onclick="setActiveTab('simulador')" id="tab-simulador"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2 border-transparent text-gray-500 hover:border-candelaria-purple hover:text-candelaria-purple transition-colors">
                <i data-lucide="play-circle" class="w-4 h-4"></i> Simulador
            </button>
            <button onclick="setActiveTab('consultas')" id="tab-consultas"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2 border-transparent text-gray-500 hover:border-candelaria-purple hover:text-candelaria-purple transition-colors">
                <i data-lucide="help-circle" class="w-4 h-4"></i> Consultas
            </button>

        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 items-start">

            <!-- Main Content Column -->
            <div class="lg:col-span-1">
                <div class="flex justify-between items-end mb-4">
                    <h2 class="text-lg font-bold text-gray-800" id="results-count">Mostrando eventos programados</h2>
                </div>

                <!-- Container de Tarjetas -->
                <div id="events-container" class="space-y-6 min-h-[500px]">
                    <!-- JS Inyectará las tarjetas aquí -->
                    <div class="animate-pulse flex space-x-4">
                        <div class="flex-1 space-y-4 py-1">
                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                            <div class="space-y-2">
                                <div class="h-4 bg-gray-200 rounded"></div>
                                <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center hidden" id="load-more-btn">
                    <button
                        class="px-6 py-3 border border-gray-300 rounded-full text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors shadow-sm">
                        Cargar más eventos
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->


    <!-- Scripts: Libraries first (already in head), then Logic -->

    <script src="../assets/js/spark-effect.js"></script>

    <script>
        // ==========================================
        // 1. BASE DE DATOS (DATA)
        // ==========================================
        // Coordenadas base Puno: -15.8402, -70.0219

        const eventos = [
            { id: 1, fecha: '14 ENE', dia: 'MIÉ', banda: 'Congreso de Diablada', genero: 'CONGRESO', hora: 'Todo el día', imagen: 'https://portal.andina.pe/EDPFotografia3/thumbnail/2021/09/17/000808729M.jpg', color: 'linear-gradient(to bottom right, #eab308, #b45309)', description: 'Congreso Nacional e Internacional de la Diablada Puneña. Este evento reúne a expertos, historiadores y danzantes para discutir la historia, evolución y preservación de la emblemática danza Diablada.', extra: 'Participan delegaciones de todo el Perú y países vecinos.', location: 'Puno, Perú' },
            { id: 2, fecha: '16 ENE', dia: 'VIE', banda: 'Presentación Oficial', genero: 'OFICIAL', hora: '10:00 AM', imagen: 'https://imgmedia.larepublica.pe/1000x590/larepublica/original/2026/01/14/6967c3f063a35248e304ca99.webp', color: 'linear-gradient(to bottom right, #a855f7, #6b21a8)', description: 'Ceremonia de presentación oficial de la LIX Festividad Virgen de la Candelaria 2026. Autoridades regionales y locales dan inicio formal a las celebraciones.', extra: 'Evento con presencia de autoridades municipales, regionales y representantes de la FRFCP.', location: 'Plaza de Armas, Puno' },
            { id: 3, fecha: '18 ENE', dia: 'DOM', banda: 'Desfile Institucional', genero: 'INSTITUCIONAL', hora: '09:00 AM', imagen: 'https://i.ytimg.com/vi/F_Ps-HAhcy0/hqdefault.jpg', color: 'linear-gradient(to bottom right, #3b82f6, #1d4ed8)', description: 'Desfile conmemorativo por el 61° Aniversario de la Federación Regional de Folklore y Cultura de Puno e Inicio de la Festividad.', extra: 'Se presentan todas las danzas representativas de la región Puno en un colorido desfile.', location: 'Av. Floral, Puno' },
            { id: 4, fecha: '19 ENE', dia: 'LUN', banda: 'Pasarela de Trajes', genero: 'PASARELA', hora: '18:00 PM', imagen: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWcBtXlSDstjO6POKVJP4pCRpgrxv7Y9FDeA&s', color: 'linear-gradient(to bottom right, #ec4899, #be185d)', description: 'Exhibición de los trajes típicos de la Festividad Virgen de la Candelaria 2026. Artesanos y diseñadores presentan las mejores creaciones.', extra: 'Se exhiben trajes de luces y trajes originarios con bordados tradicionales.', location: 'Teatro Municipal, Puno' },
            { id: 5, fecha: '23 ENE', dia: 'VIE', banda: 'Elección y Coronación', genero: 'CORONACIÓN', hora: '17:00 PM', imagen: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTt0PsphcJScYscxgWG7FCpsVFJ7DFir2ML1A&s', color: 'linear-gradient(to bottom right, #eab308, #a16207)', description: 'Elección y coronación de la Señorita Folklore Autóctonos y Luces 2026.', extra: 'Las ganadoras serán embajadoras culturales de la festividad durante todo el año.', location: 'Coliseo Cerrado, Puno' },
            { id: 6, fecha: '24 ENE', dia: 'SÁB', banda: 'Misas de Novena', genero: 'RELIGIOSO', hora: 'Todo el día', imagen: 'https://i.ytimg.com/vi/HY-QmjgJU1M/hqdefault.jpg?v=67946c3a', color: 'linear-gradient(to bottom right, #7e22ce, #581c87)', description: 'Celebraciones eucarísticas de la Novena a la Virgen de la Candelaria. Nueve días de oración y preparación espiritual.', extra: 'Devotos de toda la región acuden al Santuario para venerar a la Virgen.', location: 'Santuario Virgen de la Candelaria' },
            { id: 7, fecha: '31 ENE', dia: 'SÁB', banda: 'LIX Concurso Originarios - Día 1', genero: 'ORIGINARIAS', hora: '07:00 AM', imagen: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQDhK-bxOdDkPLOazdNzsfIBHSN_beITM1pUQ&s', color: 'linear-gradient(to bottom right, #16a34a, #15803d)', description: 'Primer día del LIX Concurso de Danzas en Trajes Originarios. Participan conjuntos de danzas autóctonas de toda la región.', extra: 'Las danzas originarias representan la cultura ancestral de las comunidades puneñas.', location: 'Estadio Torres Belón' },
            { id: 8, fecha: '01 FEB', dia: 'DOM', banda: 'LIX Concurso Originarios - Día 2', genero: 'ORIGINARIAS', hora: '07:00 AM', imagen: 'https://radioondaazul.com/wp-content/uploads/2025/02/2-153-scaled.jpg', color: 'linear-gradient(to bottom right, #2563eb, #1e3a8a)', description: 'Segundo día del LIX Concurso de Danzas en Trajes Originarios.', extra: 'Se premian a los mejores conjuntos en diferentes categorías.', location: 'Estadio Torres Belón' },
            { id: 9, fecha: '01 FEB', dia: 'DOM', banda: 'Celebración de Vísperas', genero: 'RELIGIOSO', hora: '18:00 PM', imagen: 'https://incaexperience.com/wp-content/uploads/2025/12/Que-es-la-Fiesta-de-la-Virgen-de-la-Candelaria.webp', color: 'linear-gradient(to bottom right, #d97706, #b45309)', description: 'Vísperas en Homenaje a la Virgen de la Candelaria. Incluye misa de albas, quema de fuegos artificiales y fogata.', extra: 'Espectáculo pirotécnico y celebración nocturna en honor a la Virgen.', location: 'Santuario, Puno' },
            { id: 10, fecha: '02 FEB', dia: 'LUN', banda: 'Solemne Misa y Procesión', genero: 'DÍA CENTRAL', hora: '10:00 AM', imagen: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjDw3aRtiGioDLEdz2xu62nbTynvYKifHWYA&s', color: 'linear-gradient(to bottom right, #dc2626, #991b1b)', description: 'Día Central de la Festividad. Solemne Misa y Procesión de la Virgen de la Candelaria por las principales arterias de Puno.', extra: 'Miles de devotos acompañan a la imagen de la Virgen en su recorrido por la ciudad.', location: 'Catedral de Puno' },
            { id: 11, fecha: '08 FEB', dia: 'DOM', banda: 'LIX Concurso Trajes de Luces', genero: 'TRAJE DE LUCES', hora: '07:00 AM', imagen: 'https://portal.andina.pe/EDPFotografia3/thumbnail/2024/02/08/001036561M.jpg', color: 'linear-gradient(to bottom right, #eab308, #854d0e)', description: 'LIX Concurso de Danzas en Trajes de Luces. Se presentan las danzas más emblemáticas: Diablada, Morenada, Caporales, Kullawada y más.', extra: 'Los trajes de luces brillan con lentejuelas, piedras y bordados espectaculares.', location: 'Estadio Torres Belón' },
            { id: 12, fecha: '09 FEB', dia: 'LUN', banda: 'Gran Parada - Día 1', genero: 'PARADA', hora: '08:00 AM', imagen: 'https://imgmedia.larepublica.pe/1200x735/larepublica/original/2026/01/14/6967c3f063a35248e304ca99.jpg', color: 'linear-gradient(to bottom right, #be185d, #831843)', description: 'Primer día de la Gran Parada y Veneración en honor a la Virgen de la Candelaria 2026.', extra: 'Los conjuntos desfilan por las calles de Puno en homenaje a la Patrona.', location: 'Av. Floral y calles de Puno' },
            { id: 13, fecha: '10 FEB', dia: 'MAR', banda: 'Gran Parada - Día 2', genero: 'PARADA', hora: '08:00 AM', imagen: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8oX5A199kC2fi5FNRkp87a3dkgnJYxOPQ3w&s', color: 'linear-gradient(to bottom right, #be185d, #831843)', description: 'Segundo día de la Gran Parada. Veneración de Danzas en Trajes de Luces o Danzas Mestizas.', extra: 'Clausura oficial de la LIX Festividad Virgen de la Candelaria 2026.', location: 'Av. Floral y calles de Puno' }
        ];

        // danzas will be loaded from the API service
        let danzas = []; // Keep for backward compatibility (used by modals)

        // ========== Turbo Mode State ==========
        let RAM_DANZAS = [];
        let filteredDanzas = [];
        let currentDanzaPage = 1;
        const danzaPageSize = 12;
        let currentDanzaSearch = '';
        let isRamLoaded = false;
        let isDanzaLoading = false;

        const faqs = [
            { id: 1, question: "¿Cuáles son los horarios del evento?", answer: "El evento se desarrolla durante dos meses, con actividades diarias. Consulta la pestaña de Programación para ver los horarios específicos de cada día." },
            { id: 2, question: "¿Cómo puedo obtener entradas?", answer: "Las entradas están disponibles en las taquillas principales y a través de nuestra plataforma en línea. Consulta con nuestro equipo de contacto para más detalles." },
            { id: 3, question: "¿Dónde se realiza el evento?", answer: "El evento se realiza en múltiples escenarios del salón. Consulta la pestaña de Mapa para ver la ubicación de cada presentación." },
            { id: 4, question: "¿Puedo participar como danzante?", answer: "Sí, se aceptan nuevos grupos de danzas. Contacta a nuestro equipo para conocer los requisitos y el proceso de inscripción." },
            { id: 5, question: "¿Hay estacionamiento disponible?", answer: "Sí, contamos con estacionamiento gratuito para todos nuestros visitantes. Consulta con el personal de seguridad para ubicar las áreas disponibles." }
        ];

        // ==========================================
        // 2. ESTADO DE LA APLICACIÓN (STATE)
        // ==========================================
        let state = {
            activeTab: 'programacion',
            activeDay: 'day2',
            search: '',
            filters: {
                bestRated: false,
                amenities: [],
                maxPrice: 500,
                rating: 0
            }
        };

        function setActiveDay(day) {
            state.activeDay = day;
            renderEvents();
        }

        // ==========================================
        // 3. FUNCIONALIDADES DE INTERFAZ (UI LOGIC)
        // ==========================================

        // Global function to fix photo paths - transform filename to full path
        function fixPhotoPath(url) {
            if (!url) return 'https://placehold.co/400x300?text=Imagen+no+disponible';
            if (url.startsWith('http') || url.startsWith('data:')) return url;
            // Clean the path and prepend the correct uploads directory
            let clean = url.startsWith('/') ? url.substring(1) : url;
            clean = clean.replace(/^candelaria\/assets\/uploads\//, '')
                .replace(/^assets\/uploads\//, '')
                .replace(/^uploads\//, '');
            return '../assets/uploads/' + clean;
        }

        // Configuración de Lucide Icons
        lucide.createIcons();

        // Establecer pestaña activa
        function setActiveTab(tabName) {
            // Actualizar estado
            state.activeTab = tabName;

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

            // Actualizar contenido según pestaña
            updateContent();

            // Actualizar la URL para reflejar la pestaña actual sin recargar (preservando query params)
            const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname + window.location.search + `#${tabName}`;
            window.history.pushState({ tab: tabName }, '', newURL);
        }

        // Actualizar contenido según el estado
        function updateContent() {
            // Clear any existing simulator interval when switching tabs
            if (window.simuladorInterval) {
                clearInterval(window.simuladorInterval);
                window.simuladorInterval = null;
            }

            const container = document.getElementById('events-container');
            if (!container) return;

            // Limpiar contenido actual
            container.innerHTML = '';

            // Handle map display for the mapa tab
            {
                // Mostrar contenido según pestaña activa in the main content area
                switch (state.activeTab) {
                    case 'programacion':
                        renderEvents();
                        break;
                    case 'simulador':
                        renderSimulador();
                        break;
                    case 'consultas':
                        renderConsultas();
                        break;
                    case 'danzas':
                        renderDanzas();
                        break;
                    default:
                        renderEvents();
                }
            }
        }

        // Renderizar eventos (Programación - Original List View)
        function renderEvents() {
            const container = document.getElementById('events-container');
            if (!container) return;

            container.innerHTML = `
                <div class="grid">
                    ${eventos.map(evento => `
                        <div class="event-card">
                            <div class="event-image-container">
                                <img class="event-image" src="${evento.imagen}" alt="${evento.banda}" onerror="this.onerror=null; this.src='https://placehold.co/400x300/4c1d95/fbbf24?text=${encodeURIComponent(evento.banda)}';">
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
                                <p style="color: #6b7280; font-size: 0.875rem; margin-bottom: 1rem; flex-grow: 1;">${evento.fecha} • ${evento.dia}</p>
                                <button class="event-btn" onclick="openEventModal(${evento.id})">Ver Detalles</button>
                            </div>
                        </div>
                    `).join('')}
                </div>
            `;

            // Actualizar los íconos de Lucide
            lucide.createIcons();
        }

        // Listado de Danzas Originarias (Sábado 31 de Enero 2026)
        const danzasOriginarias = [
            { id: 0, nombre: "Exhibición Conjunto en Exhibición", tipo: "Exhibición" },
            { id: 1, nombre: "1 Carnaval De Nicasio", tipo: "Concurso" },
            { id: 2, nombre: "2 Conjunto De Zampoñas Juventud Central Chucuito - Puno", tipo: "Concurso" },
            { id: 3, nombre: "3 Asociación Folklórica Ayarachis Riqchary Huayna De Cuyo Cuyo- Sandia", tipo: "Concurso" },
            { id: 4, nombre: "4 Danza Autóctona Choquelas De Calacoto", tipo: "Concurso" },
            { id: 5, nombre: "5 Carnaval De Mañazo", tipo: "Concurso" },
            { id: 6, nombre: "6 Conjunto De Sikuris Proyecto Cultural Wiñay Panqara Marka - Moho", tipo: "Concurso" },
            { id: 7, nombre: "7 Institución Cultural Mallku Kunturine - Kelluyo", tipo: "Concurso" },
            { id: 8, nombre: "8 Los Turcos De Cabanilla - Lampa", tipo: "Concurso" },
            { id: 9, nombre: "9 Agrupación Sentimiento Sikuris De Ingeniería Civil", tipo: "Concurso" },
            { id: 10, nombre: "10 Centro de Expresión Cultural Sikuris 12 de Julio Inchupalla-Huancane", tipo: "Concurso" },
            { id: 11, nombre: "11 Asociación Cultural Carnaval Chaku Chucahuacas - Chupa - Azangaro", tipo: "Concurso" },
            { id: 12, nombre: "12 Asociación Folklórica Carnaval De Jayllihuaya", tipo: "Concurso" },
            { id: 13, nombre: "13 Cultural De Arte Milenario Heraldos Sangre Aymara - Ilave", tipo: "Concurso" },
            { id: 14, nombre: "14 Conjunto Autóctono Cahuires Tajquina - Chucuito", tipo: "Concurso" },
            { id: 15, nombre: "15 Conjunto Arte Folklórico Nueva Generación Kajelos Del C.P. Marca Esqueña", tipo: "Concurso" },
            { id: 16, nombre: "16 Asociación Central Pulipulis De Taraco", tipo: "Concurso" },
            { id: 17, nombre: "17 Asociación Cultural Carnaval De Chupa", tipo: "Concurso" },
            { id: 18, nombre: "18 Conjunto Folklórico Carnaval De Taraco", tipo: "Concurso" },
            { id: 19, nombre: "19 Asociación De Arte Folklórico Conjunto Yapuchiris 25 De Julio Huilacaya", tipo: "Concurso" },
            { id: 20, nombre: "20 Asociación Juvenil De Sikuris Y Zampoñas Wayra Marca - Juliaca", tipo: "Concurso" },
            { id: 21, nombre: "21 Asociación Cultural Carnaval De Huerta Huaraya - Puno", tipo: "Concurso" },
            { id: 22, nombre: "22 Centro De Expresión Cultural \"Carnaval De Patambuco\"", tipo: "Concurso" },
            { id: 23, nombre: "23 Asociación Cultural Chokela De La Comunidad Campesina Huarijuyo", tipo: "Concurso" },
            { id: 24, nombre: "24 Conjunto Folklórico Carnaval De Churo - Huayrapata", tipo: "Concurso" },
            { id: 25, nombre: "25 Conjunto De Sikuris Centro Cultural 2 De Febrero De Sucuni - Conima", tipo: "Concurso" },
            { id: 26, nombre: "26 Conjunto Carnaval De Chullunquiani Palca Lampa", tipo: "Concurso" },
            { id: 27, nombre: "27 Asociación Folklórica Alpaqueros De Culta Acora", tipo: "Concurso" },
            { id: 28, nombre: "28 Asociación Cultural De Luriguyos Auténticos Rivales De Aychuyo - Yunguyo", tipo: "Concurso" },
            { id: 29, nombre: "29 Danza Guerrera Los Unkakus De La Comunidad Campesina Pacaje", tipo: "Concurso" },
            { id: 30, nombre: "30 Asociación Cultural Originarios Hach'akallas De Usicayos - Carabaya Puno", tipo: "Concurso" },
            { id: 31, nombre: "31 Asociación Cultural Unucajas De Azangaro - Acupa", tipo: "Concurso" },
            { id: 32, nombre: "32 Asociación Cultural Carnaval De Santiago Del Distrito De Santiago De Pupuja - Azangaro", tipo: "Concurso" },
            { id: 33, nombre: "33 Centro De Expresión Cultural Sikuris \"Sentimiento Q'ori Wayra\" San Antonio De Putina", tipo: "Concurso" },
            { id: 34, nombre: "34 Confraternidad Negritos De Ccacca - Acora", tipo: "Concurso" },
            { id: 35, nombre: "35 Conjunto Wifalas De San Fernando San Juan De Salinas", tipo: "Concurso" },
            { id: 36, nombre: "36 Sociedad De Expresión Cultural Café Pallay De Las Yungas De San Juan Del Oro", tipo: "Concurso" },
            { id: 37, nombre: "37 Asociación De Arte Y Cultura Carnaval De Chucuito", tipo: "Concurso" },
            { id: 38, nombre: "38 Conjunto Juventud K'ajelos San Juan De Dios De Pichacani", tipo: "Concurso" },
            { id: 39, nombre: "39 Conjunto Folklórico Carnaval De Pusi-Cofocap", tipo: "Concurso" },
            { id: 40, nombre: "40 Sikuris 27 De Junio Nueva Era - Puno", tipo: "Concurso" },
            { id: 41, nombre: "41 Internacional Grupo De Arte Sikuris Los Chasquis De Coasia Vilquechico", tipo: "Concurso" },
            { id: 42, nombre: "42 Luriguyos Fraternidad Cultural Los Compadres De Yunguyo", tipo: "Concurso" },
            { id: 43, nombre: "43 Sociedad Cultural 9 de Agosto - Perka", tipo: "Concurso" },
            { id: 44, nombre: "44 A.C. Carnaval Ceniza Sangre Aymara Zona Lago - Perka Plateria", tipo: "Concurso" },
            { id: 45, nombre: "45 Asociación Cultural \"Qawra T'ikhiris\" Kelluyo", tipo: "Concurso" },
            { id: 46, nombre: "46 Conjunto Autóctono Pinkillada Utachiris Aymaras - Desaguadero", tipo: "Concurso" },
            { id: 47, nombre: "47 Conjunto Folklórico Flor De Sankayo Centro Pucara Acora", tipo: "Concurso" },
            { id: 48, nombre: "48 Asociación Cultural Música Danza Sikuris Viento Andino Nueva Era Santa Lucia-Lampa", tipo: "Concurso" },
            { id: 49, nombre: "49 Asociación Cultural Carnaval Misturitas Atuncolla - Sillustani", tipo: "Concurso" },
            { id: 50, nombre: "50 Conjunto De Danzas Pinkilladas Lu'qe Pankara De La Comunidad De Carancas - Desaguadero", tipo: "Concurso" },
            { id: 51, nombre: "51 Asociación Cultural Los Tenientes De Incasaya - Caracoto", tipo: "Concurso" },
            { id: 52, nombre: "52 Conjunto Juventud Wifalas De Centro Poblado De San Isidro-Putina", tipo: "Concurso" },
            { id: 53, nombre: "53 Conjunto Milenario De Sikuris 12 De Diciembre - El Collao", tipo: "Concurso" },
            { id: 54, nombre: "54 Conjunto Awatiris Santiago De Vizcachani Jayllihuaya", tipo: "Concurso" },
            { id: 55, nombre: "55 Asociación Cultural Chacareros De Caritamaya Acora - Puno", tipo: "Concurso" },
            { id: 56, nombre: "56 Agrupación Cultural De Música Y Danzas Autóctonas Sikuris 29 De Septiembre Chillcapata - Conima", tipo: "Concurso" },
            { id: 57, nombre: "57 Autenticos Lawa Kumus Del Centro Poblado Thunco - Acora", tipo: "Concurso" },
            { id: 58, nombre: "58 Centro Cultural Juventud K'ajelos Laraqueri", tipo: "Concurso" },
            { id: 59, nombre: "59 Autentico Y Original Carnaval De Ichu", tipo: "Concurso" },
            { id: 60, nombre: "60 Guerreros Hach'akallas De Oruro - Crucero", tipo: "Concurso" },
            { id: 61, nombre: "61 Agrupación Cultural Sikuris Sentimiento Rosal Andino - Cabana", tipo: "Concurso" },
            { id: 62, nombre: "62 Centro Cultural Sikuris y Danza Proyecto Peñablanca-Santa Lucia-Lampa", tipo: "Concurso" },
            { id: 63, nombre: "63 Asociación Cultural Q'aswa 5 Claveles De Capachica", tipo: "Concurso" },
            { id: 64, nombre: "64 Conjunto Folklórico \"Carnaval De Chuque De La Parcialidad De Lluscahaque Jurunawi\" - Acora", tipo: "Concurso" },
            { id: 65, nombre: "65 Asociación Cultural Carnaval Machu - Thinkay Santa Lucia", tipo: "Concurso" },
            { id: 66, nombre: "66 Asociación Chacallada Juventud Clavelitos De Camacani - Plateria", tipo: "Concurso" },
            { id: 67, nombre: "67 Asociación Cultural \"Ispalla Llachon\" - Capachica", tipo: "Concurso" },
            { id: 68, nombre: "68 Asociación Cultural Sikuris Kalacampana - Chucuito", tipo: "Concurso" },
            { id: 69, nombre: "69 Conjunto Juventud De Wifalas San Antonio De Putina", tipo: "Concurso" },
            { id: 70, nombre: "70 Conjunto Folklórico Carnaval Autóctono De Angara - Vilavila", tipo: "Concurso" },
            { id: 71, nombre: "71 Kajelos Asociación Cultural Estudiantes Laraqueri", tipo: "Concurso" },
            { id: 72, nombre: "72 Conjunto Carnaval De Alto Antalla", tipo: "Concurso" },
            { id: 73, nombre: "73 Asociación Cultural Chacareros Fuerza Aymara Yanaque Zona Lago - Acora", tipo: "Concurso" },
            { id: 74, nombre: "Exhibición Asociación Cultural los Argentinos de Paucarcolla", tipo: "Exhibición" }
        ];

        // Función Helper para sumar minutos a una fecha
        function addMinutes(date, minutes) {
            return new Date(date.getTime() + minutes * 60000);
        }

        // Renderizar Simulador (Real-Time Schedule UI)
        function renderSimulador() {

            const container = document.getElementById('events-container');
            if (!container) return;

            // 1. Calcular Tiempos
            // Fecha Base: Sábado 31 de Enero 2026, 10:00 AM
            const baseDate = new Date('2026-01-31T10:00:00-05:00'); // Hora Puno/Perú
            const slotDuration = 10; // minutos

            // Simular fecha actual para pruebas si no estamos en 2026 (Comentar para producción real)
            // const now = new Date('2026-01-31T10:25:00-05:00');
            const now = new Date(); // Fecha Real del sistema del usuario

            const fullSchedule = danzasOriginarias.map((danza, index) => {
                const start = addMinutes(baseDate, index * slotDuration);
                const end = addMinutes(start, slotDuration);

                let status = 'upcoming'; // upcoming, live, past
                if (now >= end) status = 'past';
                else if (now >= start && now < end) status = 'live';

                return {
                    ...danza,
                    start,
                    end,
                    status,
                    startTimeStr: start.toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit', hour12: true }),
                    endTimeStr: end.toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit', hour12: true })
                };
            });

            // 2. Filtrar Eventos
            const liveEvent = fullSchedule.find(e => e.status === 'live');
            const pastEvents = fullSchedule.filter(e => e.status === 'past').slice(-2); // Últimos 2
            const upcomingEvents = fullSchedule.filter(e => e.status === 'upcoming');

            // 3. Renderizar
            let html = `
                <!-- Heading -->
                <div class="flex flex-col gap-6 mb-8 font-display">
                    <div class="flex flex-wrap justify-between items-end gap-4">
                        <div class="flex flex-col gap-2">
                            <h1 class="text-gray-900 text-3xl md:text-5xl font-black tracking-tight">Simulador en Vivo</h1>
                            <p class="text-gray-500 text-lg max-w-2xl">
                                Danzas Originarias - Sábado 31 de Enero 2026 <br>
                                <span class="text-sm font-medium text-candelaria-purple">Estadio UNA Puno • Cada danza 10 min</span>
                            </p>
                        </div>
                        <div class="bg-white p-2 rounded-xl border border-gray-200 shadow-sm text-right">
                            <p class="text-xs text-gray-400 uppercase font-bold">Hora Actual</p>
                            <p class="text-xl font-mono font-bold text-gray-800">${now.toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}</p>
                        </div>
                    </div>
                </div>

                <!-- Timeline Section -->
                <div class="relative mt-4 pl-4 md:pl-0 font-display">
                    <!-- Vertical Line -->
                    <div class="absolute left-6 md:left-10 top-4 bottom-0 w-0.5 bg-gradient-to-b from-gray-200 via-gray-200 to-transparent"></div>
                    <div class="flex flex-col gap-10">
            `;

            // A) Past Events
            pastEvents.forEach(evt => {
                html += `
                    <div class="relative pl-16 md:pl-20 group opacity-60 hover:opacity-90 transition-opacity">
                        <div class="absolute left-[21px] md:left-[37px] top-2 size-3 bg-gray-300 rounded-full ring-4 ring-white"></div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 rounded-xl border border-transparent hover:border-gray-200 hover:bg-white hover:shadow-sm transition-all">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-3">
                                    <span class="text-gray-500 font-mono text-sm">${evt.startTimeStr}</span>
                                    <span class="px-2 py-0.5 rounded-full bg-gray-100 border border-gray-200 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Finalizado</span>
                                </div>
                                <h3 class="text-gray-800 text-lg font-bold leading-tight">${evt.nombre}</h3>
                            </div>
                        </div>
                    </div>
                `;
            });

            // B) Live Event
            if (liveEvent) {
                html += `
                    <div class="relative pl-0 md:pl-16">
                        <!-- Custom Node for Live -->
                        <div class="absolute left-[37px] top-1/2 -translate-y-1/2 hidden md:block">
                            <span class="relative flex h-4 w-4">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-candelaria-primary opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-4 w-4 bg-candelaria-primary"></span>
                            </span>
                        </div>
                        
                        <!-- Live Card -->
                        <div class="bg-white rounded-2xl border border-candelaria-primary/30 shadow-[0_10px_40px_-10px_rgba(236,19,37,0.15)] overflow-hidden relative">
                            <div class="bg-candelaria-primary/5 border-b border-candelaria-primary/10 px-6 py-2 flex items-center justify-between">
                                <div class="flex items-center gap-2 text-candelaria-primary font-black tracking-wider text-sm uppercase">
                                    <span class="material-symbols-outlined text-lg animate-pulse fill-1">circle</span>
                                    En Escenario
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex flex-col justify-between gap-6">
                                    <div>
                                        <div class="flex items-center gap-3 mb-2">
                                            <span class="text-gray-500 font-mono text-sm">Inicio: ${liveEvent.startTimeStr}</span>
                                            <span class="px-3 py-1 rounded-full bg-candelaria-primary text-white text-[10px] font-black uppercase tracking-wider shadow-sm">Presentándose Ahora</span>
                                        </div>
                                        <h2 class="text-3xl font-black text-gray-900 leading-tight mb-2">${liveEvent.nombre}</h2>
                                        <p class="text-gray-500 text-sm">Duras 10 minutos strictos en el escenario.</p>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-2 mt-2">
                                        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
                                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-1">Fin Programado</p>
                                            <p class="text-gray-900 font-mono font-bold">${liveEvent.endTimeStr}</p>
                                        </div>
                                        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
                                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-1">Slot</p>
                                            <p class="text-gray-900 font-mono font-bold">#${liveEvent.id}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            } else if (upcomingEvents.length > 0 && pastEvents.length > 0) {
                // No live event but in between slots? Or just waiting for next.
                // Actually logic covers all times. If now < start[0], all upcoming.
            } else if (upcomingEvents.length === danzasOriginarias.length) {
                // Before event starts
                html += `
                    <div class="relative pl-0 md:pl-16 mb-8">
                        <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100 text-center">
                            <h3 class="text-blue-900 font-bold text-lg">El evento aún no ha comenzado</h3>
                            <p class="text-blue-700 text-sm">Inicia el Sábado 31 de Enero a las 10:00 AM</p>
                        </div>
                    </div>
                 `;
            }

            // C) Upcoming Events (Show next 5)
            upcomingEvents.slice(0, 50).forEach((evt, idx) => {
                const label = idx === 0 ? 'A Continuación' : 'Programado';
                html += `
                    <div class="relative pl-16 md:pl-20 group">
                        <!-- Node -->
                        <div class="absolute left-[21px] md:left-[37px] top-6 size-3 bg-white border-2 border-gray-300 rounded-full"></div>
                        <!-- Connector -->
                        <div class="absolute left-6 md:left-10 top-9 bottom-[-40px] w-px border-l border-dashed border-gray-300"></div>
                        
                        <div class="flex flex-col gap-3 p-4 rounded-xl hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100 cursor-pointer">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="text-gray-900 font-mono font-bold text-lg">${evt.startTimeStr}</span>
                                    <span class="px-2 py-0.5 rounded-full bg-gray-100 border border-gray-200 text-[10px] font-bold text-gray-700 uppercase tracking-wider">${label}</span>
                                </div>
                            </div>
                            <h3 class="text-gray-700 font-bold text-base">${evt.nombre}</h3>
                        </div>
                    </div>
                `;
            });

            html += `
                    </div> <!-- End Timeline flex col -->
                </div> <!-- End Timeline Container -->
            `;

            container.innerHTML = html;

            // Re-schedule update every 10 seconds to keep clock fresh
            if (!window.simuladorInterval) {
                window.simuladorInterval = setInterval(renderSimulador, 10000);
            }
        }

        // Renderizar consultas
        function renderConsultas() {
            const container = document.getElementById('events-container');
            if (!container) return;

            container.innerHTML = `
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i data-lucide="help-circle" class="w-5 h-5 mr-2 text-candelaria-purple"></i>
                        Preguntas Frecuentes
                    </h2>
                    <div class="space-y-4">
                        ${faqs.map(faq => `
                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <button class="w-full flex justify-between items-center p-4 text-left bg-gray-50 hover:bg-gray-100 transition-colors">
                                    <span class="font-medium text-gray-800">${faq.question}</span>
                                    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-500"></i>
                                </button>
                                <div class="p-4 bg-white text-gray-600">
                                    <p>${faq.answer}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div class="bg-gradient-to-br from-purple-500 to-candelaria-purple rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="font-bold text-lg mb-2 flex items-center">
                        <i data-lucide="mail" class="w-5 h-5 mr-2"></i>
                        Correo Electrónico
                    </h3>
                    <p class="text-purple-100 mb-4">Envíanos tu consulta por correo</p>
                    <button class="w-full py-3 bg-white text-candelaria-purple rounded-lg font-bold hover:bg-purple-50 transition-colors">
                        Enviar Correo
                    </button>
                </div>

                <div class="bg-gradient-to-br from-blue-500 to-candelaria-lake rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="font-bold text-lg mb-2 flex items-center">
                        <i data-lucide="phone" class="w-5 h-5 mr-2"></i>
                        Contacto Directo
                    </h3>
                    <p class="text-blue-100 mb-4">Habla con nuestro equipo</p>
                    <button class="w-full py-3 bg-white text-blue-600 rounded-lg font-bold hover:bg-blue-50 transition-colors">
                        Llamar Ahora
                    </button>
                </div>
            </div>
        `;

            // Actualizar los íconos de Lucide
            lucide.createIcons();
        }

        // Renderizar danzas (Turbo Mode Refactored)
        async function renderDanzas() {
            const container = document.getElementById('events-container');
            if (!container) return;

            // Show loading state first (Layout Structure)
            container.innerHTML = `
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <i data-lucide="users" class="w-5 h-5 mr-2 text-candelaria-purple"></i>
                            Lista Completa de Danzas
                        </h2>
                    </div>

                    <!--Search bar for danzas-->
                    <form id="danzas-search-form" class="mb-6">
                        <div class="flex gap-3">
                            <div class="relative flex-grow group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="search" class="w-5 h-5 text-gray-400 group-focus-within:text-candelaria-purple transition-colors"></i>
                                </div>
                                <input type="text" id="danzas-search-input"
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:bg-white focus:ring-2 focus:ring-candelaria-purple focus:border-candelaria-purple sm:text-sm transition-all shadow-sm"
                                    placeholder="Buscar danzas por conjunto...">
                            </div>
                            <button type="submit" class="px-4 py-2.5 bg-candelaria-purple text-white rounded-lg text-sm font-medium hover:bg-purple-600 transition-colors">
                                Buscar
                            </button>
                            <a href="../assets/orden.pdf" download="Programacion_Candelaria_2026.pdf" class="px-4 py-2.5 bg-candelaria-gold text-candelaria-purple rounded-lg text-sm font-bold hover:bg-yellow-400 transition-colors flex items-center gap-2 whitespace-nowrap shadow-sm border border-yellow-400" style="text-decoration: none;">
                                <i data-lucide="download" class="w-4 h-4"></i>
                                <span class="hidden sm:inline">Descargar Danzas</span>
                            </a>
                        </div>
                    </form>

                    <div id="danzas-grid" class="danzas-grid">
                        <!-- Skeleton Injection Point -->
                    </div>

                    <div id="pagination-container" class="mt-8">
                        <div class="flex items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6">
                            <div class="text-sm text-gray-700" id="results-info">
                                Cargando resultados...
                            </div>
                            <div class="flex space-x-2" id="pagination">
                                <!-- Pagination controls -->
                            </div>
                        </div>
                    </div>
                </div>
            `;

            lucide.createIcons();

            // Setup Event Listeners
            const searchForm = document.getElementById('danzas-search-form');
            if (searchForm) {
                searchForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                });
            }

            const searchInput = document.getElementById('danzas-search-input');
            if (searchInput) {
                searchInput.value = currentDanzaSearch;
                searchInput.addEventListener('input', function (e) {
                    currentDanzaSearch = e.target.value;
                    currentDanzaPage = 1;
                    filterAndRenderDanzas();
                });
                searchInput.focus(); // Keep focus
            }

            // LOAD DATA
            await loadAllDanzasIntoRam();
        }

        // ========== logic: Load ALL Danzas into RAM (Turbo Load) ==========
        async function loadAllDanzasIntoRam() {
            if (isRamLoaded) {
                filterAndRenderDanzas();
                return;
            }
            if (isDanzaLoading) return;

            isDanzaLoading = true;
            const danzasGrid = document.getElementById('danzas-grid');

            if (danzasGrid) {
                danzasGrid.innerHTML = `
                <div class="animate-pulse flex flex-col space-y-4 col-span-full">
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded"></div>
                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                </div>
              `;
            }

            try {
                console.time("🚀 Descarga Turbo Horarios");
                const response = await fetch('../api/danzas_all.php'); // Path relative to horarios_y_danzas/index.php
                if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);

                RAM_DANZAS = await response.json();
                danzas = RAM_DANZAS; // Sync global for modal
                console.timeEnd("🚀 Descarga Turbo Horarios");
                console.log(`✅ ${RAM_DANZAS.length} danzas cargadas en RAM (Horarios).`);

                isRamLoaded = true;
                filterAndRenderDanzas();

            } catch (error) {
                console.error('Error loading ALL danzas:', error);
                if (danzasGrid) {
                    danzasGrid.innerHTML = `<div class="col-span-full text-center py-8 text-red-500">Error al cargar las danzas: ${error.message}</div>`;
                }
            } finally {
                isDanzaLoading = false;
            }
        }

        // ========== Logic: Filter RAM -> filteredDanzas -> Paginate -> Render ==========
        function filterAndRenderDanzas() {
            let results = RAM_DANZAS;

            if (currentDanzaSearch && currentDanzaSearch.trim() !== '') {
                const q = currentDanzaSearch.toLowerCase();
                results = results.filter(d => {
                    const text = (
                        (d.conjunto || '') + ' ' +
                        (d.categoria || '') + ' ' +
                        (d.descripcion || '')
                    ).toLowerCase();
                    return text.includes(q);
                });
            }

            filteredDanzas = results;
            renderCurrentDanzaPage();
        }

        function renderCurrentDanzaPage() {
            const danzasGrid = document.getElementById('danzas-grid');
            const resultsInfo = document.getElementById('results-info');
            const paginationContainer = document.getElementById('pagination');

            if (!danzasGrid) return;

            const total = filteredDanzas.length;

            if (total === 0) {
                danzasGrid.innerHTML = `<div class="col-span-full text-center py-8 text-gray-500">No se encontraron danzas${currentDanzaSearch ? ` para "${currentDanzaSearch}"` : ''}</div>`;
                if (resultsInfo) resultsInfo.textContent = '0 resultados';
                if (paginationContainer) paginationContainer.innerHTML = '';
                return;
            }

            const totalPages = Math.ceil(total / danzaPageSize);
            if (currentDanzaPage > totalPages) currentDanzaPage = 1;

            const startIdx = (currentDanzaPage - 1) * danzaPageSize;
            const endIdx = Math.min(startIdx + danzaPageSize, total);

            const pageItems = filteredDanzas.slice(startIdx, endIdx);

            danzasGrid.innerHTML = '';
            pageItems.forEach(danza => {
                let categoria = danza.categoria || 'N/A';
                if (categoria === 'Luces Parada') categoria = 'Traje de Luces';

                let categoryClass = 'traditional';
                const catUpper = categoria.toUpperCase();
                if (catUpper.includes('LUCE')) categoryClass = 'lights';
                else if (catUpper.includes('ORIGIN')) categoryClass = 'originary';
                else if (catUpper.includes('TRADICION')) categoryClass = 'traditional';
                else if (['PARADA', 'CIERRE / FIESTA', 'RELIGIOSO'].includes(catUpper)) categoryClass = 'traditional';

                // We are not using categoryClass for styling in the card HTML structure similar to before,
                // but if we wanted to revive the color logic:
                // Currently reusing the 'event-card' style which is standard.

                const card = document.createElement('div');
                card.className = 'event-card';
                card.innerHTML = `
                    <div class="event-image-container">
                        <img class="event-image" src="${fixPhotoPath(danza.foto)}"
                             alt="${danza.conjunto}"
                             loading="lazy"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x300?text=Imagen+no+disponible';">
                    </div>
                    <div class="event-content">
                        <div class="event-genre">${categoria}</div>
                        <h3 class="event-title">${danza.conjunto}</h3>
                        <button class="event-btn" onclick="openDanceModal(${danza.id})">
                            Ver Detalles
                        </button>
                    </div>
                `;
                danzasGrid.appendChild(card);
            });

            if (resultsInfo) {
                resultsInfo.textContent = `Mostrando ${startIdx + 1} a ${endIdx} de ${total} resultados`;
            }

            if (paginationContainer) {
                let paginationHtml = '';

                // Prev
                if (currentDanzaPage > 1) {
                    paginationHtml += `<button class="prev px-4 py-2 bg-candelaria-purple text-white rounded-lg hover:bg-purple-600" onclick="changeDanzaPage(${currentDanzaPage - 1})">← Anterior</button>`;
                } else {
                    paginationHtml += `<button class="prev px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed" disabled>← Anterior</button>`;
                }

                const maxPages = 5;
                let startPage = Math.max(1, currentDanzaPage - Math.floor(maxPages / 2));
                let endPage = Math.min(totalPages, startPage + maxPages - 1);
                if (endPage - startPage + 1 < maxPages) startPage = Math.max(1, endPage - maxPages + 1);

                if (startPage > 1) {
                    paginationHtml += `<button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg" onclick="changeDanzaPage(1)">1</button>`;
                    if (startPage > 2) paginationHtml += '<span class="px-2">...</span>';
                }

                for (let i = startPage; i <= endPage; i++) {
                    if (i === currentDanzaPage) {
                        paginationHtml += `<button class="px-3 py-2 bg-candelaria-purple text-white rounded-lg">${i}</button>`;
                    } else {
                        paginationHtml += `<button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg" onclick="changeDanzaPage(${i})">${i}</button>`;
                    }
                }

                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) paginationHtml += '<span class="px-2">...</span>';
                    paginationHtml += `<button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg" onclick="changeDanzaPage(${totalPages})">${totalPages}</button>`;
                }

                // Next
                if (currentDanzaPage < totalPages) {
                    paginationHtml += `<button class="next px-4 py-2 bg-candelaria-purple text-white rounded-lg hover:bg-purple-600" onclick="changeDanzaPage(${currentDanzaPage + 1})">Siguiente →</button>`;
                } else {
                    paginationHtml += `<button class="next px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed" disabled>Siguiente →</button>`;
                }

                paginationContainer.innerHTML = paginationHtml;
            }
            lucide.createIcons();
        }

        // Function to change danza page (Local)
        function changeDanzaPage(page) {
            if (page < 1) return;
            currentDanzaPage = page;
            renderCurrentDanzaPage();
            // Optional: scroll to top of grid
            document.getElementById('events-container').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }


        // Renderizar mapa



        // Helper function to open image in new tab
        function openImage(url) {
            if (url && url.startsWith('http')) {
                window.open(url, '_blank');
            } else {
                alert('Imagen no disponible');
            }
        }

        // Función para inicializar la aplicación
        function initApp() {
            // Verificar si hay una pestaña específica en la URL (hash)
            const hash = window.location.hash.substring(1);
            if (hash && ['programacion', 'consultas', 'danzas'].includes(hash)) {
                setActiveTab(hash);
            } else {
                // Establecer la pestaña activa por defecto
                setActiveTab(state.activeTab);
            }

            // Configurar eventos de búsqueda
            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    state.search = e.target.value;
                    updateContent();
                });
            }

            // Detectar parámetro danzaId para abrir modal automáticamente
            const urlParams = new URLSearchParams(window.location.search);
            const danzaId = urlParams.get('danzaId');
            if (danzaId) {
                // Esperar a que las danzas se carguen y luego abrir el modal
                const checkAndOpenModal = setInterval(() => {
                    if (danzas && danzas.length > 0) {
                        clearInterval(checkAndOpenModal);
                        const id = parseInt(danzaId, 10);
                        openDanceModal(id);
                    }
                }, 200);
                // Timeout después de 5 segundos
                setTimeout(() => clearInterval(checkAndOpenModal), 5000);
            }

        }

        // Inicializar la aplicación cuando se cargue el DOM
        document.addEventListener('DOMContentLoaded', initApp);

        // Actualizar la pestaña activa si cambia el hash de la URL
        window.addEventListener('hashchange', function () {
            const hash = window.location.hash.substring(1);
            if (hash && ['programacion', 'consultas', 'danzas'].includes(hash)) {
                setActiveTab(hash);
            }
        });

        // Initialize modal close functionality
        function initModalClose() {
            const eventCloseBtn = document.getElementById('event-modal-close');
            const danceCloseBtn = document.getElementById('dance-modal-close');

            if (eventCloseBtn) {
                eventCloseBtn.addEventListener('click', () => {
                    const modal = document.getElementById('event-modal');
                    if (modal) modal.classList.remove('active');
                });
            }

            if (danceCloseBtn) {
                danceCloseBtn.addEventListener('click', () => {
                    const modal = document.getElementById('dance-modal');
                    if (modal) modal.classList.remove('active');
                });
            }

            // Close modals by clicking outside
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.classList.remove('active');
                    }
                });
            });
        }

        // Since script is at end of body, DOM is already loaded, initialize directly
        // Check if document is already loaded, if not wait for it
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initModalClose);
        } else {
            // DOM is already loaded, run immediately
            setTimeout(initModalClose, 0); // Use timeout to ensure everything is ready
        }

        // Open event modal
        function openEventModal(eventoId) {
            const evento = eventos.find(e => e.id === eventoId);
            if (!evento) return;

            const modal = document.getElementById('event-modal');
            const modalBody = document.getElementById('event-modal-body');
            const modalTitle = document.getElementById('event-modal-title');

            modalTitle.textContent = evento.banda;

            modalBody.innerHTML = `
            <div class="dance-details-grid">
                    <div>
                        <img src="${evento.imagen}" alt="${evento.banda}" class="dance-image">
                        <div style="margin-top: 1.5rem;">
                            <h3>Información del Evento</h3>
                            <div class="quick-facts">
                                <div class="info-item">
                                    <div class="info-label">Fecha</div>
                                    <div class="info-value">${evento.fecha} • ${evento.dia}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Hora</div>
                                    <div class="info-value">${evento.hora}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Tipo</div>
                                    <div class="info-value">${evento.genero}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="modal-section">
                            <h3>Descripción</h3>
                            <p style="line-height: 1.6; color: #4b5563;">${evento.description || 'No hay descripción disponible para este evento.'}</p>
                        </div>
                        <div class="modal-section">
                            <h3>Detalles Adicionales</h3>
                            <div style="background: #f5f3ff; padding: 1.5rem; border-radius: 0.75rem; border: 2px solid #e0e7ff;">
                                <div style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 1rem;">
                                    <div class="info-item">
                                        <div class="info-label">Información Extra</div>
                                        <div class="info-value">${evento.extra || 'No hay información extra disponible.'}</div>
                                    </div>
                                    <div class="info-item" style="margin-top: 1rem;">
                                        <div class="info-label">Ubicación</div>
                                        <div class="info-value">${evento.location || 'Puno, Perú'}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;


            modal.classList.add('active');
        }

        // Open dance modal - simplified to use only ID
        function openDanceModal(danzaId) {
            console.log('[DEBUG openDanceModal] Called with ID:', danzaId);
            console.log('[DEBUG openDanceModal] Global danzas array length:', danzas ? danzas.length : 'undefined');

            // Search in global danzas array
            let danza = null;
            if (typeof danzas !== 'undefined' && danzas.length > 0) {
                danza = danzas.find(d => d.id == danzaId);
                console.log('[DEBUG openDanceModal] Found danza:', danza ? 'YES' : 'NO');
                if (danza) {
                    console.log('[DEBUG openDanceModal] Danza data:', JSON.stringify(danza, null, 2).substring(0, 500));
                }
            } else {
                console.error('[DEBUG openDanceModal] danzas array is empty or undefined!');
            }

            // If danza is not found, show error
            if (!danza) {
                console.error("[DEBUG openDanceModal] Danza not found with ID: " + danzaId);
                alert('Error: No se pudo cargar la información de la danza. Por favor recarga la página.');
                return;
            }

            const modal = document.getElementById('dance-modal');
            const modalBody = document.getElementById('dance-modal-body');
            const modalTitle = document.getElementById('dance-modal-title');

            modalTitle.textContent = danza.name || danza.conjunto || 'Danza';

            const nombre = danza.name || danza.conjunto || 'Danza';
            const descValue = danza.descripcion || 'Descripción no disponible';
            const catValue = danza.categoria || 'N/A';
            // Show "Traje de Luces" for "Luces Parada" or "Luces Estadio"
            const catDisplay = catValue.toLowerCase().includes('luces') ? 'Traje de Luces' : catValue;
            const horaValue = danza.hora || 'Hora no especificada';
            const ordenConcursoValue = danza.orden_concurso || 'N/A';
            const ordenVeneracionValue = danza.orden_veneracion || 'N/A';
            const detallesValue = danza.detalles || '';
            // New extended fields
            const historiaValue = danza.historia || '';
            const juntaDirectivaValue = danza.junta_directiva || '';
            const bloquesValue = danza.bloques || '';
            const bandasValue = danza.bandas || '';

            // Function to fix photo paths - transform filename to full path
            function fixPhotoPath(url) {
                if (!url) return 'https://placehold.co/400x300?text=Imagen+no+disponible';
                if (url.startsWith('http') || url.startsWith('data:')) return url;
                // Clean the path and prepend the correct uploads directory
                let clean = url.startsWith('/') ? url.substring(1) : url;
                clean = clean.replace(/^candelaria\/assets\/uploads\//, '')
                    .replace(/^assets\/uploads\//, '')
                    .replace(/^uploads\//, '');
                return '../assets/uploads/' + clean;
            }

            // FIX: Use fixPhotoPath to get the correct URL
            const fotoValue = fixPhotoPath(danza.foto);

            modalBody.innerHTML = `
            <div class="dance-details-grid">
                    <div>
                        <img src="${fotoValue}"
                             alt="${nombre}"
                             class="dance-image"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x300?text=Imagen+no+disponible';">
                        <div style="margin-top: 1.5rem;">
                            <h3>Información de Presentación</h3>
                            <div class="quick-facts">
                                <div class="info-item">
                                    <div class="info-label">Categoría</div>
                                    <div class="info-value">${catDisplay}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Orden en Concurso</div>
                                    <div class="info-value">#${ordenConcursoValue}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Orden en Veneración</div>
                                    <div class="info-value">#${ordenVeneracionValue}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">Hora Estimada</div>
                                    <div class="info-value">${horaValue}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="modal-section">
                            <h3>Datos del Conjunto</h3>
                            <p><strong>Conjunto:</strong> ${nombre}</p>
                            <p><strong>Descripción:</strong> ${descValue}</p>
                            ${detallesValue ? `<p><strong>Detalles:</strong> ${detallesValue}</p>` : ''}
                        </div>
                        ${juntaDirectivaValue ? `
                        <div class="modal-section" style="margin-top: 1rem;">
                            <h3>Junta Directiva</h3>
                            <p style="line-height: 1.6; color: #4b5563;">${juntaDirectivaValue}</p>
                        </div>
                        ` : ''}
                        ${bandasValue ? `
                        <div class="modal-section" style="margin-top: 1rem;">
                            <h3>Bandas</h3>
                            <p style="line-height: 1.6; color: #4b5563;">${bandasValue}</p>
                        </div>
                        ` : ''}
                        ${bloquesValue ? `
                        <div class="modal-section" style="margin-top: 1rem;">
                            <h3>Bloques</h3>
                            <p style="line-height: 1.6; color: #4b5563;">${bloquesValue}</p>
                        </div>
                        ` : ''}
                    </div>
                </div>

            ${historiaValue ? `
                <div class="modal-section">
                    <h3>Historia del Conjunto</h3>
                    <p style="line-height: 1.6; color: #4b5563;">${historiaValue}</p>
                </div>
                ` : ''
                }

        <div class="card-actions">
            <button class="btn-modal-action btn-modal-live" onclick="window.location.href='../live-platform/index.php#live'">
                <i data-lucide="radio" style="width: 18px; height: 18px; margin-right: 8px;"></i> Ver En Vivo
            </button>
            <button class="btn-modal-action btn-modal-score" onclick="window.location.href='../live-platform/index.php#scores'">
                <i data-lucide="trophy" style="width: 18px; height: 18px; margin-right: 8px;"></i> Ver Puntaje
            </button>
            <button class="btn-modal-action btn-modal-map" onclick="window.location.href='../live-platform/index.php#map'">
                Ver en Mapa
            </button>
            <button class="btn-modal-action btn-modal-share" onclick="(function(){
                const shareUrl = window.location.origin + window.location.pathname + '?danzaId=' + ${danza.id} + '#danzas';
                if (navigator.share) {
                    navigator.share({
                        title: '${nombre}',
                        text: 'Mira esta danza en la Festividad Virgen de la Candelaria 2026',
                        url: shareUrl
                    }).catch(console.error);
                } else {
                    navigator.clipboard.writeText(shareUrl).then(() => {
                        alert('¡Enlace copiado al portapapeles!');
                    }).catch(err => console.error('Error al copiar:', err));
                }
            })()">Compartir</button>
        </div>
            `;

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            modal.classList.add('active');
        }
        // Generate PDF Function

    </script>

    <!-- Modal for Event Details -->
    <div class="modal" id="event-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="event-modal-title">Detalles del Evento</h2>
                <button class="modal-close" id="event-modal-close">&times;</button>
            </div>
            <div class="modal-body" id="event-modal-body"></div>
        </div>
    </div>

    <!-- Modal for Dance Details -->
    <div class="modal" id="dance-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="dance-modal-title">Detalles de la Danza</h2>
                <button class="modal-close" id="dance-modal-close">&times;</button>
            </div>
            <div class="modal-body" id="dance-modal-body"></div>
        </div>
    </div>

    <!-- Modal CSS -->
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            overflow-y: auto;
        }

        .modal.active {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 2rem;
        }

        .modal-content {
            background: white;
            border-radius: 1rem;
            width: 90%;
            max-width: 1200px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 2rem;
            background: linear-gradient(to right, #4c1d95, #5b21b6);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-close {
            background: none;
            border: none;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            padding: 0;
            width: 2rem;
            height: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.3s ease;
        }

        .modal-close:hover {
            color: #fbbf24;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-section {
            margin-bottom: 2.5rem;
        }

        .modal-section h3 {
            color: #4c1d95;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #fbbf24;
        }

        .dance-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .dance-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .quick-facts {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .info-label {
            font-size: 0.75rem;
            color: #6b7280;
            font-weight: 600;
        }

        .info-value {
            font-size: 0.875rem;
            color: #1f2937;
            font-weight: 700;
        }

        .card-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.875rem;
        }

        .btn-primary {
            background: linear-gradient(to right, #fbbf24, #f59e0b);
            color: #4c1d95;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #f59e0b, #d97706);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #4c1d95;
            color: white;
        }

        .btn-secondary:hover {
            background: #5b21b6;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #fbbf24;
            color: #fbbf24;
        }

        .btn-outline:hover {
            background: #fef3c7;
        }
    </style>

    <!-- Chatbot Widget Removed -->

    <script>
        // Mobile Menu Logic
        // Mobile Menu Logic handled by standard-header.php
    </script>
    <!-- Chatbot Widget Removed (Duplicate) -->

    <!-- Auth Modal and Dropdown -->
    <?= getAuthModalHTML() ?>
    <?= getAuthJS() ?>

    <?php
    $footerDepth = 1;
    include '../includes/standard-footer.php';
    ?>
</body>

</html>