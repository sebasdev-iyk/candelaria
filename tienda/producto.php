<?php
// candelaria/tienda/producto.php

// --- EXTREME DEBUGGING ---
ini_set('display_errors', 0); // Changed to 0 to prevent HTML breakage
error_reporting(E_ALL);

// Authentication Check
require_once '../includes/supabase-middleware.php';
$isGuest = !isAuthenticated();

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
    <style>
        .login-overlay-backdrop {
            background: rgba(243, 244, 246, 0.85);
            backdrop-filter: blur(8px);
        }
    </style>
</head>

<body class="bg-white text-gray-900 <?= $isGuest ? 'overflow-hidden h-screen' : '' ?>">

    <?php if ($isGuest): ?>
        <!-- Facebook-style Floating Login Modal -->
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 login-overlay-backdrop">
            <div
                class="bg-white w-full max-w-[400px] rounded-xl shadow-2xl overflow-hidden transform scale-100 transition-all border border-gray-100">
                <!-- Header with Decor -->
                <div class="bg-gradient-to-r from-purple-900 to-purple-800 p-6 text-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-[url('../principal/headerfondo2.jpg')] opacity-30 bg-cover bg-center">
                    </div>
                    <div class="relative z-10 flex flex-col items-center">
                        <img src="../principal/logoc.png" class="h-16 w-auto mb-2 drop-shadow-md">
                        <h3 class="text-white font-bold text-lg leading-tight">Federación Regional de Folklore y Cultura de
                            Puno</h3>
                    </div>
                </div>

                <div class="p-8">
                    <div class="text-center mb-6">
                        <p class="text-gray-900 font-bold text-xl mb-1">Inicia sesión para ver producto</p>
                        <p class="text-gray-500 text-sm">Accede a precios exclusivos y compra segura</p>
                    </div>

                    <!-- Inline Login Form -->
                    <form id="inline-login-form" class="space-y-4 text-left">
                        <div>
                            <label for="inline-email" class="block text-sm font-medium text-gray-700">Correo
                                Electrónico</label>
                            <input type="email" id="inline-email" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm p-2 border"
                                placeholder="tu@email.com">
                        </div>
                        <div>
                            <label for="inline-password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input type="password" id="inline-password" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 sm:text-sm p-2 border"
                                placeholder="••••••••">
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition-colors shadow-sm">
                            Iniciar Sesión
                        </button>

                        <div class="flex items-center justify-between text-xs mt-2">
                            <a href="#" onclick="event.preventDefault(); openAuthModal()"
                                class="text-purple-600 hover:text-purple-500 font-medium">¿Olvidaste tu contraseña?</a>
                            <a href="#" onclick="event.preventDefault(); openAuthModal()"
                                class="text-purple-600 hover:text-purple-500 font-medium">Crear cuenta</a>
                        </div>
                    </form>

                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-2 text-xs text-gray-400 uppercase">O continuar con</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" onclick="handleProductSocialLogin('google')"
                            class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                    fill="#EA4335" />
                            </svg>
                            Google
                        </button>
                        <button type="button" onclick="handleProductSocialLogin('facebook')"
                            class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                            <svg class="h-5 w-5 mr-2 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            Facebook
                        </button>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="index.php" class="text-sm text-gray-400 hover:text-gray-600 font-medium font-sans">Ahora
                        no, volver a la tienda</a>
                </div>
            </div>
        </div>
        </div>
    <?php endif; ?>

    <!-- Main Content Wrapper (Blurred if Guest) -->
    <div
        class="<?= $isGuest ? 'blur-sm pointer-events-none select-none filter grayscale-[0.3]' : '' ?> transition-all duration-500">


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
                            onload="console.log('✅ [PRODUCT DEBUG] Main Image Loaded:', this.src)"
                            onerror="console.error('🔥 [PRODUCT DEBUG] Main Image Failed:', this.src)"
                            alt="Producto Principal">
                    </div>
                    <div class="flex gap-4 overflow-x-auto pb-2">
                        <?php foreach ($product['imagenes'] as $img): ?>
                            <?php $thumbUrl = '../' . $img; ?>
                            <button
                                onclick="document.getElementById('mainImage').src = '<?= $thumbUrl ?>'; console.log('📸 [PRODUCT DEBUG] Switched to:', '<?= $thumbUrl ?>')"
                                class="w-20 h-20 flex-shrink-0 border-2 border-transparent hover:border-purple-500 rounded-lg overflow-hidden transition-all">
                                <img src="<?= $thumbUrl ?>" class="w-full h-full object-cover"
                                    onload="console.log('✅ [PRODUCT DEBUG] Thumb Loaded:', this.src)"
                                    onerror="console.error('🔥 [PRODUCT DEBUG] Thumb Failed:', this.src)">
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
                    <div class="flex flex-col gap-4 mb-8 border-t border-b border-gray-100 py-6">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex items-center border border-gray-300 rounded-xl w-max">
                                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100"
                                    onclick="updateQty(-1)">-</button>
                                <input type="number" id="qty" value="1" min="1" max="<?= $product['stock'] ?>"
                                    class="w-12 text-center border-none focus:ring-0 p-0 text-lg font-bold">
                                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100"
                                    onclick="updateQty(1)">+</button>
                            </div>

                            <button onclick="addToCart()"
                                class="flex-1 bg-purple-700 hover:bg-purple-800 text-white font-bold py-3 px-8 rounded-xl flex items-center justify-center gap-2 transform active:scale-95 transition-all shadow-lg shadow-purple-200">
                                <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                                Añadir
                            </button>
                        </div>

                        <?php if (!empty($product['numero_whatsapp'])): ?>
                            <?php
                            $waMsg = "Hola, me interesa el producto: " . $product['nombre'] . " (Precio: S/ " . $product['precio'] . ")";
                            $waLink = "https://wa.me/" . preg_replace('/[^0-9]/', '', $product['numero_whatsapp']) . "?text=" . urlencode($waMsg);
                            ?>
                            <a href="<?= $waLink ?>" target="_blank"
                                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-xl flex items-center justify-center gap-2 transform active:scale-95 transition-all shadow-lg shadow-green-200">
                                <i data-lucide="message-circle" class="w-5 h-5"></i>
                                Pedir por WhatsApp
                            </a>
                        <?php endif; ?>
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


        <!-- End Main Content Wrapper -->
    </div>

    <!-- Floating Cart Button (Hidden if guest) -->
    <?php if (!$isGuest): ?>
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
    <?php endif; ?>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // Extreme Debugging: Dump Product Info
        console.group("🔥 [PRODUCT PAGE DEBUG]");
        console.log("Product ID:", <?= $product['id'] ?>);
        console.log("Name:", "<?= htmlspecialchars($product['nombre'], ENT_QUOTES) ?>");
        console.log("Price:", <?= $product['precio'] ?>);
        console.log("Stock:", <?= $product['stock'] ?>);
        console.log("Image:", "<?= $mainImg ?>");
        console.groupEnd();

        lucide.createIcons();

        function updateQty(change) {
            const input = document.getElementById('qty');
            let val = parseInt(input.value) + change;
            if (val < 1) val = 1;
            console.log("🔢 [PRODUCT DEBUG] Qty changed to:", val);
            input.value = val;
        }

        function addToCart() {
            const qty = parseInt(document.getElementById('qty').value);
            console.log("⚡ [PRODUCT] addToCart BUTTON CLICKED. Quantity:", qty);

            if (typeof window.Tienda === 'undefined') {
                console.error("🔥 [PRODUCT CRITICAL] window.Tienda IS NOT DEFINED. Store script not loaded?");
                alert("Error crítico: El sistema de tienda no cargó correctamente. Revisa la consola.");
                return;
            }

            console.log("✅ [PRODUCT] window.Tienda found. Calling addItem...");

            // Pass minimal details purely for immediate UI update before sync
            window.Tienda.addItem(<?= $product['id'] ?>, qty, {
                nombre: '<?= htmlspecialchars($product['nombre'], ENT_QUOTES) ?>',
                precio: <?= $product['precio'] ?>,
                imagen: '<?= $baseImg ?>',
                whatsapp: '<?= $product['numero_whatsapp'] ?? '' ?>'
            });
        }
    </script>
    <script src="../assets/js/tienda.js?v=<?= time() ?>"></script>
    <?php
    // Include Auth Modal for logged in users (logout etc) and for guest overlay interaction
    if (function_exists('getAuthModalHTML')) {
        echo getAuthModalHTML();
    }

    // Explicitly include JS helper
    if (function_exists('getAuthJS')) {
        echo getAuthJS();
    }
    ?>

    <script>
    // Inline Login Logic
    document.addEventListener('DOMContentLoaded', () => {
        const inlineForm = document.getElementById('inline-login-form');
        if(inlineForm) {
            inlineForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const email = document.getElementById('inline-email').value;
                const password = document.getElementById('inline-password').value;
                
                if(!email || !password) return;
                
                try {
                    // Reuse Supabase Logic
                    if (typeof SupabaseCore === 'undefined') {
                        console.error('SupabaseCore missing');
                        return;
                    }
                    
                    const { data, error } = await SupabaseCore.signInWithEmail(email, password);
                    
                    if(error) {
                        alert('Error: ' + error.message); // Simple alert for this overlay context
                        return;
                    }
                    
                    if(data.user) {
                        // Success - Reload page to show content
                        location.reload();
                    }
                } catch(err) {
                    console.error('Inline Login Error', err);
                    alert('Error al iniciar sesión');
                }
            });
        }
    });

    // Custom Social Login for Product Page (Preserves ID parameter)
    window.handleProductSocialLogin = async function(provider) {
        console.group("🔥 [DEBUG] handleProductSocialLogin");
        console.log("Provider:", provider);
        
        if (typeof SupabaseCore === 'undefined') {
             console.error("SupabaseCore NOT defined");
             alert('Error: Sistema de autenticación no cargado.');
             console.groupEnd();
             return;
        }

        try {
            // Explicitly pass window.location.href to preserve ?id=10
            const currentUrl = window.location.href;
            console.log("📍 Current URL (to use as redirect):", currentUrl);
            
            if (provider === 'google') {
                console.log("🚀 Calling signInWithGoogle with redirect:", currentUrl);
                await SupabaseCore.signInWithGoogle(currentUrl);
            } else if (provider === 'facebook') {
                console.log("🚀 Calling signInWithFacebook with redirect:", currentUrl);
                await SupabaseCore.signInWithFacebook(currentUrl);
            }
        } catch (e) {
            console.error('❌ Social Login Error:', e);
            alert('Error al conectar con ' + provider);
        }
        console.groupEnd();
    }
    </script>
</body>

</html>