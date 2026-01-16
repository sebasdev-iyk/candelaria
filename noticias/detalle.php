<?php
include_once '../../php-admin/src/Config/Database.php';
use Config\Database;

$database = new Database();
$db = $database->connect('mipuno_candelaria');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$article = null;

if ($db && $id) {
    try {
        $stmt = $db->prepare("SELECT * FROM noticias WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Log Error
    }
}

// Helpers
function getImg($path)
{
    if (!$path)
        return 'https://picsum.photos/800/400';
    if (strpos($path, 'http') === 0)
        return $path;
    return '../../' . $path;
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
    <header class="bg-candelaria-purple text-white shadow-lg sticky top-0 z-50">
        <div class="w-full px-4 py-4 flex justify-between items-center max-w-7xl mx-auto">
            <a href="../index.php" class="flex items-center"><img src="../principal/virgencandelariaa.png"
                    class="h-10"></a>
            <div class="flex items-center gap-6">
                <nav class="hidden md:flex gap-4">
                    <a href="../servicios/index.php" class="nav-link-custom">Servicios</a>
                    <a href="../cultura/cultura.html" class="nav-link-custom">Cultura</a>
                    <a href="../horarios_y_danzas/index.php" class="nav-link-custom">Horarios</a>
                    <a href="../noticias/index.php" class="nav-link-custom text-candelaria-gold font-bold">Noticias</a>
                </nav>
                <?php include '../includes/auth-header.php'; ?>
                <?= getAuthButtonHTML() ?>
            </div>
            <a href="index.php"
                class="text-sm font-bold border border-white/30 rounded-full px-4 py-2 hover:bg-white/10 flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Volver
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-10">
        <?php if ($article): ?>
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
                        // Fix relative paths from Admin (../assets) to Public (../../assets)
                        $content = str_replace('src="../assets', 'src="../../assets', $content);
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

    <footer class="bg-gray-900 text-white py-8 text-center mt-12">
        <p class="text-gray-500 text-sm">&copy; 2025 Candelaria Puno</p>
    </footer>
    <script>lucide.createIcons();</script>
</body>

</html>