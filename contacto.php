<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto | Candelaria 2026</title>
    
    <!-- Critical CSS inline to prevent FOUC -->
    <style>
        /* Prevent FOUC - Hide body until styles load */
        body {
            opacity: 0;
            transition: opacity 0.3s ease-in;
        }
        body.loaded {
            opacity: 1;
        }
        
        /* Base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }

        h1, h2, h3, h4 {
            font-family: 'Montserrat', sans-serif;
            color: #1e293b;
        }
    </style>
    
    <!-- Preload critical resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    <link rel="preconnect" href="https://unpkg.com">
    
    <!-- Load fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Load icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-50">
    <?php
    // Include header after body tag
    $headerDepth = 0;
    $activePage = 'contacto';
    if (file_exists('includes/standard-header.php')) {
        require_once 'includes/standard-header.php';
    }
    ?>

    <main class="max-w-5xl mx-auto px-6 py-16">

        <!-- Header Banner -->
        <div class="mb-12">
            <h1
                class="text-3xl md:text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-800 to-amber-500 mb-2">
                Contáctanos</h1>
            <p class="text-slate-500 text-lg">Estamos aquí para ayudarte. Elige el medio que prefieras.</p>
        </div>


        <div class="flex flex-col gap-6">

            <!-- Card 1: Ayuda en Línea -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col md:flex-row items-center md:items-start md:gap-8 hover:shadow-md transition-shadow">
                <div class="mb-4 md:mb-0">
                    <div class="w-16 h-16 rounded-full border-2 border-slate-900 flex items-center justify-center">
                        <i data-lucide="message-circle" class="w-8 h-8 text-slate-900 stroke-[1.5]"></i>
                    </div>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Ayuda en línea</h3>
                    <p class="text-slate-500 mb-1">Horario Chatbot : 24/7 (sólo español)</p>
                    <p class="text-slate-500 mb-4">Horarios de Agentes: Lun a Vie 09:00-18:00 (sólo español)</p>
                    <a href="#"
                        onclick="if(window.toggleChat) toggleChat(); else alert('Chat no disponible'); return false;"
                        class="inline-flex items-center font-medium text-blue-500 hover:text-blue-600 transition-colors">
                        Chatea ahora <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Card 2: WhatsApp -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col md:flex-row items-center md:items-start md:gap-8 hover:shadow-md transition-shadow">
                <div class="mb-4 md:mb-0">
                    <div class="w-16 h-16 rounded-full border-2 border-slate-900 flex items-center justify-center">
                        <!-- Using fa icon for brand consistency closest to image, or lucide phone -->
                        <i class="fab fa-whatsapp text-3xl text-slate-900"></i>
                    </div>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">WhatsApp</h3>
                    <p class="text-slate-500 mb-1">+51 983519979 | Atención en Español | De lunes a viernes de 9 am a 6
                        pm</p>
                    <p class="text-slate-500 mb-4">Soporte para descarga de aplicaciones y consultas generales.</p>
                    <!-- Optional link if they want to click to chat -->
                    <!-- <a href="https://wa.me/51983519979" target="_blank" class="text-blue-500 hover:text-blue-600 font-medium">Chat en WhatsApp ></a> -->
                </div>
            </div>

            <!-- Card 3: Email -->
            <div
                class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 flex flex-col md:flex-row items-center md:items-start md:gap-8 hover:shadow-md transition-shadow">
                <div class="mb-4 md:mb-0">
                    <div class="w-16 h-16 rounded-full border-2 border-slate-900 flex items-center justify-center">
                        <i data-lucide="mail" class="w-8 h-8 text-slate-900 stroke-[1.5]"></i>
                    </div>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Envíanos un email</h3>

                    <a href="mailto:mipuno@gmail.com"
                        class="inline-flex items-center font-medium text-blue-500 hover:text-blue-600 transition-colors mt-2">
                        Escríbenos <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="mt-12 text-center text-slate-400 text-sm">
            <p>&copy; 2026 Festividad Virgen de la Candelaria</p>
        </div>

    </main>

    <!-- Global Footer Include (Standard) -->
    <?php
    $footerDepth = 0;
    require_once 'includes/standard-footer.php';
    ?>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Show body after everything is loaded
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('loaded');
        });
        
        // Fallback: show body after 500ms even if DOMContentLoaded hasn't fired
        setTimeout(function() {
            document.body.classList.add('loaded');
        }, 500);
    </script>
</body>

</html>