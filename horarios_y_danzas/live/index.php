<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candelaria Live - Horario en Tiempo Real</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
    
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Tailwind Config -->
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#4c1d95",
                        "primary-light": "#5b21b6",
                        "accent": "#fbbf24",
                        "accent-dark": "#f59e0b",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="font-display bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">
    
    <?php include '../../includes/auth-header.php'; ?>
    
    <!-- Top Navigation -->
    <header class="sticky top-0 z-50 w-full border-b border-gray-200 bg-white shadow-sm">
        <div class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto w-full">
            <div class="flex items-center gap-8">
                <a class="flex items-center gap-3 text-primary hover:opacity-80 transition-opacity" href="../../index.php">
                    <div class="text-accent">
                        <span class="material-symbols-outlined text-4xl">festival</span>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-gray-900">Candelaria Live</h2>
                </a>
                <nav class="hidden lg:flex items-center gap-8">
                    <a class="text-primary font-bold text-sm leading-normal" href="index.php">Horario</a>
                    <a class="text-gray-600 hover:text-primary text-sm font-medium transition-colors" href="../../live-platform/index.php">Livestream</a>
                    <a class="text-gray-600 hover:text-primary text-sm font-medium transition-colors" href="../mapa/index.html">Mapa</a>
                    <a class="text-gray-600 hover:text-primary text-sm font-medium transition-colors" href="../index.php">Resultados</a>
                </nav>
            </div>
            <div class="flex items-center gap-6">
                <label class="hidden md:flex flex-col min-w-40 !h-10 max-w-64 relative group">
                    <div class="flex w-full flex-1 items-center rounded-xl h-full bg-gray-100 border border-gray-200 focus-within:border-primary transition-all">
                        <div class="text-gray-400 flex items-center justify-center pl-3">
                            <span class="material-symbols-outlined text-[20px]">search</span>
                        </div>
                        <input id="search-input" class="w-full bg-transparent border-none text-gray-900 placeholder:text-gray-400 px-3 focus:ring-0 text-sm" placeholder="Buscar conjunto..."/>
                    </div>
                </label>
                <?= getAuthButtonHTML() ?>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="flex-1 flex flex-col items-center w-full px-4 sm:px-6 py-8">
        <div class="w-full max-w-4xl flex flex-col gap-8">
            <!-- Heading & Tabs -->
            <div class="flex flex-col gap-6">
                <div class="flex flex-wrap justify-between items-end gap-4">
                    <div class="flex flex-col gap-2">
                        <h1 class="text-gray-900 text-3xl md:text-5xl font-black tracking-tight">Horario en Tiempo Real</h1>
                        <p class="text-gray-600 text-lg max-w-2xl">Sigue el orden oficial de presentación para la Festividad de la Virgen de la Candelaria.</p>
                    </div>
                    <!-- Date Toggle -->
                    <div class="bg-white p-1 rounded-full inline-flex border border-gray-200 shadow-sm self-start md:self-end">
                        <button onclick="changeDay(1)" class="day-btn px-5 py-2 rounded-full text-sm font-bold text-gray-600 hover:text-primary transition-colors" data-day="1">
                            Día 1
                        </button>
                        <button onclick="changeDay(2)" class="day-btn px-5 py-2 rounded-full bg-primary text-white shadow-md text-sm font-bold" data-day="2">
                            Día 2: Trajes de Luces
                        </button>
                        <button onclick="changeDay(3)" class="day-btn px-5 py-2 rounded-full text-sm font-bold text-gray-600 hover:text-primary transition-colors" data-day="3">
                            Día 3
                        </button>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="flex flex-col gap-1 rounded-2xl p-5 bg-white border border-gray-200 shadow-sm">
                        <div class="flex items-center gap-2 text-gray-500 mb-1">
                            <span class="material-symbols-outlined text-xl">groups</span>
                            <span class="text-sm font-bold uppercase tracking-wider">Participación</span>
                        </div>
                        <p class="text-gray-900 text-3xl font-bold"><span id="performed-count">0</span> <span class="text-gray-500 text-xl font-medium">/ <span id="total-count">0</span></span></p>
                        <p class="text-xs text-gray-500">Grupos presentados</p>
                    </div>
                    <div class="flex flex-col gap-1 rounded-2xl p-5 bg-white border border-gray-200 shadow-sm">
                        <div class="flex items-center gap-2 text-gray-500 mb-1">
                            <span class="material-symbols-outlined text-xl">schedule</span>
                            <span class="text-sm font-bold uppercase tracking-wider">Retraso Prom.</span>
                        </div>
                        <p class="text-primary text-3xl font-bold" id="avg-delay">+0 min</p>
                        <p class="text-xs text-gray-500">Retraso promedio</p>
                    </div>
                    <div class="flex flex-col gap-1 rounded-2xl p-5 bg-white border border-gray-200 shadow-sm sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center gap-2 text-gray-500 mb-1">
                            <span class="material-symbols-outlined text-xl">sunny</span>
                            <span class="text-sm font-bold uppercase tracking-wider">Clima (Puno)</span>
                        </div>
                        <p class="text-gray-900 text-3xl font-bold" id="weather-temp">14°C</p>
                        <p class="text-xs text-gray-500">Parcialmente Nublado</p>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Search -->
            <div class="md:hidden">
                <label class="flex flex-col w-full h-12">
                    <div class="flex w-full flex-1 items-center rounded-xl h-full bg-gray-100 border border-gray-200">
                        <div class="text-gray-400 flex items-center justify-center pl-4">
                            <span class="material-symbols-outlined">search</span>
                        </div>
                        <input id="search-input-mobile" class="w-full bg-transparent border-none text-gray-900 placeholder:text-gray-400 px-4 focus:ring-0" placeholder="Buscar conjunto..."/>
                    </div>
                </label>
            </div>
            
            <!-- Timeline Section -->
            <div class="relative mt-4">
                <!-- Vertical Line -->
                <div class="absolute left-6 top-4 bottom-0 w-0.5 bg-gradient-to-b from-border-dark via-border-dark to-transparent"></div>
                
                <div id="timeline-container" class="flex flex-col gap-10">
                    <!-- Timeline items will be loaded here -->
                </div>
                
                <div class="flex justify-center py-8">
                    <button id="load-more-btn" onclick="loadMoreGroups()" class="flex items-center gap-2 text-text-muted hover:text-white transition-colors text-sm font-bold uppercase tracking-wide hidden">
                        <span>Cargar más grupos</span>
                        <span class="material-symbols-outlined">expand_more</span>
                    </button>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col items-center justify-center text-center">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-xl font-bold font-heading text-gray-900">Candelaria 2026</span>
                </div>
                <div class="text-gray-500 text-sm mb-6">
                    &copy; 2026 Candela Digital. Todos los derechos reservados.
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="script.js"></script>
    
    <!-- Auth Modal and Dropdown -->
    <?= getAuthModalHTML() ?>
    <?= getAuthJS('../../') ?>
</body>
</html>
