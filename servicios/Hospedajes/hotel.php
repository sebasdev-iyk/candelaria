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
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Toast Container -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2"></div>

    <!-- Auth Modal -->
    <div id="auth-modal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm" onclick="closeAuthModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-8">
                    <button onclick="closeAuthModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>

                    <!-- Tab Navigation -->
                    <div class="flex border-b border-gray-200 mb-6">
                        <button id="tab-login" onclick="switchAuthTab('login')"
                            class="flex-1 py-3 text-center font-bold text-candelaria-purple border-b-2 border-candelaria-purple">Iniciar
                            Sesión</button>
                        <button id="tab-register" onclick="switchAuthTab('register')"
                            class="flex-1 py-3 text-center font-bold text-gray-400 border-b-2 border-transparent hover:text-gray-600">Registrarse</button>
                    </div>

                    <!-- Login Form -->
                    <form id="login-form" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico</label>
                            <input type="email" id="login-email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-candelaria-purple"
                                placeholder="tu@email.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                            <input type="password" id="login-password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-candelaria-purple"
                                placeholder="••••••••">
                        </div>
                        <button type="submit"
                            class="w-full bg-candelaria-purple text-white py-3 rounded-xl font-bold hover:bg-purple-800 transition-all">
                            Iniciar Sesión
                        </button>
                    </form>

                    <!-- Register Form -->
                    <form id="register-form" class="space-y-4 hidden">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo *</label>
                            <input type="text" id="register-name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-candelaria-purple"
                                placeholder="Tu nombre">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Correo Electrónico *</label>
                            <input type="email" id="register-email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-candelaria-purple"
                                placeholder="tu@email.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono *</label>
                            <input type="tel" id="register-phone" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-candelaria-purple"
                                placeholder="+51 999 999 999">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña *</label>
                            <input type="password" id="register-password" required minlength="6"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-candelaria-purple"
                                placeholder="Mínimo 6 caracteres">
                        </div>
                        <button type="submit"
                            class="w-full bg-candelaria-purple text-white py-3 rounded-xl font-bold hover:bg-purple-800 transition-all">
                            Crear Cuenta
                        </button>
                    </form>

                    <!-- Logged In View - Now just shows logout if they open modal while logged in -->
                    <div id="logged-in-view" class="hidden text-center">
                        <p class="text-gray-500 mb-4">Ya has iniciado sesión</p>
                        <button onclick="closeAuthModal()"
                            class="w-full bg-candelaria-purple text-white py-3 rounded-xl font-bold hover:bg-purple-800 transition-all">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Dropdown (when logged in) -->
    <div id="user-dropdown"
        class="fixed top-20 right-6 bg-white rounded-xl shadow-xl border border-gray-200 w-64 z-50 hidden">
        <div class="p-4 border-b border-gray-100">
            <p class="font-bold text-gray-900" id="dropdown-user-name"></p>
            <p class="text-sm text-gray-500" id="dropdown-user-email"></p>
        </div>
        <div class="p-2">
            <a href="../../perfil.php"
                class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-purple-50 text-gray-700">
                <i data-lucide="user" class="w-5 h-5"></i>
                Mi Perfil
            </a>
            <button onclick="logout()"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-red-50 text-red-600">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                Cerrar Sesión
            </button>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-candelaria-purple text-white shadow-lg sticky top-0 z-40">
        <div class="bg-purple-950 text-xs py-1 text-center text-purple-200">
            Festividad de la Virgen de la Candelaria 2025 - Del 2 al 11 de Febrero
        </div>
        <div class="w-full px-6 md:px-12 py-5">
            <div class="flex justify-between items-center">
                <a href="../../index.php" class="flex items-center cursor-pointer group">
                    <img src="../../principal/virgencandelariaa.png" alt="Candelaria"
                        class="h-10 md:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                </a>
                <div class="flex items-center gap-6">
                    <nav class="hidden md:flex items-center gap-2">
                        <a href="../index.php" class="nav-link-custom">Servicios</a>
                        <a href="../../cultura/cultura.html" class="nav-link-custom">Cultura</a>
                        <a href="../../horarios_y_danzas/index.php" class="nav-link-custom">Horarios</a>
                    </nav>
                    <!-- User Login Button -->
                    <button id="user-btn" onclick="toggleAuthModal()" class="user-btn">
                        <i data-lucide="user" class="w-5 h-5"></i>
                        <span id="user-btn-text">Iniciar Sesión</span>
                    </button>
                    <a href="../../horarios_y_danzas/index.php" class="btn-live">
                        <div class="live-dot"></div>
                        <span>EN TIEMPO REAL</span>
                    </a>
                </div>
            </div>
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
                    <i data-lucide="loader-2" class="w-12 h-12 mx-auto mb-4 animate-spin text-candelaria-purple"></i>
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
    <footer class="bg-gray-900 text-white mt-16 border-t-4 border-candelaria-gold">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-500">
                &copy; 2025 Gobierno Regional de Puno & Comité de Salvaguardia. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

    <script>
        // State
        let hotel = null;
        let rooms = [];
        let selectedRoom = null;
        let checkinDate = null;
        let checkoutDate = null;
        let mapInstance = null;
        let currentUser = null; // User authentication state

        // Helper to fix image paths
        function fixImagePath(url) {
            if (!url) return '';
            if (url.startsWith('http') || url.startsWith('data:')) return url;
            if (url.startsWith('assets/')) return '../../../' + url;
            return url;
        }

        // Get hotel ID from URL
        const urlParams = new URLSearchParams(window.location.search);
        const hotelId = urlParams.get('id');

        if (!hotelId) {
            window.location.href = '../index.php';
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', async () => {
            lucide.createIcons();
            checkAuthStatus(); // Check if user is logged in
            await loadHotelData();
            initDatePickers();
            setupAuthForms();
            loadReviews(); // Load ratings and reviews
            setupGalleryCarousel(); // Setup photo carousel
        });

        // ============================================
        // AUTHENTICATION FUNCTIONS
        // ============================================

        function checkAuthStatus() {
            const token = localStorage.getItem('clientToken');
            const userData = localStorage.getItem('clientUser');

            if (token && userData) {
                try {
                    currentUser = JSON.parse(userData);
                    updateUserUI();
                } catch (e) {
                    logout();
                }
            }
        }

        function updateUserUI() {
            const btn = document.getElementById('user-btn');
            const btnText = document.getElementById('user-btn-text');

            if (currentUser) {
                btn.classList.add('logged-in');
                btnText.textContent = currentUser.nombre.split(' ')[0]; // First name only

                // Update reservation section if visible
                updateReservationSection();
            } else {
                btn.classList.remove('logged-in');
                btnText.textContent = 'Iniciar Sesión';
            }
            lucide.createIcons();
        }

        function updateReservationSection() {
            const loginRequired = document.getElementById('login-required-section');
            const formContainer = document.getElementById('reservation-form-container');

            if (currentUser) {
                loginRequired?.classList.add('hidden');
                formContainer?.classList.remove('hidden');
                const reservingAs = document.getElementById('reserving-as');
                if (reservingAs) {
                    reservingAs.textContent = `${currentUser.nombre} (${currentUser.email})`;
                }
            } else {
                loginRequired?.classList.remove('hidden');
                formContainer?.classList.add('hidden');
            }
            lucide.createIcons();
        }

        function toggleAuthModal() {
            if (currentUser) {
                // Show dropdown instead of modal when logged in
                const dropdown = document.getElementById('user-dropdown');
                dropdown.classList.toggle('hidden');

                // Populate dropdown info
                document.getElementById('dropdown-user-name').textContent = currentUser.nombre;
                document.getElementById('dropdown-user-email').textContent = currentUser.email;
                lucide.createIcons();
            } else {
                // Show login modal
                const modal = document.getElementById('auth-modal');
                modal.classList.remove('hidden');
                switchAuthTab('login');
                document.getElementById('logged-in-view').classList.add('hidden');
                lucide.createIcons();
            }
        }

        function closeUserDropdown() {
            document.getElementById('user-dropdown').classList.add('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('user-dropdown');
            const btn = document.getElementById('user-btn');
            if (dropdown && btn && !dropdown.contains(e.target) && !btn.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        function closeAuthModal() {
            document.getElementById('auth-modal').classList.add('hidden');
        }

        function switchAuthTab(tab) {
            const loginTab = document.getElementById('tab-login');
            const registerTab = document.getElementById('tab-register');
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');

            if (tab === 'login') {
                loginTab.classList.add('text-candelaria-purple', 'border-candelaria-purple');
                loginTab.classList.remove('text-gray-400', 'border-transparent');
                registerTab.classList.remove('text-candelaria-purple', 'border-candelaria-purple');
                registerTab.classList.add('text-gray-400', 'border-transparent');
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
            } else {
                registerTab.classList.add('text-candelaria-purple', 'border-candelaria-purple');
                registerTab.classList.remove('text-gray-400', 'border-transparent');
                loginTab.classList.remove('text-candelaria-purple', 'border-candelaria-purple');
                loginTab.classList.add('text-gray-400', 'border-transparent');
                registerForm.classList.remove('hidden');
                loginForm.classList.add('hidden');
            }
        }

        function setupAuthForms() {
            // Login form
            document.getElementById('login-form').addEventListener('submit', async (e) => {
                e.preventDefault();

                const email = document.getElementById('login-email').value;
                const password = document.getElementById('login-password').value;

                try {
                    const res = await fetch('../../api/clientes.php?action=login', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ email, password })
                    });

                    const result = await res.json();

                    if (res.ok) {
                        localStorage.setItem('clientToken', result.token);
                        localStorage.setItem('clientUser', JSON.stringify(result.cliente));
                        currentUser = result.cliente;
                        closeAuthModal();
                        updateUserUI();
                        showToast('¡Bienvenido ' + currentUser.nombre + '!', 'success');
                    } else {
                        showToast(result.message || 'Error de autenticación', 'error');
                    }
                } catch (error) {
                    showToast('Error de conexión', 'error');
                }
            });

            // Register form
            document.getElementById('register-form').addEventListener('submit', async (e) => {
                e.preventDefault();

                const data = {
                    nombre: document.getElementById('register-name').value,
                    email: document.getElementById('register-email').value,
                    telefono: document.getElementById('register-phone').value,
                    password: document.getElementById('register-password').value
                };

                try {
                    const res = await fetch('../../api/clientes.php?action=register', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    });

                    const result = await res.json();

                    if (res.ok) {
                        localStorage.setItem('clientToken', result.token);
                        localStorage.setItem('clientUser', JSON.stringify(result.cliente));
                        currentUser = result.cliente;
                        closeAuthModal();
                        updateUserUI();
                        showToast('¡Cuenta creada exitosamente!', 'success');
                    } else {
                        showToast(result.message || 'Error al registrar', 'error');
                    }
                } catch (error) {
                    showToast('Error de conexión', 'error');
                }
            });
        }

        function logout() {
            localStorage.removeItem('clientToken');
            localStorage.removeItem('clientUser');
            currentUser = null;
            closeAuthModal();
            updateUserUI();
            showToast('Sesión cerrada', 'info');
        }

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

                if (!hotel) throw new Error('Hotel no encontrado');

                // Parse JSON fields
                if (typeof hotel.servicios === 'string') {
                    try { hotel.servicios = JSON.parse(hotel.servicios); } catch (e) { hotel.servicios = []; }
                }
                if (typeof hotel.imagenes === 'string') {
                    try { hotel.imagenes = JSON.parse(hotel.imagenes); } catch (e) { hotel.imagenes = []; }
                }

                // Fetch rooms
                const roomsRes = await fetch(`../../api/habitaciones.php?hospedaje_id=${hotelId}`);
                if (roomsRes.ok) {
                    rooms = await roomsRes.json();
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

                // Render everything
                renderHotel();
                renderRooms();
                initMap();
                loadReviews(); // Load real ratings

                // Show content
                document.getElementById('loading-state').classList.add('hidden');
                document.getElementById('main-content').classList.remove('hidden');

            } catch (error) {
                console.error('Error loading hotel:', error);
                document.getElementById('loading-state').innerHTML = `
                    <div class="text-center py-20">
                        <i data-lucide="alert-circle" class="w-16 h-16 mx-auto text-red-500 mb-4"></i>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Hotel no encontrado</h2>
                        <p class="text-gray-600 mb-6">El hospedaje que buscas no existe o ha sido eliminado.</p>
                        <a href="../index.php" class="inline-block bg-candelaria-purple text-white px-6 py-3 rounded-full font-bold">
                            Volver a Servicios
                        </a>
                    </div>
                `;
                lucide.createIcons();
            }
        }

        // Render hotel info
        function renderHotel() {
            document.title = `Candelaria 2025 | ${hotel.nombre}`;
            document.getElementById('breadcrumb-name').textContent = hotel.nombre;
            document.getElementById('hotel-name').textContent = hotel.nombre;
            document.getElementById('hotel-type').textContent = hotel.tipo || 'Hotel';
            document.getElementById('hotel-location').textContent = hotel.ubicacion;
            document.getElementById('hotel-capacity').textContent = hotel.capacidad || '50';
            document.getElementById('hotel-description').textContent = hotel.descripcion || 'Sin descripción disponible';
            document.getElementById('hotel-rating').textContent = parseFloat(hotel.calificacion || 4.5).toFixed(1);
            document.getElementById('map-address').querySelector('span').textContent = hotel.ubicacion;

            // Gallery
            const rawImages = hotel.imagenes && hotel.imagenes.length > 0
                ? hotel.imagenes
                : ['https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800'];

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

            if (!currentUser) {
                showToast('Debes iniciar sesión para reservar', 'warning');
                toggleAuthModal();
                return;
            }

            const token = localStorage.getItem('clientToken');

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
                    body: JSON.stringify(formData)
                });

                const result = await res.json();

                if (res.ok) {
                    showToast('¡Reservación creada exitosamente!', 'success');

                    // Show confirmation
                    document.getElementById('reservation-section').innerHTML = `
                        <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="check-circle" class="w-10 h-10 text-green-500"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">¡Reservación Confirmada!</h2>
                            <p class="text-gray-600 mb-6">Tu reservación #${result.id} ha sido creada exitosamente. Hemos enviado los detalles a <strong>${currentUser.email}</strong></p>
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
            if (currentUser) {
                const userHasRated = data.reviews && data.reviews.some(r => r.cliente_id == currentUser.id);

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

            const token = localStorage.getItem('clientToken');
            const comment = document.getElementById('rate-comment').value;

            try {
                const res = await fetch('../../api/calificaciones.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify({
                        hospedaje_id: parseInt(hotelId),
                        puntuacion: userRating,
                        comentario: comment
                    })
                });

                if (res.ok) {
                    showToast('¡Gracias por tu opinión!', 'success');
                    document.getElementById('rate-comment').value = '';
                    userRating = 0;
                    setRating(0);
                    loadReviews();
                } else {
                    const err = await res.json();
                    showToast(err.message || 'Error al enviar', 'error');
                }
            } catch (e) {
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
            mainImg.src = galleryImages[currentGalleryIndex];

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
</body>

</html>