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
        let danzas = [];

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

        // Renderizar Simulador (Real-Time Schedule UI)
        function renderSimulador() {
            const container = document.getElementById('events-container');
            if (!container) return;

            // Updated Layout for "Real-Time" with Cheerful/Professional Theme
            const isDay1 = state.activeDay === 'day1';
            const isDay2 = state.activeDay === 'day2';
            const isDay3 = state.activeDay === 'day3';

            container.innerHTML = `
                <!-- Heading & Tabs -->
                <div class="flex flex-col gap-6 mb-8 font-display">
                    <div class="flex flex-wrap justify-between items-end gap-4">
                        <div class="flex flex-col gap-2">
                            <h1 class="text-gray-900 text-3xl md:text-5xl font-black tracking-tight">Horario en Vivo</h1>
                            <p class="text-gray-500 text-lg max-w-2xl">Sigue el orden oficial de presentación de la Festividad de la Candelaria.</p>
                        </div>
                        <!-- Date Toggle -->
                        <div class="bg-white p-1 rounded-full inline-flex border border-gray-200 self-start md:self-end shadow-sm">
                            <button onclick="setActiveDay('day1')" class="px-5 py-2 rounded-full text-sm font-bold transition-colors ${state.activeDay === 'day1' ? 'bg-candelaria-primary text-white shadow-md' : 'text-gray-500 hover:text-gray-900'}">
                                Día 1
                            </button>
                            <button onclick="setActiveDay('day2')" class="px-5 py-2 rounded-full text-sm font-bold transition-colors ${state.activeDay === 'day2' ? 'bg-candelaria-primary text-white shadow-md' : 'text-gray-500 hover:text-gray-900'}">
                                Día 2: Trajes de Luces
                            </button>
                            <button onclick="setActiveDay('day3')" class="px-5 py-2 rounded-full text-sm font-bold transition-colors ${state.activeDay === 'day3' ? 'bg-candelaria-primary text-white shadow-md' : 'text-gray-500 hover:text-gray-900'}">
                                Día 3
                            </button>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="flex flex-col gap-1 rounded-2xl p-5 bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-2 text-gray-500 mb-1">
                                <span class="material-symbols-outlined text-xl">groups</span>
                                <span class="text-sm font-bold uppercase tracking-wider">Participación</span>
                            </div>
                            <p class="text-gray-900 text-3xl font-bold">45 <span class="text-gray-400 text-xl font-medium">/ 80</span></p>
                            <p class="text-xs text-gray-500">Conjuntos presentados</p>
                        </div>
                        <div class="flex flex-col gap-1 rounded-2xl p-5 bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-2 text-gray-500 mb-1">
                                <span class="material-symbols-outlined text-xl">schedule</span>
                                <span class="text-sm font-bold uppercase tracking-wider">Retraso Promedio</span>
                            </div>
                            <p class="text-candelaria-primary text-3xl font-bold">+25 min</p>
                            <p class="text-xs text-gray-500">Detrás del horario</p>
                        </div>
                        <div class="flex flex-col gap-1 rounded-2xl p-5 bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow sm:col-span-2 lg:col-span-1">
                            <div class="flex items-center gap-2 text-gray-500 mb-1">
                                <span class="material-symbols-outlined text-xl">sunny</span>
                                <span class="text-sm font-bold uppercase tracking-wider">Clima (Puno)</span>
                            </div>
                            <p class="text-gray-900 text-3xl font-bold">14°C</p>
                            <p class="text-xs text-gray-500">Parcialmente Nublado, UV Alto</p>
                        </div>
                    </div>
                </div>

                <!-- Timeline Section -->
                <div class="relative mt-4 pl-4 md:pl-0 font-display">
                    <!-- Vertical Line -->
                    <div class="absolute left-6 md:left-10 top-4 bottom-0 w-0.5 bg-gradient-to-b from-gray-200 via-gray-200 to-transparent"></div>
                    <div class="flex flex-col gap-10">

                        <!-- Past Item 1 -->
                        <div class="relative pl-16 md:pl-20 group opacity-60 hover:opacity-90 transition-opacity">
                            <div class="absolute left-[21px] md:left-[37px] top-2 size-3 bg-gray-300 rounded-full ring-4 ring-white"></div>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 rounded-xl border border-transparent hover:border-gray-200 hover:bg-white hover:shadow-sm transition-all">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-3">
                                        <span class="text-gray-500 font-mono text-sm">07:45 AM</span>
                                        <span class="px-2 py-0.5 rounded-full bg-gray-100 border border-gray-200 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Finalizado</span>
                                    </div>
                                    <h3 class="text-gray-800 text-lg font-bold leading-tight">Asociación Cultural Caporales Centralistas</h3>
                                </div>
                                <div class="text-right sm:text-left">
                                    <span class="text-sm text-green-600 font-medium">A tiempo</span>
                                </div>
                            </div>
                        </div>

                         <!-- Past Item 2 -->
                        <div class="relative pl-16 md:pl-20 group opacity-70 hover:opacity-100 transition-opacity">
                            <div class="absolute left-[21px] md:left-[37px] top-2 size-3 bg-gray-300 rounded-full ring-4 ring-white"></div>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 rounded-xl border border-transparent hover:border-gray-200 hover:bg-white hover:shadow-sm transition-all">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-3">
                                        <span class="text-gray-500 font-mono text-sm">08:15 AM</span>
                                        <span class="px-2 py-0.5 rounded-full bg-gray-100 border border-gray-200 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Finalizado</span>
                                    </div>
                                    <h3 class="text-gray-800 text-lg font-bold leading-tight">Conjunto Sicuris del Barrio Mañazo</h3>
                                </div>
                                <div class="text-right sm:text-left">
                                    <span class="text-sm text-red-500 font-medium">+10m Retraso</span>
                                </div>
                            </div>
                        </div>

                        <!-- LIVE ITEM -->
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
                                <!-- Live Banner -->
                                <div class="bg-candelaria-primary/5 border-b border-candelaria-primary/10 px-6 py-2 flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-candelaria-primary font-black tracking-wider text-sm uppercase">
                                        <span class="material-symbols-outlined text-lg animate-pulse fill-1">circle</span>
                                        Escenario Principal
                                    </div>
                                    <div class="flex items-center gap-2 opacity-80">
                                        <span class="material-symbols-outlined text-candelaria-primary text-lg">visibility</span>
                                        <span class="text-gray-800 text-xs font-bold">12.5k viendo</span>
                                    </div>
                                </div>

                                <div class="p-6 grid grid-cols-1 md:grid-cols-12 gap-6">
                                    <!-- Info Column -->
                                    <div class="md:col-span-7 flex flex-col justify-between gap-6">
                                        <div>
                                            <div class="flex items-center gap-3 mb-2">
                                                <span class="text-gray-500 font-mono text-sm">Prog: 08:30 AM</span>
                                                <span class="px-3 py-1 rounded-full bg-candelaria-primary text-white text-[10px] font-black uppercase tracking-wider shadow-sm">Presentándose Ahora</span>
                                            </div>
                                            <h2 class="text-3xl font-black text-gray-900 leading-tight mb-2">Diablada Bellavista</h2>
                                            <p class="text-gray-500 text-sm">Tradicional diablada con más de 400 danzarines y 3 bandas de músicos. Conocidos por sus máscaras intrincadas.</p>
                                        </div>
                                        
                                        <div class="grid grid-cols-3 gap-2 mt-2">
                                            <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
                                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-1">Inicio Real</p>
                                                <p class="text-gray-900 font-mono font-bold">08:50</p>
                                            </div>
                                            <div class="bg-gray-50 rounded-xl p-3 border border-gray-100 border-l-2 border-l-candelaria-primary">
                                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-1">Retraso</p>
                                                <p class="text-candelaria-primary font-mono font-bold">+20m</p>
                                            </div>
                                            <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
                                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider mb-1">Fin Est.</p>
                                                <p class="text-gray-900 font-mono font-bold">09:35</p>
                                            </div>
                                        </div>

                                        <div class="flex gap-3 mt-2">
                                            <a href="../live-platform/index.php" class="flex-1 bg-gray-900 text-white hover:bg-gray-800 py-3 rounded-full font-bold text-sm transition-colors flex items-center justify-center gap-2 shadow-lg shadow-gray-900/20">
                                                <span class="material-symbols-outlined text-lg">play_circle</span>
                                                Ver Transmisión
                                            </a>
                                            <button class="size-11 flex items-center justify-center rounded-full border border-gray-200 text-gray-400 hover:text-candelaria-primary hover:border-candelaria-primary hover:bg-red-50 transition-colors" title="Compartir">
                                                <span class="material-symbols-outlined text-lg">share</span>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Visual Column -->
                                    <div class="md:col-span-5 relative h-48 md:h-auto rounded-xl overflow-hidden bg-gray-100 group/video cursor-pointer border border-gray-200">
                                        <img alt="Diablada" class="absolute inset-0 w-full h-full object-cover group-hover/video:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAerOl6EH8tGjccvYLHzd4uCFj3lQ9XCX3mg5C-FIzOD_zoMA6bJkUMs-zAqc4MpETwE9viTXg2UqGvyziBVELeRqtPl5KC3eT5Rg_1wCMppAmujAa9l8qJs9iaglBK4GbMRI2IJCauU-OSeYOgg1yU4JNspVW_k1wJMJJWyWVMdt4KvWmCCcSdvw1H_Ur44PkCmhygNeGM0BurSWDPzrx-6OrG2KMMJ63iXEDQeJu6Z9fpFHcw1GGHvSYqv3ikq-eUaVOMQjq4KXgM">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <div class="size-12 rounded-full bg-white/90 text-candelaria-primary flex items-center justify-center shadow-lg group-hover/video:scale-110 transition-transform">
                                                <span class="material-symbols-outlined text-2xl">play_arrow</span>
                                            </div>
                                        </div>
                                        <div class="absolute bottom-3 left-3">
                                            <p class="text-white text-xs font-bold shadow-black drop-shadow-md">En Vivo • Escenario Principal</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upcoming Item 1 -->
                        <div class="relative pl-16 md:pl-20 group">
                            <!-- Node -->
                            <div class="absolute left-[21px] md:left-[37px] top-6 size-3 bg-white border-2 border-gray-300 rounded-full"></div>
                            <!-- Connector (Dotted) -->
                            <div class="absolute left-6 md:left-10 top-9 bottom-[-40px] w-px border-l border-dashed border-gray-300"></div>
                            
                            <div class="flex flex-col gap-3 p-4 rounded-xl hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100 cursor-pointer">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="text-gray-900 font-mono font-bold text-lg">09:35 AM</span>
                                        <span class="px-2 py-0.5 rounded-full bg-gray-100 border border-gray-200 text-[10px] font-bold text-gray-700 uppercase tracking-wider">A Continuación</span>
                                    </div>
                                    <div class="flex items-center gap-1 text-orange-500 text-sm font-medium">
                                        <span class="material-symbols-outlined text-base">warning</span>
                                        <span>Est. +25m Tarde</span>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="size-12 rounded-full bg-gray-100 border border-gray-200 flex-shrink-0 overflow-hidden">
                                        <img alt="Morenada" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD62isiJ67ZgQT7JTAIxUL8Ely53D_ukcAcCn1qMbbky7AiTJGb1itVxMtj9kYyXDZafHtesTetDXqV0A-cp49dZcrtswdUVHrFqQMlf1EaVTOkYhUoJpw4gmXtC7eNCCtjlKfSWJybF3n187gHlwiqrEIhpUEA8ks48rq3B5CnhBAOKLtu3Tgtf__wYXmrOspwLoukyDrtPV15iW6aBRwAYs1aG3S2M7U8QMp63EiS7flcrjXE8IA-PdLQtTlTzqtTlMuqupHuRR-T">
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 text-xl font-bold">Morenada Laykakota</h3>
                                        <p class="text-gray-500 text-sm mt-1">Una de las fraternidades más antiguas. Se espera retraso por cambio de vestuario.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Upcoming Item 2 -->
                        <div class="relative pl-16 md:pl-20 group">
                            <!-- Node -->
                            <div class="absolute left-[21px] md:left-[37px] top-6 size-3 bg-gray-300 rounded-full"></div>
                            
                            <div class="flex flex-col gap-3 p-4 rounded-xl hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100 cursor-pointer opacity-70 hover:opacity-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="text-gray-500 font-mono font-medium text-lg">10:15 AM</span>
                                        <span class="px-2 py-0.5 rounded-full border border-gray-200 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Programado</span>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="size-12 rounded-full bg-gray-100 border border-gray-200 flex-shrink-0 flex items-center justify-center text-gray-400 font-black text-xs">
                                        FC
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 text-xl font-bold">Fraternidad Caporales San Carlos</h3>
                                        <p class="text-gray-500 text-sm mt-1">Inicio Est: 10:40 AM (+25m)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <!-- Upcoming Item 3 -->
                        <div class="relative pl-16 md:pl-20 group">
                            <!-- Node -->
                            <div class="absolute left-[21px] md:left-[37px] top-6 size-3 bg-gray-300 rounded-full"></div>
                            
                            <div class="flex flex-col gap-3 p-4 rounded-xl hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100 cursor-pointer opacity-70 hover:opacity-100">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="text-gray-500 font-mono font-medium text-lg">11:00 AM</span>
                                        <span class="px-2 py-0.5 rounded-full border border-gray-200 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Programado</span>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="size-12 rounded-full bg-gray-100 border border-gray-200 flex-shrink-0 flex items-center justify-center text-gray-400 font-black text-xs">
                                        TK
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 text-xl font-bold">Tinkus Kay Sur</h3>
                                        <p class="text-gray-500 text-sm mt-1">Inicio Est: 11:25 AM (+25m)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="flex justify-center py-8">
                            <button class="flex items-center gap-2 text-gray-400 hover:text-gray-900 transition-colors text-sm font-bold uppercase tracking-wide">
                                <span>Cargar los 35 restantes</span>
                                <span class="material-symbols-outlined">expand_more</span>
                            </button>
                        </div>
                    </div>
                </div>
            `;

            // Re-render icons just in case
            // lucide.createIcons(); // Not needed for Material Symbols but kept for other tabs
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

        // Renderizar danzas
        async function renderDanzas() {
            const container = document.getElementById('events-container');
            if (!container) return;

            // Show loading state first
            container.innerHTML = `
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <i data-lucide="users" class="w-5 h-5 mr-2 text-candelaria-purple"></i>
                            Lista Completa de Danzas
                        </h2>
                    </div>

                    <!-- Search bar for danzas -->
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
                        </div>
                    </form>

                    <div id="danzas-grid" class="danzas-grid">
                        <div class="animate-pulse flex flex-col space-y-4">
                            <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                            <div class="h-4 bg-gray-200 rounded"></div>
                            <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                        </div>
                    </div>

                    <div id="pagination-container" class="mt-8">
                        <div class="flex items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6">
                            <div class="text-sm text-gray-700" id="results-info">
                                Cargando resultados...
                            </div>
                            <div class="flex space-x-2" id="pagination">
                                <!-- Pagination controls will be loaded dynamically -->
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Actualizar los íconos de Lucide
            lucide.createIcons();

            // Now load the actual danzas data
            try {
                // Load page 1 of danzas data
                const response = await fetch('../api/danzas.php');

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = await response.json();
                const dances = Array.isArray(result) ? result : result.data || [];
                const pagination = result.pagination || null;

                // Update the danzas grid
                const danzasGrid = document.getElementById('danzas-grid');
                if (danzasGrid) {
                    if (dances.length === 0) {
                        danzasGrid.innerHTML = `<div class="col-span-full text-center py-8 text-gray-500">No se encontraron dansas en la base de datos</div>`;
                    } else {
                        // Store in global danzas array for modal access
                        danzas = dances;
                        console.log('[DEBUG] Danzas cargadas:', danzas.length);

                        danzasGrid.innerHTML = '';
                        dances.forEach(danza => {
                            let categoria = danza.categoria || 'N/A';
                            // Rename 'Luces Parada' to 'Traje de Luces'
                            if (categoria === 'Luces Parada') categoria = 'Traje de Luces';

                            const descripcionValue = danza.descripcion || 'Descripción no disponible';

                            let categoryClass = 'traditional';
                            if (categoria && categoria.includes('LUCE')) categoryClass = 'lights';  // Covers 'TRAJE DE LUCES', 'LUCE', etc.
                            else if (categoria && categoria.includes('ORIGIN')) categoryClass = 'originary';  // Covers 'ORIGINARIAS', 'ORIGINARIO', etc.
                            else if (categoria && categoria.includes('TRADICION')) categoryClass = 'traditional';  // Covers 'TRADICIONAL', 'TRADICION', etc.
                            else if (categoria && (categoria === 'PARADA' || categoria === 'CIERRE / FIESTA' || categoria === 'RELIGIOSO')) categoryClass = 'traditional';  // Default category for other types

                            const cardClass = categoryClass === 'traditional' ? 'bg-red-50 border-red-200' :
                                categoryClass === 'lights' ? 'bg-yellow-50 border-yellow-200' :
                                    'bg-green-50 border-green-200';

                            const card = document.createElement('div');
                            card.className = 'event-card';
                            card.innerHTML = `
                                <div class="event-image-container">
                                    <img class="event-image" src="${fixPhotoPath(danza.foto)}"
                                         alt="${danza.conjunto}"
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
                    }
                }

                // Update pagination
                if (pagination) {
                    const resultsInfo = document.getElementById('results-info');
                    const paginationContainer = document.getElementById('pagination');

                    if (resultsInfo) {
                        const start = (pagination.page - 1) * pagination.pageSize + 1;
                        const end = Math.min(pagination.page * pagination.pageSize, pagination.total);
                        resultsInfo.textContent = `Mostrando ${start} a ${end} de ${pagination.total} resultados`;
                    }

                    if (paginationContainer) {
                        let paginationHtml = '';

                        if (pagination.hasPrev) {
                            paginationHtml += `<button class="prev px-4 py-2 bg-candelaria-purple text-white rounded-lg hover:bg-purple-600" onclick="changeDanzaPage(${pagination.page - 1})">← Anterior</button>`;
                        } else {
                            paginationHtml += `<button class="prev px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed" disabled>← Anterior</button>`;
                        }

                        // Calculate the range of pages to show
                        const maxVisiblePages = 5;
                        let startPage = Math.max(1, pagination.page - Math.floor(maxVisiblePages / 2));
                        let endPage = Math.min(pagination.totalPages, startPage + maxVisiblePages - 1);

                        // Adjust startPage if we're near the end
                        if (endPage - startPage + 1 < maxVisiblePages) {
                            startPage = Math.max(1, endPage - maxVisiblePages + 1);
                        }

                        // Add first page if not already included and we have more than the max visible pages
                        if (startPage > 1) {
                            paginationHtml += `<button class="px-3 py-2 rounded-lg ${startPage === pagination.page ? 'bg-candelaria-purple text-white' : 'bg-gray-100 hover:bg-gray-200'}" onclick="changeDanzaPage(1)">1</button>`;
                            if (startPage > 2) {
                                paginationHtml += '<span class="px-2">...</span>';
                            }
                        }

                        // Add the page numbers in the range
                        for (let i = startPage; i <= endPage; i++) {
                            if (i === pagination.page) {
                                paginationHtml += `<button class="px-3 py-2 bg-candelaria-purple text-white rounded-lg">${i}</button>`;
                            } else {
                                paginationHtml += `<button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg" onclick="changeDanzaPage(${i})">${i}</button>`;
                            }
                        }

                        // Add last page if not already included and we have more pages
                        if (endPage < pagination.totalPages) {
                            if (endPage < pagination.totalPages - 1) {
                                paginationHtml += '<span class="px-2">...</span>';
                            }
                            paginationHtml += `<button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg" onclick="changeDanzaPage(${pagination.totalPages})">${pagination.totalPages}</button>`;
                        }

                        if (pagination.hasNext) {
                            paginationHtml += `<button class="next px-4 py-2 bg-candelaria-purple text-white rounded-lg hover:bg-purple-600" onclick="changeDanzaPage(${pagination.page + 1})">Siguiente →</button>`;
                        } else {
                            paginationHtml += `<button class="next px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed" disabled>Siguiente →</button>`;
                        }

                        paginationContainer.innerHTML = paginationHtml;
                    }
                } else {
                    const resultsInfo = document.getElementById('results-info');
                    if (resultsInfo) {
                        resultsInfo.textContent = `Mostrando ${dances.length} resultados`;
                    }
                }

            } catch (error) {
                console.error('Error loading danzas:', error);
                const danzasGrid = document.getElementById('danzas-grid');
                if (danzasGrid) {
                    danzasGrid.innerHTML = `<div class="col-span-full text-center py-8 text-red-500">Error al cargar las dansas: ${error.message}</div>`;
                }
            }

            // Set up event listener for search form
            const searchForm = document.getElementById('danzas-search-form');
            if (searchForm) {
                searchForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const query = document.getElementById('danzas-search-input').value;
                    searchDanzas(query, 1);
                });
            }

            // Instant search with debounce
            const searchInput = document.getElementById('danzas-search-input');
            if (searchInput) {
                searchInput.addEventListener('input', debounce(function (e) {
                    const query = e.target.value;
                    searchDanzas(query, 1);
                }, 300));
            }
        }

        // ========== Debounce Function ==========
        function debounce(func, wait) {
            let timeout;
            return function (...args) {
                const context = this;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        // Function to search danzas
        async function searchDanzas(query, page = 1) {
            console.log('[DEBUG] searchDanzas called', { query, page });
            const danzasGrid = document.getElementById('danzas-grid');
            if (!danzasGrid) {
                console.error('[DEBUG] danzas-grid element not found');
                return;
            }

            // Show loading state
            danzasGrid.innerHTML = '<div class="col-span-full animate-pulse flex flex-col space-y-4"><div class="h-4 bg-gray-200 rounded w-3/4"></div><div class="h-4 bg-gray-200 rounded"></div><div class="h-4 bg-gray-200 rounded w-5/6"></div></div>';

            try {
                // Construct URL with proper pagination parameters
                const pageSize = 12; // Set consistent page size
                let url = `../api/danzas.php?page=${page}&pageSize=${pageSize}`;

                if (query && query.trim() !== '') {
                    url += `&q=${encodeURIComponent(query)}`;
                }

                console.log('[DEBUG] Fetching URL:', url);

                const response = await fetch(url);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

                const result = await response.json();
                console.log('[DEBUG] API Response:', result);

                const dances = Array.isArray(result) ? result : result.data || [];
                const pagination = result.pagination || null;

                // Update the danzas grid
                if (dances.length === 0) {
                    danzasGrid.innerHTML = `<div class="col-span-full text-center py-8 text-gray-500">No se encontraron danzas${query ? ` que coincidan con "${query}"` : ''}</div>`;
                } else {
                    // Store in global danzas array for modal access
                    danzas = dances;
                    console.log('[DEBUG] Danzas updated in global state:', danzas.length);

                    danzasGrid.innerHTML = '';
                    dances.forEach(danza => {
                        const card = document.createElement('div');
                        card.className = 'event-card';
                        card.innerHTML = `<div class="event-image-container"><img class="event-image" src="${fixPhotoPath(danza.foto)}" alt="${danza.conjunto}" onerror="this.onerror=null; this.src='https://placehold.co/400x300?text=Imagen+no+disponible';"></div><div class="event-content"><div class="event-genre">${danza.categoria || 'N/A'}</div><h3 class="event-title">${danza.conjunto}</h3><button class="event-btn" onclick="openDanceModal(${danza.id})">Ver Detalles</button></div>`;
                        danzasGrid.appendChild(card);
                    });
                }

                // Update pagination
                if (pagination) {
                    const resultsInfo = document.getElementById('results-info');
                    const paginationContainer = document.getElementById('pagination');

                    if (resultsInfo) {
                        const start = (pagination.page - 1) * pagination.pageSize + 1;
                        const end = Math.min(pagination.page * pagination.pageSize, pagination.total);
                        resultsInfo.textContent = `Mostrando ${start} a ${end} de ${pagination.total} resultados`;
                    }

                    if (paginationContainer) {
                        let html = pagination.hasPrev ? `<button class="prev px-4 py-2 bg-candelaria-purple text-white rounded-lg hover:bg-purple-600" onclick="changeDanzaPage(${pagination.page - 1})">← Anterior</button>` : '<button class="prev px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed" disabled>← Anterior</button>';

                        const maxPages = 5;
                        let startPage = Math.max(1, pagination.page - Math.floor(maxPages / 2));
                        let endPage = Math.min(pagination.totalPages, startPage + maxPages - 1);

                        if (endPage - startPage + 1 < maxPages) startPage = Math.max(1, endPage - maxPages + 1);

                        if (startPage > 1) {
                            html += `<button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg" onclick="changeDanzaPage(1)">1</button>`;
                            if (startPage > 2) html += '<span class="px-2">...</span>';
                        }

                        for (let i = startPage; i <= endPage; i++) {
                            html += i === pagination.page ? `<button class="px-3 py-2 bg-candelaria-purple text-white rounded-lg">${i}</button>` : `<button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg" onclick="changeDanzaPage(${i})">${i}</button>`;
                        }

                        if (endPage < pagination.totalPages) {
                            if (endPage < pagination.totalPages - 1) html += '<span class="px-2">...</span>';
                            html += `<button class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg" onclick="changeDanzaPage(${pagination.totalPages})">${pagination.totalPages}</button>`;
                        }

                        html += pagination.hasNext ? `<button class="next px-4 py-2 bg-candelaria-purple text-white rounded-lg hover:bg-purple-600" onclick="changeDanzaPage(${pagination.page + 1})">Siguiente →</button>` : '<button class="next px-4 py-2 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed" disabled>Siguiente →</button>';

                        paginationContainer.innerHTML = html;
                    }
                } else {
                    const resultsInfo = document.getElementById('results-info');
                    if (resultsInfo) resultsInfo.textContent = `Mostrando ${dances.length} resultados`;
                }

                lucide.createIcons();

            } catch (error) {
                console.error('[DEBUG] Error searching danzas:', error);
                danzasGrid.innerHTML = `<div class="col-span-full text-center py-8 text-red-500">Error al buscar danzas: ${error.message}</div>`;
            }
        }

        // Function to change danza page
        async function changeDanzaPage(page) {
            const searchInput = document.getElementById('danzas-search-input');
            const query = searchInput ? searchInput.value : '';
            searchDanzas(query, page);
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
                ` : ''}

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
                    <button class="btn-modal-action btn-modal-share">Compartir</button>
                    <button class="btn-modal-action btn-modal-recordarme">Recordarme</button>
                </div>
            `;

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            modal.classList.add('active');
        }
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
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
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