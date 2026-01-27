<?php
// candelaria/tienda/carrito.php
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito | Candelaria Shop</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/lucide-static@0.321.0/font/lucide.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">

    <?php
    $headerDepth = 1;
    include_once '../includes/standard-header.php';
    ?>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-3">
            <i data-lucide="shopping-cart" class="w-8 h-8 text-purple-600"></i>
            Mi Carrito de Compras
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 hidden" id="cart-content">
            <!-- Left: Cart Items -->
            <div class="lg:col-span-2 space-y-4" id="cart-items-container">
                <!-- Items injected by JS -->
            </div>

            <!-- Right: Summary & Checkout -->
            <div class="h-fit">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Resumen del Pedido</h2>

                    <div class="space-y-3 mb-6 pb-6 border-b border-gray-100">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span id="summary-subtotal">S/ 0.00</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Envío</span>
                            <span class="text-green-600 font-medium">Gratis</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-8">
                        <span class="text-xl font-bold text-gray-900">Total</span>
                        <span class="text-3xl font-black text-purple-700" id="summary-total">S/ 0.00</span>
                    </div>

                    <!-- Contact Form (Simple) -->
                    <div class="mb-6 space-y-3">
                        <label class="block text-sm font-medium text-gray-700">Datos de Envío</label>
                        <input type="text" id="checkout-address" placeholder="Dirección de entrega"
                            class="w-full rounded-lg border-gray-300 p-3 text-sm focus:ring-purple-500">
                        <input type="tel" id="checkout-phone" placeholder="Celular / WhatsApp"
                            class="w-full rounded-lg border-gray-300 p-3 text-sm focus:ring-purple-500">
                    </div>

                    <button onclick="Tienda.checkout()"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl flex items-center justify-center gap-2 transition-all shadow-lg hover:shadow-green-200">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        Pedir por WhatsApp
                    </button>

                    <p class="text-xs text-center text-gray-400 mt-4">Transacción segura. Se coordinará el pago por
                        Yape/Plin.</p>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div id="cart-empty" class="text-center py-20 hidden">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="shopping-bag" class="w-10 h-10 text-gray-300"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Tu carrito está vacío</h2>
            <p class="text-gray-500 mb-8">Parece que aún no has agregado nada.</p>
            <a href="index.php"
                class="inline-flex items-center gap-2 bg-purple-600 text-white px-8 py-3 rounded-full font-bold hover:bg-purple-700 transition-colors">
                Ir a la Tienda
            </a>
        </div>

        <!-- Loading State -->
        <div id="cart-loading" class="text-center py-20">
            <i data-lucide="loader-2" class="w-10 h-10 text-purple-600 animate-spin mx-auto"></i>
        </div>

    </div>

    <!-- Auth Modal & JS -->
    <?= getAuthModalHTML() ?>
    <?= getAuthJS() ?>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="../assets/js/tienda.js"></script>
    <script>
        // Init page specific logic
        document.addEventListener('DOMContentLoaded', () => {
            Tienda.renderCartPage();
        });
    </script>
</body>

</html>