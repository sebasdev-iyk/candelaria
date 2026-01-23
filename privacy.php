<?php
// privacy.php
$headerDepth = 0;
// Check if file exists before including to prevent errors (though we know it exists)
if (file_exists('includes/standard-header.php')) {
    require_once 'includes/standard-header.php';
} else {
    // Fallback header or error handling
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidad Integral | Candelaria 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Open Sans', sans-serif; background-color: #f8fafc; color: #334155; }
        h1, h2, h3, h4 { font-family: 'Montserrat', sans-serif; color: #1e293b; }
        .legal-text p { margin-bottom: 1rem; line-height: 1.7; text-align: justify; }
        .legal-text ul { list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1rem; }
        .legal-text li { margin-bottom: 0.5rem; }
    </style>
</head>
<body class="bg-slate-50">

    <main class="max-w-5xl mx-auto px-6 py-16">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Header Banner -->
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 p-12 text-white text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 relative z-10">Política de Privacidad</h1>
                <p class="text-slate-300 text-lg relative z-10">Compromiso de Transparencia y Protección de Datos</p>
                <div class="mt-6 inline-block bg-white/10 px-4 py-1 rounded-full text-sm backdrop-blur-sm">
                    Versión 2.4 - Actualizada: 22 de Enero de 2026
                </div>
            </div>

            <div class="p-8 md:p-12 legal-text text-slate-700">
                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2 text-indigo-700">
                        <i data-lucide="shield" class="w-6 h-6"></i> 1. Declaración General
                    </h2>
                    <p>Bienvenido a la plataforma digital oficial de la Festividad de la Virgen de la Candelaria 2026 ("mipuno.pe"). En Candelaria Digital, valoramos su confianza y estamos firmemente comprometidos con la protección de su privacidad y sus datos personales. Esta Política de Privacidad Integral ("Política") describe detalladamente cómo recopilamos, utilizamos, almacenamos, procesamos, transferimos y protegemos la información personal que usted nos proporciona al utilizar nuestro sitio web, aplicaciones móviles y servicios relacionados (colectivamente, los "Servicios").</p>
                    <p>Al acceder o utilizar nuestros Servicios, usted acepta expresamente las prácticas descritas en esta Política. Si no está de acuerdo con alguno de los términos aquí expuestos, le rogamos que se abstenga de utilizar nuestros Servicios. Nos reservamos el derecho de modificar esta Política en cualquier momento, y dichas modificaciones entrarán en vigor inmediatamente después de su publicación en el sitio web.</p>
                </section>

                <section class="mb-10 p-6 bg-slate-50 rounded-xl border-l-4 border-indigo-500">
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2 text-indigo-700">
                        <i data-lucide="database" class="w-6 h-6"></i> 2. Controladores de Datos y Responsabilidad
                    </h2>
                    <p>Para los fines del Reglamento General de Protección de Datos (GDPR) de la UE, la Ley de Privacidad del Consumidor de California (CCPA) y la Ley de Protección de Datos Personales del Perú (Ley N° 29733), el controlador de los datos es:</p>
                    <div class="font-semibold text-slate-900 mt-2 ml-4">
                        Candelaria Digital S.A.C.<br>
                        Jr. Lima 123, Puno, Perú<br>
                        Oficina de Protección de Datos: data-protection@mipuno.pe
                    </div>
                </section>

                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4 text-indigo-700">3. Recopilación Exhaustiva de Datos</h2>
                    <p>Recopilamos información para proporcionar mejores servicios a todos nuestros usuarios. Los tipos de información que recopilamos incluyen:</p>
                    
                    <h3 class="text-lg font-bold mt-6 mb-2 text-slate-800">3.1. Información que usted nos proporciona directamente</h3>
                    <ul>
                        <li><strong>Datos de Registro:</strong> Cuando crea una cuenta, recopilamos su nombre completo, dirección de correo electrónico, contraseña (encriptada), fecha de nacimiento y género.</li>
                        <li><strong>Datos de Perfil:</strong> Información adicional que decide añadir a su perfil, como foto de perfil, biografía, ubicación, intereses culturales y enlaces a redes sociales.</li>
                        <li><strong>Comunicaciones:</strong> Si nos contacta directamente, recopilamos el contenido de los mensajes, archivos adjuntos y metadatos asociados.</li>
                        <li><strong>Datos de Transacciones:</strong> Si realiza reservas de hoteles o compras de entradas, recopilamos detalles de pago (procesados de forma segura por terceros), historial de compras y direcciones de facturación.</li>
                    </ul>

                    <h3 class="text-lg font-bold mt-6 mb-2 text-slate-800">3.2. Información recopilada automáticamente</h3>
                    <ul>
                        <li><strong>Datos de Dispositivo y Navegación:</strong> Dirección IP, tipo de navegador, sistema operativo, identificadores únicos de dispositivo (UUID, IMEI), resolución de pantalla y configuración de idioma.</li>
                        <li><strong>Datos de Uso:</strong> Páginas visitadas, tiempo de permanencia, clics, rutas de navegación, tiempos de carga y errores experimentados.</li>
                        <li><strong>Datos de Ubicación:</strong> Ubicación aproximada basada en IP o ubicación precisa (GPS) si nos otorga permiso explícito en su dispositivo móvil.</li>
                        <li><strong>Cookies y Tecnologías Similares:</strong> Utilizamos cookies de sesión, cookies persistentes y web beacons para autenticación, preferencias y análisis.</li>
                    </ul>

                    <h3 class="text-lg font-bold mt-6 mb-2 text-slate-800">3.3. Información de Terceros (Social Login)</h3>
                    <p>Si decide registrarse o iniciar sesión mediante servicios de terceros como <strong>Facebook Login</strong> o <strong>Google Sign-In</strong>, recibimos automáticamente cierta información de estos proveedores, que puede incluir:</p>
                    <ul>
                        <li>Identificador único de usuario (OpenID / Facebook ID).</li>
                        <li>Dirección de correo electrónico verificada.</li>
                        <li>Nombre y foto de perfil pública.</li>
                        <li>Listas de amigos (solo si otorga permiso explícito).</li>
                        <li>Token de acceso y token de actualización para la autenticación continua.</li>
                    </ul>
                </section>

                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4 text-indigo-700">4. Finalidad y Base Legal del Procesamiento</h2>
                    <p>Utilizamos sus datos personales basándonos en las siguientes bases legales:</p>
                    
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-200">
                            <h4 class="font-bold text-slate-900 mb-2">Ejecución del Contrato</h4>
                            <p class="text-sm">Para gestionar su cuenta, procesar reservas, facilitar la comunicación con proveedores de servicios y proporcionar acceso a la plataforma.</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-200">
                            <h4 class="font-bold text-slate-900 mb-2">Consentimiento</h4>
                            <p class="text-sm">Para el envío de boletines informativos, uso de cookies no esenciales y procesamiento de datos sensibles (si aplica).</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-200">
                            <h4 class="font-bold text-slate-900 mb-2">Interés Legítimo</h4>
                            <p class="text-sm">Para mejorar nuestros servicios, garantizar la seguridad de la red, prevenir fraudes y realizar análisis de mercado.</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-200">
                            <h4 class="font-bold text-slate-900 mb-2">Cumplimiento Legal</h4>
                            <p class="text-sm">Para cumplir con obligaciones fiscales, legales y regulatorias ante las autoridades competentes del Perú.</p>
                        </div>
                    </div>
                </section>

                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4 text-indigo-700">5. Compartición y Transferencia de Datos</h2>
                    <p>No vendemos sus datos personales. Sin embargo, podemos compartir información con:</p>
                    <ul>
                        <li><strong>Proveedores de Servicios:</strong> Empresas que prestan servicios en nuestro nombre, como alojamiento web (AWS/Google Cloud), procesamiento de pagos (Stripe/Niubiz), análisis de datos (Google Analytics) y servicios de correo electrónico. Estos proveedores están obligados por contrato a proteger sus datos.</li>
                        <li><strong>Socios Comerciales:</strong> Hoteles y operadores turísticos con los que usted interactúa directamente a través de nuestra plataforma para completar sus reservas.</li>
                        <li><strong>Autoridades Legales:</strong> Cuando sea requerido por ley, orden judicial o para proteger derechos, propiedad o seguridad de Candelaria Digital o terceros.</li>
                        <li><strong>Transferencias Internacionales:</strong> Sus datos pueden ser procesados en servidores ubicados fuera de su país de residencia. Implementamos Cláusulas Contractuales Tipo (SCC) para garantizar un nivel adecuado de protección en transferencias transfronterizas.</li>
                    </ul>
                </section>

                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4 text-indigo-700">6. Seguridad de la Información</h2>
                    <p>Implementamos medidas técnicas y organizativas robustas para proteger sus datos:</p>
                    <ul>
                        <li>Encriptación SSL/TLS en tránsito para todas las comunicaciones.</li>
                        <li>Hashing seguro de contraseñas (Bcrypt/Argon2).</li>
                        <li>Controles de acceso estrictos y autenticación multifactor (MFA) para personal administrativo.</li>
                        <li>Monitoreo continuo de amenazas y auditorías de seguridad periódicas.</li>
                        <li>Copias de seguridad encriptadas y redundantes para garantizar la disponibilidad.</li>
                    </ul>
                    <p>A pesar de nuestros esfuerzos, ningún sistema es 100% invulnerable. En caso de una violación de seguridad que comprometa sus derechos, le notificaremos a usted y a las autoridades pertinentes dentro de las 72 horas siguientes a la detección, conforme a la normativa vigente.</p>
                </section>

                <section class="mb-10 p-6 bg-slate-100 rounded-xl">
                    <h2 class="text-2xl font-bold mb-4 flex items-center gap-2 text-indigo-700">
                        <i data-lucide="user-check" class="w-6 h-6"></i> 7. Sus Derechos de Privacidad (ARCO y GDPR)
                    </h2>
                    <p>Usted tiene control total sobre sus datos. Puede ejercer los siguientes derechos en cualquier momento:</p>
                    <ul class="grid md:grid-cols-2 gap-4 mt-4">
                        <li class="bg-white p-3 rounded shadow-sm"><strong>Acceso:</strong> Solicitar una copia de todos sus datos personales.</li>
                        <li class="bg-white p-3 rounded shadow-sm"><strong>Rectificación:</strong> Corregir datos inexactos o incompletos.</li>
                        <li class="bg-white p-3 rounded shadow-sm"><strong>Cancelación (Olvido):</strong> Solicitar la eliminación total de sus datos.</li>
                        <li class="bg-white p-3 rounded shadow-sm"><strong>Oposición:</strong> Oponerse al procesamiento de datos para marketing.</li>
                        <li class="bg-white p-3 rounded shadow-sm"><strong>Portabilidad:</strong> Recibir sus datos en un formato estructurado y legible (JSON/XML).</li>
                        <li class="bg-white p-3 rounded shadow-sm"><strong>Limitación:</strong> Restringir temporalmente el uso de sus datos.</li>
                    </ul>
                    <p class="mt-4">Para ejercer cualquiera de estos derechos, visite nuestra página de <a href="delete-data.php" class="text-indigo-600 font-bold hover:underline">Eliminación de Datos</a> o contacte a nuestro Oficial de Privacidad.</p>
                </section>

                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4 text-indigo-700">8. Retención de Datos</h2>
                    <p>Conservaremos sus datos personales solo durante el tiempo necesario para cumplir los fines para los que fueron recopilados, incluidos los fines de cumplir con requisitos legales, contables o de información. Para determinar el período de retención adecuado, consideramos la cantidad, naturaleza y sensibilidad de los datos personales, el riesgo potencial de daño por uso no autorizado, y las leyes aplicables de prescripción.</p>
                </section>

                <section class="mb-10">
                    <h2 class="text-2xl font-bold mb-4 text-indigo-700">9. Política de Cookies</h2>
                    <p>Nuestro sitio utiliza cookies esenciales para la operación del sitio y cookies de terceros para análisis. Usted puede configurar su navegador para rechazar todas o algunas cookies, pero esto puede afectar la funcionalidad del sitio.</p>
                </section>

                <div class="mt-12 pt-8 border-t border-slate-200 text-center">
                    <p class="font-bold text-slate-900">¿Tiene dudas adicionales?</p>
                    <a href="mailto:privacidad@mipuno.pe" class="inline-block mt-4 bg-indigo-600 text-white px-8 py-3 rounded-full font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                        Contactar al Oficial de Privacidad
                    </a>
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
