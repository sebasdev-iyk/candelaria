<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Robust Database Include
$db_paths = [
    __DIR__ . '/../../php-admin/src/Config/Database.php',       // Local / Standard
    __DIR__ . '/../../candelaria-admin/src/Config/Database.php', // Plesk Alternative
    $_SERVER['DOCUMENT_ROOT'] . '/php-admin/src/Config/Database.php',
    $_SERVER['DOCUMENT_ROOT'] . '/candelaria-admin/src/Config/Database.php'
];

$db_included = false;
foreach ($db_paths as $path) {
    if (file_exists($path)) {
        include_once $path;
        $db_included = true;
        break;
    }
}

if (!$db_included) {
    die("Error Critical: No se pudo encontrar el archivo de configuración de base de datos. Rutas probadas: " . implode(", ", $db_paths));
}

use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

$hero_news = null;
$side_news = [];
$grid_news = [];
$ticker_news = [];

if ($db) {
    // Hero: Latest 1
    $stmt = $db->query("SELECT * FROM noticias ORDER BY fecha_publicacion DESC LIMIT 1");
    $hero_news = $stmt->fetch(PDO::FETCH_ASSOC);

    // Side Stories: Next 2 (Offset 1, Limit 2)
    $stmt = $db->query("SELECT * FROM noticias ORDER BY fecha_publicacion DESC LIMIT 2 OFFSET 1");
    $side_news = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Grid: Next 4 (Offset 3, Limit 4)
    $stmt = $db->query("SELECT * FROM noticias ORDER BY fecha_publicacion DESC LIMIT 4 OFFSET 3");
    $grid_news = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ticker: Latest 5
    $stmt = $db->query("SELECT * FROM noticias ORDER BY fecha_publicacion DESC LIMIT 5");
    $ticker_news = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Helpers
function getImg($path)
{
    if (!$path)
        return 'https://picsum.photos/800/600';
    // If path starts with assets/, it's relative to root. 
    // From candelaria/noticias/, we need ../../assets/
    // If it's http, use it.
    if (strpos($path, 'http') === 0)
        return $path;
    return '../../' . $path; // Assuming stored as 'assets/uploads/...'
}

function timeAgo($datetime)
{
    if (!$datetime)
        return '';
    $time = strtotime($datetime);
    $diff = time() - $time;
    if ($diff < 3600)
        return 'Hace ' . floor($diff / 60) . ' min';
    if ($diff < 86400)
        return 'Hace ' . floor($diff / 3600) . ' horas';
    return 'Hace ' . floor($diff / 86400) . ' días';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Noticias - Candelaria 2025</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { candelaria: { purple: '#4c1d95', gold: '#fbbf24', lake: '#0ea5e9', light: '#f5f3ff' } },
                    fontFamily: { sans: ['Open Sans', 'sans-serif'], heading: ['Montserrat', 'sans-serif'] }
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

        .news-card-img {
            transition: transform 0.5s ease;
        }

        .news-card:hover .news-card-img {
            transform: scale(1.05);
        }
    </style>
    <!-- Spark Effect CSS -->
    <link rel="stylesheet" href="../assets/css/sparks.css">
</head>

<body>
    <!-- Navbar -->
    <header class="bg-candelaria-purple text-white shadow-lg sticky top-0 z-50">
        <div class="bg-purple-950 text-xs py-1 text-center text-purple-200">Festividad de la Virgen de la Candelaria
            2025 - Del 2 al 11 de Febrero</div>
        <div class="w-full px-4 md:px-12 h-20 md:h-22 flex items-center">
            <div class="flex justify-between items-center w-full h-full">
                <a href="../index.php" id="logo-container"
                    class="flex items-center group h-full relative spark-container">
                    <img src="../principal/logoc.png" alt="Candelaria"
                        class="h-full w-auto object-contain transition-transform duration-300 group-hover:scale-105 relative z-10">
                </a>
                <div class="flex items-center gap-6">
                    <nav class="hidden md:flex items-center gap-1">
                        <a href="../servicios/index.php" class="nav-link-custom">Servicios</a>
                        <a href="../cultura/cultura.php" class="nav-link-custom">Cultura</a>
                        <a href="../horarios_y_danzas/index.php" class="nav-link-custom">Horarios</a>
                        <a href="index.php" class="nav-link-custom active">Noticias</a>
                    </nav>
                    <?php include '../includes/auth-header.php'; ?>
                    <?= getAuthButtonHTML() ?>
                    <a href="../live-platform/index.php" class="btn-live text-white font-bold no-underline">
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
                Noticias de última hora</div>
            <div class="flex-1 bg-gray-900 text-white px-6 py-3 flex items-center min-w-0 overflow-hidden">
                <div class="truncate text-sm font-medium whitespace-nowrap animate-marquee">
                    <?php foreach ($ticker_news as $tick): ?>
                        <span class="mr-8"><span
                                class="text-red-400 mr-2"><?= timeAgo($tick['fecha_publicacion']) ?>:</span>
                            <?= htmlspecialchars($tick['titulo']) ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <?php if ($hero_news): ?>
            <!-- Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-1 lg:gap-1 h-auto lg:h-[500px] mb-12">
                <!-- Main Story -->
                <a href="detalle.php?id=<?= $hero_news['id'] ?>"
                    class="lg:col-span-2 relative group overflow-hidden news-card block h-[300px] lg:h-full">
                    <img src="<?= getImg($hero_news['imagen_principal']) ?>"
                        class="absolute inset-0 w-full h-full object-cover news-card-img" alt="Main News">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 left-0 p-6 md:p-8 w-full">
                        <span
                            class="inline-block bg-candelaria-gold text-black text-xs font-bold px-2 py-1 rounded mb-2 uppercase"><?= htmlspecialchars($hero_news['categoria']) ?></span>
                        <p class="text-gray-300 text-xs mb-2"><?= timeAgo($hero_news['fecha_publicacion']) ?></p>
                        <h2
                            class="text-2xl md:text-3xl lg:text-4xl font-bold text-white leading-tight font-heading mb-2 group-hover:underline decoration-candelaria-gold underline-offset-4">
                            <?= htmlspecialchars($hero_news['titulo']) ?>
                        </h2>
                        <p class="text-gray-300 text-sm md:text-base line-clamp-2 md:line-clamp-none max-w-2xl">
                            <?= htmlspecialchars($hero_news['resumen']) ?>
                        </p>
                    </div>
                </a>

                <!-- Side Stories -->
                <div class="grid grid-cols-1 grid-rows-2 gap-1 h-[400px] lg:h-full">
                    <?php foreach ($side_news as $side): ?>
                        <a href="detalle.php?id=<?= $side['id'] ?>"
                            class="relative group overflow-hidden news-card block h-full">
                            <img src="<?= getImg($side['imagen_principal']) ?>"
                                class="absolute inset-0 w-full h-full object-cover news-card-img" alt="Side News">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-5 w-full">
                                <span
                                    class="inline-block bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded mb-2 uppercase"><?= htmlspecialchars($side['categoria']) ?></span>
                                <p class="text-gray-300 text-xs mb-1"><?= timeAgo($side['fecha_publicacion']) ?></p>
                                <h3
                                    class="text-xl font-bold text-white font-heading leading-tight group-hover:text-candelaria-gold transition-colors">
                                    <?= htmlspecialchars($side['titulo']) ?>
                                </h3>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-20 bg-white rounded-xl shadow-sm mb-12">
                <i data-lucide="newspaper" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                <h2 class="text-2xl font-bold text-gray-400">No hay noticias destacadas</h2>
            </div>
        <?php endif; ?>

        <!-- Section: Vive Puno -->
        <div class="mb-8 flex items-center gap-3">
            <i class="fas fa-newspaper text-candelaria-purple text-2xl"></i>
            <h2 class="text-2xl font-bold font-heading text-gray-800 uppercase tracking-wide">Vive Puno</h2>
            <div class="flex-1 h-1 bg-gradient-to-r from-gray-200 to-transparent ml-4"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($grid_news as $item): ?>
                <article
                    class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                    <div class="h-48 relative overflow-hidden">
                        <img src="<?= getImg($item['imagen_principal']) ?>"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute top-3 left-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1 rounded shadow-sm text-gray-800">
                            <?= htmlspecialchars($item['categoria']) ?>
                        </div>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <span
                            class="text-xs text-gray-500 font-medium mb-2"><?= timeAgo($item['fecha_publicacion']) ?></span>
                        <h3
                            class="text-lg font-bold text-gray-800 mb-2 leading-tight group-hover:text-candelaria-purple transition-colors">
                            <a href="detalle.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['titulo']) ?></a>
                        </h3>
                        <p class="text-gray-500 text-sm line-clamp-3 mb-4"><?= htmlspecialchars($item['resumen']) ?></p>
                        <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs text-gray-400">Por <?= htmlspecialchars($item['autor']) ?></span>
                            <a href="detalle.php?id=<?= $item['id'] ?>"
                                class="text-candelaria-purple text-sm font-bold hover:underline">Leer más</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </main>

    <footer class="bg-gray-900 text-white mt-16 border-t-4 border-candelaria-gold">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col items-center justify-center text-center">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="sparkles" class="w-5 h-5 text-[#fbbf24]"></i>
                    <span class="text-xl font-bold font-heading">Candelaria 2026</span>
                </div>

                <div class="text-gray-500 text-sm mb-6">
                    &copy; 2026 Candela Digital. Todos los derechos reservados.
                </div>

                <div class="flex flex-col gap-4 mb-8 text-gray-400 text-sm">
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <div class="flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4 text-[#fbbf24]"></i>
                            <span>922191501</span>
                        </div>
                        <span class="text-gray-600">|</span>
                        <div class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4 text-[#fbbf24]"></i>
                            <span>antonyzapana550@gmail.com</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <div class="flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4 text-[#fbbf24]"></i>
                            <span>974526627</span>
                        </div>
                        <span class="text-gray-600">|</span>
                        <div class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4 text-[#fbbf24]"></i>
                            <span>p.sebastian.bn@gmail.com</span>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </footer>
    <script>lucide.createIcons();</script>
    <script src="../assets/js/spark-effect.js"></script>

    <!-- Auth Modal and Dropdown -->
    <?= getAuthModalHTML() ?>
    <?= getAuthJS('../') ?>
</body>

</html>