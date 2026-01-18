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

    <!-- Custom Live Styles -->
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <!-- Header (Consistent with Main Project) -->
    <header
        class="bg-candelaria-purple text-white shadow-lg sticky top-0 z-50 h-[80px] flex items-center justify-between px-6 border-b border-purple-800">
        <div class="flex items-center gap-4">
            <!-- Back to Main -->
            <a href="../index.php" class="text-purple-300 hover:text-white transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>

            <a href="../index.php" class="flex items-center gap-2">
                <img src="../principal/virgencandelariaa.png" alt="Logo" class="h-10 w-auto">
                <span class="font-heading font-bold text-xl tracking-wider text-white hidden md:block">
                    CANDELARIA <span class="text-candelaria-gold">ONE</span>
                </span>
            </a>

            <div class="hidden md:flex ml-8 bg-purple-900/50 rounded-full px-4 py-2 border border-purple-700">
                <i class="fas fa-search text-gray-400 mr-2"></i>
                <input type="text" placeholder="Buscar canal..."
                    class="bg-transparent border-none outline-none text-sm text-white placeholder-gray-400 w-48">
            </div>
        </div>

        <div class="flex items-center gap-6">
            <!-- User Auth Section -->
            <div class="flex items-center">
                <?= getAuthButtonHTML() ?>
            </div>
        </div>
    </header>

    <!-- Main Content Grid -->
    <div class="live-container">

        <!-- Center Stage: Video & Info -->
        <main class="main-stage custom-scrollbar">

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

                    <!-- Fallback Overlay for Controls (Only if needed, usually embeds handle controls) -->
                    <!-- Removed custom controls overlay as real embeds have their own -->

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
                                <button onclick="toggleFollow(this)"
                                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-semibold transition-colors flex items-center gap-2 group">
                                    <i class="far fa-heart group-[:hover]:hidden"></i>
                                    <i class="fas fa-heart hidden group-[:hover]:inline"></i> Seguir
                                </button>
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

        </main>

        <!-- Right Side: Chat -->
        <aside class="chat-sidebar">
            <div class="chat-header text-white">
                <span><i class="fas fa-comment-alt text-candelaria-gold mr-2"></i> Chat en Vivo</span>
                <i class="fas fa-ellipsis-v text-gray-400 cursor-pointer hover:text-white"></i>
            </div>

            <div id="chat-messages" class="chat-messages custom-scrollbar">
                <!-- Messages injected by JS -->
            </div>

            <div class="chat-input-area">
                <input type="text" id="chat-input" class="chat-input" placeholder="Enviar mensaje...">
                <div class="flex justify-between items-center mt-2 px-1">
                    <div class="text-xs text-gray-500">0/200</div>
                    <button class="text-candelaria-gold hover:text-white transition-colors">
                        <i class="fas fa-smile text-lg"></i>
                    </button>
                </div>
            </div>
        </aside>

    </div>

    <!-- Live Script -->
    <script src="./script.js"></script>

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
    </style>
</body>

</html>