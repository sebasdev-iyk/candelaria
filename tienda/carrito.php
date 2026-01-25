<?php
// candelaria/tienda/carrito.php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras | Candelaria Shop</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/lucide-static@0.321.0/font/lucide.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">

    <?php $headerDepth = 1;
    include_once '../includes/standard-header.php'; ?>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-black mb-8">Tu Carrito de Compras</h1>

        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Lista de Items -->
            <div class="flex-1">
                <div id="cart-items" class="space-y-4">
                    <!-- JS Rendering here -->
                    <div class="bg-white p-8 rounded-xl text-center text-gray-400 border border-gray-100">
                        <i data-lucide="shopping-cart" class="w-12 h-12 mx-auto mb-3 opacity-20"></i>
                        <p>Tu carrito está cargando o vacío...</p>
                    </div>
                </div>
            </div>

            <!-- Resumen de Orden -->
            <div class="w-full lg:w-96">
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm sticky top-24">
                    <h2 class="text-lg font-bold mb-4">Resumen del Pedido</h2>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span id="cart-subtotal">S/ 0.00</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Envío</span>
                            <span class="font-medium">Gratis</span>
                        </div>

                        <div
                            class="border-t border-gray-100 pt-3 flex justify-between font-black text-xl text-gray-900">
                            <span>Total</span>
                            <span id="cart-total">S/ 0.00</span>
                        </div>
                    </div>

                    <button onclick="checkout()"
                        class="w-full bg-purple-700 hover:bg-purple-800 text-white font-bold py-3.5 rounded-xl transition-colors shadow-lg shadow-purple-200">
                        Pagar Ahora (Checkout)
                    </button>

                    <div class="mt-4 flex items-center justify-center gap-2 text-gray-400">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                        <span class="text-xs">Pago 100% Seguro</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="../assets/js/tienda.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            renderCart();
        });

        function renderCart() {
            const container = document.getElementById('cart-items');
            const cart = Tienda.cart; // From tienda.js (loaded from LS)

            let total = 0;

            if (cart.length === 0) {
                container.innerHTML = `
                    <div class="bg-white p-12 rounded-xl text-center border border-gray-100">
                        <i data-lucide="shopping-bag" class="w-16 h-16 mx-auto mb-4 text-gray-200"></i>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Tu carrito está vacío</h3>
                        <p class="text-gray-500 mb-6">Parece que aún no has agregado nada.</p>
                        <a href="index.php" class="inline-block bg-purple-600 text-white font-bold px-6 py-3 rounded-full hover:bg-purple-700 transition">Explorar Tienda</a>
                    </div>
                `;
                lucide.createIcons();
                updateTotals(0);
                return;
            }

            let html = '';
            cart.forEach(item => {
                const price = item.precio || 0; // Fallback
                const sub = price * item.qty;
                total += sub;
                // Fix path for display: 'assets/...' -> '../assets/...'
                const imgPath = item.imagen ? '../' + item.imagen : '../assets/placeholder.png';

                html += `
                    <div class="bg-white p-4 rounded-xl border border-gray-100 flex gap-4 items-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            <img src="${imgPath}" class="w-full h-full object-cover">
                        </div>
                        
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900 line-clamp-1">${item.nombre || 'Producto ' + item.id}</h3>
                            <p class="text-gray-500 text-sm mb-2">Código: ${item.id}</p>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center border border-gray-200 rounded-lg">
                                    <button onclick="Tienda.updateQuantity(${item.id}, ${item.qty - 1}); renderCart()" class="px-2 py-1 hover:bg-gray-50 text-gray-600">-</button>
                                    <span class="w-8 text-center text-sm font-bold">${item.qty}</span>
                                    <button onclick="Tienda.updateQuantity(${item.id}, ${item.qty + 1}); renderCart()" class="px-2 py-1 hover:bg-gray-50 text-gray-600">+</button>
                                </div>
                                <button onclick="Tienda.removeItem(${item.id}); renderCart()" class="text-red-500 text-sm hover:underline">Eliminar</button>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="font-bold text-lg">S/ ${price.toFixed(2)}</p>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
            updateTotals(total);
        }

        function updateTotals(total) {
            document.getElementById('cart-subtotal').innerText = 'S/ ' + total.toFixed(2);
            document.getElementById('cart-total').innerText = 'S/ ' + total.toFixed(2);
        }

        function checkout() {
            if (!Tienda.cart.length) return alert('El carrito está vacío');

            // Check auth
            if (!window.currentUser) {
                // Trigger global auth modal if available
                if (window.openAuthModal) {
                    window.openAuthModal();
                    alert('Por favor inicia sesión para continuar con la compra.');
                } else {
                    alert('Debes iniciar sesión.');
                }
            } else {
                alert('¡Listo! Integración de pagos pendiente (V2).');
            }
        }
    </script>
</body>

</html>