<?php
// candelaria/tienda/producto.php

// --- EXTREME DEBUGGING ---
ini_set('display_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'] ?? 0;
$product = null;

try {
    // 1. Locate Database Class (Dual Path Check)
    $localDbPath = __DIR__ . '/../../php-admin/src/Config/Database.php';
    $prodDbPath = __DIR__ . '/../../candelaria-admin/src/Config/Database.php';

    if (file_exists($prodDbPath)) {
        require_once $prodDbPath;
    } elseif (file_exists($localDbPath)) {
        require_once $localDbPath;
    } else {
        throw new Exception("Database file not found.");
    }

    if (!class_exists('Config\Database')) {
        throw new Exception("Database Class not found.");
    }

    // 2. Connect
    $database = new Config\Database();
    $pdo = $database->connect('mipuno_candelaria');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 3. Fetch Product
    $stmt = $pdo->prepare("SELECT * FROM tienda_productos WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Producto no encontrado o eliminado.");
    }

    // Normalizing data for view
    $product['imagenes'] = [$product['imagen_principal']]; // Array por si luego hay galería real
    $product['estrellas'] = 5; // Default/Mock por ahora hasta tener tabla reviews
    $product['reviews'] = rand(10, 100);

} catch (Throwable $e) {
    die("Error Base de Datos: " . $e->getMessage());
}

// Fix image path logic
// Database stores: "assets/uploads/tienda/foto.jpg"
// We are in: candelaria/tienda/
// We need: "../assets/uploads/tienda/foto.jpg"
$baseImg = !empty($product['imagen_principal']) ? $product['imagen_principal'] : 'assets/placeholder.png';
$mainImg = '../' . $baseImg;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= htmlspecialchars($product['nombre']) ?> | Candelaria Shop
    </title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/lucide-static@0.321.0/font/lucide.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-900">

    <?php $headerDepth = 1;
    include_once '../includes/standard-header.php'; ?>

    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
            <a href="index.php" class="hover:text-purple-600">Tienda</a>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <span class="text-gray-900 font-medium truncate">
                <?= htmlspecialchars($product['nombre']) ?>
            </span>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

            <!-- Galería de Imágenes -->
            <div class="space-y-4">
                <div class="aspect-square bg-gray-100 rounded-2xl overflow-hidden border border-gray-100">
                    <img src="<?= $mainImg ?>" id="mainImage" class="w-full h-full object-cover"
                        alt="Producto Principal">
                </div>
                <div class="flex gap-4 overflow-x-auto pb-2">
                    <?php foreach ($product['imagenes'] as $img): ?>
                        <?php $thumbUrl = '../' . $img; ?>
                        <button onclick="document.getElementById('mainImage').src = '<?= $thumbUrl ?>'"
                            class="w-20 h-20 flex-shrink-0 border-2 border-transparent hover:border-purple-500 rounded-lg overflow-hidden transition-all">
                            <img src="<?= $thumbUrl ?>" class="w-full h-full object-cover">
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Detalles del Producto -->
            <div>
                <h1 class="text-2xl md:text-4xl font-black text-gray-900 mb-2 leading-tight">
                    <?= htmlspecialchars($product['nombre']) ?>
                </h1>

                <div class="flex items-center gap-4 mb-6">
                    <div class="flex text-yellow-400">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i data-lucide="star"
                                class="w-5 h-5 <?= $i < $product['estrellas'] ? 'fill-current' : 'text-gray-200' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <span class="text-blue-600 font-medium text-sm hover:underline cursor-pointer">
                        <?= $product['reviews'] ?> calificaciones
                    </span>
                    <span class="text-gray-300">|</span>
                    <span class="text-green-600 font-bold text-sm flex items-center gap-1">
                        <i data-lucide="package-check" class="w-4 h-4"></i> Stock Disponible
                    </span>
                </div>

                <div class="text-4xl font-bold text-gray-900 mb-6">
                    S/
                    <?= number_format($product['precio'], 2) ?>
                    <span class="text-sm font-normal text-gray-500 block mt-1">Incluye IGV</span>
                </div>

                <div class="prose prose-purple text-gray-600 mb-8">
                    <?= nl2br(htmlspecialchars($product['descripcion'])) ?>
                </div>

                <!-- Selector de Cantidad y Botón -->
                <div class="flex flex-col sm:flex-row gap-4 mb-8 border-t border-b border-gray-100 py-6">
                    <div class="flex items-center border border-gray-300 rounded-xl w-max">
                        <button class="px-4 py-2 text-gray-600 hover:bg-gray-100" onclick="updateQty(-1)">-</button>
                        <input type="number" id="qty" value="1" min="1" max="<?= $product['stock'] ?>"
                            class="w-12 text-center border-none focus:ring-0 p-0 text-lg font-bold">
                        <button class="px-4 py-2 text-gray-600 hover:bg-gray-100" onclick="updateQty(1)">+</button>
                    </div>

                    <button onclick="addToCart()"
                        class="flex-1 bg-purple-700 hover:bg-purple-800 text-white font-bold py-3 px-8 rounded-xl flex items-center justify-center gap-2 transform active:scale-95 transition-all shadow-lg shadow-purple-200">
                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                        Añadir al Carrito
                    </button>
                </div>

                <!-- Beneficios -->
                <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <i data-lucide="shield-check" class="w-5 h-5 text-purple-600"></i>
                        <span>Compra Segura</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="truck" class="w-5 h-5 text-purple-600"></i>
                        <span>Envíos a todo Puno</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();

        function updateQty(change) {
            const input = document.getElementById('qty');
            let val = parseInt(input.value) + change;
            if (val < 1) val = 1;
            input.value = val;
        }

        function addToCart() {
            const qty = parseInt(document.getElementById('qty').value);
            // Pass minimal details purely for immediate UI update before sync
            if (window.Tienda) {
                window.Tienda.addItem(<?= $product['id'] ?>, qty, {
                    nombre: '<?= htmlspecialchars($product['nombre'], ENT_QUOTES) ?>',
                    precio: <?= $product['precio'] ?>,
                    imagen: '<?= $baseImg ?>'
                });
            } else {
                alert('Añadido: ' + qty + ' unidades');
            }
        }
    </script>
    <script src="../assets/js/tienda.js"></script>
</body>

</html>