<?php
// candelaria/tienda/index.php

// --- EXTREME DEBUGGING START ---
ini_set('display_errors', 1);
error_reporting(E_ALL);
error_log("🔥 [STORE DEBUG] Accessing Store Index");

$products = [];
try {
    // 1. Locate Database Class
    // Relative path from candelaria/tienda/ -> ../../php-admin/src/Config/Database.php
    $dbPath = __DIR__ . '/../../php-admin/src/Config/Database.php';

    if (!file_exists($dbPath)) {
        throw new Exception("Database file not found at: " . $dbPath);
    }

    require_once $dbPath;

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

$headerDepth = 1;
include_once '../includes/standard-header.php';
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

    <?php include_once '../includes/navbar.php'; ?>

    <!-- Hero Banner removed by user request -->
    <div class="h-8"></div>

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
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            <?php foreach ($products as $p): ?>
                <?php
                $precioInt = floor($p['precio']);
                $precioDec = number_format(($p['precio'] - $precioInt) * 100, 0);
                $img = !empty($p['imagen_principal']) ? '../' . $p['imagen_principal'] : '../assets/placeholder.png'; // Fix path logic later
                ?>
                <a href="producto.php?id=<?= $p['id'] ?>"
                    class="group block bg-white rounded-xl overflow-hidden border border-gray-100 product-card relative">
                    <!-- Badge Oferta (Demo) -->
                    <?php if (isset($p['precio_oferta'])): ?>
                        <div
                            class="absolute top-2 left-2 z-10 discount-badge text-white text-xs font-bold px-2 py-1 rounded-md shadow-sm">
                            OFERTA
                        </div>
                    <?php endif; ?>

                    <div class="aspect-[1/1] overflow-hidden bg-gray-100 relative">
                        <img src="<?= $img ?>" alt="<?= htmlspecialchars($p['nombre']) ?>"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                        <!-- Quick Add Button (Desktop Hover) -->
                        <button onclick="event.preventDefault(); addToCart(<?= $p['id'] ?>)"
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
                            <?php if (isset($p['precio_oferta'])): ?>
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

    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        function addToCart(productId) {
            // Placeholder logic -> Tienda.js handle this
            if (window.Tienda) {
                window.Tienda.addItem(productId);
            } else {
                alert('Añadido al carrito (Demo ID: ' + productId + ')');
            }
        }
    </script>

    <!-- Tienda Core JS -->
    <script src="../assets/js/tienda.js"></script>

</body>

</html>