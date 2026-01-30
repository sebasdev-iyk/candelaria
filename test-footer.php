<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Footer - Developers Check</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { 
            min-height: 100vh; 
            background: linear-gradient(135deg, #1e293b, #334155);
        }
    </style>
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-white text-3xl font-bold text-center mb-8">
            Test Footer - Verificación de Desarrolladores
        </h1>
        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6 text-white text-center">
            <p class="mb-4">Esta página es para verificar que el footer muestre únicamente:</p>
            <ul class="list-disc list-inside space-y-2">
                <li><strong>Sam Zapana</strong> - Full Stack Developer</li>
                <li><strong>Sebastian Barriga</strong> - Full Stack Developer</li>
            </ul>
            <p class="mt-4 text-yellow-300">
                Si ves otros nombres (Carlos, Ana, Luis), hay un problema de caché.
            </p>
            <p class="mt-2 text-sm text-gray-300">
                Revisa la consola del navegador para logs de depuración.
            </p>
        </div>
    </div>

    <?php
    $footerDepth = 0;
    include __DIR__ . '/includes/standard-footer.php';
    ?>
</body>
</html>