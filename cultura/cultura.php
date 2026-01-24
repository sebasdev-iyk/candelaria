<?php include '../includes/auth-header.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Legado Sagrado | Candelaria Puno</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- jsPDF Library for PDF Generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Configuración de Tailwind y Estilos Personalizados -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        candelaria: {
                            purple: '#4c1d95', // Color principal festivo
                            gold: '#fbbf24',   // Detalles premium
                            lake: '#0ea5e9',   // Lago Titicaca
                            light: '#f5f3ff',  // Fondos suaves
                            red: '#dc2626',    // Para acentos
                            green: '#16a34a'   // Para elementos positivos
                        }
                    },
                    fontFamily: {
                        sans: ['Open Sans', 'sans-serif'],
                        heading: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Montserrat', sans-serif;
        }

        /* Animaciones suaves */
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scrollbar personalizado */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Efecto Foto Antigua */
        .vintage-photo {
            filter: sepia(0.6) grayscale(0.5) contrast(1.2);
            transition: all 0.5s ease;
            position: relative;
        }

        .vintage-photo:hover {
            filter: sepia(0) grayscale(0) contrast(1);
            transform: scale(1.02);
        }

        /* Animaciones de Entrada */
        .reveal-up {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .reveal-up.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Línea de tiempo dorada */
        .golden-line {
            position: absolute;
            left: 20px;
            /* Ajuste para móvil */
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, transparent, #fbbf24, transparent);
        }

        @media (min-width: 768px) {
            .golden-line {
                left: 50%;
                transform: translateX(-50%);
            }

            .timeline-item-right {
                text-align: right;
            }
        }

        /* Estilo para línea de tiempo interactiva */
        .timeline-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #fbbf24;
            border: 3px solid white;
            box-shadow: 0 0 0 3px #fbbf24;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .timeline-dot:hover {
            transform: translateX(-50%) scale(1.3);
            box-shadow: 0 0 0 3px #fbbf24, 0 0 15px 5px rgba(251, 191, 36, 0.5);
        }

        .timeline-content {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .timeline-content.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* ========== EN TIEMPO REAL Button Styles ========== */
        .btn-live {
            position: relative;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 10px 24px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            overflow: hidden;
            animation: pulseLive 2s infinite;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-live::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transition: left 0.6s;
        }

        .btn-live:hover::before {
            left: 100%;
        }

        .btn-live:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 25px rgba(220, 38, 38, 0.6);
        }

        .live-dot {
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            animation: blink 1s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        @keyframes pulseLive {

            0%,
            100% {
                box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            }

            50% {
                box-shadow: 0 4px 25px rgba(220, 38, 38, 0.7), 0 0 30px rgba(220, 38, 38, 0.4);
            }
        }

        /* ========== Navigation Link Styles ========== */
        .nav-link-custom {
            color: #e9d5ff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 16px;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link-custom:hover {
            color: #fbbf24;
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: #fbbf24;
            transition: width 0.3s ease;
        }

        .nav-link-custom:hover::after {
            width: 80%;
        }

        .nav-link-custom.active {
            color: #fbbf24;
        }

        .nav-link-custom.active::after {
            width: 80%;
        }

        /* Header Manta Premium Style - Lliclla Pattern */
        .header-manta-premium {
            height: 140px;
            background-image: linear-gradient(rgba(45, 10, 80, 0.45), rgba(15, 5, 30, 0.65)), url('../principal/headerfondo2.jpg');
            background-size: auto 100%;
            background-repeat: repeat-x;
            background-position: center;
            position: relative;
            border-bottom: 3px solid #fbbf24;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .header-manta-premium::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, transparent 30%, rgba(0, 0, 0, 0.2) 100%);
            pointer-events: none;
        }

        .header-manta-premium>div {
            position: relative;
            z-index: 2;
        }

        /* Fix for sticky header overlap on anchor links */
        .tab-content {
            scroll-margin-top: 160px;
        }
    </style>
    <!-- Spark Effect CSS -->
    <link rel="stylesheet" href="../assets/css/sparks.css">
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Notificaciones Toast Container -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2"></div>

    <!-- Header Section - Standardized with EN TIEMPO REAL Style -->
    <header class="header-manta-premium text-white shadow-lg sticky top-0 z-40">

        <div class="w-full px-6 md:px-12 h-20 md:h-22 flex items-center">
            <div class="flex justify-between items-center w-full h-full">
                <a href="../index.php" id="logo-container"
                    class="flex items-center cursor-pointer group h-full relative spark-container">
                    <img src="../principal/logoc.png" alt="Candelaria"
                        class="h-full w-auto object-contain transition-transform duration-300 group-hover:scale-105 relative z-10">
                </a>
                <div class="flex items-center gap-6">
                    <nav class="hidden md:flex items-center gap-2">
                        <a href="../servicios/index.php" class="nav-link-custom">Servicios</a>
                        <a href="cultura.php" class="nav-link-custom active">Cultura</a>
                        <a href="../horarios_y_danzas/index.php" class="nav-link-custom">Horarios</a>
                        <a href="../noticias/index.php" class="nav-link-custom">Noticias</a>
                    </nav>
                    <?= getAuthButtonHTML() ?>
                    <a href="../live-platform/index.php" class="btn-live group !p-2.5 md:!px-6 md:!py-2.5">
                        <div class="live-dot"></div>
                        <span class="tracking-wider hidden md:inline">EN TIEMPO REAL</span>
                    </a>
                    <button class="md:hidden text-white" onclick="toggleMobileMenu()">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-candelaria-purple border-t border-purple-700 hidden">
        <div class="py-4 px-4 space-y-4">
            <a href="#historia" class="block text-purple-100 hover:text-white transition-colors">Historia</a>
            <a href="#conjuntos" class="block text-purple-100 hover:text-white transition-colors">Conjuntos</a>
            <a href="#danzas" class="block text-purple-100 hover:text-white transition-colors">Danzas</a>
            <a href="#ganadores" class="block text-purple-100 hover:text-white transition-colors">Ganadores</a>
            <a href="#cronologia" class="block text-purple-100 hover:text-white transition-colors">Cronología</a>
            <a href="../noticias/index.php"
                class="block text-purple-100 hover:text-white transition-colors font-bold text-candelaria-gold">Noticias</a>
            <button onclick="downloadInfo()"
                class="w-full bg-candelaria-gold text-purple-900 px-4 py-2 rounded-lg font-bold hover:bg-yellow-300 transition-colors shadow-lg">
                Descargar Info
            </button>
        </div>
    </div>

    <!-- HERO: EL ORIGEN MÍSTICO -->
    <header class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Imagen de Fondo Parallax -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1533560707325-1db36e788812?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                class="w-full h-full object-cover opacity-40 scale-110" alt="Fondo Místico"
                onerror="this.onerror=null;this.src='https://placehold.co/1920x1080/0f172a/d4af37?text=ALTIPLANO';">
            <div
                class="absolute inset-0 bg-gradient-to-t from-candelaria-purple via-candelaria-purple/80 to-transparent">
            </div>
        </div>

        <div class="relative z-10 text-center px-6 max-w-5xl">
            <i data-lucide="crown" class="w-12 h-12 mx-auto text-candelaria-gold mb-4 animate-bounce"></i>
            <h2 class="font-sans italic text-xl md:text-2xl text-purple-200 mb-4 tracking-wide">La historia y el fervor
                de</h2>
            <h1 class="font-heading text-5xl md:text-8xl font-black text-white mb-8 leading-tight">
                EL ALMA DEL<br>ALTIPLANO
            </h1>
            <p class="text-lg md:text-xl text-purple-100 max-w-2xl mx-auto font-light leading-relaxed">
                Patrimonio Cultural Inmaterial de la Humanidad por la UNESCO. Sumérgete en la fe, la danza y el legado
                histórico de la Mamita Candelaria.
            </p>
        </div>

        <!-- Scroll Indicator -->
        <div
            class="absolute bottom-10 left-1/2 -translate-x-1/2 text-white/50 flex flex-col items-center gap-2 animate-pulse">
            <span class="text-xs tracking-[0.3em] uppercase">Explorar</span>
            <div class="h-16 w-[1px] bg-gradient-to-b from-candelaria-gold to-transparent"></div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="w-full">

        <!-- Navigation Tabs -->
        <nav class="flex justify-center space-x-1 border-b border-gray-200 mb-6 overflow-x-auto pb-1 scrollbar-hide sticky top-[84px] bg-white z-30"
            aria-label="Tabs">
            <button onclick="setActiveTab('historia')" id="tab-historia"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2 border-candelaria-purple text-candelaria-purple">
                <i data-lucide="book" class="w-4 h-4"></i> Historia y Origen
            </button>
            <button onclick="setActiveTab('conjuntos')" id="tab-conjuntos"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2 border-transparent text-gray-500">
                <i data-lucide="users" class="w-4 h-4"></i> Conjuntos Folklóricos
            </button>
            <button onclick="setActiveTab('danzas')" id="tab-danzas"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2 border-transparent text-gray-500">
                <i data-lucide="drum" class="w-4 h-4"></i> Danzas y Significados
            </button>
            <button onclick="setActiveTab('ganadores')" id="tab-ganadores"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2 border-transparent text-gray-500">
                <i data-lucide="trophy" class="w-4 h-4"></i> Ganadores Históricos
            </button>
            <button onclick="setActiveTab('cronologia')" id="tab-cronologia"
                class="tab-btn whitespace-nowrap py-3 px-6 border-b-2 font-medium text-sm flex items-center gap-2 border-transparent text-gray-500">
                <i data-lucide="calendar" class="w-4 h-4"></i> Cronología
            </button>
        </nav>

        <!-- Container de Contenido -->
        <div id="content-container" class="w-full">

            <!-- 1. HISTORIA DE LA CANDELARIA -->
            <div id="historia" class="tab-content active-content w-full bg-slate-50 py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <!-- Header Clásico (Restaurado) -->
                    <header class="text-center mb-12 reveal-up">
                        <h2 class="font-heading text-4xl md:text-5xl font-extrabold text-candelaria-purple mb-4">El Origen Místico</h2>
                        <p class="text-gray-600 text-xl max-w-3xl mx-auto">Donde la fe virreinal y la Pachamama andina se hicieron una.</p>
                    </header>

                    <!-- Introducción Humanizada -->
                    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-gray-100 mb-12 reveal-up">
                        <p class="text-gray-700 leading-relaxed text-lg text-justify mb-0 first-letter:text-5xl first-letter:font-bold first-letter:text-candelaria-gold first-letter:mr-3 first-letter:float-left">
                            La ciudad de Puno, a más de 3,800 metros de altura, es el corazón de una de las celebraciones más intensas de América. La Festividad de la Virgen de la Candelaria es mucho más que baile; es el encuentro vivo de dos mundos. Aquí, la historia de resistencia andina se mezcla con la fe católica para dar vida a una identidad única, que hoy el mundo reconoce como Patrimonio de la Humanidad.
                        </p>
                    </div>

                    <!-- SECCIÓN 1: EL ASEDIO -->
                    <div class="grid md:grid-cols-1 lg:grid-cols-12 gap-8 mb-16">
                        <div class="lg:col-span-8 space-y-8">
                            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 reveal-up">
                                <h3 class="flex items-center gap-3 text-2xl font-bold text-gray-900 mb-6 font-heading border-b border-gray-100 pb-4">
                                    <span class="bg-red-50 text-red-600 w-10 h-10 flex items-center justify-center rounded-lg"><i data-lucide="sword" class="w-5 h-5"></i></span>
                                    1781: Una Historia de Fe y Guerra
                                </h3>
                                <p class="text-gray-700 leading-relaxed mb-4 text-justify">
                                    Para entender la devoción de Puno, debemos viajar al año 1781. El Altiplano vivía tiempos de guerra. La rebelión de Túpac Amaru II crecía y, junto a Túpac Katari, pusieron a la región en jaque.
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-4 text-justify">
                                    <strong>El Asedio:</strong> Puno resistía, pero estaba rodeada por un ejército rebelde de más de 12,000 hombres. Aislados y superados, la esperanza parecía perdida.
                                </p>
                                <div class="bg-slate-50 p-6 rounded-xl border-l-4 border-candelaria-purple my-6">
                                    <h4 class="font-bold text-gray-900 mb-2">El Milagro que Salvó a la Ciudad</h4>
                                    <p class="text-gray-600 italic text-sm text-justify">
                                        "Cuenta la historia que, en la oscuridad, los rebeldes vieron un ejército inmenso bajando de los cerros con antorchas. Se asustaron y huyeron. Pero no era un ejército: eran los pobladores de Puno en procesión con la Virgen, cuyas velas y rezos se multiplicaron ante los ojos del enemigo."
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-4 space-y-8">
                             <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                <h4 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wider">Datos Clave (1781)</h4>
                                <table class="w-full text-sm text-left text-gray-600">
                                    <tbody class="divide-y divide-gray-100">
                                        <tr>
                                            <td class="py-3 font-medium text-gray-900">Fuerza Rebelde</td>
                                            <td class="py-3 text-right">12,000 - 18,000</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 font-medium text-gray-900">Líder Rebelde</td>
                                            <td class="py-3 text-right">Túpac Katari / Vilcapaza</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 font-medium text-gray-900">Corregidor</td>
                                            <td class="py-3 text-right">Joaquín de Orellana</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 font-medium text-gray-900">Desenlace</td>
                                            <td class="py-3 text-right text-green-600 font-bold">Retirada Rebelde</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="rounded-2xl overflow-hidden shadow-lg h-64">
                                <img src="assets/procesion1871.png" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 2: SINCRETISMO -->
                    <div class="bg-white p-8 md:p-12 rounded-2xl shadow-sm border border-gray-100 mb-16">
                        <div class="grid md:grid-cols-2 gap-12 items-center">
                            <div>
                                <h3 class="flex items-center gap-3 text-2xl font-bold text-gray-900 mb-6 font-heading">
                                    <span class="bg-green-100 text-green-600 w-10 h-10 flex items-center justify-center rounded-lg"><i data-lucide="sprout" class="w-5 h-5"></i></span>
                                    El Rostro de la Pachamama
                                </h3>
                                <p class="text-gray-700 leading-relaxed mb-4 text-justify">
                                    La evangelización en el Altiplano no fue una sustitución, sino una negociación. La Virgen de la Candelaria es la encarnación de la <strong>Pachamama</strong>.
                                </p>
                                <ul class="space-y-4">
                                    <li class="flex items-start gap-3">
                                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mt-1 flex-shrink-0"></i>
                                        <div>
                                            <strong class="block text-gray-900">Coincidencia Agrícola</strong>
                                            <p class="text-sm text-gray-600 text-justify">Febrero es el tiempo del <em>Juchuy Pucuy</em> (primeros frutos). La fiesta conmemora la purificación de María y agradece la fertilidad de la tierra.</p>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mt-1 flex-shrink-0"></i>
                                        <div>
                                            <strong class="block text-gray-900">Guardianes del Titicaca</strong>
                                            <p class="text-sm text-gray-600 text-justify">La Virgen heredó el papel de guardiana del Lago Titicaca. Su procesión renueva el vínculo con el agua sagrada, asegurando el equilibrio ecológico.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="relative">
                                <img src="assets/VirgenCerro.png" class="rounded-xl shadow-lg w-full object-cover h-80">
                                <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-lg shadow-xl border border-gray-100 max-w-xs hidden md:block">
                                    <p class="text-xs text-gray-500 italic">"Los indígenas se apropiaron de las imágenes cristianas porque ofrecían recompensas similares a sus antiguas divinidades." — Manuel Marzal</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN: EL CICLO RITUAL -->
                    <div class="mb-16">
                        <div class="bg-slate-900 rounded-2xl p-8 md:p-12 shadow-2xl relative overflow-hidden text-white">
                            <div class="absolute top-0 right-0 p-32 bg-candelaria-purple rounded-full blur-3xl opacity-20 -mr-16 -mt-16"></div>
                            <div class="relative z-10">
                                <h3 class="flex items-center gap-3 text-2xl font-bold mb-8 font-heading text-white">
                                    <span class="bg-yellow-500 text-purple-900 w-10 h-10 flex items-center justify-center rounded-lg"><i data-lucide="clock" class="w-5 h-5"></i></span>
                                    Un Ciclo Sagrado
                                </h3>
                                <p class="text-slate-300 leading-relaxed mb-8 max-w-3xl text-lg">
                                    La Candelaria no es un evento aislado; es una respiración profunda que dura semanas. Es un tiempo litúrgico y festivo que transforma la vida cotidiana de Puno.
                                </p>
                                
                                <div class="grid md:grid-cols-4 gap-6">
                                    <!-- Fase 1 -->
                                    <div class="bg-slate-800/50 p-6 rounded-xl border border-slate-700 hover:border-yellow-500/50 transition-colors">
                                        <div class="text-yellow-400 font-bold text-sm mb-2 uppercase tracking-wider">24 Ene - 1 Feb</div>
                                        <h4 class="font-bold text-lg mb-2">Las Novenas</h4>
                                        <p class="text-sm text-slate-400">El tiempo del silencio y la oración. Los devotos acuden al Santuario para "preparar el alma" antes de la fiesta.</p>
                                    </div>
                                    <!-- Fase 2 -->
                                    <div class="bg-slate-800/50 p-6 rounded-xl border border-slate-700 hover:border-yellow-500/50 transition-colors">
                                        <div class="text-yellow-400 font-bold text-sm mb-2 uppercase tracking-wider">2 de Febrero</div>
                                        <h4 class="font-bold text-lg mb-2">Día Central</h4>
                                        <p class="text-sm text-slate-400">La Misa de Fiesta y la Procesión. La ciudad se detiene para ver pasar a la "Mamita" sobre alfombras de flores.</p>
                                    </div>
                                    <!-- Fase 3 -->
                                    <div class="bg-slate-800/50 p-6 rounded-xl border border-slate-700 hover:border-yellow-500/50 transition-colors">
                                        <div class="text-yellow-400 font-bold text-sm mb-2 uppercase tracking-wider">La Octava</div>
                                        <h4 class="font-bold text-lg mb-2">El Esplendor</h4>
                                        <p class="text-sm text-slate-400">El Concurso de Trajes de Luces. 50,000 danzantes toman el estadio y las calles en un estallido de color y música.</p>
                                    </div>
                                    <!-- Fase 4 -->
                                    <div class="bg-slate-800/50 p-6 rounded-xl border border-slate-700 hover:border-yellow-500/50 transition-colors">
                                        <div class="text-yellow-400 font-bold text-sm mb-2 uppercase tracking-wider">Cacharpari</div>
                                        <h4 class="font-bold text-lg mb-2">La Despedida</h4>
                                        <p class="text-sm text-slate-400">La fiesta termina con la promesa de volver. Se realiza el "Cacharpari" o despedida hasta el próximo año.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 3: MÁSCARAS -->
                    <div class="grid md:grid-cols-1 lg:grid-cols-12 gap-8 mb-16">
                        <div class="lg:col-span-12">
                             <h3 class="flex items-center gap-3 text-2xl font-bold text-gray-900 mb-6 font-heading">
                                <span class="bg-purple-100 text-purple-600 w-10 h-10 flex items-center justify-center rounded-lg"><i data-lucide="venetian-mask" class="w-5 h-5"></i></span>
                                El Poder de la Máscara
                            </h3>
                        </div>
                        <div class="lg:col-span-7 space-y-6">
                            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 h-full">
                                <p class="text-gray-700 leading-relaxed mb-6 text-justify">
                                    En la festividad puneña, la máscara no oculta, <strong>revela</strong>. Según la antropóloga Gisela Cánepa Koch, la máscara ritual funciona en una doble dimensión: permite al danzante entrar en un proceso de mímesis, apropiándose del poder del "otro" (el español, el diablo, el esclavo).
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-0 text-justify">
                                    Al asumir roles foráneos —como el capataz en los Caporales—, el sujeto andino ejerce una forma de resistencia cultural, subvirtiendo el orden colonial a través de la sátira y la estética.
                                </p>
                            </div>
                        </div>
                        <div class="lg:col-span-5">
                            <div class="bg-white overflow-hidden rounded-2xl shadow-sm border border-gray-100">
                                <table class="w-full text-sm text-left">
                                    <thead class="bg-gray-50 text-gray-700 font-bold uppercase text-xs">
                                        <tr>
                                            <th class="px-6 py-3">Concepto (Cánepa)</th>
                                            <th class="px-6 py-3">Aplicación en Puno</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 text-gray-600">
                                        <tr>
                                            <td class="px-6 py-3 font-medium text-indigo-700">Dimensión Doble</td>
                                            <td class="px-6 py-3">Oculta al individuo, revela el mito</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-3 font-medium text-indigo-700">Mímesis</td>
                                            <td class="px-6 py-3">Apropiación de poder ajeno</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-3 font-medium text-indigo-700">Identidad Colectiva</td>
                                            <td class="px-6 py-3">La comparsa es el sujeto social</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-3 font-medium text-indigo-700">Mediación</td>
                                            <td class="px-6 py-3">Resolución de conflictos históricos</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 4: DANZAS -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mb-16">
                        <h3 class="flex items-center gap-3 text-2xl font-bold text-gray-900 mb-8 font-heading">
                            <span class="bg-yellow-100 text-yellow-600 w-10 h-10 flex items-center justify-center rounded-lg"><i data-lucide="music" class="w-5 h-5"></i></span>
                            Mosaico de Resistencia: Las Danzas
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-10 mb-8">
                            <div>
                                <h4 class="font-bold text-lg text-gray-900 mb-3 text-candelaria-purple">Diablada Puneña</h4>
                                <p class="text-sm text-gray-600 text-justify mb-4">
                                    Complejo entrelazamiento de catequización jesuita y mitología minera. El "Supay" no es el mal absoluto, sino el dueño del Uku Pacha (subsuelo).
                                </p>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-900 mb-3 text-candelaria-purple">Morenada</h4>
                                <p class="text-sm text-gray-600 text-justify mb-4">
                                    Homenaje doloroso y rítmico a la memoria de los esclavos africanos. El sonido de las matracas evoca el caminar encadenado.
                                </p>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left border-t border-gray-100">
                                <thead class="bg-gray-50 text-gray-900 font-bold">
                                    <tr>
                                        <th class="px-6 py-3">Categoría</th>
                                        <th class="px-6 py-3">Ejemplos</th>
                                        <th class="px-6 py-3">Origen y Simbolismo</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-gray-600">
                                    <tr>
                                        <td class="px-6 py-4 font-medium">De Luces</td>
                                        <td class="px-6 py-4">Diablada, Caporales, Morenada</td>
                                        <td class="px-6 py-4">Mestizaje urbano, sátira, lujo ostentoso.</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 font-medium">Autóctonas</td>
                                        <td class="px-6 py-4">Sikuris, Ayarachis</td>
                                        <td class="px-6 py-4">Comunidades rurales, rituales agrícolas, solemnidad.</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 font-medium">Cazadores</td>
                                        <td class="px-6 py-4">Choqqelas, Llipi-puli</td>
                                        <td class="px-6 py-4">Relación hombre-naturaleza, fauna andina.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- SECCIÓN 5: SOCIEDAD PROFUNDA -->
                    <div class="mb-16">
                        <div class="bg-white p-8 md:p-12 rounded-2xl shadow-sm border border-gray-100">
                            <h3 class="flex items-center gap-3 text-2xl font-bold text-gray-900 mb-8 font-heading">
                                <span class="bg-indigo-100 text-indigo-600 w-10 h-10 flex items-center justify-center rounded-lg"><i data-lucide="users" class="w-5 h-5"></i></span>
                                La Trama Invisible: Fe y Reciprocidad
                            </h3>
                            
                            <div class="grid md:grid-cols-2 gap-12">
                                <div>
                                    <p class="text-gray-700 leading-relaxed mb-6 text-justify">
                                        Detrás del espectáculo visual, la Candelaria se sostiene sobre una maquinaria social antigua y poderosa. No es solo devoción; es un pacto de solidaridad comunitaria conocido como <strong>Ayni</strong> (reciprocidad).
                                    </p>
                                    <div class="space-y-6">
                                        <div class="flex gap-4">
                                            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 text-candelaria-purple">
                                                <i data-lucide="crown" class="w-6 h-6"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">El Alferado</h4>
                                                <p class="text-sm text-gray-600 text-justify mt-1">
                                                    Es el mayordomo de la fiesta. Asumir este cargo implica un prestigio inmenso pero también una carga económica brutal. El Alferado costea bandas, comida y bebida, no por riqueza, sino por fe y servicio a su comunidad.
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex gap-4">
                                            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 text-candelaria-purple">
                                                <i data-lucide="shirt" class="w-6 h-6"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">Maestros Artesanos</h4>
                                                <p class="text-sm text-gray-600 text-justify mt-1">
                                                    Bordadores y mascareros son los arquitectos de la fantasía. Sus talleres trabajan todo el año creando obras de arte en hilo de oro y pedrería, manteniendo vivas técnicas coloniales que son Patrimonio Cultural de la Nación.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                                    <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                        <i data-lucide="bar-chart-3" class="w-4 h-4 text-gray-400"></i>
                                        Impacto de la Fe
                                    </h4>
                                    <div class="space-y-4">
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <div class="text-3xl font-bold text-candelaria-gold mb-1">100,000+</div>
                                            <div class="text-xs text-gray-500 uppercase tracking-widest">Visitantes Anuales</div>
                                        </div>
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <div class="text-3xl font-bold text-green-600 mb-1">200+</div>
                                            <div class="text-xs text-gray-500 uppercase tracking-widest">Conjuntos Folklóricos</div>
                                        </div>
                                        <div class="border-t border-gray-200 pt-4 mt-2">
                                            <p class="text-xs text-gray-500 italic text-center">
                                                "La fiesta redistribuye la riqueza y refuerza los lazos de parentesco. Nadie baila solo; se baila en y para la comunidad."
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- SECCIÓN 6: VIDEO ARCHIVO -->
                    <div class="bg-slate-900 rounded-2xl overflow-hidden shadow-2xl mb-16">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/3 p-8 flex flex-col justify-center bg-slate-800">
                                <span class="text-yellow-500 font-bold tracking-widest text-xs mb-2 uppercase">Archivo Histórico</span>
                                <h3 class="text-white font-heading text-2xl font-bold mb-4">Voces del Pasado</h3>
                                <p class="text-slate-400 text-sm mb-6">
                                    Documentos audiovisuales que registran la evolución de la festividad. Entrevistas y registros de la década de los 80s y 90s.
                                </p>
                            </div>
                            <div class="md:w-2/3 bg-black relative aspect-video">
                                <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/E2lx_G8kxFc?autoplay=1&mute=1" title="Archivo Candelaria" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- REFERENCIAS -->
                    <div class="border-t border-gray-200 pt-8">
                        <h5 class="font-bold text-gray-900 text-sm mb-4 uppercase tracking-wider">Referencias Bibliográficas</h5>
                        <div class="grid md:grid-cols-2 gap-4 text-xs text-gray-500">
                            <a href="https://ich.unesco.org/es/RL/la-fiesta-de-la-virgin-de-la-candelaria-en-puno-00956" target="_blank" class="hover:text-candelaria-purple transition-colors truncate block">
                                [1] UNESCO (2014). La fiesta de la Virgen de la Candelaria en Puno.
                            </a>
                            <a href="https://doi.org/10.18800/anthropologica.199801.021" target="_blank" class="hover:text-candelaria-purple transition-colors truncate block">
                                [2] Cánepa, G. (1998). Máscara, transformación e identidad.
                            </a>
                            <a href="https://revistas.pucp.edu.pe/index.php/historica/article/download/28718/26367" target="_blank" class="hover:text-candelaria-purple transition-colors truncate block">
                                [3] Cahill, D. (2002). The Siege of La Paz and the Battle of Puno.
                            </a>
                            <a href="http://intranet.comunidadandina.org/documentos/BDA/pe-ca-0005.pdf" target="_blank" class="hover:text-candelaria-purple transition-colors truncate block">
                                [4] Comunidad Andina. Sincretismo y Cosmovisión en los Andes.
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- 2. HISTORIA DE LOS CONJUNTOS -->
            <div id="conjuntos" class="tab-content hidden w-full bg-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- NEW HERO: EPOPEYA -->
                    <header class="text-center mb-16 reveal-up">
                        <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">Arquitectura Cultural</span>
                        <h2 class="font-heading text-4xl md:text-5xl font-extrabold text-candelaria-purple mb-6">
                            Una Epopeya del Altiplano
                        </h2>
                        <p class="text-gray-700 text-lg leading-relaxed max-w-4xl mx-auto text-justify">
                            La Festividad no representa únicamente una manifestación de fe religiosa, sino el eje gravitacional de la identidad del Altiplano. Reconocida por la UNESCO, es un complejo sincretismo donde los conjuntos folklóricos actúan como reservorios de memoria colectiva y motores de innovación estética. Estas agrupaciones, muchas centenarias, han forjado la historia de Puno a través de la danza, la música y una devoción inquebrantable.
                        </p>
                    </header>

                    <!-- SECTION: GENESIS & TIMELINE -->
                    <!-- Contenido redundante removido para mejorar la experiencia de usuario -->
                    <div class="mb-12"></div>

                    <!-- SECTION: SIKURIS LEGENDARIOS -->
                    <div class="mb-20">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-px bg-gray-200 flex-1"></div>
                            <h3 class="font-heading text-3xl font-extrabold text-center text-gray-900 uppercase tracking-widest">
                                <span class="text-candelaria-gold">I.</span> Los Cimientos: Sikuris
                            </h3>
                            <div class="h-px bg-gray-200 flex-1"></div>
                        </div>
                        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">
                            La base espiritual reside en los sikuris, símbolo de la dualidad andina (arca/ira). Son las instituciones más antiguas, manteniendo su estructura comunitaria.
                        </p>

                        <div class="grid md:grid-cols-3 gap-8">
                            <!-- CARD 1: MAÑAZO -->
                            <div class="group relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                                <div class="absolute top-4 right-4 z-10 bg-candelaria-purple text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">1892</div>
                                <div class="h-56 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
                                    <img src="https://imgmedia.larepublica.pe/640x384/larepublica/migration/images/AUYVEJ2FDJGGXBBFODIK7OQQKY.webp" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                    <h4 class="absolute bottom-4 left-4 z-20 text-white font-heading text-xl font-bold">Sikuris Mañazo</h4>
                                </div>
                                <div class="p-6">
                                    <p class="text-sm text-gray-600 mb-4 text-justify">
                                        <strong>Resistencia de los Matarifes.</strong> Surgió del gremio de carniceros. Se sostiene que de aquí surgieron los primeros "diablos" con máscaras de toro. Guardianes del estilo de un solo bombo.
                                    </p>
                                    <div class="flex gap-2">
                                        <button onclick="openConjuntoModal('sikuris-manazo')" class="flex-1 py-2 text-candelaria-purple font-bold text-sm border border-candelaria-purple rounded hover:bg-purple-50 transition-colors">Ver Historia</button>
                                        <button onclick="generatePDF('sikuris-manazo')" class="px-3 py-2 bg-candelaria-gold text-purple-900 rounded hover:bg-yellow-400 transition-colors"><i data-lucide="download" class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD 2: JUVENTUD OBRERA -->
                            <div class="group relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                                <div class="absolute top-4 right-4 z-10 bg-candelaria-purple text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">1884</div>
                                <div class="h-56 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
                                    <img src="https://www.punomagico.com/image/juventud%20obrera%202021.jpg" onerror="this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=JUVENTUD+OBRERA'" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                    <h4 class="absolute bottom-4 left-4 z-20 text-white font-heading text-xl font-bold">Juventud Obrera</h4>
                                </div>
                                <div class="p-6">
                                    <p class="text-sm text-gray-600 mb-4 text-justify">
                                        <strong>El Legado Obrero.</strong> Representa el vínculo entre el campesinado y la nueva clase obrera urbana. A través de sus talleres, han asegurado la transmisión de la técnica del siku por generaciones.
                                    </p>
                                    <div class="flex gap-2">
                                        <button onclick="openConjuntoModal('sikuris-juventud-obrera')" class="flex-1 py-2 text-candelaria-purple font-bold text-sm border border-candelaria-purple rounded hover:bg-purple-50 transition-colors">Ver Historia</button>
                                        <button onclick="generatePDF('sikuris-juventud-obrera')" class="px-3 py-2 bg-candelaria-gold text-purple-900 rounded hover:bg-yellow-400 transition-colors"><i data-lucide="download" class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD 3: QHANTATI URURI -->
                            <div class="group relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                                <div class="absolute top-4 right-4 z-10 bg-candelaria-purple text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">1913</div>
                                <div class="h-56 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10"></div>
                                    <img src="https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/468534294_10160885465911295_6005985246805577581_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=0b6b33&_nc_eui2=AeF_HogN7k97sYMMtIX1sZWpdqNZLu11YW12o1ku7XVhbfchF8x_z-rA7g5q0O4YqDwgFWati0h75Z7IE3SMT1iO&_nc_ohc=vvTTmmsEzqQQ7kNvwGw1KTn&_nc_oc=AdkiUVkrpCNKzBNcPACNvZ1qZEhoQ_3022hNaWlRKxCkHPrNd66i_7VqyioQfJIJE8o&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=oTyCPorLYwjnd-R6A3wLVw&oh=00_AfrTbtgij2r8aSs4wEcMBRd7JhMFlJMvcvJNNIiKkjsOGQ&oe=6979AF7B" onerror="this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=QHANTATI+URURI'" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                    <h4 class="absolute bottom-4 left-4 z-20 text-white font-heading text-xl font-bold">Qhantati Ururi</h4>
                                </div>
                                <div class="p-6">
                                    <p class="text-sm text-gray-600 mb-4 text-justify">
                                        <strong>La Leyenda del Siku.</strong> Desde Conima (Moho). Aportaron una dimensión mística y melódica única ("estilo suave"). Su presencia subraya que la festividad integra a las provincias lejanas.
                                    </p>
                                    <div class="flex gap-2">
                                        <button onclick="openConjuntoModal('sikuris-qhantati-ururi')" class="flex-1 py-2 text-candelaria-purple font-bold text-sm border border-candelaria-purple rounded hover:bg-purple-50 transition-colors">Ver Historia</button>
                                        <button onclick="generatePDF('sikuris-qhantati-ururi')" class="px-3 py-2 bg-candelaria-gold text-purple-900 rounded hover:bg-yellow-400 transition-colors"><i data-lucide="download" class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: TRAJES DE LUCES -->
                    <div class="mb-20">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-px bg-gray-200 flex-1"></div>
                            <h3 class="font-heading text-3xl font-extrabold text-center text-gray-900 uppercase tracking-widest">
                                <span class="text-candelaria-gold">II.</span> El Resplandor: Trajes de Luces
                            </h3>
                            <div class="h-px bg-gray-200 flex-1"></div>
                        </div>
                        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">
                            A mediados del s. XX, la fiesta se transforma. Aparecen los bordados en oro, la pedrería y las bandas de metales. Es la era de la "Diablada" y la "Morenada".
                        </p>

                        <!-- SUBSECTION: DIABLADAS -->
                        <h4 class="font-heading text-xl font-bold text-candelaria-purple mb-6 pl-4 border-l-4 border-candelaria-purple">La Diablada: Lucifer en el Altiplano</h4>
                        <div class="grid md:grid-cols-2 gap-8 mb-12">
                            <!-- DIABLADA PORTEÑO -->
                            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row gap-6 items-center">
                                <div class="w-full md:w-1/3 h-40 shrink-0">
                                    <img src="assets/dporteno.png" onerror="this.src='https://placehold.co/400x400/b91c1c/ffffff?text=PORTEÑO'" class="w-full h-full object-cover rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <h5 class="font-bold text-lg">Tradicional Diablada Porteño</h5>
                                        <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded">1962</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 text-justify">
                                        Surgida en el Barrio Porteño, profesionalizó la danza y elevó los estándares artísticos. Un punto de inflexión en la competencia moderna.
                                    </p>
                                    <button onclick="openConjuntoModal('diablada-porteno')" class="text-candelaria-purple text-sm font-bold hover:underline">Leer más</button>
                                </div>
                            </div>
                            <!-- DIABLADA BELLAVISTA -->
                            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row gap-6 items-center">
                                <div class="w-full md:w-1/3 h-40 shrink-0">
                                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhE6LPtSpDH5jaLU0pg8jsFTPzL5Kg4e0YBV-QgmSDdtP0QKj7T3l7tYYJJJXPQ8VoCm9ArqO5fbnA6az1-o_G2UrFHo2umlKrsavvCWkDqGyGNtrkvHSkljM709uAyz5kwMFuU9troCBPF/s280/Diablos_Puno.jpg" class="w-full h-full object-cover rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <h5 class="font-bold text-lg">Diablada Bellavista</h5>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">1963</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 text-justify">
                                        Su rival histórica. Fundada por Simón Rodríguez y Paulina Gómez. Famosa por la influencia de maestros bolivianos y el lujo de sus trajes.
                                    </p>
                                    <div class="flex gap-2">
                                        <button onclick="openConjuntoModal('diablada-bellavista')" class="text-candelaria-purple text-sm font-bold hover:underline">Leer más</button>
                                        <button onclick="generatePDF('diablada-bellavista')" class="text-candelaria-gold hover:text-yellow-600"><i data-lucide="download" class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBSECTION: MORENADAS -->
                        <h4 class="font-heading text-xl font-bold text-candelaria-purple mb-6 pl-4 border-l-4 border-candelaria-purple">Morenadas: Elegancia y Peso</h4>
                        <div class="grid md:grid-cols-2 gap-8 mb-12">
                            <!-- ORKAPATA -->
                            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row gap-6 items-center">
                                <div class="w-full md:w-1/3 h-40 shrink-0">
                                    <img src="https://vivecandelaria.com/wp-content/uploads/2021/05/morenada-orkapata-1024x600.jpg" class="w-full h-full object-cover rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <h5 class="font-bold text-lg">Morenada Orkapata</h5>
                                        <span class="bg-amber-100 text-amber-800 text-xs font-bold px-2 py-1 rounded">1955</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 text-justify">
                                        Pionera. Sus miembros bailaban en Mañazo antes de institucionalizarse. Transición orgánica de lo autóctono a lo mestizo.
                                    </p>
                                    <div class="flex gap-2">
                                        <button onclick="openConjuntoModal('morenada-orkapata')" class="text-candelaria-purple text-sm font-bold hover:underline">Leer más</button>
                                        <button onclick="generatePDF('morenada-orkapata')" class="text-candelaria-gold hover:text-yellow-600"><i data-lucide="download" class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- LAYKAKOTA -->
                            <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row gap-6 items-center">
                                <div class="w-full md:w-1/3 h-40 shrink-0">
                                    <img src="https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/476632019_1170733227970041_2953058933484479784_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=f727a1&_nc_eui2=AeEpuwh3xJc20s5XNni6ulcDYDNZPaGwWQZgM1k9obBZBodqc5ms3v8EzQdmNDVyhHxWRFCqN2CtEfHHQEUGMMOl&_nc_ohc=7qtT2TwvB0kQ7kNvwFocCvJ&_nc_oc=AdkgY6GQDg31cWMSI1yw4knu8OQQ0IWW4vvePKdcJLKfGjiVHxbYy9UHh35AMxyUhcA&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=NtVGG1ZqasrKnC9Eu5a4vQ&oh=00_AfruFSNh7CHdaUZWxjpDMLr4_xK2DvcRJRS_MKU1Bi4ZHw&oe=6979981B" onerror="this.src='https://placehold.co/400x400/4c1d95/fbbf24?text=LAYKAKOTA'" class="w-full h-full object-cover rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <h5 class="font-bold text-lg">Morenada Laykakota</h5>
                                        <span class="bg-amber-100 text-amber-800 text-xs font-bold px-2 py-1 rounded">1962</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 text-justify">
                                        Evolucionó de "Rey Moreno" a Morenada masiva (2007). Campeón de campeones en 2012, representando la masificación moderna.
                                    </p>
                                    <button onclick="openConjuntoModal('morenada-laykakota')" class="text-candelaria-purple text-sm font-bold hover:underline">Leer más</button>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE: FUNDACIONES -->
                        <div class="bg-slate-900 rounded-xl p-6 text-white overflow-hidden">
                            <h4 class="font-bold mb-4 flex items-center gap-2"><i data-lucide="list" class="w-5 h-5 text-yellow-400"></i> Cronología de Fundaciones</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-slate-300">
                                    <thead class="text-yellow-400 border-b border-slate-700 uppercase text-xs">
                                        <tr>
                                            <th class="px-4 py-3">Conjunto</th>
                                            <th class="px-4 py-3">Año</th>
                                            <th class="px-4 py-3">Importancia Histórica</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-700">
                                        <tr>
                                            <td class="px-4 py-3 font-medium text-white">Morenada Orkapata</td>
                                            <td class="px-4 py-3">1955</td>
                                            <td class="px-4 py-3">Primera morenada institucionalizada.</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 font-medium text-white">Diablada Porteño</td>
                                            <td class="px-4 py-3">1962</td>
                                            <td class="px-4 py-3">Iniciadora de la era moderna.</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 font-medium text-white">Diablada Bellavista</td>
                                            <td class="px-4 py-3">1963</td>
                                            <td class="px-4 py-3">Prestigio competitivo y organización.</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 font-medium text-white">Confraternidad Victoria</td>
                                            <td class="px-4 py-3">1965</td>
                                            <td class="px-4 py-3">Expansión nacional del folklore.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: INSTITUCIONALIZACIÓN & GLOBALIZACIÓN -->
                    <div class="grid md:grid-cols-2 gap-12 mb-20 items-center">
                        <div>
                            <span class="text-indigo-600 font-bold uppercase tracking-wider text-xs mb-2 block">1967 - Presente</span>
                            <h3 class="font-heading text-2xl font-bold text-gray-900 mb-4">La Era de la Institucionalización</h3>
                            <p class="text-gray-600 mb-6 text-justify">
                                La visita de <strong>José María Arguedas</strong> en 1967 fue clave. Al ver el espectáculo en el Estadio Torres Belón, llamó a Puno la "Capital Simbólica de la Danza". La creación de la Federación Regional de Folklore transformó la fiesta parroquial en un concurso de escala global con más de 130,000 danzantes.
                            </p>
                            <h4 class="font-heading text-lg font-bold text-gray-900 mb-2 mt-8">Impacto Caporal</h4>
                            <p class="text-sm text-gray-600 text-justify">
                                En los 80s, los Caporales (recreados en Bolivia por los Hnos. Estrada) conquistaron a la juventud. Agrupaciones como <em>Caporales Huáscar</em> (1982) y <em>Centralistas</em> (1996) internacionalizaron la fiesta a Miami y NY.
                            </p>
                        </div>
                        <div class="bg-gray-100 rounded-xl p-6 relative">
                            <div class="absolute -top-4 -right-4 bg-yellow-400 w-12 h-12 flex items-center justify-center rounded-full shadow-lg font-bold text-lg">!</div>
                            <blockquote class="italic text-gray-600 text-center font-serif text-lg">
                                "La festividad redistribuye la riqueza y refuerza los lazos de parentesco. Nadie baila solo; se baila en y para la comunidad."
                            </blockquote>
                        </div>
                    </div>

                    <!-- SECTION: ARTESANOS -->
                    <div class="bg-indigo-900 rounded-2xl p-8 md:p-12 text-white mb-20 relative overflow-hidden">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                        <div class="relative z-10 grid md:grid-cols-2 gap-12 items-center">
                            <div>
                                <h3 class="font-heading text-3xl font-bold mb-6">Maestros Mascareros y Bordadores</h3>
                                <p class="text-indigo-200 mb-6 text-justify leading-relaxed">
                                    La magnificencia visual es obra de los talleres de Puno. En 1956, los hermanos Velásquez revolucionaron la mascarería, reemplazando la importación por una iconografía propia de ojos de vidrio soplado. Los bordadores convirtieron cada traje en un "texto visual" de la identidad local.
                                </p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white/10 p-4 rounded-lg backdrop-blur text-center">
                                    <i data-lucide="lasso" class="w-8 h-8 mx-auto mb-2 text-yellow-400"></i>
                                    <span class="block font-bold">Bordadores</span>
                                    <span class="text-xs text-indigo-300">Hilos de oro y plata</span>
                                </div>
                                <div class="bg-white/10 p-4 rounded-lg backdrop-blur text-center">
                                    <i data-lucide="smile" class="w-8 h-8 mx-auto mb-2 text-yellow-400"></i>
                                    <span class="block font-bold">Mascareros</span>
                                    <span class="text-xs text-indigo-300">Yeso y latón</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ARCHIVOS VISUALES -->
                    <div class="mb-16">
                        <h3 class="font-heading text-2xl font-bold text-gray-900 mb-6 text-center">Archivos de la Memoria</h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <a href="https://ich.unesco.org/es/10-lista-representativa-00748?include=slideshow_inc.php&id=00956&width=620&call=slideshow&mode=scroll" target="_blank" class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-candelaria-purple hover:shadow-lg transition-all">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600"><i data-lucide="globe" class="w-5 h-5"></i></div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-candelaria-purple">UNESCO Gallery</h4>
                                </div>
                                <p class="text-xs text-gray-500">Diapositivas históricas y contemporáneas oficiales.</p>
                            </a>
                            <a href="http://repositorio.unap.edu.pe/" target="_blank" class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-candelaria-purple hover:shadow-lg transition-all">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="bg-candelaria-purple/10 p-2 rounded-lg text-candelaria-purple"><i data-lucide="book-open" class="w-5 h-5"></i></div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-candelaria-purple">Repositorio UNAP</h4>
                                </div>
                                <p class="text-xs text-gray-500">Investigaciones y fotos de campo históricas.</p>
                            </a>
                            <a href="https://www.punomagico.com/folklor%20historia.html" target="_blank" class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-candelaria-purple hover:shadow-lg transition-all">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="bg-amber-100 p-2 rounded-lg text-amber-600"><i data-lucide="image" class="w-5 h-5"></i></div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-candelaria-purple">Puno Mágico</h4>
                                </div>
                                <p class="text-xs text-gray-500">Crónicas y fotos de conjuntos fundacionales.</p>
                            </a>
                        </div>
                    </div>

                    <!-- Delegate Request Section -->
                    <div
                        class="mt-16 max-w-2xl mx-auto bg-candelaria-light p-8 rounded-xl shadow-2xl border border-candelaria-gold/20 reveal-up">
                        <h3 class="font-heading text-2xl text-candelaria-purple mb-4 flex items-center gap-2">
                            <i data-lucide="hand-heart" class="w-6 h-6"></i> ¿Eres delegado de un conjunto?
                        </h3>
                        <p class="text-gray-700 mb-6">
                            Si representas a un conjunto folklórico y deseas contribuir con información histórica,
                            documentación o crear el perfil de una nueva danza, completa el siguiente formulario.
                        </p>
                        <button onclick="showDelegateForm()"
                            class="w-full px-5 py-3 bg-candelaria-purple text-white font-bold rounded-lg hover:bg-purple-800 transition-colors shadow-md flex items-center justify-center gap-2">
                            <i data-lucide="edit-3" class="w-5 h-5"></i>
                            Solicitar Formulario de Aporte Histórico
                        </button>
                    </div>

                    <!-- Formulario (Inicialmente Oculto) -->
                    <div id="delegate-form"
                        class="mt-8 max-w-2xl mx-auto bg-white p-8 rounded-xl border border-candelaria-purple/40 hidden reveal-up">
                        <h4 class="font-heading text-xl text-gray-900 mb-6 text-center">Formulario para Delegados de
                            Conjuntos</h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Conjunto</label>
                                <input type="text" placeholder="Ej: Caporales Centralistas"
                                    class="w-full p-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-candelaria-purple focus:border-candelaria-purple">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Danza</label>
                                <select
                                    class="w-full p-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-candelaria-purple focus:border-candelaria-purple">
                                    <option value="">Selecciona una danza</option>
                                    <option value="diablada">Diablada</option>
                                    <option value="morenada">Morenada</option>
                                    <option value="caporales">Caporales</option>
                                    <option value="sikuris">Sikuris</option>
                                    <option value="llamerada">Llamerada</option>
                                    <option value="tinku">Tinku</option>
                                    <option value="other">Otra danza</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Año de Fundación</label>
                                <input type="number" placeholder="Ej: 1985"
                                    class="w-full p-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-candelaria-purple focus:border-candelaria-purple">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico de
                                    Contacto</label>
                                <input type="email" placeholder="correo@ejemplo.com"
                                    class="w-full p-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-candelaria-purple focus:border-candelaria-purple">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Información
                                    Histórica</label>
                                <textarea
                                    placeholder="Describe la historia, logros y datos relevantes de tu conjunto..."
                                    rows="4"
                                    class="w-full p-3 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-candelaria-purple focus:border-candelaria-purple"></textarea>
                            </div>
                            <button
                                class="w-full px-5 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
                                <i data-lucide="send" class="w-5 h-5"></i>
                                Enviar Solicitud
                            </button>
                        </div>
                        <p class="text-center text-xs text-gray-500 mt-4">Nos contactaremos para validar la información
                            y agregarla a nuestra base de datos histórica.</p>
                    </div>
                </div>
            </div>

            <!-- 3. HISTORIA DE LAS DANZAS (CON SIGNIFICADO) -->
            <div id="danzas" class="tab-content hidden w-full bg-gray-100 py-16 relative" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
                <?php include 'danzas_content.php'; ?>
            </div>

            <!-- 4. GANADORES HISTÓRICOS -->
            <div id="ganadores" class="tab-content hidden w-full bg-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <header class="text-center mb-12 reveal-up">
                        <h2 class="font-heading text-4xl md:text-5xl font-extrabold text-candelaria-purple mb-4">El
                            Olimpo de los Campeones</h2>
                        <p class="text-gray-600 text-xl max-w-3xl mx-auto">Los conjuntos que han alcanzado la máxima
                            gloria en el Concurso de Danzas.</p>
                    </header>

                    <!-- Filtros por categoría -->
                    <div class="flex justify-center mb-8">
                        <div class="inline-flex rounded-lg border border-gray-200 p-1 bg-gray-100">
                            <button id="filter-trajes-luces"
                                class="px-4 py-2 text-sm font-medium rounded-md bg-candelaria-purple text-white transition-colors">
                                Trajes de Luces
                            </button>
                            <button id="filter-autoctonos"
                                class="px-4 py-2 text-sm font-medium rounded-md text-gray-500 hover:text-gray-700 transition-colors">
                                Autóctonos
                            </button>
                        </div>
                    </div>

                    <!-- Información sobre las categorías -->
                    <div class="bg-candelaria-light p-6 rounded-xl mb-8 reveal-up">
                        <h3 class="font-heading text-xl text-candelaria-purple mb-4">Sobre el Concurso</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-heading font-bold text-gray-900 mb-2 flex items-center gap-2">
                                    <i data-lucide="sparkles" class="w-5 h-5 text-candelaria-gold"></i>
                                    Trajes de Luces
                                </h4>
                                <p class="text-gray-700 text-sm">Caracterizados por trajes elaborados con lentejuelas,
                                    bordados y adornos metálicos. Esta categoría tiene una veneración de dos días debido
                                    a la gran cantidad de conjuntos participantes.</p>
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-gray-900 mb-2 flex items-center gap-2">
                                    <i data-lucide="mountain" class="w-5 h-5 text-candelaria-green"></i>
                                    Danzas Autóctonas
                                </h4>
                                <p class="text-gray-700 text-sm">Preservan las tradiciones ancestrales con trajes y
                                    coreografías que mantienen la esencia de las culturas originarias del altiplano.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Ganadores recientes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- 2025 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2025</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Confraternidad Morenada Santa Rosa</h3>
                                    <span class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Campeón de Campeones 2025 con 87.71 puntos. Destacó por la armonía de sus pasos y la espectacularidad de su banda.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('morenada-santa-rosa-2025')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2025</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Wifalas de Muñani</h3>
                                    <span class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Ganador oficial 2025 con 63.10 puntos. Prioridad ganada sobre criterios técnicos por su coreografía impecable.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('wifalas-munani-2025')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2024 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2024</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Morenada Laykakota</h3>
                                    <span class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Campeón de Campeones 2024 con un puntaje final de 86.32 puntos, liderando la categoría de Traje de Luces.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('rey-moreno-2024')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2024</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Cultural Unucajas de Azángaro</h3>
                                    <span class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Primer lugar 2024 con 88.68 puntos, reafirmando que la zona quechua continúa siendo la reserva técnica de las danzas.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('unucajas-2024')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2020 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2020</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Folklórica Espectacular Diablada Bellavista</h3>
                                    <span class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Último gran ganador antes de la pandemia (94.26 puntos). Sofisticación técnica en su bloque de arcángeles.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('diablada-bellavista-2020')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2020</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Cultural Musuq Illariy "Carnaval de Patambuco"</h3>
                                    <span class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Triunfo indiscutible con una puntuación de 88.84 en el último concurso antes de la emergencia sanitaria.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('patambuco-2020')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2019 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2019</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Incomparable Gran Diablada Amigos de la PNP</h3>
                                    <span class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Recuperaron el título con 88.66 puntos, destacando por su disciplina y consistencia en ambos escenarios.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('pnp-2019')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2019</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Cultural Chunchos de Esquilaya (Ayapata)</h3>
                                    <span class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Récord Histórico de 97.69 puntos. Emocionaron al jurado con su danza ancestral para evitar su extinción.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('chunchos-esquilaya-2019')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2018 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2018</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Confraternidad Morenada Orkapata</h3>
                                    <span class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Retornaron al título máximo después de décadas (89.47 puntos), marcando el resurgimiento de la Morenada.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('morenada-orkapata-2018')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2017 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="https://www.punomagico.com/image/pnp%202021.png" onerror="this.src='https://placehold.co/600x400/b91c1c/ffffff?text=DIABLADA+PNP'" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Diablada PNP">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2017</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Incomparable Gran Diablada Amigos de la PNP</h3>
                                    <span class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Sexto campeonato histórico con 90.53 puntos, definiendo la estética moderna con bloques masivos.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('pnp-2017')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2017</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Cultural Carnaval Chaku de Chucahuacas</h3>
                                    <span class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Campeón con 93.10 puntos. Danza ritual enérgica y vestimenta colorida que cautivó al jurado.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('chaku-2017')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2016 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2016</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Folklórica Diablada Centinelas del Altiplano</h3>
                                    <span class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Primer campeonato absoluto con 91.54 puntos. Elogiado por su disciplina y simetría militar en la danza.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('centinelas-2016')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2016</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Conjunto de Wifalas San Antonio de Putina</h3>
                                    <span class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Triunfo con 94.00 puntos. Con cintas de colores y pinkillos evocan sonidos de la naturaleza.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('wifalas-putina-2016')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2015 -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2015</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Cultural Caporales Centralistas Puno</h3>
                                    <span class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Campeón de Campeones con 90.37 puntos. Hito histórico en la categoría frente a su gran rival.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('caporales-centralistas-2015')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up" data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" alt="Cargando...">
                                <div class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">2015</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Wifalas San Francisco Javier de Muñani (Azángaro)</h3>
                                    <span class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Ganador oficial 2015. Patrimonio de la Nación de gran elegancia y pureza en la zona quechua.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('wifalas-munani-2015')" class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Los Años de Suspensión -->
                    <div class="mt-16 bg-slate-900 rounded-2xl p-8 md:p-12 shadow-2xl relative overflow-hidden text-white reveal-up">
                        <div class="absolute top-0 right-0 p-32 bg-red-600 rounded-full blur-3xl opacity-20 -mr-16 -mt-16"></div>
                        <div class="relative z-10">
                            <h3 class="flex items-center gap-3 text-2xl font-bold mb-6 font-heading">
                                <span class="bg-red-600 text-white w-10 h-10 flex items-center justify-center rounded-lg"><i data-lucide="alert-triangle" class="w-5 h-5"></i></span>
                                El Silencio Progresivo (2021-2023)
                            </h3>
                            <div class="grid md:grid-cols-2 gap-8 items-start">
                                <div class="space-y-4">
                                    <p class="text-slate-300 leading-relaxed text-justify">
                                        Por primera vez en la era moderna, la festividad enfrentó tres años de suspensión consecutiva. Un vacío cultural y económico que puso a prueba la resiliencia de la Capital del Folklore.
                                    </p>
                                    <div class="bg-slate-800/50 p-6 rounded-xl border border-slate-700">
                                        <h4 class="font-bold text-red-400 mb-2">Impacto Económico</h4>
                                        <p class="text-sm text-slate-400">Se estima que la región dejó de percibir más de <span class="text-white font-bold">230 millones de soles</span> durante la crisis social y sanitaria.</p>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700 text-slate-300 font-bold shrink-0">1</div>
                                        <div>
                                            <h4 class="font-bold text-lg">Pandemia (2021-2022)</h4>
                                            <p class="text-sm text-slate-400">Cancelación estricta por motivos de salud pública mundial (COVID-19).</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700 text-slate-300 font-bold shrink-0">2</div>
                                        <div>
                                            <h4 class="font-bold text-lg">Crisis Social (2023)</h4>
                                            <p class="text-sm text-slate-400">El luto por los sucesos de Juliaca llevó a los conjuntos a votar por la cancelación total en señal de duelo.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center pt-12 reveal-up">
                        <a href="#"
                            class="inline-flex items-center gap-2 text-candelaria-purple hover:text-purple-800 transition-colors border-b border-candelaria-purple pb-1 uppercase tracking-widest text-sm font-heading font-bold">
                            Ver Palmarés Completo (1960 - Hoy)
                        </a>
                    </div>
                </div>
            </div>

            <!-- 5. CRONOLOGÍA INTERACTIVA -->
            <div id="cronologia" class="tab-content hidden w-full bg-candelaria-light py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <header class="text-center mb-12 reveal-up">
                        <h2 class="font-heading text-4xl md:text-5xl font-extrabold text-candelaria-purple mb-4">
                            Candelarias en el Tiempo</h2>
                        <p class="text-gray-600 text-xl max-w-3xl mx-auto">Un viaje interactivo por la evolución de la
                            Festividad a través de los años.</p>
                    </header>

                    <!-- Línea de tiempo interactiva -->
                    <div class="relative py-10">
                        <!-- Línea central -->
                        <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-candelaria-gold"></div>

                        <!-- Elementos de la línea de tiempo -->
                        <div class="space-y-20">
                            <!-- Era 1: 1950-1970 -->
                            <div class="relative flex flex-col md:flex-row items-center">
                                <div class="md:w-1/2 md:pr-12 mb-8 md:mb-0 md:text-right">
                                    <div class="timeline-content">
                                        <h3 class="font-heading text-2xl font-bold text-candelaria-purple mb-2">Décadas
                                            de Oro (1950-1970)</h3>
                                        <p class="text-gray-700 mb-4">La época de las cofradías originales y el inicio
                                            de la formalización del concurso. Las máscaras de yeso y los trajes de lana
                                            definen esta era. Pura esencia ritual.</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="bg-candelaria-purple/10 text-candelaria-purple px-3 py-1 rounded-full text-xs font-medium">Cofradías</span>
                                            <span
                                                class="bg-candelaria-purple/10 text-candelaria-purple px-3 py-1 rounded-full text-xs font-medium">Máscaras
                                                de Yeso</span>
                                            <span
                                                class="bg-candelaria-purple/10 text-candelaria-purple px-3 py-1 rounded-full text-xs font-medium">Tradición
                                                Oral</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-dot" onclick="toggleTimelineContent(0)"></div>
                                <div class="md:w-1/2 md:pl-12">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiijAyeVlb8shbRm-HMeE-XNwfbG4uRXlBUImio62n416pNahZ-iij-ug09YMBTqK4GwnEN2OXQh-iO8tNKai-pH7y8_PgSp3EXvIBSAg4TPiEMpxqI0phlGdujmt17EpqCXNL1icP7Q1Q/s1600/Edwin+Losa.jpg"
                                            class="w-full h-48 object-cover vintage-photo" alt="Candelaria años 50"
                                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=CANDELARIA+1950-1970';">
                                    </div>
                                </div>
                            </div>

                            <!-- Era 2: 1980-1990 -->
                            <div class="relative flex flex-col md:flex-row items-center">
                                <div class="md:w-1/2 md:pr-12 order-2 md:order-1">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                        <img src="https://static.wixstatic.com/media/27f42d_c1c0a0c4f82643a290333250b73e52f0~mv2.jpg/v1/fill/w_980,h_653,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/27f42d_c1c0a0c4f82643a290333250b73e52f0~mv2.jpg"
                                            class="w-full h-48 object-cover vintage-photo" alt="Candelaria años 80"
                                            onerror="this.onerror=null;this.src='https://vivecandelaria.com/wp-content/uploads/2017/02/candelaria-puno-1950.jpg';">
                                    </div>
                                </div>
                                <div class="timeline-dot" onclick="toggleTimelineContent(1)"></div>
                                <div class="md:w-1/2 md:pl-12 mb-8 md:mb-0 order-1 md:order-2">
                                    <div class="timeline-content">
                                        <h3 class="font-heading text-2xl font-bold text-candelaria-purple mb-2">El Boom
                                            del Bordado (1980-1990)</h3>
                                        <p class="text-gray-700 mb-4">Ingresa la alta costura andina. Los trajes se
                                            vuelven más elaborados y pesados, con lentejuelas y bordados de hilos de
                                            oro. El concurso crece en número de participantes y la rivalidad se
                                            intensifica.</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="bg-candelaria-red/10 text-candelaria-red px-3 py-1 rounded-full text-xs font-medium">Alta
                                                Costura</span>
                                            <span
                                                class="bg-candelaria-red/10 text-candelaria-red px-3 py-1 rounded-full text-xs font-medium">Lentejuelas</span>
                                            <span
                                                class="bg-candelaria-red/10 text-candelaria-red px-3 py-1 rounded-full text-xs font-medium">Crecimiento</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Era 3: 2000-Presente -->
                            <div class="relative flex flex-col md:flex-row items-center">
                                <div class="md:w-1/2 md:pr-12 mb-8 md:mb-0 md:text-right">
                                    <div class="timeline-content">
                                        <h3 class="font-heading text-2xl font-bold text-candelaria-purple mb-2">
                                            Patrimonio Global (2000 - Hoy)</h3>
                                        <p class="text-gray-700 mb-4">Declaración UNESCO (2014) y la globalización de la
                                            danza. Se prioriza la agilidad y la sincronía masiva. El uso de la
                                            tecnología en la difusión la convierte en un fenómeno mundial.</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="bg-candelaria-green/10 text-candelaria-green px-3 py-1 rounded-full text-xs font-medium">UNESCO</span>
                                            <span
                                                class="bg-candelaria-green/10 text-candelaria-green px-3 py-1 rounded-full text-xs font-medium">Globalización</span>
                                            <span
                                                class="bg-candelaria-green/10 text-candelaria-green px-3 py-1 rounded-full text-xs font-medium">Tecnología</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-dot" onclick="toggleTimelineContent(2)"></div>
                                <div class="md:w-1/2 md:pl-12">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                        <img src="https://vivecandelaria.com/wp-content/uploads/2024/12/festividad-virgen-candelaria-2025-una-puno.jpg"
                                            class="w-full h-48 object-cover vintage-photo" alt="Candelaria actual"
                                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=CANDELARIA+ACTUAL';">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->


    <!-- Modal para conjuntos (oculto inicialmente) -->
    <div id="conjunto-modal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm"
            onclick="closeConjuntoModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl fade-in">
                    <div id="conjunto-modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para ganadores (oculto inicialmente) -->
    <div id="ganador-modal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm"
            onclick="closeGanadorModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl fade-in">
                    <div id="ganador-modal-content"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        lucide.createIcons();

        // --- JS para Animaciones y Tabs ---

        // 1. Lógica de Tabs
        function setActiveTab(tab) {
            // Actualizar botones
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-candelaria-purple', 'text-candelaria-purple', 'text-gray-900');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            const activeBtn = document.getElementById(`tab-${tab}`);
            activeBtn.classList.remove('border-transparent', 'text-gray-500');
            activeBtn.classList.add('border-candelaria-purple', 'text-candelaria-purple', 'text-gray-900');

            // Ocultar/Mostrar contenido
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active-content');
                content.scrollTop = 0; // Reset scroll on content change
            });

            const activeContent = document.getElementById(tab);
            if (activeContent) {
                activeContent.classList.remove('hidden');
                activeContent.classList.add('active-content');
                // Re-ejecutar animación para el nuevo contenido (excluyendo el header HERO)
                activeContent.querySelectorAll('.reveal-up').forEach(el => {
                    if (!el.closest('header.relative')) { // No aplicar animación a elementos en el header HERO
                        el.classList.remove('active');
                        // Pequeño delay para que la transición se vea
                        setTimeout(() => el.classList.add('active'), 100);
                    }
                });
            }

            // Persistir pestaña activa
            localStorage.setItem('activeCulturaTab', tab);

            // Si estamos en la pestaña de ganadores, activar el filtro por defecto
            if (tab === 'ganadores') {
                filterGanadores('trajes-luces');
            }

            // Si estamos en la cronología, activar el primer elemento
            if (tab === 'cronologia') {
                setTimeout(() => {
                    document.querySelectorAll('.timeline-content')[0].classList.add('active');
                }, 500);
            }
        }

        // 2. Lógica de Revelación por Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // No aplicar animación a elementos en el header HERO
                    if (!entry.target.closest('header.relative')) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target); // Dejar de observar una vez revelado
                    }
                }
            });
        }, { threshold: 0.1 });

        // Observar elementos iniciales (se re-observarán al cambiar de tab)
        // Excluir elementos del header HERO del observer
        document.querySelectorAll('.reveal-up').forEach(el => {
            if (!el.closest('header.relative')) { // Solo observar elementos fuera del header HERO
                observer.observe(el);
            }
        });

        // 3. Lógica para el Formulario de Delegado
        function showDelegateForm() {
            const form = document.getElementById('delegate-form');
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                form.classList.add('hidden');
            }
        }

        // 4. Lógica de Descarga de Información (Mockup)
        function downloadInfo() {
            const content = `
**EL LEGADO SAGRADO: FESTIVIDAD VIRGEN DE LA CANDELARIA DE PUNO**

---
**I. HISTORIA Y ORIGEN**

**El Milagro de 1781:**
El relato fundacional sitúa el milagro en el contexto del gran levantamiento de Túpac Catari. La ciudad de Puno se encontraba sitiada y al borde de la rendición. Los pobladores, como último recurso, sacaron la imagen de la Virgen en procesión. Se dice que el reflejo de las antorchas y el sonido amplificado de los instrumentos hicieron creer a las tropas rebeldes que un vasto ejército marchaba hacia ellos, provocando una retirada inesperada. Este evento selló el pacto entre la Virgen y la ciudad.

**Sincretismo: La Pachamama:**
En el Altiplano, la figura de la Virgen de la Candelaria se fusionó con la de la Pachamama (Madre Tierra). Febrero, tiempo de la Candelaria, coincide con el tiempo de la siembra y las primeras cosechas andinas. Las ofrendas y el fervor no son solo católicos; son también un tributo a la fertilidad del lago Titicaca y los Apus (montañas sagradas).

---
**II. SIGNIFICADO DE LAS DANZAS**

1. **La Diablada:** Representa el triunfo del Arcángel San Miguel sobre los siete pecados capitales.
2. **La Morenada:** Simboliza la trata de esclavos africanos. El paso pesado y las matracas emulan el arrastre de las cadenas.
3. **Caporales:** Inspirada en los capataces (Caporal) de las haciendas. Danza de fuerza y autoridad.

---
**III. CONJUNTOS LEGENDARIOS**

- **Sikuris Mañazo (1892):** Considerado uno de los conjuntos más antiguos. Surgió del gremio de carniceros (mañazos).
- **Morenada Orkapata (1955):** Fundada por la clase media y artistas, se centró en la precisión histórica de la indumentaria.
- **Diablada Bellavista (1963):** Introdujo una disciplina coreográfica estricta, elevando el espectáculo de la Diablada.

---
**IV. GANADORES HISTÓRICOS**

**2024 - Trajes de Luces:** Rey Moreno Laykakota
**2023 - Trajes de Luces:** Caporales Huáscar
**2020 - Autóctonos:** Waka Waka Puno

(Esta información es una muestra de datos verídicos sobre la Festividad.)
            `;

            const blob = new Blob([content], { type: 'text/plain;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Candelaria_Puno_Legado_Historico.txt';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);

            // Mensaje de confirmación suave
            showToast('¡Descarga iniciada! Se ha generado un archivo TXT con la información histórica.');
        }

        // 5. Lógica del Menú Móvil
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // 6. Función para mostrar notificaciones Toast
        function showToast(message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = 'bg-gray-800 text-white px-6 py-3 rounded-lg shadow-lg text-sm font-medium flex items-center gap-2 transform translate-y-10 opacity-0 transition-all duration-300';
            toast.innerHTML = `<i data-lucide="check" class="w-4 h-4 text-green-400"></i> ${message}`;

            container.appendChild(toast);
            lucide.createIcons();

            // Animate in
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-10', 'opacity-0');
            });

            // Remove after 3s
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-4');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // 7. Lógica para filtros de ganadores
        function filterGanadores(category) {
            const ganadores = document.querySelectorAll('[data-category]');
            ganadores.forEach(ganador => {
                if (ganador.getAttribute('data-category') === category) {
                    ganador.style.display = 'block';
                } else {
                    ganador.style.display = 'none';
                }
            });

            // Actualizar botones activos
            document.getElementById('filter-trajes-luces').classList.remove('bg-candelaria-purple', 'text-white');
            document.getElementById('filter-autoctonos').classList.remove('bg-candelaria-purple', 'text-white');

            if (category === 'trajes-luces') {
                document.getElementById('filter-trajes-luces').classList.add('bg-candelaria-purple', 'text-white');
                document.getElementById('filter-autoctonos').classList.add('text-gray-500', 'hover:text-gray-700');
            } else {
                document.getElementById('filter-autoctonos').classList.add('bg-candelaria-purple', 'text-white');
                document.getElementById('filter-trajes-luces').classList.add('text-gray-500', 'hover:text-gray-700');
            }
        }

        // 8. Lógica para línea de tiempo interactiva
        function toggleTimelineContent(index) {
            const contents = document.querySelectorAll('.timeline-content');
            contents.forEach((content, i) => {
                if (i === index) {
                    content.classList.toggle('active');
                } else {
                    content.classList.remove('active');
                }
            });
        }

        // 9. Lógica para modal de conjuntos
        // Función para convertir links de YouTube a formato Embed compatible
        function formatYoutubeEmbed(url) {
            if (!url) return '';
            let videoId = '';
            
            // Caso 1: youtu.be/ID
            if (url.includes('youtu.be/')) {
                videoId = url.split('youtu.be/')[1].split('?')[0];
            } 
            // Caso 2: youtube.com/watch?v=ID
            else if (url.includes('v=')) {
                videoId = url.split('v=')[1].split('&')[0];
            }
            // Caso 3: youtube.com/embed/ID
            else if (url.includes('embed/')) {
                videoId = url.split('embed/')[1].split('?')[0];
            }
            // Caso 4: short URL con ?v=
            else if (url.includes('youtube.com/')) {
                const parts = url.split('/');
                videoId = parts[parts.length - 1].split('?')[0];
            }

            if (!videoId) return url; // Retornar original si no se reconoce
            
            // Retornar formato embed con parámetros de autoplay y limpieza
            return `https://www.youtube.com/embed/${videoId}?autoplay=1&enablejsapi=1&rel=0&modestbranding=1`;
        }

        const ganadoresData = {
            'morenada-santa-rosa-2025': {
                title: 'Confraternidad Morenada Santa Rosa',
                year: '2025',
                category: 'Trajes de Luces',
                score: '87.71',
                badges: ['Campeón de Campeones', 'Morenada'],
                reasons: [
                    'Armonía impecable en los pasos colectivos',
                    'Espectacularidad sonora de su banda institucional',
                    'Innovación en el diseño de las polleras y mantas',
                    'Sincronización perfecta entre bloques masivos'
                ],
                video: 'https://youtu.be/zHyI2YsZOHM?si=oeJX9ukfku4pRYfg',
                image: 'https://radioondaazul.com/wp-content/uploads/2024/02/IMG_6843-scaled.jpg',
                gallery: [
                    'https://i.ytimg.com/vi/offdD_fD7ec/sddefault.jpg',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/IMG_6845-scaled.jpg',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/IMG_6849-scaled.jpg'
                ]
            },
            'wifalas-munani-2025': {
                title: 'Wifalas San Francisco Javier de Muñani',
                year: '2025',
                category: 'Autóctonos',
                score: '63.10',
                badges: ['Ganador Oficial*', 'Azángaro'],
                reasons: [
                    'Ejecución técnica impecable de la danza Wifala',
                    'Uso de vestimentas de lana de oveja',
                    'Simbolismo puro de la alegría del carnaval',
                    'Prioridad ganada por criterios de desempate técnicos'
                ],
                video: 'https://youtu.be/Hdz7oQ2L56U?si=Hzxic8d8Xp8102s5',
                image: 'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/481667780_607308822167738_924106991794853925_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFLAVA3lxGs8Ej9UFiB-DvBjyA_PgfEAxmPID8-B8QDGXEDsOLsEQT7VLCe4feW1VjNhdvvKc0FSItBw_Z9QOUr&_nc_ohc=Oztc0rf6B34Q7kNvwGwrOsK&_nc_oc=AdnoitbuUW-MHhasf-XJ_-NFbgX44SDHHhxVcoHL7HnUq7nmU19PtqZLVTyoV3o6Ei4&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=wxajznF_QQs_lW64Q5LDUw&oh=00_AfpXPUFgdW7nJWbPzL22HSrSYsN79wfHjN8sObr8sZyrfw&oe=6979ED0C',
                gallery: [
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/481829898_607309548834332_6895553575553519726_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeHMkCrtV6xli4KPIUvlqPRoUCluByf5JGZQKW4HJ_kkZl_vm3r4usKC6XFX9eWbV7eIBNnBQloBBFVB5T8Zwv1q&_nc_ohc=yMe6mzyhzroQ7kNvwEo_JXk&_nc_oc=AdmpFsoaVivsvQ7Bi5qUuXHfKmtdHZvlpx8RiL73fAkcAM6Wz42XxgTSu5SmM_3iu8k&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=LavnZ_LUGxPUYznva1qCCw&oh=00_AfqJ-uBCfF49nl3he8N7ZFLHKd_rRqgGG1lf9VJIBKtr2A&oe=697A056C',
                    'https://scontent.flim6-3.fna.fbcdn.net/v/t39.30808-6/481697180_607309715500982_2190773412209976210_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFaYx47ZUaUqv3aayKdG6p46jQ2TN_knnjqNDZM3-SeeNsYQkj5vd59lhF_NaCbZMm3fhOyifnmQNrN9zvBCoVt&_nc_ohc=3OxPtdh718QQ7kNvwFTVOvm&_nc_oc=AdkAiSQuqRto4lg44s_B_KLAjXLbAdU95WkydgMfxx3hYUtaTyEe-fZwiwnQpwaVTAQ&_nc_zt=23&_nc_ht=scontent.flim6-3.fna&_nc_gid=f_1YtMJmOGWWxuAuAJPKrg&oh=00_AfoYcQ6qB1l5ZVRAwHT42yWP-pWMLQUzup6TGteNtEDgJg&oe=6979F699',
                    'https://radioondaazul.com/wp-content/uploads/2024/08/IMG_0378-scaled.jpg'
                ]
            },
            'rey-moreno-2024': {
                title: 'Morenada Laykakota',
                year: '2024',
                category: 'Trajes de Luces',
                score: '86.32',
                badges: ['Gran Campeón', 'Morenada'],
                reasons: [
                    'Coreografía impecable con transiciones fluidas entre formaciones',
                    'Vestuario de extraordinaria elaboración con bordados en hilo de oro',
                    'Interpretación musical precisa y potente',
                    'Excelente sincronización entre más de 200 danzantes'
                ],
                video: 'https://youtu.be/mWjsPu_scqs?si=jwqM5lQK8AHy_IYH',
                image: 'https://radioondaazul.com/wp-content/uploads/2024/02/IMG_7154-scaled.jpg',
                gallery: [
                    'https://radioondaazul.com/wp-content/uploads/2024/02/IMG_4226-scaled.jpg',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/WhatsApp-Image-2024-02-14-at-6.12.36-PM.jpeg',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/Morenada-Laykakota.jpg'
                ]
            },
            'unucajas-2024': {
                title: 'Asociación Cultural Unucajas de Azángaro',
                year: '2024',
                category: 'Autóctonos',
                score: '88.68',
                badges: ['Reserva Moral', 'Azángaro'],
                reasons: [
                    'Mantenimiento fiel de la herencia dancística quechua',
                    'Potencia sonora de los pinkillos tradicionales',
                    'Resiliencia regional en el retorno de la festividad',
                    'Vestimenta auténtica elaborada por comuneros'
                ],
                video: 'https://youtu.be/zB-ZGsfYdaE?si=_Q91WqYb2HLpmGQy',
                image: 'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0049-4-scaled.jpg',
                gallery: [
                    'https://radioondaazul.com/wp-content/uploads/2024/02/Conjunto-Unucajas-de-Azangaro.jpg',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0056-5-scaled.jpg',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0002-1-scaled.jpg'
                ]
            },
            'diablada-bellavista-2020': {
                title: 'Asociación Folklórica Espectacular Diablada Bellavista',
                year: '2020',
                category: 'Trajes de Luces',
                score: '94.26',
                badges: ['Elegancia Barrio', 'Diablada'],
                reasons: [
                    'Sofisticación técnica superior en el bloque de "arcángeles"',
                    'Coordinación milimétrica en el salto de diablos',
                    'Impacto visual de sus máscaras de fibra de vidrio',
                    'Tradición mantenida por 11 campeonatos previos'
                ],
                video: 'https://youtu.be/EIoshYmAf2w?si=r4fdlUGZlF1ojnuW',
                image: 'https://scontent.flim6-2.fna.fbcdn.net/v/t1.6435-9/80399177_2710595505686820_4286447519698780160_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFtSYqMXS4zwcx_4az4bgPCCG32abCN2WYIbfZpsI3ZZt4SwC9pRF0ASA4mH55uBXKua72AakaBG_2i51-FiXKF&_nc_ohc=zqhTW2tXYiMQ7kNvwHtc3ts&_nc_oc=AdmH5i0H_2STGAR5jUhjXrqcsTgY6i_OOkcZdXx7rzU1mx75KtLAaqsNUQYBnE1wnxM&_nc_zt=23&_nc_ht=scontent.flim6-2.fna&_nc_gid=juzpviTW765zV-dWgJaL5A&oh=00_AfpABzjILw1xZj2tibAFOkW8HwysL9c9jovpr7XfyB-PZA&oe=699B9564',
                gallery: [
                    'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0032-7-scaled.jpg',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0033-4-scaled.jpg',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0008-10-scaled.jpg'
                ]
            },
            'patambuco-2020': {
                title: 'Asociación Cultural Musuq Illariy "Carnaval de Patambuco"',
                year: '2020',
                category: 'Autóctonos',
                score: '88.84',
                badges: ['Fuerza Sandia', 'Autóctono'],
                reasons: [
                    'Consolidación como ganadora absoluta el primer día',
                    'Energía desbordante en la ejecución del carnaval',
                    'Trajes coloridos representativos de la selva puneña',
                    'Acompañamiento musical de gran calidad rítmica'
                ],
                video: 'https://youtu.be/EyUKR8_sGs0?si=PTq2if1ldVZalaUG',
                image: 'https://radioondaazul.com/wp-content/uploads/2020/02/carnaval-de-patambuco-ok.jpg',
                gallery: [
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t1.6435-9/83042737_2677440029007463_1278512382770937856_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFjYgOjWfUPYRE8UQ-jhadKqcjNpt9kJDupyM2m32QkO5SZ6FgEEMSC20PD-P588rMVDXYOkic07woXWqVoGegB&_nc_ohc=30qjoD5hKoMQ7kNvwFHeMnv&_nc_oc=Adk_P4vWRr8fCgPdbffARb0tGRL_2YNuXaaBdo4aF2R7zeAxsOc3JoeMgJjhyWmzL2c&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=_yY6JehqGp6y5pJbgiBImg&oh=00_AfriOCfISbhpqZIsJr2BEyX3PPpDJySnnJRg_nHnCluTHg&oe=699BA72C',
                    'https://scontent.flim6-3.fna.fbcdn.net/v/t1.6435-9/83171421_2677439985674134_1094952567235936256_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeHu1ijhOiE_yQJm_PNP8LB206I0z_JN7n7TojTP8k3ufgY9hzq00ZP0yw_SxZUb_FkSSiN3xMHQzWVlaxJ3SGUy&_nc_ohc=gKiMBG_5xiYQ7kNvwGe4q1s&_nc_oc=Adl2kb7wTran8PPf5jc2wGaF21faHEYJNy5rGPLBc36wHaed9HfO-946zv1XJJAbixg&_nc_zt=23&_nc_ht=scontent.flim6-3.fna&_nc_gid=VZ-w3aUiUXQCVUdOvOLkOg&oh=00_Afq8vhAlscfQWo17CaRFWmp1sXbSNa_M-5ZBjn9JYDfmMw&oe=699B7F4D',
                    'https://scontent.flim6-3.fna.fbcdn.net/v/t1.6435-9/82817043_2677439975674135_1684939000483151872_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFI4HoZvSmu3GhaNzsM5uslSLZ-wJJFYMVItn7AkkVgxUmD36ps115H2zOFbZux1gx28RaUbw7lVtp6FMGNKulP&_nc_ohc=7s4hwIP0ZbgQ7kNvwEF_AeQ&_nc_oc=Adl0IYz0iOAePrZcwlCsu2fX8SRzzKrDv73tJ7CaxiQXexd6kmM_d4XjT7PLSeO8YLQ&_nc_zt=23&_nc_ht=scontent.flim6-3.fna&_nc_gid=5dBPKkLtFXVe4XgOs50z4Q&oh=00_Afq0PFE60Mn8t1FsiBNng-ARlu3MdXWtGUTknTbqhIdTYQ&oe=699B83E8'
                ]
            },
            'pnp-2019': {
                title: 'Incomparable Gran Diablada Amigos de la PNP',
                year: '2019',
                category: 'Trajes de Luces',
                score: '88.66',
                badges: ['Disciplina Militar', 'Diablada'],
                reasons: [
                    'Consistencia premiada en estadio y parada de veneración',
                    'Bloques masivos con cambios coreográficos rápidos',
                    'Disciplina férrea en el desplazamiento escénico',
                    'Recuperación del título con alto nivel artístico'
                ],
                video: 'https://www.youtube.com/embed/E2lx_G8kxFc',
                image: 'https://www.punomagico.com/image/pnp%202021.png',
                gallery: [
                    'https://www.punomagico.com/image/pnp%202021.png',
                    'https://images.unsplash.com/photo-1518173946687-a4c899c3362e?auto=format&fit=crop&w=800',
                    'https://images.unsplash.com/photo-1544919982-b61976f0ba43?auto=format&fit=crop&w=800'
                ]
            },
            'chunchos-esquilaya-2019': {
                title: 'Asociación Cultural Chunchos de Esquilaya (Ayapata)',
                year: '2019',
                category: 'Autóctonos',
                score: '97.69',
                badges: ['Récord Histórico', 'Carabaya'],
                reasons: [
                    'Respuesta emocional sin precedentes en público y jurado',
                    'Misión de evitar la extinción de su danza ancestral',
                    'Uso de plumas y trajes rústicos de gran autenticidad',
                    'Viaje de siete horas sumado a un esfuerzo físico total'
                ],
                video: 'https://www.youtube.com/embed/qy2TWYUx2zI',
                image: 'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0338-scaled.jpg',
                gallery: [
                    'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0338-scaled.jpg',
                    'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=800',
                    'https://images.unsplash.com/photo-1518173946687-a4c899c3362e?auto=format&fit=crop&w=800'
                ]
            },
            'morenada-orkapata-2018': {
                title: 'Confraternidad Morenada Orkapata',
                year: '2018',
                category: 'Trajes de Luces',
                score: '89.47',
                badges: ['Resurgimiento', 'Morenada'],
                reasons: [
                    'Victoria emotiva tras años sin títulos máximos',
                    'Resurgimiento de la Morenada en las élites sociales',
                    'Gran capacidad de logística y despliegue artístico',
                    'Elegancia suprema en el paso de las cholas puneñas'
                ],
                video: 'https://www.youtube.com/embed/qy2TWYUx2zI',
                image: 'https://vivecandelaria.com/wp-content/uploads/2021/05/morenada-orkapata-1024x600.jpg',
                gallery: [
                    'https://vivecandelaria.com/wp-content/uploads/2021/05/morenada-orkapata-1024x600.jpg',
                    'https://images.unsplash.com/photo-1544919982-b61976f0ba43?auto=format&fit=crop&w=800',
                    'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=800'
                ]
            },
            'wifalas-munani-2018': {
                title: 'Wifalas San Francisco Javier de Muñani',
                year: '2018',
                category: 'Autóctonos',
                score: '94.78',
                badges: ['Hegemonía', 'Azángaro'],
                reasons: [
                    'Rigurosidad en la preparación de los danzarines',
                    'Transmisión fiel de la herencia dancística quechua',
                    'Elegancia y porte en la ejecución de la Wifala',
                    'Dominio absoluto en el ámbito de las danzas originarias'
                ],
                video: 'https://www.youtube.com/embed/EoJO-bFrSaw',
                image: 'https://radioondaazul.com/wp-content/uploads/2024/08/IMG_0378-scaled.jpg',
                gallery: [
                    'https://radioondaazul.com/wp-content/uploads/2024/08/IMG_0378-scaled.jpg',
                    'https://images.unsplash.com/photo-1518173946687-a4c899c3362e?auto=format&fit=crop&w=800',
                    'https://images.unsplash.com/photo-1544919982-b61976f0ba43?auto=format&fit=crop&w=800'
                ]
            },
            'pnp-2017': {
                title: 'Incomparable Gran Diablada Amigos de la PNP',
                year: '2017',
                category: 'Trajes de Luces',
                score: '90.53',
                badges: ['Sexto Título', 'Diablada'],
                reasons: [
                    'Introducción pionera de bloques masivos en la Diablada',
                    'Cambios coreográficos rápidos y definidos',
                    'Mantenimiento de la alta competencia institucional',
                    'Puntaje de 90.53 para consolidar supremacía'
                ],
                video: 'https://www.youtube.com/embed/EoJO-bFrSaw',
                image: 'https://www.punomagico.com/image/pnp%202021.png',
                gallery: [
                    'https://www.punomagico.com/image/pnp%202021.png',
                    'https://images.unsplash.com/photo-1544919982-b61976f0ba43?auto=format&fit=crop&w=800',
                    'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=800'
                ]
            },
            'chaku-2017': {
                title: 'Asociación Cultural Carnaval Chaku de Chucahuacas',
                year: '2017',
                category: 'Autóctonos',
                score: '93.10',
                badges: ['Fertilidad', 'Azángaro'],
                reasons: [
                    'Ejecución enérgica vinculada al arreo de animales',
                    'Celebración de la fertilidad de la tierra en la danza',
                    'Vestimenta colorida que cautivó al jurado calificador',
                    'Representación auténtica del distrito de Chupa'
                ],
                video: 'https://www.youtube.com/embed/E2lx_G8kxFc',
                image: 'https://muniazangaro.gob.pe/web/wp-content/uploads/2019/08/santiago-de-pupuja.jpg',
                gallery: [
                    'https://muniazangaro.gob.pe/web/wp-content/uploads/2019/08/santiago-de-pupuja.jpg',
                    'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=800',
                    'https://images.unsplash.com/photo-1518173946687-a4c899c3362e?auto=format&fit=crop&w=800'
                ]
            },
            'centinelas-2016': {
                title: 'Asociación Folklórica Diablada Centinelas del Altiplano',
                year: '2016',
                category: 'Trajes de Luces',
                score: '91.54',
                badges: ['Primer Título', 'Diablada'],
                reasons: [
                    'Despliegue coreográfico de gran disciplina y simetría',
                    'Ejecución militarizada de los pasos de la Diablada',
                    'Simetría perfecta en todas las fases del escenario',
                    'Campeonato absoluto ganado con excelencia técnica'
                ],
                video: 'https://www.youtube.com/embed/E2lx_G8kxFc',
                image: 'https://portal.andina.pe/EDPfotografia3/Thumbnail/2020/02/11/000654060W.jpg',
                gallery: [
                    'https://portal.andina.pe/EDPfotografia3/Thumbnail/2020/02/11/000654060W.jpg',
                    'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=800',
                    'https://images.unsplash.com/photo-1518173946687-a4c899c3362e?auto=format&fit=crop&w=800'
                ]
            },
            'wifalas-putina-2016': {
                title: 'Conjunto de Wifalas San Antonio de Putina',
                year: '2016',
                category: 'Autóctonos',
                score: '94.00',
                badges: ['Cintas Color', 'Putina'],
                reasons: [
                    'Uso de cintas de colores y sonidos de la naturaleza',
                    'Interpretación magistral de pinkillos tradicionales',
                    'Evocación del cortejo amoroso en comunidades altoandinas',
                    'Victoria contundente con alto puntaje técnico'
                ],
                video: 'https://www.youtube.com/embed/qy2TWYUx2zI',
                image: 'https://i.ytimg.com/vi/EoJO-bFrSaw/maxresdefault.jpg',
                gallery: [
                    'https://i.ytimg.com/vi/EoJO-bFrSaw/maxresdefault.jpg',
                    'https://images.unsplash.com/photo-1518173946687-a4c899c3362e?auto=format&fit=crop&w=800',
                    'https://images.unsplash.com/photo-1544919982-b61976f0ba43?auto=format&fit=crop&w=800'
                ]
            },
            'caporales-centralistas-2015': {
                title: 'Asociación Cultural Caporales Centralistas Puno',
                year: '2015',
                category: 'Trajes de Luces',
                score: '90.37',
                badges: ['Hito Histórico', 'Caporales'],
                reasons: [
                    'Victoria significativa frente a la Diablada PNP',
                    'Despliegue de fuerza y agilidad en cada bloque',
                    'Hito en la categoría de Traje de Luces Puneño',
                    'Título de Campeón de Campeones con alto puntaje'
                ],
                video: 'https://www.youtube.com/embed/qy2TWYUx2zI',
                image: 'https://www.punomagico.com/image/centralistas%202021.jpg',
                gallery: [
                    'https://www.punomagico.com/image/centralistas%202021.jpg',
                    'https://images.unsplash.com/photo-1544919982-b61976f0ba43?auto=format&fit=crop&w=800',
                    'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=800'
                ]
            },
            'wifalas-munani-2015': {
                title: 'Wifalas San Francisco Javier de Muñani (Azángaro)',
                year: '2015',
                category: 'Autóctonos',
                score: 'Ganador Oficial',
                badges: ['Elegancia Pura', 'Muñani'],
                reasons: [
                    'Vistosas vestimentas blancas de lana de oveja',
                    'Elegancia suprema en la ejecución del carnaval',
                    'Simbolismo de pureza y alegría en la zona quechua',
                    'Inicio de una era de dominio para Azángaro'
                ],
                video: 'https://www.youtube.com/embed/EoJO-bFrSaw',
                image: 'https://radioondaazul.com/wp-content/uploads/2024/08/IMG_0378-scaled.jpg',
                gallery: [
                    'https://radioondaazul.com/wp-content/uploads/2024/08/IMG_0378-scaled.jpg',
                    'https://images.unsplash.com/photo-1518173946687-a4c899c3362e?auto=format&fit=crop&w=800',
                    'https://images.unsplash.com/photo-1544919982-b61976f0ba43?auto=format&fit=crop&w=800'
                ]
            }
        };

        function openGanadorModal(winnerId) {
            const modal = document.getElementById('ganador-modal');
            const content = document.getElementById('ganador-modal-content');
            const data = ganadoresData[winnerId];

            if (!data) return;

            const reasonsHTML = data.reasons.map(reason => `
                <li class="flex items-start gap-2 text-sm text-gray-600">
                    <div class="mt-1 bg-green-100 rounded-full p-0.5 shrink-0">
                        <i data-lucide="check" class="w-3 h-3 text-green-600"></i>
                    </div>
                    <span>${reason}</span>
                </li>
            `).join('');

            const badgesHTML = data.badges.map(badge => `
                <span class="bg-purple-50 text-candelaria-purple px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border border-purple-100">
                    ${badge}
                </span>
            `).join('');

            const modalHTML = `
                <div class="bg-white rounded-2xl overflow-hidden max-w-4xl mx-auto flex flex-col h-auto md:max-h-[90vh]">
                    <!-- Header Section -->
                    <div class="relative h-48 md:h-72 shrink-0">
                        <img src="${data.image}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                        
                        <!-- Badges -->
                        <div class="absolute bottom-6 left-8 flex gap-3">
                            <div class="bg-yellow-400 text-purple-900 px-4 py-1.5 rounded-full text-sm font-black shadow-2xl flex items-center gap-2">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                ${data.year}
                            </div>
                            <div class="bg-candelaria-purple text-white px-4 py-1.5 rounded-full text-sm font-bold shadow-2xl flex items-center gap-2">
                                <i data-lucide="award" class="w-4 h-4"></i>
                                ${data.category.toUpperCase()}
                            </div>
                        </div>
                        
                        <!-- Close Button -->
                        <button onclick="closeGanadorModal()" class="absolute top-6 right-6 bg-white/30 hover:bg-white/50 text-white rounded-full p-3 backdrop-blur-xl transition-all shadow-xl group">
                            <i data-lucide="x" class="w-6 h-6 group-hover:rotate-90 transition-transform"></i>
                        </button>
                    </div>

                    <!-- Body Content -->
                    <div class="p-8 md:p-10 overflow-y-auto">
                        <div class="flex flex-col lg:flex-row gap-12">
                            <!-- Left Column: Info -->
                            <div class="lg:w-3/5">
                                <h2 class="text-4xl font-black text-gray-900 font-heading mb-3 leading-tight tracking-tight">${data.title}</h2>
                                <div class="flex flex-wrap gap-2 mb-8">
                                    ${badgesHTML}
                                </div>

                                <div class="space-y-6">
                                    <div class="flex items-center gap-3">
                                        <div class="h-px bg-gray-200 flex-1"></div>
                                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.3em]">Razones del Triunfo</h3>
                                        <div class="h-px bg-gray-200 flex-1"></div>
                                    </div>
                                    <ul class="space-y-4">
                                        ${reasonsHTML}
                                    </ul>
                                </div>
                            </div>

                            <!-- Right Column: Video & Score -->
                            <div class="lg:w-2/5 flex flex-col gap-8">
                                <div class="bg-gray-100 rounded-2xl overflow-hidden group relative aspect-[16/10] shadow-2xl border border-gray-200">
                                    <iframe class="w-full h-full" src="${formatYoutubeEmbed(data.video)}" 
                                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen></iframe>
                                    <div class="absolute bottom-3 left-0 right-0 text-center pointer-events-none">
                                        <p class="text-[9px] text-white/90 font-black uppercase tracking-[0.2em] bg-black/40 backdrop-blur-sm inline-block px-3 py-1 rounded-full">Presentación ganadora</p>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br from-purple-50 to-white p-6 rounded-2xl border border-purple-100 shadow-inner">
                                    <div class="flex items-center gap-3 mb-2">
                                        <i data-lucide="gavel" class="w-4 h-4 text-candelaria-purple"></i>
                                        <h4 class="text-[10px] font-black text-candelaria-purple uppercase tracking-[0.2em]">Jurado Calificador</h4>
                                    </div>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-sm font-bold text-gray-400">Puntuación:</span>
                                        <span class="text-3xl font-black text-candelaria-purple">${data.score}</span>
                                        <span class="text-sm font-bold text-gray-400">/ 100</span>
                                    </div>
                                    <div class="mt-3 h-1.5 w-full bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-candelaria-purple rounded-full shadow-[0_0_10px_#4c1d9577]" style="width: ${data.score}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="h-px bg-gray-100 my-10"></div>

                        <!-- Gallery -->
                        <div class="flex flex-col md:flex-row gap-10 items-end">
                            <div class="flex-1 w-full">
                                <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 flex items-center gap-2">
                                    <i data-lucide="images" class="w-4 h-4"></i> Galería del Conjunto
                                </h4>
                                <div class="flex gap-3">
                                    ${data.gallery ? data.gallery.map(imgUrl => `
                                        <div class="group/img w-24 h-24 rounded-xl overflow-hidden border-2 border-transparent hover:border-candelaria-purple transition-all cursor-pointer shadow-lg">
                                            <img src="${imgUrl}" class="w-full h-full object-cover group-hover/img:scale-110 transition-transform">
                                        </div>
                                    `).join('') : `
                                        <div class="w-24 h-24 rounded-xl bg-gray-50 flex items-center justify-center border-2 border-dashed border-gray-200">
                                            <i data-lucide="image" class="w-8 h-8 text-gray-200"></i>
                                        </div>
                                    `}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="p-5 bg-gray-50 border-t border-gray-100 flex justify-end shrink-0">
                        <button onclick="closeGanadorModal()" class="px-8 py-2.5 bg-gray-900 text-white font-black rounded-xl text-[10px] uppercase tracking-widest hover:bg-black transition-all shadow-lg active:scale-95">
                            Cerrar ventana
                        </button>
                    </div>
                </div>
            `;

            content.innerHTML = modalHTML;
            lucide.createIcons();
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeGanadorModal() {
            const modal = document.getElementById('ganador-modal');
            const content = document.getElementById('ganador-modal-content');
            content.innerHTML = ''; // Stop video
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        const conjuntosData = {
            'sikuris-manazo': {
                title: 'Sikuris del Barrio Mañazo',
                year: '1892',
                subtitle: 'Los Patriarcas del Viento',
                type: 'Autóctono',
                image: 'https://imgmedia.larepublica.pe/640x384/larepublica/migration/images/AUYVEJ2FDJGGXBBFODIK7OQQKY.webp',
                history: 'El Conjunto Sicuris del Barrio Mañazo, fundado en 1892, es una de las instituciones más emblemáticas de Puno. El barrio Mañazo, habitado históricamente por el gremio de los matarifes o carniceros, ha sido un bastión de la cultura popular. Se sostiene que de esta agrupación surgieron los primeros "diablos" de Puno, quienes utilizaban cabezas de toros sacrificados como máscaras rudimentarias para danzar en honor a la Virgen.',
                features: [
                    'Sikuris de un solo bombo (estilo único)',
                    'Guardianes de la transición a la Diablada',
                    'Participación ininterrumpida por más de un siglo',
                    'Conexión directa con rituales ganaderos'
                ],
                fullText: `HISTORIA DE SIKURIS MAÑAZO\n\nEl Conjunto Sicuris del Barrio Mañazo, fundado en 1892, es una de las instituciones más emblemáticas de Puno. El barrio Mañazo, habitado históricamente por el gremio de los matarifes o carniceros, ha sido un bastión de la cultura popular.\n\nSe sostiene que de esta agrupación surgieron los primeros "diablos" de Puno, quienes utilizaban cabezas de toros sacrificados como máscaras rudimentarias para danzar en honor a la Virgen. Esta transición de un ritual ganadero a una expresión coreográfica religiosa es fundamental para entender el origen de la Diablada Puneña.\n\nLos integrantes de Mañazo no solo son músicos, sino guardianes de un estilo de ejecución del siku de un solo bombo que se diferencia de las formas más modernas y urbanas.`
            },
            'sikuris-juventud-obrera': {
                title: 'Juventud Obrera',
                year: '1884',
                subtitle: 'El Legado Obrero',
                type: 'Autóctono',
                image: 'https://www.losandes.com.pe/wp-content/uploads/2019/02/juventud-obrera.jpg',
                history: 'Fundada en 1884, esta agrupación representa el vínculo entre el campesinado que se trasladó a la ciudad y la nueva clase obrera urbana. A través de sus talleres de enseñanza y su participación ininterrumpida, han asegurado que la técnica de interpretación del siku se transmita a las nuevas generaciones.',
                features: [
                    'Pioneros de la clase obrera urbana cultural',
                    'Talleres permanentes de enseñanza',
                    'Defensa de la identidad mestiza temprana',
                    'Espacio de asociatividad civil histórica'
                ],
                fullText: `HISTORIA DE SICURIS JUVENTUD OBRERA\n\nEl Conjunto de Arte Folklórico Sicuris Juventud Obrera fue fundado en 1884. Esta agrupación representa el vínculo entre el campesinado que se trasladó a la ciudad y la nueva clase obrera urbana.\n\nA través de sus talleres de enseñanza y su participación ininterrumpida, han asegurado que la técnica de interpretación del siku se transmita a las nuevas generaciones. Juventud Obrera es un ejemplo de cómo la festividad permitió la creación de espacios de asociatividad civil en una época donde las poblaciones indígenas y mestizas tenían limitados derechos de participación política.`
            },
            'sikuris-qhantati-ururi': {
                title: 'Qhantati Ururi de Conima',
                year: '1913',
                subtitle: 'La Leyenda del Siku',
                type: 'Autóctono',
                image: 'https://admin.diariosinfronteras.com.pe/wp-content/uploads/2019/02/qhantati.jpg',
                history: 'Desde la provincia de Moho, fundado originalmente en 1913 y reorganizado en 1933. Conocidos como una "leyenda viva", su estilo de ejecución es suave, cadencioso y profundamente ligado al ciclo agrícola de la zona norte del Lago Titicaca.',
                features: [
                    'Estilo "suave" y cadencioso característico',
                    'Conexión mística con el ciclo agrícola',
                    'Representantes de la zona norte (Moho)',
                    'Integración regional profunda'
                ],
                fullText: `HISTORIA DE QHANTATI URURI\n\nDesde la provincia de Moho, el conjunto Qhantati Ururi de Conima, fundado originalmente en 1913 y reorganizado en 1933, ha aportado una dimensión mística y melódica única a la festividad.\n\nConocidos como una "leyenda viva", su estilo de ejecución es suave, cadencioso y profundamente ligado al ciclo agrícola de la zona norte del Lago Titicaca. Su presencia en la Candelaria subraya que la festividad es un evento regional que integra a las provincias más alejadas en un solo cuerpo cultural.`
            },
            'diablada-porteno': {
                title: 'Tradicional Diablada Porteño',
                year: '1962',
                subtitle: 'Génesis de la Diablada Urbana',
                type: 'Trajes de Luces',
                image: 'https://portal.andina.pe/EDPfotografia3/Thumbnail/2019/02/12/000563459W.jpg',
                history: 'El año 1962 marca un punto de inflexión con la fundación de la Tradicional Diablada Porteño. Surgida en el Barrio Porteño, esta agrupación profesionalizó la danza y comenzó a competir bajo estándares artísticos elevados.',
                features: [
                    'Profesionalización de la danza de la Diablada',
                    'Representación del barrio portuario',
                    'Inicio de la competencia artística moderna',
                    'Elevación estética del "traje de luces"'
                ],
                fullText: `HISTORIA DE LA DIABLADA PORTEÑO\n\nEl año 1962 marca un punto de inflexión con la fundación de la Tradicional Diablada Porteño. Surgida en el Barrio Porteño, esta agrupación profesionalizó la danza y comenzó a competir bajo estándares artísticos elevados.\n\nSu fundación marcó el inicio de la era moderna de las diabladas en Puno, estableciendo nuevos cánones estéticos y organizativos que serían seguidos por otras agrupaciones.`
            },
            'diablada-bellavista': {
                title: 'Diablada Bellavista',
                year: '1963',
                subtitle: 'Espectacularidad y Lujo',
                type: 'Trajes de Luces',
                image: 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhE6LPtSpDH5jaLU0pg8jsFTPzL5Kg4e0YBV-QgmSDdtP0QKj7T3l7tYYJJJXPQ8VoCm9ArqO5fbnA6az1-o_G2UrFHo2umlKrsavvCWkDqGyGNtrkvHSkljM709uAyz5kwMFuU9troCBPF/s280/Diablos_Puno.jpg',
                history: 'Nació en 1963, liderada por figuras como Simón Rodríguez y Paulina Gómez en el jirón Condorcanqui. Ejemplifica la participación barrial masiva. Hubo una fuerte influencia de maestros bolivianos como Fortunato Yana en sus inicios, evidenciando la hermandad cultural lacustre.',
                features: [
                    'Disciplina coreográfica estricta',
                    'Lujo y detalle en los trajes (bordados)',
                    'Rivalidad histórica que elevó el nivel',
                    'Vínculo cultural con maestros de Oruro'
                ],
                fullText: `HISTORIA DE LA DIABLADA BELLAVISTA\n\nEn 1963 nacería la rival histórica de Porteño: la Asociación Folklórica Espectacular Diablada Bellavista. La fundación de Bellavista, liderada por figuras como Simón Rodríguez y Paulina Gómez en el jirón Condorcanqui, ejemplifica la participación barrial masiva.\n\nEs documentado que en estos años iniciales hubo una fuerte influencia de maestros bolivianos como Fortunato Yana, quien enseñó los pasos y facilitó la llegada de los primeros trajes desde Oruro, evidenciando una hermandad cultural lacustre que trasciende las fronteras nacionales.`
            },
            'morenada-orkapata': {
                title: 'Morenada Orkapata',
                year: '1955',
                subtitle: 'Pioneros de la Morenada',
                type: 'Trajes de Luces',
                image: 'https://vivecandelaria.com/wp-content/uploads/2021/05/morenada-orkapata-1024x600.jpg',
                history: 'Fundada el 7 de diciembre de 1955, es la pionera en esta categoría. Antes de su institucionalización, sus miembros bailaban en los sikuris de Mañazo, lo que demuestra la transición orgánica de lo autóctono a lo mestizo.',
                features: [
                    'Primera morenada institucionalizada',
                    'Transición directa de sikuris a morenada',
                    'Precisión histórica en pasos e indumentaria',
                    'Sátira elegante del capataz colonial'
                ],
                fullText: `HISTORIA DE LA MORENADA ORKAPATA\n\nEl Conjunto Morenada Orkapata, fundado el 7 de diciembre de 1955, es el pionero en esta categoría. Antes de su institucionalización, sus miembros bailaban en los sikuris de Mañazo, lo que demuestra la transición orgánica de lo autóctono a lo mestizo.\n\nFundada por la clase media y artistas, esta morenada se centró en la precisión histórica de la indumentaria y los pasos. Su baile lento y majestuoso simboliza el peso de las cadenas y la sátira del capataz colonial.`
            },
            'morenada-laykakota': {
                title: 'Morenada Laykakota',
                year: '1962',
                subtitle: 'El Rey Moreno',
                type: 'Trajes de Luces',
                image: 'https://admin.diariosinfronteras.com.pe/wp-content/uploads/2024/02/WhatsApp-Image-2024-02-13-at-9.05.51-PM.jpeg',
                history: 'Fundada en 1962, comenzó originalmente como un conjunto de "Rey Moreno" antes de adoptar el formato actual de Morenada en 2007. Logró hitos como el campeonato de campeones en 2012, representando la evolución contemporánea de la danza.',
                features: [
                    'Evolución de Rey Moreno a Morenada masiva',
                    'Campeón de Campeones (2012)',
                    'Gran despliegue coreográfico moderno',
                    'Integración de jóvenes y nuevas generaciones'
                ],
                fullText: `HISTORIA DE LA MORENADA LAYKAKOTA\n\nLa Morenada Laykakota, fundada en 1962, comenzó originalmente como un conjunto de Rey Moreno antes de adoptar el formato actual de Morenada en 2007.\n\nEsta agrupación ha logrado hitos importantes, como el campeonato de campeones en 2012. Su evolución refleja la capacidad de adaptación de las agrupaciones a los nuevos formatos de concurso masivo sin perder la esencia de la danza pesada.`
            }
        };

        function openConjuntoModal(conjuntoId) {
            const modal = document.getElementById('conjunto-modal');
            const content = document.getElementById('conjunto-modal-content');
            const data = conjuntosData[conjuntoId];

            if (!data) return;

            // Construir HTML dinámico
            let featuresHTML = data.features.map(f => `<li class="flex items-center gap-2"><i data-lucide="check" class="w-4 h-4 text-green-500"></i> ${f}</li>`).join('');

            const modalHTML = `
                <div class="bg-white">
                    <div class="h-64 w-full bg-gray-200 relative">
                        <img src="${data.image}" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/800x400/4c1d95/fbbf24?text=${encodeURIComponent(data.title)}'">
                        <button onclick="closeConjuntoModal()" class="absolute top-4 right-4 bg-white/50 hover:bg-white text-gray-800 rounded-full p-2 backdrop-blur-md transition-all">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                        <div class="absolute bottom-4 left-4">
                            <span class="px-3 py-1 bg-candelaria-purple text-white text-xs font-bold rounded-full uppercase tracking-wider shadow-lg">Fundado en ${data.year}</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-900 font-heading mb-2">${data.title}</h2>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="bg-candelaria-purple/10 text-candelaria-purple px-2 py-1 rounded text-xs font-bold">${data.subtitle}</span>
                            <span class="bg-candelaria-gold/10 text-amber-800 px-2 py-1 rounded text-xs font-bold">${data.type}</span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">Reseña Histórica</h3>
                                <p class="text-gray-700 text-sm text-justify leading-relaxed">${data.history}</p>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-2">Puntos Clave</h3>
                                <ul class="text-gray-700 text-sm space-y-2">
                                    ${featuresHTML}
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mt-6 flex justify-between border-t border-gray-100 pt-4">
                            <button onclick="generatePDF('${conjuntoId}')" class="px-4 py-2 bg-candelaria-gold text-purple-900 font-bold rounded-lg hover:bg-yellow-300 transition-colors flex items-center gap-2 shadow-sm">
                                <i data-lucide="file-text" class="w-4 h-4"></i> Descargar Ficha Histórica
                            </button>
                            <button onclick="closeConjuntoModal()" class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            `;

            content.innerHTML = modalHTML;
            lucide.createIcons(); // Reactivar iconos
            modal.classList.remove('hidden');
        }

        // 10. Función para cerrar modal de conjuntos
        function closeConjuntoModal() {
            document.getElementById('conjunto-modal').classList.add('hidden');
        }

        // 11. Función para generar PDF Profesional con jsPDF
        async function generatePDF(id) {
            const data = conjuntosData[id];

            if (!data) {
                showToast('Información no disponible para descarga.');
                return;
            }

            // Mostrar feedback visual
            showToast('Generando documento PDF...');

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            // Configuración de colores y fuentes
            const purple = '#4c1d95';
            const gold = '#fbbf24';
            const gray = '#4b5563';
            
            // --- HEADER ---
            // Barra superior
            doc.setFillColor(purple);
            doc.rect(0, 0, 210, 40, 'F');
            
            // Título Principal
            doc.setTextColor('#ffffff');
            doc.setFontSize(22);
            doc.setFont('helvetica', 'bold');
            doc.text('FESTIVIDAD VIRGEN DE LA CANDELARIA', 105, 20, { align: 'center' });
            
            doc.setFontSize(12);
            doc.setFont('helvetica', 'normal');
            doc.text('Patrimonio Cultural Inmaterial de la Humanidad (UNESCO)', 105, 30, { align: 'center' });

            // --- CONTENIDO DEL CONJUNTO ---
            let yPos = 60;

            // Título del Conjunto
            doc.setTextColor(purple);
            doc.setFontSize(18);
            doc.setFont('helvetica', 'bold');
            doc.text(data.title.toUpperCase(), 20, yPos);
            
            // Línea decorativa
            yPos += 3;
            doc.setDrawColor(gold);
            doc.setLineWidth(1);
            doc.line(20, yPos, 190, yPos);
            
            yPos += 15;

            // Metadatos
            doc.setFontSize(11);
            doc.setTextColor(gray);
            doc.setFont('helvetica', 'bold');
            doc.text(`AÑO DE FUNDACIÓN:`, 20, yPos);
            doc.setFont('helvetica', 'normal');
            doc.text(data.year, 70, yPos);
            
            yPos += 8;
            doc.setFont('helvetica', 'bold');
            doc.text(`CATEGORÍA:`, 20, yPos);
            doc.setFont('helvetica', 'normal');
            doc.text(data.type, 70, yPos);

            yPos += 8;
            doc.setFont('helvetica', 'bold');
            doc.text(`SUBTÍTULO:`, 20, yPos);
            doc.setFont('helvetica', 'normal');
            doc.text(data.subtitle, 70, yPos);

            // Reseña Histórica
            yPos += 20;
            doc.setFillColor('#f3f4f6');
            doc.rect(20, yPos - 5, 170, 10, 'F');
            doc.setTextColor(purple);
            doc.setFontSize(12);
            doc.setFont('helvetica', 'bold');
            doc.text('RESEÑA HISTÓRICA', 25, yPos + 2);

            yPos += 15;
            doc.setTextColor('#000000');
            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal');
            
            // Dividir texto para ajuste de línea (max width 170)
            const splitHistory = doc.splitTextToSize(data.fullText, 170);
            doc.text(splitHistory, 20, yPos);
            
            yPos += (splitHistory.length * 5) + 15;

            // Características
            doc.setFillColor('#f3f4f6');
            doc.rect(20, yPos - 5, 170, 10, 'F');
            doc.setTextColor(purple);
            doc.setFontSize(12);
            doc.setFont('helvetica', 'bold');
            doc.text('CARACTERÍSTICAS PRINCIPALES', 25, yPos + 2);

            yPos += 15;
            doc.setTextColor('#000000');
            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal');
            
            data.features.forEach(feature => {
                doc.text(`• ${feature}`, 25, yPos);
                yPos += 7;
            });

            // --- FOOTER ---
            const pageHeight = doc.internal.pageSize.height;
            doc.setDrawColor(purple);
            doc.line(20, pageHeight - 20, 190, pageHeight - 20);
            
            doc.setFontSize(8);
            doc.setTextColor(gray);
            doc.text(`Documento generado automáticamen el ${new Date().toLocaleDateString()}`, 20, pageHeight - 12);
            doc.text('www.festividadcandelaria.pe', 190, pageHeight - 12, { align: 'right' });

            // Guardar PDF
            doc.save(`Candelaria_${data.title.replace(/\s+/g, '_')}_Historia.pdf`);
            showToast('¡Descarga completada con éxito!');
        }

        // Configurar event listeners para filtros de ganadores
        document.getElementById('filter-trajes-luces').addEventListener('click', () => filterGanadores('trajes-luces'));
        document.getElementById('filter-autoctonos').addEventListener('click', () => filterGanadores('autoctonos'));

        // 12. Sincronizar imágenes de cards con los datos de ganadoresData
        function syncCardImages() {
            for (const id in ganadoresData) {
                const button = document.querySelector(`button[onclick*="'${id}'"]`);
                if (button) {
                    const card = button.closest('.reveal-up');
                    if (card) {
                        const img = card.querySelector('img');
                        if (img && ganadoresData[id].image) {
                            img.src = ganadoresData[id].image;
                            img.alt = ganadoresData[id].title;
                            // Pre-cargar las imágenes de la galería para que abran instantáneamente
                            if (ganadoresData[id].gallery) {
                                ganadoresData[id].gallery.forEach(url => {
                                    const preloader = new Image();
                                    preloader.src = url;
                                });
                            }
                        }
                    }
                }
            }
        }

        // Ejecución inmediata para evitar flicker
        (function() {
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', syncCardImages);
            } else {
                syncCardImages();
            }
        })();

        // Inicializar íconos de Lucide y contenido
        // Inicializar íconos de Lucide y contenido
        window.onload = () => {
            lucide.createIcons();
            syncCardImages(); // Sincronizar imágenes de portada
            
            // Animaciones iniciales solo en el contenido activo
            const activeTab = localStorage.getItem('activeCulturaTab') || 'historia';
            const activeContent = document.getElementById(activeTab);
            
            if (activeContent) {
                // No afectar al header HERO, solo a los elementos dentro de las secciones
                activeContent.querySelectorAll('.reveal-up').forEach(el => {
                     if (!el.closest('header.relative')) { 
                        el.classList.add('active');
                    }
                });
            }

            // Activar el primer elemento de la línea de tiempo si estamos en esa pestaña
            setTimeout(() => {
                const timelineContent = document.querySelectorAll('.timeline-content')[0];
                if(timelineContent) timelineContent.classList.add('active');
            }, 500);
        };
        
        // EJECUTAR INMEDIATAMENTE (Sync) para evitar flash
        (function initTabs() {
            const savedTab = localStorage.getItem('activeCulturaTab');
            const defaultTab = 'historia';
            const tabToLoad = savedTab || defaultTab;
            
            // Establecer estado inicial
            setActiveTab(tabToLoad);
        })();
    </script>
    <script src="../assets/js/spark-effect.js"></script>

    <!-- Auth Modal and Dropdown -->
    <?= getAuthModalHTML() ?>
    <?= getAuthJS('../') ?>

    <?php 
    $footerDepth = 1;
    include '../includes/standard-footer.php'; 
    ?>
</body>
</html>