<?php
require_once '../includes/auth-header.php';
require_once 'includes/live-functions.php';

// Get Current Stream (Default to first LIVE one, or first generic)
$currentId = $_GET['id'] ?? null;
$liveStreams = getStreams('live');
$allStreams = getStreams();

if ($currentId) {
    $currentStream = getStreamById($currentId);
} else {
    // Default: Pick first live, or just first available
    $currentStream = !empty($liveStreams) ? reset($liveStreams) : (!empty($allStreams) ? reset($allStreams) : null);
}

// Separate current from recommendations
$recommendations = array_filter($allStreams, fn($s) => $s['id'] !== ($currentStream['id'] ?? ''));
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En Vivo - Candelaria 2026</title>

    <!-- Fonts & Icons from Main Project -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        candelaria: {
                            purple: '#4c1d95',
                            gold: '#fbbf24',
                            lake: '#0ea5e9',
                            light: '#f5f3ff',
                            dark: '#0f172a'
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

    <!-- Lucide Icons for Auth -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Custom Live Styles -->
    <link rel="stylesheet" href="./style.css">
    <!-- Spark Effect -->
    <link rel="stylesheet" href="../assets/css/sparks.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #0f172a;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }

        .video-player-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Nav Link Styles from Main */
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
            cursor: pointer;
        }

        .nav-link-custom:hover {
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

        .nav-link-custom:hover::after {
            width: 80%;
        }

        .nav-link-custom.active {
            color: #fbbf24;
        }

        .nav-link-custom.active::after {
            width: 80%;
        }

        /* Map Styles */
        #map-live-container {
            z-index: 1;
            width: 100%;
            height: 100%;
            min-height: 600px;
            /* Ensure height */
        }

        /* Custom Leaflet Control Styles if needed */
        .leaflet-popup-content-wrapper {
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .custom-dance-icon div {
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        /* Custom Secondary Nav for Live Platform */
        .live-nav-bar {
            background: rgba(30, 10, 60, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 76px;
            /* Adjust based on header height 76px */
            z-index: 30;
        }

        .live-nav-item {
            cursor: pointer;
            padding: 0.75rem 1.5rem;
            color: #d8b4fe;
            font-weight: 600;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .live-nav-item:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
        }

        .live-nav-item.active {
            color: #fbbf24;
            border-bottom-color: #fbbf24;
        }
    </style>

    <!-- Standard Header Include -->
    <?php
    $headerDepth = 1;
    $activePage = 'live';
    include '../includes/standard-header.php';
    ?>

    <!-- Secondary Navigation Bar (Platform Specific) -->
    <div class="live-nav-bar shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-center md:justify-start gap-2 overflow-x-auto">
                <div id="tab-live" class="live-nav-item active" onclick="switchView('live')">
                    <i class="fas fa-broadcast-tower"></i> En Vivo
                </div>
                <div id="tab-scores" class="live-nav-item" onclick="switchView('scores')">
                    <i class="fas fa-list-ol"></i> Puntajes
                </div>
                <div id="tab-map" class="live-nav-item" onclick="switchView('map')">
                    <i class="fas fa-map-marked-alt"></i> Mapa TR
                </div>
            </div>
        </div>
    </div>

    <!-- Main Live View -->
    <!-- Main Live View -->
    <div class="live-container">
        <!-- Center Stage: Video & Info -->
        <main class="main-stage custom-scrollbar">
            <div id="view-live" class="h-full">

                <?php if ($currentStream): ?>
                    <!-- Video Player -->
                    <div class="video-player-container">
                        <?php if ($currentStream['status'] === 'live'): ?>
                            <div class="live-badge-overlay animate-pulse">
                                <span class="w-2 h-2 rounded-full bg-white"></span>
                                EN VIVO
                            </div>
                        <?php endif; ?>

                        <!-- Render Real Embed -->
                        <div class="absolute inset-0 bg-black">
                            <?= renderEmbed($currentStream) ?>
                        </div>

                        <div class="viewers-badge" id="viewer-count">
                            <i class="fas fa-user-friends text-candelaria-gold"></i>
                            <span id="count-val"><?= number_format($currentStream['viewers']) ?></span> Viewers
                        </div>
                    </div>

                    <!-- Content Wrapper -->
                    <div class="stage-content">
                        <!-- Stream Info -->
                        <div class="stream-info">
                            <div class="flex justify-between items-start">
                                <div class="flex gap-4">
                                    <div class="relative">
                                        <img src="<?= htmlspecialchars($currentStream['thumbnail']) ?>" alt="Avatar"
                                            class="streamer-avatar bg-purple-900 object-cover">
                                        <?php if ($currentStream['status'] === 'live'): ?>
                                            <span
                                                class="absolute bottom-0 right-0 w-3 h-3 bg-red-500 border border-black rounded-full animate-ping"></span>
                                            <span
                                                class="absolute bottom-0 right-0 w-3 h-3 bg-red-500 border border-black rounded-full"></span>
                                        <?php else: ?>
                                            <span
                                                class="absolute bottom-0 right-0 w-3 h-3 bg-gray-500 border border-black rounded-full"></span>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h1 class="stream-title"><?= htmlspecialchars($currentStream['title']) ?></h1>
                                        <p class="text-purple-300 font-medium">
                                            <?= htmlspecialchars($currentStream['streamer']) ?>
                                            <i class="fas fa-check-circle text-blue-400 text-xs ml-1"></i>
                                        </p>
                                        <div class="flex gap-2 mt-2">
                                            <span
                                                class="text-xs bg-purple-900/60 text-purple-200 px-2 py-1 rounded"><?= htmlspecialchars($currentStream['category']) ?></span>
                                            <span
                                                class="text-xs bg-purple-900/60 text-purple-200 px-2 py-1 rounded uppercase"><?= htmlspecialchars($currentStream['platform']) ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-3">

                                    <button
                                        class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold transition-colors">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <div class="flex flex-col items-center justify-center h-full text-center py-20">
                            <i class="fas fa-broadcast-tower text-6xl text-gray-600 mb-4"></i>
                            <h2 class="text-2xl font-bold">No hay transmisiones activas</h2>
                            <p class="text-gray-400">Vuelve más tarde para ver el contenido en vivo.</p>
                        </div>
                    <?php endif; ?>

                    <!-- Recommended Channels -->
                    <div class="recommended-section">
                        <h3 class="section-title text-white">Canales Recomendados</h3>
                        <div class="channels-grid">
                            <?php foreach ($recommendations as $rec): ?>
                                <!-- Channel Card -->
                                <a href="index.php?id=<?= $rec['id'] ?>" class="block">
                                    <div class="channel-card group">
                                        <div class="card-thumb">
                                            <img src="<?= htmlspecialchars($rec['thumbnail']) ?>"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            <?php if ($rec['status'] === 'live'): ?>
                                                <span class="card-live-badge bg-red-600">LIVE</span>
                                            <?php elseif ($rec['status'] === 'upcoming'): ?>
                                                <span class="card-live-badge bg-blue-600">PROX</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-info">
                                            <div class="w-8 h-8 rounded-full bg-blue-500 overflow-hidden">
                                                <img src="<?= htmlspecialchars($rec['thumbnail']) ?>"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="card-details">
                                                <h4 class="truncate w-32"><?= htmlspecialchars($rec['streamer']) ?></h4>
                                                <p class="truncate w-32 text-xs"><?= htmlspecialchars($rec['title']) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div> <!-- End Stage Content -->

            </div>

            <!-- VIEW: PUNTAJES (Initially Hidden) -->
            <div id="view-scores"
                class="hidden h-full flex flex-col overflow-y-auto custom-scrollbar p-4 md:p-6 bg-gray-900">
                <div class="max-w-6xl mx-auto w-full">
                    <!-- Header -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-4 md:mb-6 gap-4">
                        <h2 class="text-xl md:text-3xl font-bold font-heading text-white flex items-center gap-3">
                            <i class="fas fa-trophy text-candelaria-gold"></i>
                            Resultados y Puntajes
                        </h2>
                        <!-- Category Tabs -->
                        <div class="bg-gray-800 p-1 rounded-lg inline-flex flex-wrap justify-center">
                            <button id="btn-autoctonos" onclick="switchScoreType('autoctonos')"
                                class="px-3 md:px-4 py-2 rounded-md font-medium text-sm transition-all duration-200 bg-purple-600 text-white shadow-lg">
                                Autóctonos
                            </button>
                            <button id="btn-luces" onclick="switchScoreType('luces')"
                                class="px-3 md:px-4 py-2 rounded-md font-medium text-sm transition-all duration-200 text-gray-300 hover:text-white">
                                Trajes de Luces
                            </button>
                            <div class="w-px h-6 bg-gray-600 mx-2 self-center hidden md:block"></div>
                            <button onclick="refreshScores()" id="btn-refresh"
                                class="px-3 py-2 rounded-md text-gray-400 hover:text-candelaria-gold hover:bg-gray-700 transition-colors"
                                title="Actualizar Puntajes">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Filter Bar for Autoctonos -->
                    <div id="filter-bar-autoctonos" class="flex flex-wrap gap-2 mb-4 items-center">
                        <span class="text-gray-400 text-sm"><i class="fas fa-filter mr-1"></i>Filtrar:</span>
                        <button id="btn-date-all" onclick="filterByDate('all')"
                            class="px-3 py-1 rounded-lg text-sm font-medium bg-purple-600 text-white">
                            Todos
                        </button>
                        <button id="btn-date-day1" onclick="filterByDate('2026-01-31')"
                            class="px-3 py-1 rounded-lg text-sm font-medium bg-gray-700 text-gray-300 hover:bg-gray-600">
                            Día 1 (31 Ene)
                        </button>
                        <button id="btn-date-day2" onclick="filterByDate('2026-02-01')"
                            class="px-3 py-1 rounded-lg text-sm font-medium bg-gray-700 text-gray-300 hover:bg-gray-600">
                            Día 2 (1 Feb)
                        </button>
                        <div class="flex-grow"></div>
                        <button id="btn-order-toggle" onclick="toggleOrderBy()"
                            class="px-3 py-1 rounded-lg text-sm font-medium bg-gray-700 text-gray-300 hover:bg-gray-600 flex items-center gap-1"
                            title="Cambiar ordenamiento">
                            <i class="fas fa-sort-amount-down"></i>
                            <span id="order-label">Por Puntaje</span>
                        </button>
                    </div>

                    <!-- Scores List -->
                    <div class="bg-gray-800/50 border border-gray-700 rounded-xl overflow-hidden backdrop-blur-sm">
                        <div
                            class="grid grid-cols-12 bg-purple-900/40 p-3 md:p-4 border-b border-gray-700 text-purple-200 font-semibold text-xs md:text-sm uppercase tracking-wider">
                            <div class="col-span-4 md:col-span-5 pl-2 md:pl-4">Conjunto</div>
                            <div class="col-span-2 text-center">Parada</div>
                            <div class="col-span-2 text-center">Estadio</div>
                            <div class="col-span-4 md:col-span-3 text-center">Final</div>
                        </div>
                        <div id="scores-list" class="divide-y divide-gray-700/50">
                            <div class="p-8 text-center text-gray-400">
                                <i class="fas fa-circle-notch fa-spin text-2xl mb-2"></i>
                                <p>Cargando puntajes...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VIEW: MAPA (Initially Hidden) -->
            <div id="view-map" class="hidden h-full flex flex-col relative bg-gray-900">
                <!-- Map Header Overlay -->
                <div
                    class="absolute top-4 left-4 right-4 z-[9999] pointer-events-none flex justify-between items-start">
                    <div
                        class="bg-white/90 backdrop-blur-md text-gray-900 px-4 py-2 rounded-lg shadow-lg border border-white/20 pointer-events-auto">
                        <h3 class="font-bold flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-candelaria-red"></i>
                            Ubicación en Tiempo Real
                        </h3>
                        <p class="text-xs text-gray-600">Sigue el recorrido de las danzas</p>
                    </div>
                </div>
                <!-- Leaflet Map Container -->
                <div id="map-live-container" class="w-full h-full"></div>
            </div>

        </main>

        <!-- Right Side: Chat -->
        <aside id="chat-sidebar" class="chat-sidebar">
            <div class="chat-header text-white">
                <span><i class="fas fa-comment-alt text-candelaria-gold mr-2"></i> Chat en Vivo</span>
                <i class="fas fa-ellipsis-v text-gray-400 cursor-pointer hover:text-white"></i>
            </div>

            <div id="chat-messages" class="chat-messages custom-scrollbar">
                <!-- Messages loaded via API -->
            </div>

            <!-- Hidden stream ID for JS -->
            <input type="hidden" id="stream-id" value="<?= htmlspecialchars($currentStream['id'] ?? 'default') ?>">

            <div class="chat-input-area">
                <?php
                $isLoggedIn = isset($_COOKIE['sb-access-token']) && !empty($_COOKIE['sb-access-token']);
                if ($isLoggedIn):
                    ?>
                    <input type="text" id="chat-input" class="chat-input text-white" placeholder="Enviar mensaje..."
                        maxlength="200">
                    <div class="flex justify-between items-center mt-2 px-1">
                        <div id="char-counter" class="text-xs text-gray-500">0/200</div>
                        <button class="text-candelaria-gold hover:text-white transition-colors">
                            <i class="fas fa-smile text-lg"></i>
                        </button>
                    </div>
                <?php else: ?>
                    <div id="login-prompt" class="text-center py-4">
                        <p class="text-gray-400 text-sm mb-3">
                            <i class="fas fa-lock mr-2"></i>Inicia sesión para poder chatear
                        </p>
                        <button onclick="openAuthModal()"
                            class="bg-candelaria-gold text-candelaria-purple px-4 py-2 rounded-lg font-bold text-sm hover:bg-yellow-400 transition-colors">
                            <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                        </button>
                    </div>
                    <!-- Hidden input for JS compatibility -->
                    <input type="hidden" id="chat-input" disabled>
                <?php endif; ?>
            </div>
        </aside>
    </div>


    <!-- Auth Modal and Dropdown (MUST be before live script) -->
    <?= getAuthModalHTML() ?>
    <?= getAuthJS() ?>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Live Script (after auth is loaded) -->
    <script src="./script.js?v=<?= time() ?>"></script>
    <!-- Spark Effect Script -->
    <script src="../assets/js/spark-effect.js"></script>
</body>

</html>