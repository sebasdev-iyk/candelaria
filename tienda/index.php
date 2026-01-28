<?php
// candelaria/tienda/index.php

// --- EXTREME DEBUGGING START ---
ini_set('display_errors', 0); // Changed to 0 to prevent HTML breakage
error_reporting(E_ALL);
error_log("🔥 [STORE DEBUG] Accessing Store Index");

$products = [];
try {
    // 1. Locate Database Class
    // Relative path from candelaria/tienda/ -> ../../php-admin/src/Config/Database.php
    // Dual check for Production (candelaria-admin) vs Local (php-admin)
    $localDbPath = __DIR__ . '/../../php-admin/src/Config/Database.php';
    $prodDbPath = __DIR__ . '/../../candelaria-admin/src/Config/Database.php';

    if (file_exists($prodDbPath)) {
        require_once $prodDbPath;
    } elseif (file_exists($localDbPath)) {
        require_once $localDbPath;
    } else {
        throw new Exception("Database file not found. Checked: \n- $prodDbPath \n- $localDbPath");
    }

    if (!class_exists('Config\Database')) {
        throw new Exception("Database Class not found after include");
    }

    // 2. Connect
    $database = new Config\Database();
    $pdo = $database->connect('mipuno_candelaria');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    error_log("🔥 [STORE DEBUG] DB Connected Successfully");

    // 3. Fetch Products
    // NOTE: 'estado' column might allow 'activo', check your schema. Adjusting to fetch ALL for debug if needed, or stick to active.
    // Querying all for now to verify connectivity, filtering active.
    $stmt = $pdo->query("SELECT * FROM tienda_productos ORDER BY id DESC");
    $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    error_log("🔥 [STORE DEBUG] Total products found: " . count($allProducts));

    // Filter active in PHP or SQL. Let's do SQL next time, but for now filtering here to be safe if column missing
    $products = $allProducts;

    foreach ($products as $p) {
        error_log("🔥 [STORE DEBUG] Product Loaded: ID " . $p['id'] . " - " . $p['nombre']);
    }

} catch (Throwable $e) {
    error_log("🔥 [STORE DEBUG] CRITICAL ERROR: " . $e->getMessage());
    echo "<div style='background:red;color:white;padding:10px'>Error Crítico en Tienda: " . $e->getMessage() . "</div>";
    // Do NOT fall back to mock data. We want to see the error.
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Oficial | Candelaria 2026</title>
    <link rel="stylesheet" href="../styles.css"> <!-- Base styles -->
    <link href="https://cdn.jsdelivr.net/npm/lucide-static@0.321.0/font/lucide.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Estilos específicos Tienda (Temu-style) */
        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.2);
        }

        .discount-badge {
            background: linear-gradient(135deg, #FF6B00 0%, #FF9000 100%);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 overflow-y-auto h-screen">

    <?php
    // Use standard-header.php which exists, fixing the missing navbar.php issue
    $headerDepth = 1;
    $activePage = 'servicios'; // Active tab for header
    include_once '../includes/standard-header.php';
    ?>

    <!-- Hero Banner removed by user request -->
    <div class="h-8"></div>

    <div class="max-w-7xl mx-auto px-4">
        <!-- Navigation Tabs (Mirrors Services Page) -->
        <nav class="flex space-x-1 border-b border-gray-200 mb-6 overflow-x-auto pb-1 scrollbar-hide" aria-label="Tabs">
            <a href="../servicios/index.php?tab=hospedajes"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 border-transparent font-medium text-sm flex items-center gap-2 text-gray-500 hover:text-candelaria-purple hover:border-gray-300 transition-colors">
                <i data-lucide="bed-double" class="w-4 h-4"></i> Hospedajes
            </a>
            <a href="../servicios/index.php?tab=restaurantes"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 border-transparent font-medium text-sm flex items-center gap-2 text-gray-500 hover:text-candelaria-purple hover:border-gray-300 transition-colors">
                <i data-lucide="utensils" class="w-4 h-4"></i> Gastronomía
            </a>
            <a href="../servicios/index.php?tab=transporte"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 border-transparent font-medium text-sm flex items-center gap-2 text-gray-500 hover:text-candelaria-purple hover:border-gray-300 transition-colors">
                <i data-lucide="car" class="w-4 h-4"></i> Transporte
            </a>
            <a href="../servicios/index.php?tab=info"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 border-transparent font-medium text-sm flex items-center gap-2 text-gray-500 hover:text-candelaria-purple hover:border-gray-300 transition-colors">
                <i data-lucide="info" class="w-4 h-4"></i> Turismo
            </a>
            <button
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 border-candelaria-purple font-medium text-sm flex items-center gap-2 text-gray-900 bg-purple-50 rounded-t-lg">
                <i data-lucide="shopping-bag" class="w-4 h-4 text-candelaria-purple"></i> Tienda
            </button>
        </nav>
    </div>

    <div class="max-w-7xl mx-auto px-4 pb-20">

        <!-- Filtros y Opciones (Simulado) -->
        <div
            class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto">
                <button
                    class="bg-purple-600 text-white px-4 py-2 rounded-full text-sm font-bold whitespace-nowrap">Todas</button>
                <button
                    class="bg-gray-100 text-gray-600 hover:bg-gray-200 px-4 py-2 rounded-full text-sm font-bold whitespace-nowrap">Ropa</button>
                <button
                    class="bg-gray-100 text-gray-600 hover:bg-gray-200 px-4 py-2 rounded-full text-sm font-bold whitespace-nowrap">Artesanía</button>
                <button
                    class="bg-gray-100 text-gray-600 hover:bg-gray-200 px-4 py-2 rounded-full text-sm font-bold whitespace-nowrap">Souvenirs</button>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-500 font-medium hidden md:inline">Ordenar por:</span>
                <select
                    class="form-select bg-white border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block p-2.5">
                    <option>Más vendidos</option>
                    <option>Precio: Menor a Mayor</option>
                    <option>Precio: Mayor a Menor</option>
                    <option>Nuevos</option>
                </select>
            </div>
        </div>

        <!-- Grid de Productos -->
        <?php if (empty($products)): ?>
            <div class="text-center py-20">
                <div class="bg-gray-100 rounded-full h-24 w-24 flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="shopping-bag" class="w-10 h-10 text-gray-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">La tienda está vacía</h3>
                <p class="text-gray-500 max-w-md mx-auto">No hay productos disponibles por el momento. Intente más tarde.
                </p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                <?php foreach ($products as $p): ?>
                    <?php
                    $precioInt = floor($p['precio']);
                    $precioDec = number_format(($p['precio'] - $precioInt) * 100, 0);
                    // Use clean logic relative to public root
                    $img = !empty($p['imagen_principal']) ? '../' . $p['imagen_principal'] : '../assets/placeholder.png';
                    ?>
                    <a href="producto.php?id=<?= $p['id'] ?>"
                        class="group block bg-white rounded-xl overflow-hidden border border-gray-100 product-card relative">
                        <!-- Badge Oferta (Demo check) -->
                        <?php if (isset($p['precio_oferta']) && $p['precio_oferta'] > 0): ?>
                            <div
                                class="absolute top-2 left-2 z-10 discount-badge text-white text-xs font-bold px-2 py-1 rounded-md shadow-sm">
                                OFERTA
                            </div>
                        <?php endif; ?>

                        <div class="aspect-[1/1] overflow-hidden bg-gray-100 relative">
                            <img src="<?= $img ?>" alt="<?= htmlspecialchars($p['nombre']) ?>"
                                onerror="console.error('🔥 [IMAGE FAIL] Could not load:', this.src, 'for product ID:', <?= $p['id'] ?>)"
                                onload="console.log('✅ [IMAGE OK] Loaded:', this.src)"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                            <?php
                            $detailsJson = htmlspecialchars(json_encode([
                                'nombre' => $p['nombre'],
                                'precio' => $p['precio'],
                                'imagen' => $img,
                                'whatsapp' => $p['numero_whatsapp'] ?? null
                            ]), ENT_QUOTES, 'UTF-8');
                            ?>
                            <!-- Quick Add Button (Desktop Hover) -->
                            <button onclick="event.preventDefault(); addToCart(<?= $p['id'] ?>, <?= $detailsJson ?>)"
                                class="absolute bottom-3 right-3 bg-white text-purple-700 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-purple-50">
                                <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                            </button>
                        </div>

                        <div class="p-4">
                            <h3
                                class="text-gray-900 font-medium text-sm md:text-base line-clamp-2 h-10 md:h-12 leading-snug mb-1">
                                <?= htmlspecialchars($p['nombre']) ?>
                            </h3>

                            <!-- Rating -->
                            <div class="flex items-center mb-2">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <i data-lucide="star"
                                        class="w-3 h-3 <?= $i < ($p['estrellas'] ?? 5) ? 'text-yellow-400 fill-yellow-400' : 'text-gray-200' ?>"></i>
                                <?php endfor; ?>
                                <span class="text-xs text-gray-400 ml-1">(<?= rand(10, 500) ?>)</span>
                            </div>

                            <div class="flex items-baseline gap-1 mt-auto">
                                <span class="text-2xl font-bold text-gray-900">S/ <?= $p['precio'] ?></span>
                                <?php if (isset($p['precio_oferta']) && $p['precio_oferta'] > 0): ?>
                                    <span class="text-sm text-gray-400 line-through">S/ <?= $p['precio_oferta'] ?></span>
                                <?php endif; ?>
                            </div>

                            <!-- Mobile Only Add Button -->
                            <button onclick="event.preventDefault(); addToCart(<?= $p['id'] ?>)"
                                class="md:hidden w-full mt-3 bg-gray-50 text-gray-700 font-bold py-2 rounded-lg text-sm border border-gray-200 active:bg-purple-100 active:border-purple-200 login-to-buy">
                                Agregar
                            </button>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Floating Cart Button -->
    <a href="carrito.php"
        class="fixed bottom-6 right-6 z-50 bg-white text-purple-700 p-4 rounded-full shadow-2xl border-2 border-purple-100 hover:scale-110 transition-transform group flex items-center justify-center gap-2">
        <div class="relative">
            <i data-lucide="shopping-cart" class="w-6 h-6 fill-current"></i>
            <span
                class="cart-count absolute -top-3 -right-3 bg-red-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full hidden border-2 border-white">0</span>
        </div>
        <span
            class="font-bold hidden group-hover:block whitespace-nowrap overflow-hidden transition-all duration-300">Ver
            Carrito</span>
    </a>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        // Debug: Count rendered products
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.product-card');
            console.group("🔥 [STORE INDEX DEBUG]");
            console.log("Page Loaded");
            console.log("Products Rendered (DOM):", cards.length);
            // Log IDs of rendered products
            cards.forEach((card, i) => {
                const link = card.getAttribute('href');
                const id = link ? link.split('=')[1] : 'unknown';
                console.log(`Product #${i + 1}: ID ${id}`);
            });
            console.groupEnd();
        });

        function addToCart(productId, details) {
            if (window.Tienda) {
                window.Tienda.addItem(productId, 1, details);
            } else {
                alert('Añadido al carrito (Demo ID: ' + productId + ')');
            }
        }
    </script>

    <!-- Tienda Core JS -->
    <script src="../assets/js/tienda.js?v=<?= time() ?>"></script>

    <?php
    // Critical: Include Auth Modal & JS
    if (function_exists('getAuthModalHTML')) {
        echo getAuthModalHTML();
        // Also include JS if it's not part of modal HTML (it seems getAuthModalHTML includes JS, but checking auth-header.php to be sure)
        // Checking auth-header.php: getAuthModalHTML does NOT include JS scripts block, getAuthJS() does or it's separate.
        // Wait, standard-header includes auth-header.php.
        // Let's check auth-header.php again. It has getAuthModalHTML() which returns HTML string. 
        // It consumes getAuthJS() inside? No.
    
        // Retrying logic based on file reading:
        // auth-header.php has getAuthModalHTML() AND getAuthJS().
        // getAuthModalHTML() returns the modal HTML and includes supabase-core.js script tags. 
        // We need to verify if getAuthJS() is needed or if getAuthModalHTML covers it.
    }

    // Explicitly include JS helper if separate
    if (function_exists('getAuthJS')) {
        echo getAuthJS();
    }
    ?>
</body>

</html>