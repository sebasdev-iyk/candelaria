<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Noticias - Candelaria 2025</title>

    <!-- Fuentes de Google -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

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
            background-color: #f8fafc;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Montserrat', sans-serif;
        }

        /* Navigation Styles (Reused) */
        .nav-link-custom {
            color: #e9d5ff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 16px;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link-custom:hover,
        .nav-link-custom.active {
            color: #fbbf24;
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: #fbbf24;
            transition: width 0.3s ease;
        }

        .nav-link-custom:hover::after,
        .nav-link-custom.active::after {
            width: 80%;
        }

        .btn-live {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            animation: pulseLive 2s infinite;
        }

        @keyframes pulseLive {

            0%,
            100% {
                box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            }

            50% {
                box-shadow: 0 4px 25px rgba(220, 38, 38, 0.7);
            }
        }

        .live-dot {
            width: 8px;
            height: 8px;
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

        /* News Cards */
        .news-card-img {
            transition: transform 0.5s ease;
        }

        .news-card:hover .news-card-img {
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <header class="bg-candelaria-purple text-white shadow-lg sticky top-0 z-50">
        <div class="bg-purple-950 text-xs py-1 text-center text-purple-200">
            Festividad de la Virgen de la Candelaria 2025 - Del 2 al 11 de Febrero
        </div>
        <div class="w-full px-4 md:px-12 py-4">
            <div class="flex justify-between items-center">
                <a href="../index.php" class="flex items-center group">
                    <img src="../principal/virgencandelariaa.png" alt="Candelaria"
                        class="h-10 md:h-12 w-auto object-contain">
                </a>

                <div class="flex items-center gap-6">
                    <nav class="hidden md:flex items-center gap-1">
                        <a href="../servicios/index.php" class="nav-link-custom">Servicios</a>
                        <a href="../cultura/cultura.html" class="nav-link-custom">Cultura</a>
                        <a href="../horarios_y_danzas/index.php" class="nav-link-custom">Horarios</a>
                        <a href="index.php" class="nav-link-custom active">Noticias</a>
                    </nav>

                    <?php include '../includes/auth-header.php'; ?>
                    <?= getAuthButtonHTML() ?>

                    <a href="../horarios_y_danzas/index.php" class="btn-live text-white font-bold no-underline">
                        <div class="live-dot"></div> EN VIVO
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Breaking News Ticker -->
    <div class="bg-gray-900 border-b border-gray-800">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row">
            <div
                class="bg-red-600 text-white font-bold px-6 py-3 text-sm tracking-wide uppercase flex items-center shrink-0">
                Noticias de última hora
            </div>
            <div class="flex-1 bg-gray-900 text-white px-6 py-3 flex items-center min-w-0">
                <div class="truncate text-sm font-medium">
                    <span class="text-red-400 mr-2">Hace 13 horas:</span>
                    Congreso de la Diablada inició en Juli como previa a la Festividad de la Virgen de la Candelaria
                    2026
                </div>
                <a href="#" class="ml-auto text-xs text-gray-400 hover:text-white uppercase font-bold shrink-0 pl-4">Ver
                    todo <i class="fas fa-arrow-right ml-1"></i></a>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Hero Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-1 lg:gap-1 h-auto lg:h-[500px] mb-12">

            <!-- Main Story (Left, Spans 2 Cols) -->
            <a href="detalle.php?id=1"
                class="lg:col-span-2 relative group overflow-hidden news-card block h-[300px] lg:h-full">
                <!-- Using placeholder if real not available -->
                <img src="../principal/Festividad.png" class="absolute inset-0 w-full h-full object-cover news-card-img"
                    alt="Main News">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-90"></div>

                <div class="absolute bottom-0 left-0 p-6 md:p-8 w-full">
                    <span
                        class="inline-block bg-candelaria-gold text-black text-xs font-bold px-2 py-1 rounded mb-2 uppercase">Cultura</span>
                    <p class="text-gray-300 text-xs mb-2">Hace 47 minutos</p>
                    <h2
                        class="text-2xl md:text-3xl lg:text-4xl font-bold text-white leading-tight font-heading mb-2 group-hover:underline decoration-candelaria-gold underline-offset-4">
                        La Diablada Aymara en Juli: origen histórico de los diablos del altiplano
                    </h2>
                    <p class="text-gray-300 text-sm md:text-base line-clamp-2 md:line-clamp-none max-w-2xl">
                        Hablar de diablos y diabladar implica comprender un profundo sincretismo cultural que se remonta
                        a siglos de historia en la región altiplánica...
                    </p>
                </div>
            </a>

            <!-- Side Stories (Right Column) -->
            <div class="grid grid-cols-1 grid-rows-2 gap-1 h-[400px] lg:h-full">

                <!-- Top Side Story -->
                <a href="detalle.php?id=2" class="relative group overflow-hidden news-card block h-full">
                    <!-- Gradient overlay for text readability -->
                    <img src="https://picsum.photos/seed/puno1/600/400"
                        class="absolute inset-0 w-full h-full object-cover news-card-img" alt="News 2">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 p-5 w-full">
                        <span
                            class="inline-block bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded mb-2 uppercase">Política</span>
                        <p class="text-gray-300 text-xs mb-1">Hace 13 horas</p>
                        <h3
                            class="text-xl font-bold text-white font-heading leading-tight group-hover:text-candelaria-gold transition-colors">
                            Ni partidos ni candidatos: la Candelaria 2026 se blinda
                        </h3>
                    </div>
                </a>

                <!-- Bottom Side Story -->
                <a href="detalle.php?id=3" class="relative group overflow-hidden news-card block h-full">
                    <img src="https://picsum.photos/seed/diablada/600/400"
                        class="absolute inset-0 w-full h-full object-cover news-card-img" alt="News 3">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 p-5 w-full">
                        <span
                            class="inline-block bg-purple-600 text-white text-xs font-bold px-2 py-1 rounded mb-2 uppercase">Actualidad</span>
                        <p class="text-gray-300 text-xs mb-1">Hace 13 horas</p>
                        <h3
                            class="text-xl font-bold text-white font-heading leading-tight group-hover:text-candelaria-gold transition-colors">
                            Congreso de la Diablada inició en Juli con gran acogida
                        </h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- Section: Vive Puno -->
        <div class="mb-8 flex items-center gap-3">
            <i class="fas fa-newspaper text-candelaria-purple text-2xl"></i>
            <h2 class="text-2xl font-bold font-heading text-gray-800 uppercase tracking-wide">Vive Puno</h2>
            <div class="flex-1 h-1 bg-gradient-to-r from-gray-200 to-transparent ml-4"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- News Item -->
            <article
                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                <div class="h-48 relative overflow-hidden">
                    <img src="https://picsum.photos/seed/tunel/400/300"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1 rounded shadow-sm text-gray-800">
                        Infraestructura
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <span class="text-xs text-gray-500 font-medium mb-2">Hace 2 días</span>
                    <h3
                        class="text-lg font-bold text-gray-800 mb-2 leading-tight group-hover:text-candelaria-purple transition-colors">
                        <a href="detalle.php?id=4">Perú rompe barreras: el Túnel Ollachea conquista un Récord
                            Guinness</a>
                    </h3>
                    <p class="text-gray-500 text-sm line-clamp-3 mb-4">
                        La megaobra pone a Puno en la mira del mundo con una ingeniería desafiante...
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs text-gray-400">Por Redacción</span>
                        <a href="detalle.php?id=4" class="text-candelaria-purple text-sm font-bold hover:underline">Leer
                            más</a>
                    </div>
                </div>
            </article>

            <!-- News Item -->
            <article
                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                <div class="h-48 relative overflow-hidden">
                    <img src="https://picsum.photos/seed/titicaca/400/300"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1 rounded shadow-sm text-gray-800">
                        Naturaleza
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <span class="text-xs text-gray-500 font-medium mb-2">Hace 1 semana</span>
                    <h3
                        class="text-lg font-bold text-gray-800 mb-2 leading-tight group-hover:text-candelaria-purple transition-colors">
                        <a href="detalle.php?id=5">El Lago Titicaca ya tiene derechos gracias a lucha de sus
                            guardianas</a>
                    </h3>
                    <p class="text-gray-500 text-sm line-clamp-3 mb-4">
                        Histórico reconocimiento legal para el lago navegable más alto del mundo...
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs text-gray-400">Por Redacción</span>
                        <a href="detalle.php?id=5" class="text-candelaria-purple text-sm font-bold hover:underline">Leer
                            más</a>
                    </div>
                </div>
            </article>

            <!-- News Item -->
            <article
                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                <div class="h-48 relative overflow-hidden">
                    <img src="https://picsum.photos/seed/azangaro/400/300"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1 rounded shadow-sm text-gray-800">
                        Religión
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <span class="text-xs text-gray-500 font-medium mb-2">Hace 2 semanas</span>
                    <h3
                        class="text-lg font-bold text-gray-800 mb-2 leading-tight group-hover:text-candelaria-purple transition-colors">
                        <a href="detalle.php?id=6">Azángaro se llena de fe y esperanza en procesión del Niño Jesús</a>
                    </h3>
                    <p class="text-gray-500 text-sm line-clamp-3 mb-4">
                        Miles de fieles se congregaron para la tradicional procesión anual...
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs text-gray-400">Por Redacción</span>
                        <a href="detalle.php?id=6" class="text-candelaria-purple text-sm font-bold hover:underline">Leer
                            más</a>
                    </div>
                </div>
            </article>

            <!-- News Item -->
            <article
                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                <div class="h-48 relative overflow-hidden">
                    <img src="https://picsum.photos/seed/asillo/400/300"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute top-3 left-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1 rounded shadow-sm text-gray-800">
                        Tradición
                    </div>
                </div>
                <div class="p-5 flex-1 flex flex-col">
                    <span class="text-xs text-gray-500 font-medium mb-2">Hace 4 semanas</span>
                    <h3
                        class="text-lg font-bold text-gray-800 mb-2 leading-tight group-hover:text-candelaria-purple transition-colors">
                        <a href="detalle.php?id=7">Virgen de la Estrella: Asillo rinde homenaje con fervor</a>
                    </h3>
                    <p class="text-gray-500 text-sm line-clamp-3 mb-4">
                        La festividad reunió a danzantes y devotos en una jornada inolvidable...
                    </p>
                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-xs text-gray-400">Por Redacción</span>
                        <a href="detalle.php?id=7" class="text-candelaria-purple text-sm font-bold hover:underline">Leer
                            más</a>
                    </div>
                </div>
            </article>
        </div>

    </main>

    <!-- Footer (Short version) -->
    <footer class="bg-gray-900 text-white mt-12 border-t-4 border-candelaria-gold py-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="flex items-center justify-center gap-2 mb-4">
                <i data-lucide="sparkles" class="w-6 h-6 text-candelaria-gold"></i>
                <span class="text-xl font-bold font-heading">Candelaria 2025</span>
            </div>
            <p class="text-gray-500 text-sm">&copy; 2025 Gobierno Regional de Puno. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>