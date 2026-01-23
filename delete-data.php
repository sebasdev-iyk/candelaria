<?php
// delete-data.php
$headerDepth = 0;
if (file_exists('includes/standard-header.php')) {
    require_once 'includes/standard-header.php';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Eliminación de Datos (GDPR/CCPA) | Candelaria 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Open Sans', sans-serif; background-color: #f1f5f9; color: #334155; }
        h1, h2, h3 { font-family: 'Montserrat', sans-serif; color: #0f172a; }
        .step-card { border-left: 4px solid #cbd5e1; transition: all 0.3s; }
        .step-card:hover { border-left-color: #ef4444; transform: translateX(5px); }
    </style>
</head>
<body class="bg-slate-100">

    <main class="max-w-4xl mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                <i data-lucide="trash-2" class="w-8 h-8 text-red-600"></i>
            </div>
            <h1 class="text-4xl font-extrabold text-slate-900 mb-2">Eliminación de Datos Personales</h1>
            <p class="text-slate-500 max-w-2xl mx-auto">Cumplimiento normativa Facebook Data Deletion Instructions & GDPR Right to Erasure</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="p-8 border-b border-gray-100">
                <h2 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-amber-500"></i>
                    Información Importante
                </h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    En Candelaria Digital valoramos su privacidad y le otorgamos control total sobre sus datos. De acuerdo con las normas de la plataforma de Facebook y las leyes internacionales de privacidad, usted tiene derecho a solicitar la eliminación permanente de todos los datos que hayamos recopilado sobre usted a través de nuestra aplicación o sitio web.
                </p>
                <div class="bg-amber-50 p-4 rounded-lg border border-amber-100 text-sm text-amber-800">
                    <strong>Advertencia:</strong> Esta acción es irreversible. Una vez procesada la eliminación, perderá el acceso a su historial de reservas, preferencias, comentarios y nivel de usuario. No podremos recuperar su cuenta.
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <!-- Método 1: Autoservicio -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border-t-8 border-blue-500 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i data-lucide="settings" class="w-24 h-24 text-blue-500"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Método 1: Automático</h3>
                <p class="text-gray-500 mb-6 text-sm">Si aún tiene acceso a su cuenta, esta es la forma más rápida.</p>
                
                <ol class="space-y-4 relative z-10">
                    <li class="flex gap-3 items-start">
                        <span class="bg-blue-100 text-blue-700 font-bold w-6 h-6 flex items-center justify-center rounded-full text-xs flex-shrink-0 mt-0.5">1</span>
                        <p class="text-sm">Inicie sesión en <a href="index.php" class="text-blue-600 font-semibold hover:underline">mipuno.pe</a></p>
                    </li>
                    <li class="flex gap-3 items-start">
                        <span class="bg-blue-100 text-blue-700 font-bold w-6 h-6 flex items-center justify-center rounded-full text-xs flex-shrink-0 mt-0.5">2</span>
                        <p class="text-sm">Vaya a "Mi Perfil" en el menú superior.</p>
                    </li>
                    <li class="flex gap-3 items-start">
                        <span class="bg-blue-100 text-blue-700 font-bold w-6 h-6 flex items-center justify-center rounded-full text-xs flex-shrink-0 mt-0.5">3</span>
                        <p class="text-sm">Desplácese hasta la sección "Zona de Peligro".</p>
                    </li>
                    <li class="flex gap-3 items-start">
                        <span class="bg-blue-100 text-blue-700 font-bold w-6 h-6 flex items-center justify-center rounded-full text-xs flex-shrink-0 mt-0.5">4</span>
                        <p class="text-sm">Haga clic en "Eliminar Cuenta" y confirme su contraseña.</p>
                    </li>
                </ol>
                <div class="mt-8">
                    <a href="perfil.php" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-blue-200">
                        Ir a Mi Perfil
                    </a>
                </div>
            </div>

            <!-- Método 2: Manual -->
            <div class="bg-white p-8 rounded-2xl shadow-lg border-t-8 border-slate-700 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i data-lucide="mail-warning" class="w-24 h-24 text-slate-700"></i>
                </div>
                <h3 class="text-2xl font-bold mb-4">Método 2: Solicitud Manual</h3>
                <p class="text-gray-500 mb-6 text-sm">Si no puede acceder o prefiere contacto humano.</p>
                
                <ol class="space-y-4 relative z-10">
                    <li class="flex gap-3 items-start">
                        <span class="bg-slate-200 text-slate-700 font-bold w-6 h-6 flex items-center justify-center rounded-full text-xs flex-shrink-0 mt-0.5">1</span>
                        <p class="text-sm">Envíe un correo a <strong>admin@mipuno.pe</strong></p>
                    </li>
                    <li class="flex gap-3 items-start">
                        <span class="bg-slate-200 text-slate-700 font-bold w-6 h-6 flex items-center justify-center rounded-full text-xs flex-shrink-0 mt-0.5">2</span>
                        <p class="text-sm">Asunto: <strong>"Solicitud Baja de Datos - [Su ID de Usuario]"</strong></p>
                    </li>
                    <li class="flex gap-3 items-start">
                        <span class="bg-slate-200 text-slate-700 font-bold w-6 h-6 flex items-center justify-center rounded-full text-xs flex-shrink-0 mt-0.5">3</span>
                        <p class="text-sm">Debe enviar el correo desde la misma dirección registrada.</p>
                    </li>
                </ol>
                
                <div class="mt-8 bg-slate-50 p-4 rounded-xl border border-slate-200">
                    <p class="text-xs text-slate-500 mb-2 font-bold uppercase">Tiempo de Respuesta</p>
                    <div class="flex items-center gap-2 text-slate-800 font-medium">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        Máximo 48 horas hábiles
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-8">
            <h3 class="font-bold text-lg mb-4">Preguntas Frecuentes sobre Eliminación</h3>
            <div class="space-y-4">
                <details class="group bg-slate-50 rounded-lg p-4 cursor-pointer">
                    <summary class="font-semibold flex justify-between items-center list-none">
                        ¿Se eliminan mis comentarios en foros?
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <p class="text-sm text-gray-600 mt-2 pl-2 border-l-2 border-slate-300">
                        Sí, sus comentarios públicos serán anonimizados (el autor aparecerá como "Usuario Eliminado") o borrados permanentemente según la política del foro específico.
                    </p>
                </details>
                <details class="group bg-slate-50 rounded-lg p-4 cursor-pointer">
                    <summary class="font-semibold flex justify-between items-center list-none">
                        ¿Qué pasa si me registré con Facebook/Google?
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <p class="text-sm text-gray-600 mt-2 pl-2 border-l-2 border-slate-300">
                        Al eliminar su cuenta aquí, eliminamos el ID de conexión y los tokens de acceso. Para revocar los permisos completamente, también debe ir a la configuración de su cuenta de Facebook/Google y eliminar la aplicación "Candelaria 2026 App".
                    </p>
                </details>
                <details class="group bg-slate-50 rounded-lg p-4 cursor-pointer">
                    <summary class="font-semibold flex justify-between items-center list-none">
                        ¿Guardan copias de seguridad?
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform group-open:rotate-180"></i>
                    </summary>
                    <p class="text-sm text-gray-600 mt-2 pl-2 border-l-2 border-slate-300">
                        Sus datos se eliminan de la base de datos activa inmediatamente. Sin embargo, pueden permanecer en copias de seguridad encriptadas (backups) hasta por 30 días antes de ser sobrescritos automáticamente.
                    </p>
                </details>
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
