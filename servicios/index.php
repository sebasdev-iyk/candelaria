<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candelaria 2025 | Servicios Oficiales</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Leaflet CSS (Mapa) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap"
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
                            light: '#f5f3ff'   // Fondos suaves
                        }
                    },
                    fontFamily: {
                        sans: ['Open Sans', 'sans-serif'],
                        heading: ['Montserrat', 'sans-serif'],
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

        /* Estilos del Mapa */
        .custom-popup .leaflet-popup-content-wrapper {
            border-radius: 0.75rem;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .custom-popup .leaflet-popup-content {
            margin: 0;
            width: 260px !important;
        }
    </style>
    <!-- Spark Effect CSS -->
    <link rel="stylesheet" href="../assets/css/sparks.css">
</head>

<body class="bg-gray-50 text-gray-800">
    <?php include '../includes/auth-header.php'; ?>

    <!-- Notificaciones Toast Container -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2"></div>

    <!-- Modal de Detalles (Oculto por defecto) -->
    <div id="detail-modal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" onclick="closeModal()">
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl fade-in">
                    <!-- Contenido dinámico del modal se inyecta aquí -->
                    <div id="modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Section - Standardized with EN VIVO Style -->
    <!-- Header Section - Standardized with EN TIEMPO REAL Style -->
    <?php
    $headerDepth = 1;
    $activePage = 'servicios';
    include '../includes/standard-header.php';
    ?>

    <!-- Search & Filters Bar -->
    <div class="bg-white border-b border-gray-200 shadow-sm sticky top-[100px] z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <!-- Inputs Principales -->
            <div class="flex flex-col md:flex-row gap-3">

                <!-- Buscador -->
                <div class="relative flex-grow group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="search"
                            class="w-5 h-5 text-gray-400 group-focus-within:text-candelaria-purple transition-colors"></i>
                    </div>
                    <input type="text" id="search-input"
                        class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg leading-5 bg-gray-50 placeholder-gray-500 text-gray-900 focus:outline-none focus:bg-white focus:ring-2 focus:ring-candelaria-purple focus:border-candelaria-purple sm:text-sm transition-all shadow-sm"
                        placeholder="Buscar hoteles, restaurantes...">
                </div>

                <!-- Fechas & Huéspedes (Only for Hospedajes) -->
                <div id="hospedaje-specific-filters"
                    class="flex flex-col md:flex-row gap-3 w-full md:w-auto transition-all duration-300">
                    <div class="flex gap-2 md:w-auto w-full">
                        <div class="relative flex-1 md:w-40">
                            <input type="date" id="date-start" value="2025-02-02"
                                class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-candelaria-purple shadow-sm text-sm font-medium">
                        </div>
                        <div class="relative flex-1 md:w-40">
                            <input type="date" id="date-end" value="2025-02-11"
                                class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-candelaria-purple shadow-sm text-sm font-medium">
                        </div>
                    </div>

                    <!-- Huéspedes -->
                    <div class="relative md:w-40 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="users" class="w-4 h-4 text-gray-500"></i>
                        </div>
                        <select id="guest-count"
                            class="block w-full pl-10 pr-8 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-candelaria-purple shadow-sm text-sm appearance-none cursor-pointer hover:bg-gray-50">
                            <option value="1">1 Persona</option>
                            <option value="2" selected>2 Personas</option>
                            <option value="3">3 Personas</option>
                            <option value="4+">4+ Grupo</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros Chips -->
            <div class="flex flex-wrap gap-2 mt-4" id="filter-container">
                <!-- Se llenan vía JS -->
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <!-- Navigation Tabs -->
        <nav class="flex space-x-1 border-b border-gray-200 mb-6 overflow-x-auto pb-1 scrollbar-hide" aria-label="Tabs">
            <button onclick="setActiveTab('hospedajes')" id="tab-hospedajes"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2">
                <i data-lucide="bed-double" class="w-4 h-4"></i> Hospedajes
            </button>
            <button onclick="setActiveTab('restaurantes')" id="tab-restaurantes"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2">
                <i data-lucide="utensils" class="w-4 h-4"></i> Gastronomía
            </button>
            <button onclick="setActiveTab('transporte')" id="tab-transporte"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2">
                <i data-lucide="car" class="w-4 h-4"></i> Transporte
            </button>
            <button onclick="setActiveTab('info')" id="tab-info"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2">
                <i data-lucide="info" class="w-4 h-4"></i> Turismo
            </button>
            <a href="../tienda/index.php" id="tab-tienda"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 border-transparent text-gray-500 font-medium text-sm flex items-center gap-2 hover:text-candelaria-purple hover:border-gray-300 transition-colors">
                <i data-lucide="shopping-bag" class="w-4 h-4"></i> Tienda
            </a>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- Left Column: List of Cards -->
            <div class="lg:col-span-2">
                <div class="flex justify-between items-end mb-4">
                    <h2 class="text-lg font-bold text-gray-800" id="results-count">Mostrando resultados</h2>
                    <span class="text-xs text-gray-500">Precios actualizados para Feb 2025</span>
                </div>

                <!-- Container de Tarjetas -->
                <div id="cards-container" class="space-y-6 min-h-[500px]">
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
                        Cargar más resultados
                    </button>
                </div>
            </div>

            <!-- Right Column: Interactive Map -->
            <div class="lg:col-span-1 hidden lg:block">
                <div
                    class="sticky top-40 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden h-[650px] flex flex-col">
                    <div class="p-4 bg-white border-b border-gray-100 z-10 flex justify-between items-center shadow-sm">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <i data-lucide="map-pin" class="w-5 h-5 mr-2 text-candelaria-purple"></i>
                            Mapa Interactivo
                        </h3>
                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full font-medium">En
                            vivo</span>
                    </div>
                    <!-- Contenedor Leaflet -->
                    <div id="map-container" class="flex-1 w-full h-full z-0 bg-gray-100 relative"></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->


    <!-- Scripts: Libraries first (already in head), then Logic -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // ==========================================
        // 1. BASE DE DATOS (DATA)
        // ==========================================
        // Coordenadas base Puno: -15.8402, -70.0219

        // ==========================================
        // 1. BASE DE DATOS (DATA) - Initial Empty State
        // ==========================================
        const DB = {
            hospedajes: [],
            restaurantes: [],
            transporte: [],
            info: []
        };

        // --------------------------------------------------------
        // DEBUGGING: Visual & Console Logging for Images
        // --------------------------------------------------------
        window.handleImageError = function (img, context, id) {
            console.error(`[IMG FAIL] ${context} (Item #${id}):`, img.src);
            img.style.border = '4px solid red';
            img.style.opacity = '0.7';
            if (img.parentNode) {
                const debugTag = document.createElement('div');
                debugTag.innerText = `ERR #${id}`;
                debugTag.className = 'absolute top-0 left-0 bg-red-600 text-white text-xs px-1 z-50 font-bold shadow-md';
                img.parentNode.appendChild(debugTag);
            }
        };

        // Function to map DB attributes to Frontend model
        function mapItem(item, type) {
            let image = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiB2aWV3Qm94PSIwIDAgNDAwIDMwMCI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSIjZWRlZGVkIiAvPgo8dGV4dCB4PSI1MCUiIHk9IjUwJSIgZG9taW5hbnQtYmFzZWxpbmU9Im1pZGRsZSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZm9udC1mYW1pbHk9ImFyaWFsIiBmb250LXNpemU9IjIwIiBmaWxsPSIjOTk5OTk5Ij5SinZDbwogSW1hZ2U8L3RleHQ+Cjwvc3ZnPg==';;
            if (item.imagenes) {
                if (Array.isArray(item.imagenes) && item.imagenes.length > 0) image = item.imagenes[0];
                else if (typeof item.imagenes === 'string' && item.imagenes.startsWith('[')) {
                    try { const imgs = JSON.parse(item.imagenes); if (imgs.length > 0) image = imgs[0]; } catch (e) { }
                }
            }
            if (item.imagen) image = item.imagen; // Fallback for comida

            // DEBUG: Log original image URL from API
            const rawImage = image;
            console.log(`[DEBUG ${type}] Raw image from API:`, rawImage);

            // Fix image paths - handle multiple scenarios
            // DEEP DEBUGGING: Log logic path
            if (image && !image.startsWith('http') && !image.startsWith('data:')) {
                const original = image;
                if (image.startsWith('/')) {
                    // Logic: Absolute path (e.g. /candelaria/assets/...)
                    console.log(`[DEBUG ${type}] Absolute path detected:`, image);
                    // Check if it looks like a valid asset path
                    if (!image.includes('/assets/')) {
                        console.warn(`[DEBUG ${type}] Suspicious absolute path (no assets folder?):`, image);
                    }
                } else if (image.startsWith('assets/')) {
                    image = '/candelaria/' + image;
                    console.log(`[DEBUG ${type}] Relative assets path fixed: ${original} -> ${image}`);
                } else {
                    image = '/candelaria/assets/uploads/' + image;
                    console.log(`[DEBUG ${type}] Filename only fixed: ${original} -> ${image}`);
                }
            } else {
                if (!image) console.log(`[DEBUG ${type}] No image found for item ${item.id} (${item.nombre})`);
                else {
                    // Check for Broken Google Photos Proxy Links
                    if (image.includes('gps-proxy')) {
                        console.warn(`[DEBUG ${type}] POTENTIAL BROKEN PROXY LINK DETECTED:`, image);
                        // Attempt to sanitize or flag
                        // Google Proxy links often fail due to Referrer 403.
                        // We will try to add referrerpolicy="no-referrer" to the IMG tag in the HTML generation,
                        // but here we can't change the tag attributes easily for just this item without changing the template.
                        // However, we can try to rewrite the URL if it's a known pattern, but gps-proxy is complex.
                    }
                    console.log(`[DEBUG ${type}] External or Base64 image:`, image.substring(0, 50) + '...');
                }
            }

            let features = [];
            if (item.servicios) {
                if (Array.isArray(item.servicios)) features = item.servicios;
                else if (typeof item.servicios === 'string') {
                    // Try JSON then comma
                    if (item.servicios.startsWith('[')) {
                        try { features = JSON.parse(item.servicios); } catch (e) { }
                    }
                    if (features.length === 0) features = item.servicios.split(',').map(s => s.trim());
                }
            }

            // Extract ALL images for carousel
            let images = [];
            if (item.imagenes) {
                if (Array.isArray(item.imagenes)) {
                    images = item.imagenes;
                } else if (typeof item.imagenes === 'string' && item.imagenes.startsWith('[')) {
                    try { images = JSON.parse(item.imagenes); } catch (e) { }
                }
            }
            // Fallback: use single imagen if no imagenes array
            if (images.length === 0 && item.imagen) {
                images = [item.imagen];
            }
            // Fallback: use the processed image
            if (images.length === 0 && image) {
                images = [image];
            }

            // Fix paths for all images
            images = images.map(img => {
                if (!img) return null;
                if (img.startsWith('http') || img.startsWith('data:') || img.startsWith('/')) return img;
                if (img.startsWith('assets/')) return '/candelaria/' + img;
                return '/candelaria/assets/uploads/' + img;
            }).filter(img => img !== null);

            return {
                id: item.id,
                name: item.nombre,
                image: image,
                images: images, // Array of all images for carousel
                rating: item.calificacion ? parseFloat(item.calificacion) : 0,
                reviews: item.total_reviews ? parseInt(item.total_reviews) : 0,
                price: parseFloat(item.precio_noche || item.precio_promedio || item.precio || 0),
                location: item.ubicacion || item.lugar || 'Puno, Perú',
                description: item.descripcion || 'Sin descripción disponible',
                features: features,
                lat: parseFloat(item.latitud || -15.8402),
                lng: parseFloat(item.longitud || -70.0219)
            };
        }

        async function fetchServices() {
            try {
                // Fetch all data in parallel
                const [hospedajesRes, restaurantesRes, transporteRes, infoRes] = await Promise.all([
                    fetch('../api/hospedaje.php'),
                    fetch('../api/comida.php'),
                    fetch('../api/transporte.php'),
                    fetch('../api/turismo.php')
                ]);

                if (hospedajesRes.ok) {
                    const data = await hospedajesRes.json();
                    DB.hospedajes = data.map(i => mapItem(i, 'hospedajes'));
                }
                if (restaurantesRes.ok) {
                    const data = await restaurantesRes.json();
                    DB.restaurantes = data.map(i => mapItem(i, 'restaurantes'));
                }
                if (transporteRes.ok) {
                    const data = await transporteRes.json();
                    DB.transporte = data.map(i => mapItem(i, 'transporte'));
                }
                if (infoRes.ok) {
                    const data = await infoRes.json();
                    DB.info = data.map(i => mapItem(i, 'info'));
                }

                // Initial Render
                renderCards();
                renderFilters();
            } catch (error) {
                console.error('Error fetching services:', error);
                document.getElementById('cards-container').innerHTML = `<div class="p-4 text-center text-red-500">Error cargando datos. Por favor intente más tarde.</div>`;
            }
        }

        // Initialize fetching on load
        document.addEventListener('DOMContentLoaded', fetchServices);


        // ==========================================
        // 2. ESTADO DE LA APLICACIÓN (STATE)
        // ==========================================
        let state = {
            activeTab: 'hospedajes',
            search: '',
            filters: {
                bestRated: false,
                budget: false
            },
            mapInstance: null,
            markers: []
        };

        // ==========================================
        // 3. MAPA (LEAFLET)
        // ==========================================
        function initMap() {
            // Puno center
            // Verificar si el mapa ya está inicializado para evitar el error
            if (state.mapInstance) {
                return state.mapInstance;
            }

            state.mapInstance = L.map('map-container').setView([-15.8402, -70.0219], 14);

            // Tiles de CartoDB (Limpio y profesional)
            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
                maxZoom: 19
            }).addTo(state.mapInstance);

            return state.mapInstance;
        }

        function updateMap(data) {
            if (!state.mapInstance) {
                // Si no hay instancia de mapa, intentar inicializarla
                if (typeof initMap === 'function') {
                    initMap(); // Esta función verifica si ya está inicializado
                }

                if (!state.mapInstance) return; // Si aún no hay instancia, salir
            }

            // Limpiar marcadores viejos
            state.markers.forEach(m => {
                if (state.mapInstance.hasLayer(m)) {
                    state.mapInstance.removeLayer(m);
                }
            });
            state.markers = [];

            // Icono personalizado
            const createIcon = (color) => {
                return L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div style="background-color: ${color}; width: 12px; height: 12px; border-radius: 50%; border: 2px solid white; box-shadow: 0 0 4px rgba(0,0,0,0.3);"></div>`,
                    iconSize: [12, 12],
                    iconAnchor: [6, 6]
                });
            };

            const bounds = L.latLngBounds();

            data.forEach(item => {
                if (item.lat && item.lng) {
                    const marker = L.marker([item.lat, item.lng], {
                        icon: createIcon('#4c1d95') // Color púrpura candelaria
                    }).addTo(state.mapInstance);

                    // Popup Profesional
                    const popupContent = `
                        <div class="custom-popup bg-white">
                            <div class="h-24 w-full bg-gray-200 relative">
                                <img src="${item.image}" referrerpolicy="no-referrer" onerror="handleImageError(this, 'Popup', '${item.id}')" class="w-full h-full object-cover">
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-2">
                                    <h4 class="text-white font-bold text-sm truncate">${item.name}</h4>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center text-yellow-500 text-xs font-bold">
                                        ★ ${item.rating}
                                    </div>
                                    <div class="text-xs font-bold text-candelaria-purple">
                                        ${item.price ? '$' + item.price : (item.priceRange || 'Gratis')}
                                    </div>
                                </div>
                                <button onclick="openModal(${item.id}, '${state.activeTab}')" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs py-1.5 rounded transition-colors font-medium">
                                    Ver Detalles
                                </button>
                            </div>
                        </div>
                    `;

                    marker.bindPopup(popupContent);
                    state.markers.push(marker);
                    bounds.extend([item.lat, item.lng]);
                }
            });

            // Ajustar zoom para ver todos los puntos si hay data
            if (data.length > 0) {
                state.mapInstance.fitBounds(bounds, { padding: [50, 50], maxZoom: 16 });
            }
        }

        // ==========================================
        // 4. LÓGICA DE RENDERIZADO
        // ==========================================

        // Filtra los datos según el estado actual
        function getFilteredData() {
            let data = DB[state.activeTab] || [];

            // Buscador
            if (state.search) {
                const term = state.search.toLowerCase();
                data = data.filter(item =>
                    item.name.toLowerCase().includes(term) ||
                    item.location.toLowerCase().includes(term) ||
                    item.features.some(f => f.toLowerCase().includes(term))
                );
            }

            // Filtros
            if (state.filters.bestRated) {
                data = data.filter(item => item.rating >= 4.5);
            }
            if (state.filters.budget) {
                data = data.filter(item => {
                    if (item.price) return item.price < 50;
                    if (item.priceRange) return item.priceRange === '$';
                    return true;
                });
            }

            return data;
        }

        function createStars(rating) {
            const full = Math.floor(rating);
            const hasHalf = rating % 1 !== 0;
            let html = '<div class="flex text-yellow-400 text-xs">';
            for (let i = 0; i < full; i++) html += '<i data-lucide="star" class="w-3 h-3 fill-current"></i>';
            if (hasHalf) html += '<i data-lucide="star-half" class="w-3 h-3 fill-current"></i>';
            html += '</div>';
            return html;
        }

        function renderCards() {
            const container = document.getElementById('cards-container');
            const data = getFilteredData();

            // Actualizar contador
            document.getElementById('results-count').innerText = `${data.length} Resultados encontrados`;

            if (data.length === 0) {
                container.innerHTML = `
                    <div class="flex flex-col items-center justify-center py-12 text-center bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="bg-gray-100 p-4 rounded-full mb-4">
                            <i data-lucide="search-x" class="w-8 h-8 text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-700">No se encontraron resultados</h3>
                        <p class="text-gray-500 text-sm mt-1 mb-4">Intenta ajustar tus filtros o búsqueda.</p>
                        <button onclick="resetFilters()" class="text-candelaria-purple font-medium hover:underline text-sm">Limpiar búsqueda</button>
                    </div>
                `;
                updateMap([]);
                document.getElementById('load-more-btn').classList.add('hidden');
                return;
            }

            container.innerHTML = data.map(item => `
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col sm:flex-row overflow-hidden group">
                    <!-- Imagen -->
                    <div class="sm:w-48 h-48 sm:h-auto relative shrink-0 overflow-hidden cursor-pointer" onclick="openModal(${item.id}, '${state.activeTab}')">
                        <img src="${item.image}" referrerpolicy="no-referrer" onerror="handleImageError(this, 'Card', '${item.id}')" alt="${item.name}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-xs font-bold flex items-center shadow-sm">
                            <i data-lucide="star" class="w-3 h-3 text-yellow-500 mr-1 fill-yellow-500"></i>
                            ${item.rating}
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="p-5 flex flex-col justify-between flex-1">
                        <div>
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="font-bold text-lg text-gray-800 hover:text-candelaria-purple cursor-pointer transition-colors" onclick="openModal(${item.id}, '${state.activeTab}')">${item.name}</h3>
                                <div class="text-right ml-2">
                                    ${item.price
                    ? `<span class="text-lg font-bold text-candelaria-purple">$${item.price}</span>`
                    : `<span class="text-lg font-bold text-green-600">${item.priceRange || 'Gratis'}</span>`
                }
                                </div>
                            </div>

                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i data-lucide="map-pin" class="w-3 h-3 mr-1 text-gray-400"></i>
                                ${item.location}
                            </div>

                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">${item.description}</p>

                            <div class="flex flex-wrap gap-2">
                                ${item.features.slice(0, 3).map(f => `
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-50 text-purple-700 border border-purple-100">
                                        ${f}
                                    </span>
                                `).join('')}
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs text-gray-500 font-medium">${item.reviews} reseñas verificadas</span>
                            <div class="flex gap-2">
                                <button onclick="showToast('Agregado a favoritos')" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-colors">
                                    <i data-lucide="heart" class="w-5 h-5"></i>
                                </button>
                                <button onclick="openModal(${item.id}, '${state.activeTab}')" class="bg-gray-900 text-white text-sm px-4 py-2 rounded-lg font-medium hover:bg-gray-800 transition-all flex items-center shadow-sm hover:shadow">
                                    Ver Detalles
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');

            document.getElementById('load-more-btn').classList.remove('hidden');

            // Refrescar iconos
            lucide.createIcons();

            // Actualizar Mapa
            updateMap(data);
        }

        function renderFilters() {
            const container = document.getElementById('filter-container');

            // Only show these filters if activeTab is 'hospedajes'
            if (state.activeTab !== 'hospedajes') {
                container.innerHTML = '';
                return;
            }

            const filters = [
                { key: 'bestRated', label: 'Mejor Calificados', icon: 'star' },
                { key: 'budget', label: 'Económicos', icon: 'wallet' }
            ];

            container.innerHTML = filters.map(f => `
                <button onclick="toggleFilter('${f.key}')"
                    class="flex items-center px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 border ${state.filters[f.key]
                    ? 'bg-candelaria-purple text-white border-candelaria-purple shadow-md ring-2 ring-purple-200 ring-offset-1'
                    : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:border-gray-300'
                }">
                    <i data-lucide="${f.icon}" class="w-4 h-4 mr-2 ${state.filters[f.key] ? 'text-yellow-400 fill-current' : 'text-gray-400'}"></i>
                    ${f.label}
                </button>
            `).join('') + `
                <button class="flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 transition-colors">
                    <i data-lucide="sliders-horizontal" class="w-4 h-4 mr-2 text-gray-400"></i>
                    Más filtros
                </button>
            `;
            lucide.createIcons();
        }

        // 5. MODAL SYSTEM
        // ==========================================

        function openModal(id, category) {
            // For hospedajes, redirect to hotel detail page
            if (category === 'hospedajes') {
                window.location.href = 'Hospedajes/hotel.php?id=' + id;
                return;
            }

            const item = DB[category].find(i => i.id === id);
            if (!item) return;

            const modal = document.getElementById('detail-modal');
            const content = document.getElementById('modal-content');
            
            // Carousel state
            const images = item.images && item.images.length > 0 ? item.images : [item.image];
            const hasMultipleImages = images.length > 1;
            
            // Generate carousel HTML
            const carouselHTML = `
                <!-- Carousel Container -->
                <div class="relative h-64 w-full overflow-hidden" id="modal-carousel">
                    <!-- Images -->
                    <div class="carousel-images relative h-full w-full">
                        ${images.map((img, idx) => `
                            <img src="${img}" 
                                 referrerpolicy="no-referrer" 
                                 onerror="handleImageError(this, 'Modal', '${item.id}')"
                                 class="carousel-slide absolute inset-0 w-full h-full object-cover transition-opacity duration-300 ${idx === 0 ? 'opacity-100' : 'opacity-0'}"
                                 data-index="${idx}">
                        `).join('')}
                    </div>
                    
                    <!-- Navigation Arrows (only show if multiple images) -->
                    ${hasMultipleImages ? `
                        <button onclick="carouselPrev()" 
                            class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full shadow-lg transition-all z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m15 18-6-6 6-6"/>
                            </svg>
                        </button>
                        <button onclick="carouselNext()" 
                            class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full shadow-lg transition-all z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </button>
                        
                        <!-- Dot Indicators -->
                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5 z-10">
                            ${images.map((_, idx) => `
                                <button onclick="carouselGoTo(${idx})" 
                                    class="carousel-dot w-2 h-2 rounded-full transition-all ${idx === 0 ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/80'}"></button>
                            `).join('')}
                        </div>
                        
                        <!-- Counter -->
                        <div class="absolute top-3 left-3 bg-black/60 text-white text-xs px-2 py-1 rounded-full font-medium z-10">
                            <span id="carousel-current">1</span> / ${images.length}
                        </div>
                    ` : ''}
                    
                    <!-- Close Button -->
                    <button onclick="closeModal()" class="absolute top-4 right-4 bg-white/50 hover:bg-white text-gray-800 rounded-full p-2 backdrop-blur-md transition-all z-20">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                    
                    <!-- Badge -->
                    <div class="absolute bottom-4 left-4 z-10">
                        <span class="px-3 py-1 bg-candelaria-purple text-white text-xs font-bold rounded-full uppercase tracking-wider shadow-lg">Recomendado</span>
                    </div>
                </div>
            `;
            
            // Body content
            const bodyHTML = `
                <!-- Body -->
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 font-heading">${item.name}</h2>
                            <div class="flex items-center gap-2 mt-1">
                                ${createStars(item.rating)}
                                <span class="text-sm text-gray-500">(${item.reviews} reseñas)</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-candelaria-purple">${item.price ? '$' + item.price : (item.priceRange || 'Gratis')}</div>
                            ${item.price ? '<div class="text-xs text-gray-500">por noche</div>' : ''}
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                            <span class="text-xs text-gray-500 block">Ubicación</span>
                            <div class="flex items-start mt-1">
                                <i data-lucide="map-pin" class="w-4 h-4 text-candelaria-purple mr-1 mt-0.5 shrink-0"></i>
                                <span class="text-sm font-medium text-gray-800">${item.location}</span>
                            </div>
                        </div>
                         <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                            <span class="text-xs text-gray-500 block">Estado</span>
                            <div class="flex items-center mt-1">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                <span class="text-sm font-medium text-green-700">Disponible ahora</span>
                            </div>
                        </div>
                    </div>

                    <h3 class="font-bold text-gray-900 mb-2">Acerca de este lugar</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">${item.description} Perfecto para disfrutar la Festividad de la Virgen de la Candelaria con total comodidad y seguridad.</p>

                    <h3 class="font-bold text-gray-900 mb-3">Servicios incluidos</h3>
                    <div class="grid grid-cols-2 gap-y-2 mb-8">
                        ${item.features.map(f => `
                            <div class="flex items-center text-sm text-gray-600">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-green-500 mr-2"></i> ${f}
                            </div>
                        `).join('')}
                    </div>

                    <div class="flex gap-3 border-t border-gray-100 pt-6">
                        <button onclick="closeModal()" class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                            Cancelar
                        </button>
                        <button onclick="showToast('Solicitud enviada con éxito'); closeModal();" class="flex-1 px-4 py-3 bg-gradient-to-r from-purple-700 to-purple-900 text-white font-bold rounded-xl hover:from-purple-800 hover:to-purple-950 transition-all shadow-lg shadow-purple-200">
                            Reservar Ahora
                        </button>
                    </div>
                </div>
            `;
            
            // Combine and set content
            content.innerHTML = carouselHTML + bodyHTML;
            
            // Store carousel state for navigation
            window.carouselState = { images: images, currentIndex: 0 };

            lucide.createIcons();
            modal.classList.remove('hidden');
        }
        
        // Carousel navigation functions
        function carouselPrev() {
            if (!window.carouselState) return;
            const { images } = window.carouselState;
            window.carouselState.currentIndex = (window.carouselState.currentIndex - 1 + images.length) % images.length;
            updateCarousel();
        }
        
        function carouselNext() {
            if (!window.carouselState) return;
            const { images } = window.carouselState;
            window.carouselState.currentIndex = (window.carouselState.currentIndex + 1) % images.length;
            updateCarousel();
        }
        
        function carouselGoTo(index) {
            if (!window.carouselState) return;
            window.carouselState.currentIndex = index;
            updateCarousel();
        }
        
        function updateCarousel() {
            const { currentIndex } = window.carouselState;
            
            // Update slide visibility
            document.querySelectorAll('.carousel-slide').forEach((slide, idx) => {
                slide.classList.toggle('opacity-100', idx === currentIndex);
                slide.classList.toggle('opacity-0', idx !== currentIndex);
            });
            
            // Update dot indicators
            document.querySelectorAll('.carousel-dot').forEach((dot, idx) => {
                dot.classList.toggle('bg-white', idx === currentIndex);
                dot.classList.toggle('scale-125', idx === currentIndex);
                dot.classList.toggle('bg-white/50', idx !== currentIndex);
            });
            
            // Update counter
            const counter = document.getElementById('carousel-current');
            if (counter) counter.textContent = currentIndex + 1;
        }

        function closeModal() {
            document.getElementById('detail-modal').classList.add('hidden');
        }

        // ==========================================
        // 6. INTERACCIONES UI & UTILS
        // ==========================================

        function setActiveTab(tab) {
            state.activeTab = tab;

            // UI Update Tabs
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-candelaria-purple', 'text-candelaria-purple', 'text-gray-900');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            const activeBtn = document.getElementById(`tab-${tab}`);
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
            activeBtn.classList.add('border-candelaria-purple', 'text-candelaria-purple', 'text-gray-900');

            // Handle Filter Visibility
            const filtersContainer = document.getElementById('hospedaje-specific-filters');
            if (tab === 'hospedajes') {
                filtersContainer.classList.remove('hidden');
                filtersContainer.classList.add('flex');
            } else {
                filtersContainer.classList.add('hidden');
                filtersContainer.classList.remove('flex');
            }
            // Re-render filters (chips) based on new tab
            renderFilters();

            // Simular carga para sensación profesional
            const container = document.getElementById('cards-container');
            container.innerHTML = `
                 <div class="animate-pulse flex flex-col space-y-4 p-4">
                    <div class="h-48 bg-gray-200 rounded-xl w-full"></div>
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                </div>
            `;

            setTimeout(() => {
                renderCards();
            }, 300); // 300ms delay
        }

        function toggleFilter(key) {
            state.filters[key] = !state.filters[key];
            renderFilters();
            renderCards();
            showToast(state.filters[key] ? 'Filtro aplicado' : 'Filtro removido');
        }

        function resetFilters() {
            state.filters.bestRated = false;
            state.filters.budget = false;
            state.search = '';
            document.getElementById('search-input').value = '';
            renderFilters();
            renderCards();
        }

        function showToast(message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'bg-gray-800 text-white px-6 py-3 rounded-lg shadow-lg text-sm font-medium flex items-center gap-2 transform translate-y-10 opacity-0 transition-all duration-300';
            toast.innerHTML = `<i data-lucide="check" class="w-4 h-4 text-green-400"></i> ${message}`;

            container.appendChild(toast);
            lucide.createIcons();

            // Animate in
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-10', 'opacity-0');
            });

            // Remove after 3s
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ==========================================
        // 7. INICIALIZACIÓN
        // ==========================================
        document.addEventListener('DOMContentLoaded', () => {
            initMap();
            renderFilters();

            // Check for tab parameter in URL
            const urlParams = new URLSearchParams(window.location.search);
            const tabParam = urlParams.get('tab');
            const validTabs = ['hospedajes', 'restaurantes', 'transporte', 'info'];

            if (tabParam && validTabs.includes(tabParam)) {
                setActiveTab(tabParam);
            } else {
                setActiveTab('hospedajes');
            }

            lucide.createIcons();

            // Listeners
            document.getElementById('search-input').addEventListener('input', (e) => {
                state.search = e.target.value;
                renderCards();
            });
        });

    </script>

    <?php
    $footerDepth = 1;
    include '../includes/standard-footer.php';
    ?>

    <!-- Chatbot Widget Removed -->

    <script>
        // Mobile Menu Logic
        // Mobile Menu Logic handled by standard-header.php
    </script>

    <!-- Auth Modal and Dropdown -->
    <?= getAuthModalHTML() ?>
    <?= getAuthJS() ?>
    <script src="../assets/js/spark-effect.js"></script>
</body>

</html>