<?php
// contacto.php
$headerDepth = 0;
// Check if file exists before including
if (file_exists('includes/standard-header.php')) {
    require_once 'includes/standard-header.php';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | Candelaria 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Montserrat', sans-serif;
            color: #1e293b;
        }
    </style>
</head>

<body class="bg-slate-50">

    <main class="max-w-5xl mx-auto px-6 py-16">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
            <!-- Header Banner -->
            <div class="bg-gradient-to-r from-purple-900 to-indigo-900 p-12 text-white text-center relative">
                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20">
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4 relative z-10 tracking-tight">Contáctanos</h1>
                <p class="text-purple-200 text-lg relative z-10 font-medium">Estamos aquí para ayudarte</p>
            </div>

            <div class="p-8 md:p-16 text-slate-600 text-sm md:text-base">

                <div class="max-w-3xl mx-auto">
                    <p class="text-center mb-12 text-lg">
                        ¿Tienes dudas sobre la Festividad de la Virgen de la Candelaria 2026?
                        <br>Escríbenos o llámanos para más información.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Teléfonos -->
                        <div
                            class="bg-slate-50 p-8 rounded-2xl border border-slate-200 hover:shadow-lg transition-shadow">
                            <div
                                class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                                <i data-lucide="phone" class="w-6 h-6 text-yellow-600"></i>
                            </div>
                            <h3 class="text-xl font-bold text-center mb-6 text-slate-800">Llámanos</h3>
                            <div class="flex flex-col gap-4 items-center">
                                <a href="tel:922191501"
                                    class="flex items-center gap-3 text-lg font-medium hover:text-purple-700 transition-colors">
                                    <span>922191501</span>
                                </a>
                                <a href="tel:974526627"
                                    class="flex items-center gap-3 text-lg font-medium hover:text-purple-700 transition-colors">
                                    <span>974526627</span>
                                </a>
                            </div>
                        </div>

                        <!-- Correos -->
                        <div
                            class="bg-slate-50 p-8 rounded-2xl border border-slate-200 hover:shadow-lg transition-shadow">
                            <div
                                class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                                <i data-lucide="mail" class="w-6 h-6 text-blue-600"></i>
                            </div>
                            <h3 class="text-xl font-bold text-center mb-6 text-slate-800">Escríbenos</h3>
                            <div class="flex flex-col gap-4 items-center">
                                <a href="mailto:antonyzapana550@gmail.com"
                                    class="flex items-center gap-3 font-medium hover:text-purple-700 transition-colors break-all">
                                    <span>antonyzapana550@gmail.com</span>
                                </a>
                                <a href="mailto:p.sebastian.bn@gmail.com"
                                    class="flex items-center gap-3 font-medium hover:text-purple-700 transition-colors break-all">
                                    <span>p.sebastian.bn@gmail.com</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-16 text-center">
                        <h3 class="font-bold text-slate-800 mb-4">Horario de Atención</h3>
                        <p class="text-slate-500">Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                        <p class="text-slate-500">Sábados: 9:00 AM - 1:00 PM</p>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <!-- Global Footer Include (Standard) -->
    <?php
    $footerDepth = 0;
    require_once 'includes/standard-footer.php';
    ?>

    <script>lucide.createIcons();</script>
</body>

</html>