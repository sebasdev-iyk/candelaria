<?php
require_once '../../includes/supabase-middleware.php';
$isGuest = !isAuthenticated();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candelaria 2025 | Hospedaje</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/airbnb.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        candelaria: {
                            purple: '#4c1d95',
                            gold: '#fbbf24',
                            lake: '#0ea5e9',
                            light: '#f5f3ff'
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
        /* Overlay Style */
        .login-overlay-backdrop {
            background: rgba(243, 244, 246, 0.85);
            backdrop-filter: blur(8px);
        }

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

        .btn-live {
            position: relative;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 10px 24px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            animation: pulseLive 2s infinite;
        }

        .live-dot {
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            animation: blink 1s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        @keyframes pulseLive {

            0%,
            100% {
                box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            }

            50% {
                box-shadow: 0 4px 25px rgba(220, 38, 38, 0.7), 0 0 30px rgba(220, 38, 38, 0.4);
            }
        }

        .nav-link-custom {
            color: #e9d5ff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 8px 16px;
            transition: color 0.3s ease;
            text-transform: uppercase;
        }

        .nav-link-custom:hover {
            color: #fbbf24;
        }

        .room-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .room-card.selected {
            border-color: #4c1d95;
            background: #f5f3ff;
        }

        .gallery-thumb {
            cursor: pointer;
            transition: all 0.2s ease;
            opacity: 0.7;
        }

        .gallery-thumb:hover,
        .gallery-thumb.active {
            opacity: 1;
            transform: scale(1.05);
        }

        #map-hotel {
            height: 300px;
            border-radius: 12px;
        }

        .flatpickr-calendar {
            font-family: 'Open Sans', sans-serif !important;
        }

        .user-btn {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 8px 16px;
            border-radius: 30px;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .user-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .user-btn.logged-in {
            background: rgba(251, 191, 36, 0.2);
            border-color: rgba(251, 191, 36, 0.5);
        }

        /* Header Manta Premium Style - Professional Edition (Lliclla Pattern) */
        .header-manta-premium {
            height: 140px;
            background-image: linear-gradient(rgba(45, 10, 80, 0.45), rgba(15, 5, 30, 0.65)), url('../../principal/headerfondo2.jpg');
            background-size: auto 100%;
            background-repeat: repeat-x;
            background-position: center;
            position: relative;
            border-bottom: 3px solid #fbbf24;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            justify-content: center;
            will-change: transform;
            transform: translateZ(0);
            backface-visibility: hidden;
        }

        @media (max-width: 768px) {
            .header-manta-premium {
                height: 80px !important;
                min-height: 80px;
            }

            .header-manta-premium.scrolled {
                height: auto !important;
                min-height: 70px;
            }
        }

        .header-manta-premium.scrolled {
            height: 90px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.6);
            background-image: linear-gradient(rgba(45, 10, 80, 0.75), rgba(15, 5, 30, 0.9)), url('../../principal/headerfondo1.jpg');
        }

        .header-manta-premium::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, transparent 30%, rgba(0, 0, 0, 0.2) 100%);
            pointer-events: none;
        }

        .header-manta-premium>div {
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 <?= $isGuest ? 'overflow-hidden h-screen' : '' ?>">

    <?php if ($isGuest): ?>
        <!-- Guest Overlay -->
        <div class="fixed inset-0 z-[1200] flex items-center justify-center p-4 login-overlay-backdrop">
            <div
                class="bg-white w-full max-w-[400px] rounded-xl shadow-2xl overflow-hidden transform scale-100 transition-all border border-gray-100">
                <!-- Header -->
                <div class="bg-gradient-to-r from-purple-900 to-purple-800 p-6 text-center relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[url('../../principal/headerfondo2.jpg')] opacity-30 bg-cover bg-center">
                    </div>
                    <div class="relative z-10 flex flex-col items-center">
                        <img src="../../principal/logoc.png" class="h-16 w-auto mb-2 drop-shadow-md">
                        <h3 class="text-white font-bold text-lg leading-tight">Federación Regional de Folklore y Cultura de
                            Puno</h3>
                    </div>
                </div>

                <div class="p-8">
                    <div class="text-center mb-6">
                        <p class="text-gray-900 font-bold text-xl mb-1">Inicia sesión para ver detalles</p>
                        <p class="text-gray-500 text-sm">Accede a precios y reserva tu hospedaje</p>
                    </div>

                    <!-- Inline Login Form -->
                    <form id="inline-login-form" class="space-y-4 text-left">
                        <div>
                            <label for="inline-email" class="block text-sm font-medium text-gray-700">Correo
                                Electrónico</label>
                            <input type="email" id="inline-email" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm p-2 border"
                                placeholder="tu@email.com">
                        </div>
                        <div>
                            <label for="inline-password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input type="password" id="inline-password" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm p-2 border"
                                placeholder="••••••••">
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors shadow-sm">
                            Iniciar Sesión
                        </button>

                        <div class="flex items-center justify-between text-xs mt-2">
                            <a href="#" onclick="event.preventDefault(); openAuthModal()"
                                class="text-purple-600 hover:text-purple-500 font-medium">¿Olvidaste tu contraseña?</a>
                            <a href="#" onclick="event.preventDefault(); openAuthModal()"
                                class="text-purple-600 hover:text-purple-500 font-medium">Crear cuenta</a>
                        </div>
                    </form>

                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center"><span
                                class="bg-white px-2 text-xs text-gray-400 uppercase">O continuar con</span></div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" onclick="handleHotelSocialLogin('google')"
                            class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                    fill="#EA4335" />
                            </svg>
                            Google
                        </button>
                        <button type="button" onclick="handleHotelSocialLogin('facebook')"
                            class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="h-5 w-5 mr-2 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            Facebook
                        </button>
                    </div>
                </div>
                <div class="text-center mt-4 mb-6">
                    <a href="../index.php" class="text-sm text-gray-400 hover:text-gray-600 font-medium font-sans">Volver a
                        la lista</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Content Wrapper -->
    <div
        class="<?= $isGuest ? 'blur-sm pointer-events-none select-none filter grayscale-[0.3]' : '' ?> transition-all duration-500">
        <!-- Toast Container -->
        <div id="toast-container" class="fixed bottom-5 right-5 z-[1300] flex flex-col gap-2"></div>

        <!-- Auth Modal moved to global includes -->
        <!-- User Dropdown moved to global includes -->

        <!-- Header Section - Standardized with EN VIVO Style -->
        <header class="header-manta-premium text-white shadow-lg sticky top-0 z-[1100]">
            <div class="w-full px-6 md:px-12 h-20 md:h-22 flex items-center relative z-50">
                <div class="w-full flex justify-between items-center h-full">
                    <!-- Left: Candelaria Branding -->
                    <a href="../../index.php" id="logo-container"
                        class="flex items-center cursor-pointer group h-full relative spark-container">
                        <img src="../../principal/logoc.png" alt="Candelaria"
                            class="h-full w-auto object-contain transition-transform duration-300 group-hover:scale-105 relative z-10">
                    </a>
                    <!-- Right: Navigation + EN TIEMPO REAL -->
                    <div class="flex items-center gap-6">
                        <nav class="hidden md:flex items-center gap-2">
                            <a href="../../servicios/index.php" class="nav-link-custom">Servicios</a>
                            <a href="../../cultura/cultura.php" class="nav-link-custom">Cultura</a>
                            <a href="../../horarios_y_danzas/index.php" class="nav-link-custom">Festividad</a>
                            <a href="../../noticias/index.php" class="nav-link-custom">Noticias</a>
                        </nav>

                        <?php include '../../includes/auth-header.php'; ?>
                        <!-- User Auth Button -->
                        <?= getAuthButtonHTML() ?>

                        <!-- EN VIVO Button -->
                        <a href="../../live-platform/index.php" class="btn-live group !p-2.5 md:!px-6 md:!py-2.5">
                            <div class="live-dot"></div>
                            <span class="tracking-wider hidden md:inline">EN TIEMPO REAL</span>
                        </a>

                        <!-- Mobile Menu Button -->
                        <button id="mobile-menu-btn"
                            class="md:hidden text-white hover:text-candelaria-gold transition-colors">
                            <i data-lucide="menu" class="w-8 h-8"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu (Hidden by default) -->
            <div id="mobile-menu"
                class="hidden md:hidden bg-candelaria-purple absolute top-full left-0 w-full shadow-lg border-t border-purple-800 z-30 transition-all duration-300">
                <nav class="flex flex-col p-6 space-y-4">
                    <a href="../../servicios/index.php"
                        class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Servicios</a>
                    <a href="../../cultura/cultura.php"
                        class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Cultura</a>
                    <a href="../../horarios_y_danzas/index.php"
                        class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Festividad</a>
                    <a href="../../noticias/index.php"
                        class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Noticias</a>
                </nav>
            </div>
        </header>

        <!-- Loading State -->
        <div id="loading-state" class="max-w-7xl mx-auto px-4 py-12">
            <div class="animate-pulse">
                <div class="h-96 bg-gray-200 rounded-2xl mb-8"></div>
                <div class="h-8 bg-gray-200 rounded w-1/2 mb-4"></div>
                <div class="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
                <div class="h-4 bg-gray-200 rounded w-2/3"></div>
            </div>
        </div>

        <!-- Main Content (hidden until loaded) -->
        <main id="main-content" class="hidden max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Breadcrumb -->
            <nav class="mb-6 text-sm">
                <a href="../index.php" class="text-candelaria-purple hover:underline">Servicios</a>
                <span class="mx-2 text-gray-400">/</span>
                <a href="../index.php" class="text-candelaria-purple hover:underline">Hospedajes</a>
                <span class="mx-2 text-gray-400">/</span>
                <span id="breadcrumb-name" class="text-gray-600">Cargando...</span>
            </nav>

            <!-- Hotel Header + Gallery -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <!-- Gallery -->
                <div class="space-y-4">
                    <div class="relative overflow-hidden rounded-2xl shadow-lg" style="height: 400px;">
                        <img id="gallery-main" src="" alt="Hotel"
                            class="w-full h-full object-cover transition-all duration-500">
                        <div
                            class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full text-sm font-bold flex items-center gap-1">
                            <i data-lucide="star" class="w-4 h-4 text-yellow-500 fill-yellow-500"></i>
                            <span id="hotel-rating">0.0</span>
                        </div>
                    </div>
                    <div id="gallery-thumbs" class="flex gap-2 overflow-x-auto pb-2">
                        <!-- Thumbnails injected here -->
                    </div>
                </div>

                <!-- Hotel Info -->
                <div>
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <span id="hotel-type"
                                class="inline-block bg-candelaria-light text-candelaria-purple px-3 py-1 rounded-full text-sm font-semibold mb-2"></span>
                            <h1 id="hotel-name" class="text-3xl md:text-4xl font-bold text-gray-900 font-heading"></h1>
                        </div>
                        <button onclick="toggleFavorite()"
                            class="p-3 bg-white rounded-full shadow-md hover:shadow-lg transition-all">
                            <i data-lucide="heart" class="w-6 h-6 text-gray-400 hover:text-red-500" id="fav-icon"></i>
                        </button>
                    </div>

                    <div class="flex items-center gap-4 text-gray-600 mb-4">
                        <span class="flex items-center gap-1">
                            <i data-lucide="map-pin" class="w-4 h-4"></i>
                            <span id="hotel-location"></span>
                        </span>
                        <span class="flex items-center gap-1">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            <span id="hotel-capacity"></span> huéspedes máx.
                        </span>
                    </div>

                    <p id="hotel-description" class="text-gray-600 mb-6 leading-relaxed"></p>

                    <!-- Amenities -->
                    <div class="mb-6">
                        <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <i data-lucide="sparkles" class="w-5 h-5 text-candelaria-purple"></i>
                            Servicios del Hotel
                        </h3>
                        <div id="hotel-amenities" class="flex flex-wrap gap-2">
                            <!-- Amenities injected here -->
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="bg-gradient-to-r from-candelaria-purple to-purple-700 text-white p-6 rounded-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-200 text-sm">Desde</p>
                                <p class="text-3xl font-bold">$<span id="min-price">0</span><span
                                        class="text-lg font-normal">/noche</span></p>
                            </div>
                            <a href="#rooms-section"
                                class="bg-candelaria-gold text-purple-900 px-6 py-3 rounded-full font-bold hover:bg-yellow-300 transition-all shadow-lg flex items-center gap-2">
                                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                                Ver Habitaciones
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Date Selection & Rooms -->
            <section id="rooms-section" class="mb-12">
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 font-heading mb-6 flex items-center gap-3">
                        <i data-lucide="calendar" class="w-7 h-7 text-candelaria-purple"></i>
                        Selecciona tus fechas
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de entrada</label>
                            <input type="text" id="date-checkin" placeholder="Seleccionar fecha"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-candelaria-purple focus:border-candelaria-purple">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de salida</label>
                            <input type="text" id="date-checkout" placeholder="Seleccionar fecha"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-candelaria-purple focus:border-candelaria-purple">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Huéspedes</label>
                            <select id="guests-count"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-candelaria-purple focus:border-candelaria-purple">
                                <option value="1">1 Huésped</option>
                                <option value="2" selected>2 Huéspedes</option>
                                <option value="3">3 Huéspedes</option>
                                <option value="4">4 Huéspedes</option>
                                <option value="5">5+ Huéspedes</option>
                            </select>
                        </div>
                        <button onclick="checkAvailability()"
                            class="bg-candelaria-purple text-white px-6 py-3 rounded-xl font-bold hover:bg-purple-800 transition-all flex items-center justify-center gap-2">
                            <i data-lucide="search" class="w-5 h-5"></i>
                            Buscar Disponibilidad
                        </button>
                    </div>

                    <div id="dates-summary" class="mt-4 p-4 bg-candelaria-light rounded-xl hidden">
                        <p class="text-candelaria-purple font-medium">
                            <span id="nights-count">0</span> noches · <span id="dates-range"></span>
                        </p>
                    </div>
                </div>

                <!-- Rooms List -->
                <h2 class="text-2xl font-bold text-gray-900 font-heading mb-6 flex items-center gap-3">
                    <i data-lucide="bed-double" class="w-7 h-7 text-candelaria-purple"></i>
                    Habitaciones Disponibles
                </h2>

                <div id="rooms-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Rooms injected here -->
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i data-lucide="loader-2"
                            class="w-12 h-12 mx-auto mb-4 animate-spin text-candelaria-purple"></i>
                        <p>Cargando habitaciones...</p>
                    </div>
                </div>
            </section>

            <!-- Reservation Form -->
            <section id="reservation-section" class="hidden mb-12">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 font-heading mb-6 flex items-center gap-3">
                        <i data-lucide="clipboard-check" class="w-7 h-7 text-candelaria-purple"></i>
                        Completa tu Reservación
                    </h2>

                    <!-- Login Required Message (shown when not logged in) -->
                    <div id="login-required-section" class="text-center py-8 hidden">
                        <div
                            class="w-20 h-20 bg-candelaria-light rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="lock" class="w-10 h-10 text-candelaria-purple"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Inicia sesión para reservar</h3>
                        <p class="text-gray-600 mb-6">Necesitas una cuenta para completar tu reservación</p>
                        <button onclick="toggleAuthModal()"
                            class="bg-candelaria-purple text-white px-8 py-3 rounded-xl font-bold hover:bg-purple-800 transition-all inline-flex items-center gap-2">
                            <i data-lucide="log-in" class="w-5 h-5"></i>
                            Iniciar Sesión o Registrarse
                        </button>
                    </div>

                    <!-- Reservation Form (shown when logged in) -->
                    <div id="reservation-form-container" class="grid grid-cols-1 lg:grid-cols-2 gap-8 hidden">
                        <!-- Form -->
                        <form id="reservation-form" class="space-y-4">
                            <input type="hidden" id="selected-room-id" value="">

                            <!-- User Info Display -->
                            <div class="bg-candelaria-light p-4 rounded-xl mb-4">
                                <p class="text-sm text-candelaria-purple font-medium">Reservando como:</p>
                                <p id="reserving-as" class="font-bold text-gray-900"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Notas adicionales</label>
                                <textarea id="client-notes" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-candelaria-purple"
                                    placeholder="Peticiones especiales, hora de llegada, etc."></textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-candelaria-purple text-white py-4 rounded-xl font-bold text-lg hover:bg-purple-800 transition-all flex items-center justify-center gap-2">
                                <i data-lucide="check-circle" class="w-6 h-6"></i>
                                Confirmar Reservación
                            </button>
                        </form>

                        <!-- Summary -->
                        <div class="bg-gray-50 rounded-2xl p-6">
                            <h3 class="font-bold text-gray-800 mb-4">Resumen de tu reservación</h3>

                            <div id="summary-room" class="flex gap-4 mb-6 pb-6 border-b border-gray-200">
                                <img id="summary-room-img" src="" alt="" class="w-24 h-24 rounded-xl object-cover">
                                <div>
                                    <p id="summary-room-name" class="font-bold text-gray-800"></p>
                                    <p id="summary-room-type" class="text-sm text-gray-500"></p>
                                    <p id="summary-room-guests" class="text-sm text-gray-500"></p>
                                </div>
                            </div>

                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Check-in</span>
                                    <span id="summary-checkin" class="font-medium"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Check-out</span>
                                    <span id="summary-checkout" class="font-medium"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Noches</span>
                                    <span id="summary-nights" class="font-medium"></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Precio por noche</span>
                                    <span id="summary-price-night" class="font-medium"></span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                <span class="text-lg font-bold text-gray-800">Total</span>
                                <span id="summary-total" class="text-2xl font-bold text-candelaria-purple">$0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Map Section -->
            <section class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 font-heading mb-6 flex items-center gap-3">
                    <i data-lucide="map" class="w-7 h-7 text-candelaria-purple"></i>
                    Ubicación
                </h2>
                <div class="bg-white rounded-2xl shadow-lg p-4">
                    <div id="map-hotel"></div>
                    <p id="map-address" class="mt-4 text-gray-600 flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-candelaria-purple"></i>
                        <span></span>
                    </p>
                </div>
            </section>

            <!-- Ratings & Reviews Section -->
            <section id="reviews-section" class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 font-heading mb-6 flex items-center gap-3">
                    <i data-lucide="star" class="w-7 h-7 text-candelaria-purple"></i>
                    Calificaciones y Comentarios
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Rating Summary -->
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <div class="text-center">
                            <div class="text-5xl font-bold text-gray-900 mb-2" id="avg-rating">0.0</div>
                            <div id="stars-display" class="flex justify-center gap-1 mb-2">
                                <!-- Stars injected here -->
                            </div>
                            <p class="text-gray-500"><span id="total-reviews">0</span> opiniones</p>
                        </div>

                        <!-- Rate Form (only if logged in) -->
                        <div id="rate-form-container" class="mt-6 pt-6 border-t border-gray-200 hidden">
                            <h4 class="font-bold text-gray-800 mb-3">Deja tu opinión</h4>
                            <div class="flex justify-center gap-2 mb-3" id="rate-stars">
                                <button onclick="setRating(1)"
                                    class="rate-star text-3xl text-gray-300 hover:text-yellow-400">★</button>
                                <button onclick="setRating(2)"
                                    class="rate-star text-3xl text-gray-300 hover:text-yellow-400">★</button>
                                <button onclick="setRating(3)"
                                    class="rate-star text-3xl text-gray-300 hover:text-yellow-400">★</button>
                                <button onclick="setRating(4)"
                                    class="rate-star text-3xl text-gray-300 hover:text-yellow-400">★</button>
                                <button onclick="setRating(5)"
                                    class="rate-star text-3xl text-gray-300 hover:text-yellow-400">★</button>
                            </div>
                            <textarea id="rate-comment" rows="3" placeholder="Escribe tu comentario (opcional)"
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-candelaria-purple focus:border-candelaria-purple mb-3"></textarea>
                            <button onclick="submitRating()"
                                class="w-full bg-candelaria-purple text-white py-2 rounded-lg font-bold hover:bg-purple-800">
                                Enviar Calificación
                            </button>
                        </div>

                        <div id="login-to-rate" class="mt-6 pt-6 border-t border-gray-200 text-center">
                            <p class="text-gray-500 text-sm mb-3">Inicia sesión para dejar una calificación</p>
                            <button onclick="toggleAuthModal()"
                                class="text-candelaria-purple font-bold text-sm hover:underline">
                                Iniciar Sesión
                            </button>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <div class="lg:col-span-2">
                        <div id="reviews-list" class="space-y-4">
                            <div class="text-center py-8 text-gray-500">
                                <i data-lucide="message-square" class="w-12 h-12 mx-auto mb-3 text-gray-300"></i>
                                <p>Sé el primero en dejar una opinión</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <!-- Footer -->


        <!-- Scripts -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

        <script>
                // St                    ate
            let hotel = null;
            let rooms = [];
            let selectedRoom = null;
            let checkinDate = null;
            let checkoutDate = null;
            let mapInstance = null;
            // currentUser handled globally

            // Helper to fix image paths
            function fixImagePath(url) {
                const original = url;
                let finalUrl = url;

                if (!url) {
                    finalUrl = 'https://picsum.photos/800/600';
                }
                else if (url.startsWith('http') || url.startsWith('data:')) {
                    finalUrl = url;
                }
                else if (url.startsWith('/')) {
                    finalUrl = url;
                }
                else if (url.startsWith('assets/')) {
                    finalUrl = '../../' + url;
                }
                else if (url.startsWith('uploads/')) {
                    finalUrl = '../../assets/' + url;
                }
                else {
                    // Assume bare filename in uploads (standard for new uploads)
                    finalUrl = '../../assets/uploads/' + url;
                }

                console.log(`[DEBUG] Image Path Fix: "${original}" -> "${finalUrl}"`);
                return finalUrl;
            }

            // Get hotel ID from URL
            const urlParams = new URLSearchParams(window.location.search);
            const hotelId = urlParams.get('id');

            if (!hotelId) {
                window.location.href = '../index.php';
            }

            // Initialize
            document.addEventListener('DOMContentLoaded', async () => {
                try {
                    // Handle Global Auth Changes
                    window.addEventListener('auth-changed', (e) => {
                        try {
                            const user = e.detail;
                            updateReservationUI(user);
                            if (typeof loadReviews === 'function') loadReviews();
                        } catch (e) { console.error("Auth change error", e); }
                    });

                    // Initial check in case it loaded before listener
                    if (window.currentUser) {
                        updateReservationUI(window.currentUser);
                    }

                    if (typeof lucide !== 'undefined') lucide.createIcons();

                    await loadHotelData();
                    initDatePickers();

                    if (typeof loadReviews === 'function') loadReviews();
                    if (typeof setupGalleryCarousel === 'function') setupGalleryCarousel();

                } catch (initError) {
                    console.error("CRITICAL INITIALIZATION ERROR:", initError);
                    const loadingState = document.getElementById('loading-state');
                    if (loadingState) {
                        loadingState.innerHTML = `
                        <div class="max-w-md mx-auto mt-10 p-6 bg-red-50 border border-red-200 rounded-xl text-center">
                            <h3 class="text-red-800 font-bold mb-2">Error de carga</h3>
                            <p class="text-red-600 mb-4">${initError.message || 'Error desconocido al iniciar la página'}</p>
                            <button onclick="location.reload()" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">Reintentar</button>
                        </div>
                    `;
                    }
                }
            });

            // Helper to update local UI parts that depend on user
            function updateReservationUI(user) {
                const loginRequired = document.getElementById('login-required-section');
                const formContainer = document.getElementById('reservation-form-container');
                const reservingAs = document.getElementById('reserving-as');

                if (user) {
                    if (loginRequired) loginRequired.classList.add('hidden');
                    if (formContainer) formContainer.classList.remove('hidden');

                    if (reservingAs) {
                        const userName = user.name || user.nombre || 'Usuario';
                        const userEmail = user.email || '';
                        reservingAs.textContent = `${userName} (${userEmail})`;
                    }

                    // Update Ratings UI too
                    const loginMsg = document.getElementById('login-to-rate');
                    if (loginMsg) loginMsg.classList.add('hidden');
                } else {
                    if (loginRequired) loginRequired.classList.remove('hidden');
                    if (formContainer) formContainer.classList.add('hidden');

                    const loginMsg = document.getElementById('login-to-rate');
                    if (loginMsg) loginMsg.classList.remove('hidden');
                }
            }

            // Alias for backwards compatibility (called from selectRoom)
            function updateReservationSection() {
                updateReservationUI(window.currentUser);
            }

            // Helper to get access token (Supabase or legacy)
            function getAccessToken() {
                // Try Supabase token from cookies
                const cookies = document.cookie.split(';');
                for (let cookie of cookies) {
                    const [name, value] = cookie.trim().split('=');
                    if (name === 'sb-access-token' && value) {
                        return decodeURIComponent(value);
                    }
                }
                // Fallback to SupabaseCore if available
                if (typeof SupabaseCore !== 'undefined' && SupabaseCore.getAccessToken) {
                    return SupabaseCore.getAccessToken();
                }
                // Fallback to legacy token
                return localStorage.getItem('clientToken');
            }

            // ============================================
            // AUTHENTICATION FUNCTIONS REMOVED
            // (Handled by global auth-header.js)
            // ============================================

            // Load hotel data
            async function loadHotelData() {
                try {
                    // Fetch hotel details
                    const hotelRes = await fetch(`../../api/hospedaje.php?id=${hotelId}`);
                    if (!hotelRes.ok) throw new Error('Hotel no encontrado');

                    const hotelData = await hotelRes.json();
                    if (Array.isArray(hotelData)) {
                        hotel = hotelData.find(h => h.id == hotelId);
                    } else {
                        hotel = hotelData;
                    }

                    if (!hotel) throw new Error('Hotel no encontrado en la respuesta');

                    // Parse JSON fields
                    if (typeof hotel.servicios === 'string' && hotel.servicios) {
                        try { hotel.servicios = JSON.parse(hotel.servicios); } catch (e) { hotel.servicios = []; console.error('Error parsing servicios:', e); }
                    }
                    if (typeof hotel.imagenes === 'string' && hotel.imagenes) {
                        try { hotel.imagenes = JSON.parse(hotel.imagenes); } catch (e) { hotel.imagenes = []; console.error('Error parsing imagenes:', e); }
                    } else if (!hotel.imagenes) {
                        hotel.imagenes = [];
                    }

                    // Fetch rooms
                    try {
                        const roomsRes = await fetch(`../../api/habitaciones.php?hospedaje_id=${hotelId}`);
                        if (roomsRes.ok) {
                            const roomsData = await roomsRes.json();
                            // Handle potential object wrapper {success:true, habitaciones: []}
                            if (roomsData.habitaciones) {
                                rooms = roomsData.habitaciones;
                            } else if (Array.isArray(roomsData)) {
                                rooms = roomsData;
                            } else {
                                rooms = [];
                            }

                            // Parse JSON fields for rooms
                            rooms.forEach(room => {
                                if (typeof room.amenidades === 'string') {
                                    try { room.amenidades = JSON.parse(room.amenidades); } catch (e) { room.amenidades = []; }
                                }
                                if (typeof room.imagenes === 'string') {
                                    try { room.imagenes = JSON.parse(room.imagenes); } catch (e) { room.imagenes = []; }
                                }
                            });
                        }
                    } catch (roomErr) {
                        console.warn('Error loading rooms, continuing with hotel data', roomErr);
                        rooms = [];
                    }

                    console.log('Hotel loaded:', hotel);

                    // Render everything
                    renderHotel();
                    renderRooms();

                    loadReviews(); // Load real ratings

                    // Show content
                    document.getElementById('loading-state').classList.add('hidden');
                    document.getElementById('main-content').classList.remove('hidden');

                    // Init map after showing content so Leaflet can calculate dimensions
                    setTimeout(() => {
                        initMap();
                        if (mapInstance) mapInstance.invalidateSize();
                    }, 100);

                } catch (error) {
                    console.error('CRITICAL Error loading hotel:', error);

                    // Show detailed error in UI for debugging
                    const errorMsg = error.message || 'Error desconocido';
                    document.getElementById('loading-state').innerHTML = `
                    <div class="text-center py-20">
                        <i data-lucide="alert-circle" class="w-16 h-16 mx-auto text-red-500 mb-4"></i>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Error al cargar hotel</h2>
                        <p class="text-gray-600 mb-6">Detalles: ${errorMsg}</p>
                        <a href="../../servicios/index.php" class="inline-block bg-candelaria-purple text-white px-6 py-3 rounded-full font-bold">
                            Volver a Servicios
                        </a>
                    </div>
                `;
                    lucide.createIcons();
                }
            }

            // Render hotel info
            function renderHotel() {
                if (!hotel) return; // Safety check

                document.title = `Candelaria 2025 | ${hotel.nombre}`;
                document.getElementById('breadcrumb-name').textContent = hotel.nombre;
                document.getElementById('hotel-name').textContent = hotel.nombre;
                document.getElementById('hotel-type').textContent = hotel.tipo || 'Hotel';
                document.getElementById('hotel-location').textContent = hotel.ubicacion;
                document.getElementById('hotel-capacity').textContent = hotel.capacidad || '50';
                document.getElementById('hotel-description').textContent = hotel.descripcion || 'Sin descripción disponible';
                document.getElementById('hotel-rating').textContent = parseFloat(hotel.calificacion || 0).toFixed(1);
                const mapAddr = document.getElementById('map-address');
                if (mapAddr) mapAddr.querySelector('span').textContent = hotel.ubicacion;

                // Gallery
                let rawImages = [];
                if (hotel.imagenes && Array.isArray(hotel.imagenes) && hotel.imagenes.length > 0) {
                    rawImages = hotel.imagenes;
                } else {
                    rawImages = ['https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800'];
                }

                const images = rawImages.map(img => fixImagePath(img));

                document.getElementById('gallery-main').src = images[0];

                const thumbsContainer = document.getElementById('gallery-thumbs');
                thumbsContainer.innerHTML = images.map((img, i) => `
                <img src="${img}" alt="Gallery ${i + 1}" 
                     class="gallery-thumb w-20 h-20 rounded-lg object-cover ${i === 0 ? 'active ring-2 ring-candelaria-purple' : ''}"
                     onclick="changeMainImage('${img}', this)">
            `).join('');

                // Amenities
                const amenities = hotel.servicios || [];
                const amenityIcons = {
                    'WiFi Gratis': 'wifi', 'Estacionamiento': 'car', 'Desayuno Incluido': 'coffee',
                    'Restaurante': 'utensils', 'Recepción 24h': 'clock', 'Agua Caliente': 'droplet',
                    'TV Cable': 'tv', 'Calefacción': 'flame', 'Room Service': 'bell', 'Lavandería': 'shirt'
                };

                document.getElementById('hotel-amenities').innerHTML = amenities.map(a => `
                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 rounded-full text-sm text-gray-700">
                    <i data-lucide="${amenityIcons[a] || 'check'}" class="w-4 h-4 text-candelaria-purple"></i>
                    ${a}
                </span>
            `).join('');

                // Min price
                const minPrice = rooms.length > 0
                    ? Math.min(...rooms.map(r => parseFloat(r.precio_noche)))
                    : parseFloat(hotel.precio_noche);
                document.getElementById('min-price').textContent = minPrice.toFixed(0);

                lucide.createIcons();
            }

            // Render rooms
            function renderRooms() {
                const container = document.getElementById('rooms-container');

                if (rooms.length === 0) {
                    container.innerHTML = `
                    <div class="col-span-full text-center py-12 bg-white rounded-2xl">
                        <i data-lucide="bed" class="w-12 h-12 mx-auto text-gray-300 mb-4"></i>
                        <p class="text-gray-500">No hay habitaciones disponibles en este momento</p>
                    </div>
                `;
                    lucide.createIcons();
                    return;
                }

                container.innerHTML = rooms.map(room => {
                    const amenities = Array.isArray(room.amenidades) ? room.amenidades : [];
                    const rawImages = Array.isArray(room.imagenes) && room.imagenes.length > 0
                        ? room.imagenes
                        : ['https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=800'];

                    const images = rawImages.map(img => fixImagePath(img));

                    const disponible = room.disponibles !== undefined ? room.disponibles > 0 : true;
                    const tipoLabel = {
                        'individual': 'Individual', 'doble': 'Doble', 'matrimonial': 'Matrimonial',
                        'suite': 'Suite', 'familiar': 'Familiar'
                    };

                    return `
                    <div class="room-card bg-white rounded-2xl shadow-md overflow-hidden ${!disponible ? 'opacity-60' : ''}" 
                         data-room-id="${room.id}">
                        <div class="relative h-48" id="room-gallery-${room.id}">
                            <img src="${images[0]}" alt="${room.nombre}" class="w-full h-full object-cover room-img-${room.id}" data-index="0">
                            ${images.length > 1 ? `
                                <button onclick="event.stopPropagation(); roomCarouselPrev(${room.id})" 
                                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1.5 rounded-full shadow z-10">
                                    <i data-lucide="chevron-left" class="w-4 h-4 text-gray-700"></i>
                                </button>
                                <button onclick="event.stopPropagation(); roomCarouselNext(${room.id})" 
                                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-1.5 rounded-full shadow z-10">
                                    <i data-lucide="chevron-right" class="w-4 h-4 text-gray-700"></i>
                                </button>
                                <div class="absolute bottom-2 right-2 bg-black/50 text-white text-xs px-2 py-0.5 rounded-full">
                                    <span class="room-counter-${room.id}">1</span>/${images.length}
                                </div>
                            ` : ''}
                            <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-xs font-bold">
                                ${tipoLabel[room.tipo] || room.tipo}
                            </span>
                            ${!disponible ? '<span class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-md text-xs font-bold">Agotado</span>' : ''}
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-lg text-gray-800 mb-2">${room.nombre}</h3>
                            <p class="text-sm text-gray-500 mb-3 line-clamp-2">${room.descripcion || ''}</p>
                            
                            <div class="flex items-center gap-3 text-sm text-gray-600 mb-4">
                                <span class="flex items-center gap-1">
                                    <i data-lucide="users" class="w-4 h-4"></i>
                                    ${room.capacidad} personas
                                </span>
                                ${room.disponibles !== undefined ? `
                                    <span class="flex items-center gap-1 ${room.disponibles > 0 ? 'text-green-600' : 'text-red-500'}">
                                        <i data-lucide="${room.disponibles > 0 ? 'check-circle' : 'x-circle'}" class="w-4 h-4"></i>
                                        ${room.disponibles} disponibles
                                    </span>
                                ` : ''}
                            </div>
                            
                            <div class="flex flex-wrap gap-1 mb-4">
                                ${amenities.slice(0, 3).map(a => `
                                    <span class="text-xs px-2 py-0.5 bg-purple-50 text-purple-700 rounded-full">${a}</span>
                                `).join('')}
                            </div>
                            
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <div>
                                    <span class="text-2xl font-bold text-candelaria-purple">$${parseFloat(room.precio_noche).toFixed(0)}</span>
                                    <span class="text-sm text-gray-500">/noche</span>
                                    ${room.precio_total ? `<p class="text-sm text-gray-600">Total: $${room.precio_total.toFixed(2)}</p>` : ''}
                                </div>
                                ${disponible ? `
                                    <button class="bg-candelaria-purple text-white px-4 py-2 rounded-lg font-bold text-sm hover:bg-purple-800 transition-all">
                                        Reservar
                                    </button>
                                ` : ''}
                            </div>
                        </div>
                    </div>
                `;
                }).join('');

                lucide.createIcons();

                // Add click handlers to reserve buttons
                document.querySelectorAll('.room-card').forEach(card => {
                    const roomId = card.dataset.roomId;
                    const btn = card.querySelector('button:last-of-type');
                    if (btn && btn.textContent.includes('Reservar')) {
                        btn.onclick = (e) => {
                            e.stopPropagation();
                            selectRoom(parseInt(roomId));
                        };
                    }
                });
            }

            // Room carousel state
            const roomCarouselState = {};

            function roomCarouselPrev(roomId) {
                const room = rooms.find(r => r.id == roomId);
                if (!room) return;

                const images = Array.isArray(room.imagenes) ? room.imagenes : [];
                if (images.length < 2) return;

                if (!roomCarouselState[roomId]) roomCarouselState[roomId] = 0;
                roomCarouselState[roomId] = (roomCarouselState[roomId] - 1 + images.length) % images.length;
                updateRoomCarousel(roomId, images);
            }

            function roomCarouselNext(roomId) {
                const room = rooms.find(r => r.id == roomId);
                if (!room) return;

                const images = Array.isArray(room.imagenes) ? room.imagenes : [];
                if (images.length < 2) return;

                if (!roomCarouselState[roomId]) roomCarouselState[roomId] = 0;
                roomCarouselState[roomId] = (roomCarouselState[roomId] + 1) % images.length;
                updateRoomCarousel(roomId, images);
            }

            function updateRoomCarousel(roomId, images) {
                const idx = roomCarouselState[roomId] || 0;
                const img = document.querySelector(`.room-img-${roomId}`);
                const counter = document.querySelector(`.room-counter-${roomId}`);

                if (img) img.src = images[idx];
                if (counter) counter.textContent = idx + 1;
            }

            // Change gallery image
            function changeMainImage(src, thumb) {
                document.getElementById('gallery-main').src = src;
                document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active', 'ring-2', 'ring-candelaria-purple'));
                thumb.classList.add('active', 'ring-2', 'ring-candelaria-purple');
            }

            // Initialize date pickers
            function initDatePickers() {
                const config = {
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d M Y",
                    locale: "es",
                    minDate: "today"
                };

                const checkinPicker = flatpickr("#date-checkin", {
                    ...config,
                    defaultDate: new Date(2025, 1, 2), // Feb 2, 2025
                    onChange: (dates) => {
                        checkinDate = dates[0];
                        if (checkoutDate && checkinDate >= checkoutDate) {
                            const newCheckout = new Date(checkinDate);
                            newCheckout.setDate(newCheckout.getDate() + 1);
                            checkoutPicker.setDate(newCheckout);
                        }
                        checkoutPicker.set('minDate', checkinDate);
                        updateDatesSummary();
                    }
                });

                const checkoutPicker = flatpickr("#date-checkout", {
                    ...config,
                    defaultDate: new Date(2025, 1, 5), // Feb 5, 2025
                    onChange: (dates) => {
                        checkoutDate = dates[0];
                        updateDatesSummary();
                    }
                });

                // Set initial dates
                checkinDate = new Date(2025, 1, 2);
                checkoutDate = new Date(2025, 1, 5);
                updateDatesSummary();
            }

            // Update dates summary
            function updateDatesSummary() {
                if (checkinDate && checkoutDate) {
                    const nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
                    if (nights > 0) {
                        document.getElementById('dates-summary').classList.remove('hidden');
                        document.getElementById('nights-count').textContent = nights;
                        document.getElementById('dates-range').textContent =
                            `${checkinDate.toLocaleDateString('es-ES', { day: 'numeric', month: 'short' })} - ${checkoutDate.toLocaleDateString('es-ES', { day: 'numeric', month: 'short', year: 'numeric' })}`;
                    }
                }
            }

            // Check availability
            async function checkAvailability() {
                if (!checkinDate || !checkoutDate) {
                    showToast('Por favor selecciona las fechas', 'error');
                    return;
                }

                const guests = document.getElementById('guests-count').value;
                const fechaEntrada = checkinDate.toISOString().split('T')[0];
                const fechaSalida = checkoutDate.toISOString().split('T')[0];

                try {
                    const res = await fetch(`../../api/disponibilidad.php?hospedaje_id=${hotelId}&fecha_entrada=${fechaEntrada}&fecha_salida=${fechaSalida}&huespedes=${guests}`);
                    if (res.ok) {
                        const data = await res.json();
                        rooms = data.habitaciones || [];
                        renderRooms();
                        showToast(`${rooms.filter(r => r.disponible).length} habitaciones disponibles`, 'success');
                    }
                } catch (error) {
                    console.error('Error checking availability:', error);
                    showToast('Error al verificar disponibilidad', 'error');
                }
            }

            // Select room
            function selectRoom(roomId) {
                if (!checkinDate || !checkoutDate) {
                    showToast('Primero selecciona las fechas de tu estancia', 'warning');
                    document.getElementById('date-checkin').focus();
                    return;
                }

                selectedRoom = rooms.find(r => r.id === roomId);
                if (!selectedRoom) return;

                // Update UI
                document.querySelectorAll('.room-card').forEach(c => c.classList.remove('selected'));
                document.querySelector(`[data-room-id="${roomId}"]`)?.classList.add('selected');

                document.getElementById('selected-room-id').value = roomId;

                // Update summary
                const images = Array.isArray(selectedRoom.imagenes) && selectedRoom.imagenes.length > 0
                    ? selectedRoom.imagenes
                    : ['https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=800'];

                document.getElementById('summary-room-img').src = images[0];
                document.getElementById('summary-room-name').textContent = selectedRoom.nombre;
                document.getElementById('summary-room-type').textContent = selectedRoom.tipo;
                document.getElementById('summary-room-guests').textContent = `Hasta ${selectedRoom.capacidad} huéspedes`;

                const nights = Math.ceil((checkoutDate - checkinDate) / (1000 * 60 * 60 * 24));
                const pricePerNight = parseFloat(selectedRoom.precio_noche);
                const total = pricePerNight * nights;

                document.getElementById('summary-checkin').textContent = checkinDate.toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' });
                document.getElementById('summary-checkout').textContent = checkoutDate.toLocaleDateString('es-ES', { day: 'numeric', month: 'long', year: 'numeric' });
                document.getElementById('summary-nights').textContent = `${nights} noche${nights > 1 ? 's' : ''}`;
                document.getElementById('summary-price-night').textContent = `$${pricePerNight.toFixed(2)}`;
                document.getElementById('summary-total').textContent = `$${total.toFixed(2)}`;

                // Show reservation form
                document.getElementById('reservation-section').classList.remove('hidden');

                // Check auth and show appropriate section
                updateReservationSection();

                document.getElementById('reservation-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            // Submit reservation
            document.getElementById('reservation-form').addEventListener('submit', async (e) => {
                e.preventDefault();

                if (!window.currentUser) {
                    showToast('Debes iniciar sesión para reservar', 'warning');
                    if (typeof window.openAuthModal === 'function') {
                        window.openAuthModal();
                    } else {
                        console.error("Auth modal function not found");
                    }
                    return;
                }

                const token = getAccessToken();
                if (!token) {
                    showToast('No se encontró token de autenticación', 'error');
                    return;
                }

                const formData = {
                    habitacion_id: parseInt(document.getElementById('selected-room-id').value),
                    hospedaje_id: parseInt(hotelId),
                    fecha_entrada: checkinDate.toISOString().split('T')[0],
                    fecha_salida: checkoutDate.toISOString().split('T')[0],
                    num_huespedes: parseInt(document.getElementById('guests-count').value),
                    notas: document.getElementById('client-notes').value.trim() || null
                };

                try {
                    const res = await fetch('../../api/reservar.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${token}`
                        },
                        credentials: 'include', // Include cookies for Supabase
                        body: JSON.stringify(formData)
                    });

                    const result = await res.json();

                    if (res.ok) {
                        showToast('¡Reservación creada exitosamente!', 'success');

                        // Show confirmation
                        const userEmail = (window.currentUser && window.currentUser.email) ? window.currentUser.email : 'tu correo';
                        document.getElementById('reservation-section').innerHTML = `
                        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="check-circle" class="w-10 h-10 text-green-500"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">¡Reservación Confirmada!</h2>
                            <p class="text-gray-600 mb-6">Tu reservación #${result.id} ha sido creada exitosamente. Hemos enviado los detalles a <strong>${userEmail}</strong></p>
                            <div class="bg-gray-50 rounded-xl p-6 mb-6 text-left max-w-md mx-auto">
                                <p><strong>Hotel:</strong> ${hotel.nombre}</p>
                                <p><strong>Habitación:</strong> ${selectedRoom.nombre}</p>
                                <p><strong>Fechas:</strong> ${formData.fecha_entrada} al ${formData.fecha_salida}</p>
                                <p><strong>Total:</strong> $${parseFloat(result.precio_total).toFixed(2)}</p>
                                <p><strong>Estado:</strong> <span class="text-yellow-600">Pendiente de confirmación</span></p>
                            </div>
                            <a href="../index.php" class="inline-block bg-candelaria-purple text-white px-6 py-3 rounded-full font-bold hover:bg-purple-800">
                                Volver a Servicios
                            </a>
                        </div>
                    `;
                        lucide.createIcons();
                    } else {
                        showToast(result.message || 'Error al crear la reservación', 'error');
                    }
                } catch (error) {
                    console.error('Error submitting reservation:', error);
                    showToast('Error de conexión. Intenta de nuevo.', 'error');
                }
            });

            // Initialize map
            function initMap() {
                if (mapInstance) return;

                const lat = parseFloat(hotel.latitud) || -15.8402;
                const lng = parseFloat(hotel.longitud) || -70.0219;

                mapInstance = L.map('map-hotel').setView([lat, lng], 15);

                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; OpenStreetMap contributors &copy; CARTO',
                    maxZoom: 19
                }).addTo(mapInstance);

                L.marker([lat, lng]).addTo(mapInstance)
                    .bindPopup(`<strong>${hotel.nombre}</strong><br>${hotel.ubicacion}`)
                    .openPopup();
            }

            // Toast notification
            function showToast(message, type = 'info') {
                const colors = {
                    success: 'bg-green-500',
                    error: 'bg-red-500',
                    warning: 'bg-yellow-500',
                    info: 'bg-blue-500'
                };

                const toast = document.createElement('div');
                toast.className = `${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg fade-in`;
                toast.textContent = message;

                document.getElementById('toast-container').appendChild(toast);

                setTimeout(() => toast.remove(), 4000);
            }

            // Toggle favorite
            function toggleFavorite() {
                const icon = document.getElementById('fav-icon');
                icon.classList.toggle('text-red-500');
                icon.classList.toggle('fill-red-500');
                showToast(icon.classList.contains('fill-red-500') ? 'Agregado a favoritos' : 'Eliminado de favoritos', 'success');
            }

            // ============================================
            // RATINGS & REVIEWS
            // ============================================
            let userRating = 0;
            let galleryImages = [];
            let currentGalleryIndex = 0;

            async function loadReviews() {
                try {
                    const res = await fetch(`../../api/calificaciones.php?hospedaje_id=${hotelId}`);
                    if (res.ok) {
                        const data = await res.json();
                        renderRatingsSummary(data);
                        renderReviewsList(data.reviews);
                    }
                } catch (e) {
                    console.error('Error loading reviews:', e);
                }
            }

            function renderRatingsSummary(data) {
                document.getElementById('avg-rating').textContent = data.promedio.toFixed(1);
                document.getElementById('total-reviews').textContent = data.total_reviews;

                // Display stars
                const starsDisplay = document.getElementById('stars-display');
                starsDisplay.innerHTML = '';
                for (let i = 1; i <= 5; i++) {
                    const star = document.createElement('span');
                    star.textContent = '★';
                    star.className = i <= Math.round(data.promedio) ? 'text-yellow-400 text-xl' : 'text-gray-300 text-xl';
                    starsDisplay.appendChild(star);
                }

                // Update auth UI for ratings
                const user = window.currentUser;
                if (user) {
                    const userHasRated = data.reviews && data.reviews.some(r => r.user_id == user.id || r.cliente_id == user.id);

                    const formContainer = document.getElementById('rate-form-container');
                    const loginMsg = document.getElementById('login-to-rate');
                    let ratedMsg = document.getElementById('already-rated-msg');

                    if (!ratedMsg) {
                        ratedMsg = document.createElement('div');
                        ratedMsg.id = 'already-rated-msg';
                        ratedMsg.className = 'mt-6 pt-6 border-t border-gray-200 text-center text-candelaria-purple font-bold hidden';
                        ratedMsg.innerHTML = '<i data-lucide="check-circle" class="w-5 h-5 inline mr-2"></i>¡Ya has calificado este hospedaje!';
                        formContainer.parentNode.appendChild(ratedMsg);
                        lucide.createIcons();
                    }

                    if (userHasRated) {
                        formContainer.classList.add('hidden');
                        ratedMsg.classList.remove('hidden');
                    } else {
                        formContainer.classList.remove('hidden');
                        ratedMsg.classList.add('hidden');
                    }
                    loginMsg.classList.add('hidden');
                } else {
                    document.getElementById('rate-form-container').classList.add('hidden');
                    document.getElementById('login-to-rate').classList.remove('hidden');
                    const ratedMsg = document.getElementById('already-rated-msg');
                    if (ratedMsg) ratedMsg.classList.add('hidden');
                }
            }

            function renderReviewsList(reviews) {
                const container = document.getElementById('reviews-list');

                if (!reviews || reviews.length === 0) {
                    container.innerHTML = `
                    <div class="text-center py-8 text-gray-500">
                        <i data-lucide="message-square" class="w-12 h-12 mx-auto mb-3 text-gray-300"></i>
                        <p>Sé el primero en dejar una opinión</p>
                    </div>
                `;
                    lucide.createIcons();
                    return;
                }

                container.innerHTML = reviews.map(r => `
                <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 bg-candelaria-light rounded-full flex items-center justify-center text-candelaria-purple font-bold">
                                ${r.cliente_nombre.charAt(0).toUpperCase()}
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">${r.cliente_nombre}</p>
                                <div class="flex gap-0.5">
                                    ${Array.from({ length: 5 }, (_, i) =>
                    `<span class="${i < r.puntuacion ? 'text-yellow-400' : 'text-gray-300'}">★</span>`
                ).join('')}
                                </div>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400">${new Date(r.created_at).toLocaleDateString('es-ES')}</span>
                    </div>
                    ${r.comentario ? `<p class="text-gray-600 text-sm mt-2">${r.comentario}</p>` : ''}
                </div>
            `).join('');
            }

            function setRating(rating) {
                userRating = rating;
                const stars = document.querySelectorAll('.rate-star');
                stars.forEach((star, i) => {
                    star.classList.toggle('text-yellow-400', i < rating);
                    star.classList.toggle('text-gray-300', i >= rating);
                });
            }

            async function submitRating() {
                if (!userRating) {
                    showToast('Selecciona una calificación', 'warning');
                    return;
                }

                const token = getAccessToken();
                const comment = document.getElementById('rate-comment').value;

                // DEBUG LOGS
                console.log('[DEBUG] Enviando calificacion:', {
                    hospedaje_id: parseInt(hotelId),
                    puntuacion: userRating,
                    comentario: comment,
                    token: token ? 'Token existe' : 'Token NO existe'
                });

                try {
                    const res = await fetch('../../api/calificaciones.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${token}`
                        },
                        credentials: 'include', // Include cookies for Supabase
                        body: JSON.stringify({
                            hospedaje_id: parseInt(hotelId),
                            puntuacion: userRating,
                            comentario: comment
                        })
                    });

                    const contentType = res.headers.get("content-type");
                    if (contentType && contentType.indexOf("application/json") !== -1) {
                        //
                    } else {
                        console.warn('[DEBUG] La respuesta no es JSON:', await res.text());
                    }

                    if (res.ok) {
                        const data = await res.json();
                        console.log('[DEBUG] Respuesta Exitosa:', data);
                        showToast('¡Gracias por tu opinión!', 'success');
                        document.getElementById('rate-comment').value = '';
                        userRating = 0;
                        setRating(0);
                        loadReviews();
                    } else {
                        const err = await res.json();
                        console.error('[DEBUG] Error del servidor:', err);
                        showToast(err.message || 'Error al enviar', 'error');
                    }
                } catch (e) {
                    console.error('[DEBUG] Error catch:', e);
                    showToast('Error de conexión', 'error');
                }
            }

            // ============================================
            // GALLERY CAROUSEL
            // ============================================
            function setupGalleryCarousel() {
                galleryImages = hotel.imagenes || [];
                if (typeof galleryImages === 'string') {
                    try { galleryImages = JSON.parse(galleryImages); } catch (e) { galleryImages = []; }
                }

                if (galleryImages.length > 1) {
                    // Add navigation arrows
                    const galleryContainer = document.querySelector('.relative.overflow-hidden.rounded-2xl');
                    if (galleryContainer) {
                        galleryContainer.innerHTML += `
                        <button onclick="prevGalleryImage()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow-lg z-10">
                            <i data-lucide="chevron-left" class="w-6 h-6 text-gray-700"></i>
                        </button>
                        <button onclick="nextGalleryImage()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow-lg z-10">
                            <i data-lucide="chevron-right" class="w-6 h-6 text-gray-700"></i>
                        </button>
                        <div class="absolute bottom-4 right-4 bg-white/80 px-3 py-1 rounded-full text-sm font-medium">
                            <span id="gallery-counter">1</span>/${galleryImages.length}
                        </div>
                    `;
                        lucide.createIcons();
                    }
                }
            }

            function prevGalleryImage() {
                if (galleryImages.length < 2) return;
                currentGalleryIndex = (currentGalleryIndex - 1 + galleryImages.length) % galleryImages.length;
                updateGalleryDisplay();
            }

            function nextGalleryImage() {
                if (galleryImages.length < 2) return;
                currentGalleryIndex = (currentGalleryIndex + 1) % galleryImages.length;
                updateGalleryDisplay();
            }

            function updateGalleryDisplay() {
                const mainImg = document.getElementById('gallery-main');
                mainImg.src = fixImagePath(galleryImages[currentGalleryIndex]);

                const counter = document.getElementById('gallery-counter');
                if (counter) counter.textContent = currentGalleryIndex + 1;

                // Update thumbnail active state
                const thumbs = document.querySelectorAll('.gallery-thumb');
                thumbs.forEach((t, i) => {
                    t.classList.toggle('active', i === currentGalleryIndex);
                    t.classList.toggle('ring-2', i === currentGalleryIndex);
                    t.classList.toggle('ring-candelaria-purple', i === currentGalleryIndex);
                });
            }
        </script>

        <!-- Global Auth Modal (from auth-header.php) -->
        <?= getAuthModalHTML() ?>
        <!-- Global Auth JS (from auth-header.php) -->
        <?= getAuthJS() ?>

        <?php
        $footerDepth = 2;
        include '../../includes/standard-footer.php';
        ?>
        <!-- Close Main Wrapper -->
    </div>

    <script>
        // Inline Login Logic
        document.addEventListener('DOMContentLoaded', () => {
            const inlineForm = document.getElementById('inline-login-form');
            if (inlineForm) {
                inlineForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const email = document.getElementById('inline-email').value;
                    const password = document.getElementById('inline-password').value;

                    if (!email || !password) return;

                    try {
                        // Reuse Supabase Logic
                        if (typeof SupabaseCore === 'undefined') {
                            console.error('SupabaseCore missing');
                            return;
                        }

                        const { data, error } = await SupabaseCore.signInWithEmail(email, password);

                        if (error) {
                            alert('Error: ' + error.message);
                            return;
                        }

                        if (data.user) {
                            location.reload();
                        }
                    } catch (err) {
                        console.error('Inline Login Error', err);
                        alert('Error al iniciar sesión');
                    }
                });
            }
        });

        // Custom Social Login for Hotel Page
        window.handleHotelSocialLogin = async function (provider) {
            if (typeof SupabaseCore === 'undefined') {
                console.error("SupabaseCore NOT defined");
                alert('Error: Sistema de autenticación no cargado.');
                return;
            }

            try {
                const currentUrl = window.location.href;
                console.log("📍 Current URL (to use as redirect):", currentUrl);

                if (provider === 'google') {
                    await SupabaseCore.signInWithGoogle(currentUrl);
                } else if (provider === 'facebook') {
                    await SupabaseCore.signInWithFacebook(currentUrl);
                }
            } catch (e) {
                console.error('❌ Social Login Error:', e);
                alert('Error al conectar con ' + provider);
            }
        }

        // Auto-Reload on Social Login Return
        window.addEventListener('supabase-auth-change', (e) => {
            const loginOverlay = document.querySelector('.login-overlay-backdrop');
            if (loginOverlay && e.detail && e.detail.event === 'SIGNED_IN' && e.detail.user) {
                console.log("✅ [HOTEL] User Signed In & Overlay Present. Reloading...");
                window.location.reload();
            }
        });
    </script>
</body>

</html>