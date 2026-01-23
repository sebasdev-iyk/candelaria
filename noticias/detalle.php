<?php
ini_set('display_errors', 1); // Temporary for debugging
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include Custom Logger (Local)
include_once __DIR__ . '/../includes/logger.php';

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

$article = null;
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

custom_log("Detail Page Accessed: ID=$id");

if ($db && $id > 0) {
    try {
        $stmt = $db->prepare("SELECT * FROM noticias WHERE id = ?");
        $stmt->execute([$id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($article) {
            custom_log("Article FOUND: ID=$id, Title=" . $article['titulo']);
        } else {
            custom_log("Article NOT FOUND: ID=$id");
        }

    } catch (Exception $e) {
        custom_log("DB Error details: " . $e->getMessage());
        error_log("Error fetching article: " . $e->getMessage());
    }
} else {
    custom_log("Detail Page: Invalid ID or DB Connection Failed. DB=" . ($db ? "OK" : "NULL"));
}

if (!$article && isset($_GET['debug'])) {
    echo "Debug Info: ID=$id. DB Connection: " . ($db ? "OK" : "Failed");
}

// Helpers
function getImg($path)
{
    if (!$path)
        return 'https://picsum.photos/800/400';
    if (strpos($path, 'http') === 0 || strpos($path, 'data:') === 0)
        return $path;
    if (strpos($path, 'uploads/') === 0)
        return '../assets/' . $path; // If stored as uploads/img.jpg -> ../assets/uploads/img.jpg
    if (strpos($path, '/') === 0)
        return $path;

    // Fallback for bare filenames (e.g. img_67bfc.jpg) -> ../assets/uploads/img_67bfc.jpg
    return '../assets/uploads/' . $path;
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article ? htmlspecialchars($article['titulo']) : 'Noticia no encontrada' ?> - Candelaria 2025</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { candelaria: { purple: '#4c1d95', gold: '#fbbf24', lake: '#0ea5e9' } },
                    fontFamily: { heading: ['Montserrat', 'sans-serif'], sans: ['Open Sans', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        .nav-link-custom {
            color: #e9d5ff;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            position: relative;
        }

        .nav-link-custom:hover {
            color: #fbbf24;
        }

        .article-content p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            color: #374151;
            font-size: 1.1rem;
        }

        .article-content h2,
        .article-content h3 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: #1f2937;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .article-content img {
            border-radius: 0.5rem;
            max-width: 100%;
            height: auto;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <!-- Navbar -->
    <header class="bg-candelaria-purple text-white shadow-lg sticky top-0 z-50">
        <div class="bg-purple-950 text-xs py-1 text-center text-purple-200">Festividad de la Virgen de la Candelaria
            2025 - Del 2 al 11 de Febrero</div>
        <div class="w-full px-4 md:px-12 py-4">
            <div class="flex justify-between items-center">
                <a href="../index.php" class="flex items-center group">
                    <img src="../principal/logoc.png" alt="Candelaria" class="h-10 md:h-12 w-auto object-contain">
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

    <main class="max-w-4xl mx-auto px-4 py-10">
        <?php if ($article): ?>
            <?php
            // Set timezone for correct "Time Ago" calculation
            date_default_timezone_set('America/Lima');
            ?>
            <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <img src="<?= getImg($article['imagen_principal']) ?>" class="w-full h-[400px] object-cover">
                <div class="p-8 md:p-12">
                    <div class="flex items-center gap-4 mb-6 text-sm">
                        <span
                            class="bg-candelaria-purple text-white px-3 py-1 rounded-full font-bold uppercase"><?= htmlspecialchars($article['categoria']) ?></span>
                        <span class="text-gray-500 flex items-center gap-1"><i data-lucide="clock" class="w-4 h-4"></i>
                            <?= timeAgo($article['fecha_publicacion']) ?></span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-bold font-heading text-gray-900 mb-8 leading-tight">
                        <?= htmlspecialchars($article['titulo']) ?>
                    </h1>

                    <div class="article-content">
                        <?php
                        $content = $article['contenido'];

                        // DEBUG MODE: Show raw content if requested
                        if (isset($_GET['debug_content'])) {
                            echo '<div class="bg-yellow-100 p-4 mb-4 border border-yellow-300 font-mono text-xs overflow-auto">';
                            echo '<strong>RAW CONTENT (DB):</strong><br>' . htmlspecialchars($content);
                            echo '</div>';
                        }

                        // NUCLEAR OPTION REVISED: Fix paths to be ONE level up
                        // Structure: candelaria/noticias/detalle.php
                        // Assets: candelaria/assets/
                        // Path needed: ../assets/
                    
                        // FIX: Ensure all images point to the correct php-admin/uploads directory
                        // The public site is in candelaria/noticias/, admin uploads are in php-admin/uploads/
                        // Relative path needed: ../../php-admin/uploads/
                    
                        // 1. Reset any existing relative prefixes to a clean state if possible, or just catch them in regex
                    
                        // 2. Catch src="uploads/..." and turn into src="../../php-admin/uploads/..."
                        $content = preg_replace('/src="uploads\/([^"]+)"/', 'src="../../php-admin/uploads/$1"', $content);

                        // 3. Catch src="../uploads/..." (if stored that way) and turn into src="../../php-admin/uploads/..."
                        $content = preg_replace('/src="\.\.\/uploads\/([^"]+)"/', 'src="../../php-admin/uploads/$1"', $content);

                        // 4. Catch bare filenames if they look like uploads (optional, but risky if not careful)
                        // Limiting to common image extensions to be safe
                        // This handles cases where src="image.jpg" might be stored
                        $content = preg_replace('/src="([^"\/]+?\.(png|jpg|jpeg|webp))"/', 'src="../../php-admin/uploads/$1"', $content);

                        echo $content;
                        ?>
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-100 flex justify-between items-center">
                        <div class="text-gray-500 text-sm">Por <span
                                class="font-bold text-gray-800"><?= htmlspecialchars($article['autor']) ?></span></div>
                        <div class="flex gap-4">
                            <button class="text-blue-600 hover:text-blue-800 transition-colors"><i data-lucide="facebook"
                                    class="w-6 h-6"></i></button>
                            <button class="text-blue-400 hover:text-blue-600 transition-colors"><i data-lucide="twitter"
                                    class="w-6 h-6"></i></button>
                            <button class="text-green-500 hover:text-green-700 transition-colors"><i data-lucide="share-2"
                                    class="w-6 h-6"></i></button>
                        </div>
                    </div>
                </div>
            </article>
        <?php else: ?>
            <div class="text-center py-20">
                <h1 class="text-4xl font-bold text-gray-300 mb-4">404</h1>
                <p class="text-gray-500 text-xl">La noticia que buscas no existe o ha sido eliminada.</p>
                <a href="index.php"
                    class="inline-block mt-8 bg-candelaria-purple text-white px-6 py-3 rounded-full font-bold hover:bg-purple-800 transition-colors">Volver
                    a Noticias</a>
            </div>
        <?php endif; ?>
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

    <!-- Auth Modal & Logic -->
    <?= getAuthModalHTML() ?>
    <?= getAuthJS('../') ?>

    <script>lucide.createIcons();</script>
</body>

</html>