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
            left: 1.25rem;
            /* Mobile: 20px - Left aligned */
            transform: translateX(-50%);
            z-index: 10;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        @media (min-width: 768px) {
            .timeline-dot {
                left: 50%;
                /* Desktop: Centered */
            }
        }

        .timeline-dot:hover {
            transform: translateX(-50%) scale(1.3);
            box-shadow: 0 0 0 3px #fbbf24, 0 0 15px 5px rgba(251, 191, 36, 0.5);
        }

        .timeline-content {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.5s ease;
        }

        .timeline-content.hidden {
            opacity: 0;
            transform: translateY(20px);
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
    <!-- Header Section - Standardized with EN TIEMPO REAL Style -->
    <?php
    $headerDepth = 1;
    $activePage = 'cultura';
    include '../includes/standard-header.php';
    ?>

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
        <nav class="flex justify-start md:justify-center space-x-1 border-b border-gray-200 mb-6 overflow-x-auto pb-1 scrollbar-hide sticky top-[84px] bg-white z-30"
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
                        <h2 class="font-heading text-4xl md:text-5xl font-extrabold text-candelaria-purple mb-4">El
                            Origen Místico</h2>
                        <p class="text-gray-600 text-xl max-w-3xl mx-auto">Donde la fe virreinal y la Pachamama andina
                            se hicieron una.</p>
                    </header>

                    <!-- Introducción Humanizada -->
                    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-gray-100 mb-12 reveal-up">
                        <p
                            class="text-gray-700 leading-relaxed text-lg text-justify mb-0 first-letter:text-5xl first-letter:font-bold first-letter:text-candelaria-gold first-letter:mr-3 first-letter:float-left">
                            La ciudad de Puno, a más de 3,800 metros de altura, es el corazón de una de las
                            celebraciones más intensas de América. La Festividad de la Virgen de la Candelaria es mucho
                            más que baile; es el encuentro vivo de dos mundos. Aquí, la historia de resistencia andina
                            se mezcla con la fe católica para dar vida a una identidad única, que hoy el mundo reconoce
                            como Patrimonio de la Humanidad.
                        </p>
                    </div>

                    <!-- SECCIÓN 1: EL ASEDIO -->
                    <div class="grid md:grid-cols-1 lg:grid-cols-12 gap-8 mb-16">
                        <div class="lg:col-span-8 space-y-8">
                            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 reveal-up">
                                <h3
                                    class="flex items-center gap-3 text-2xl font-bold text-gray-900 mb-6 font-heading border-b border-gray-100 pb-4">
                                    <span
                                        class="bg-red-50 text-red-600 w-10 h-10 flex items-center justify-center rounded-lg"><i
                                            data-lucide="sword" class="w-5 h-5"></i></span>
                                    1781: Una Historia de Fe y Guerra
                                </h3>
                                <p class="text-gray-700 leading-relaxed mb-4 text-justify">
                                    Para entender la devoción de Puno, debemos viajar al año 1781. El Altiplano vivía
                                    tiempos de guerra. La rebelión de Túpac Amaru II crecía y, junto a Túpac Katari,
                                    pusieron a la región en jaque.
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-4 text-justify">
                                    <strong>El Asedio:</strong> Puno resistía, pero estaba rodeada por un ejército
                                    rebelde de más de 12,000 hombres. Aislados y superados, la esperanza parecía
                                    perdida.
                                </p>
                                <div class="bg-slate-50 p-6 rounded-xl border-l-4 border-candelaria-purple my-6">
                                    <h4 class="font-bold text-gray-900 mb-2">El Milagro que Salvó a la Ciudad</h4>
                                    <p class="text-gray-600 italic text-sm text-justify">
                                        "Cuenta la historia que, en la oscuridad, los rebeldes vieron un ejército
                                        inmenso bajando de los cerros con antorchas. Se asustaron y huyeron. Pero no era
                                        un ejército: eran los pobladores de Puno en procesión con la Virgen, cuyas velas
                                        y rezos se multiplicaron ante los ojos del enemigo."
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-4 space-y-8">
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                                <h4 class="font-bold text-gray-900 mb-4 text-sm uppercase tracking-wider">Datos Clave
                                    (1781)</h4>
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
                                    <span
                                        class="bg-green-100 text-green-600 w-10 h-10 flex items-center justify-center rounded-lg"><i
                                            data-lucide="sprout" class="w-5 h-5"></i></span>
                                    El Rostro de la Pachamama
                                </h3>
                                <p class="text-gray-700 leading-relaxed mb-4 text-justify">
                                    La evangelización en el Altiplano no fue una sustitución, sino una negociación. La
                                    Virgen de la Candelaria es la encarnación de la <strong>Pachamama</strong>.
                                </p>
                                <ul class="space-y-4">
                                    <li class="flex items-start gap-3">
                                        <i data-lucide="check-circle"
                                            class="w-5 h-5 text-green-500 mt-1 flex-shrink-0"></i>
                                        <div>
                                            <strong class="block text-gray-900">Coincidencia Agrícola</strong>
                                            <p class="text-sm text-gray-600 text-justify">Febrero es el tiempo del
                                                <em>Juchuy Pucuy</em> (primeros frutos). La fiesta conmemora la
                                                purificación de María y agradece la fertilidad de la tierra.
                                            </p>
                                        </div>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <i data-lucide="check-circle"
                                            class="w-5 h-5 text-green-500 mt-1 flex-shrink-0"></i>
                                        <div>
                                            <strong class="block text-gray-900">Guardianes del Titicaca</strong>
                                            <p class="text-sm text-gray-600 text-justify">La Virgen heredó el papel de
                                                guardiana del Lago Titicaca. Su procesión renueva el vínculo con el agua
                                                sagrada, asegurando el equilibrio ecológico.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="relative">
                                <img src="assets/VirgenCerro.png" class="rounded-xl shadow-lg w-full object-cover h-80">
                                <div
                                    class="absolute -bottom-6 -right-6 bg-white p-4 rounded-lg shadow-xl border border-gray-100 max-w-xs hidden md:block">
                                    <p class="text-xs text-gray-500 italic">"Los indígenas se apropiaron de las imágenes
                                        cristianas porque ofrecían recompensas similares a sus antiguas divinidades." —
                                        Manuel Marzal</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN: EL CICLO RITUAL -->
                    <div class="mb-16">
                        <div
                            class="bg-slate-900 rounded-2xl p-8 md:p-12 shadow-2xl relative overflow-hidden text-white">
                            <div
                                class="absolute top-0 right-0 p-32 bg-candelaria-purple rounded-full blur-3xl opacity-20 -mr-16 -mt-16">
                            </div>
                            <div class="relative z-10">
                                <h3 class="flex items-center gap-3 text-2xl font-bold mb-8 font-heading text-white">
                                    <span
                                        class="bg-yellow-500 text-purple-900 w-10 h-10 flex items-center justify-center rounded-lg"><i
                                            data-lucide="clock" class="w-5 h-5"></i></span>
                                    Un Ciclo Sagrado
                                </h3>
                                <p class="text-slate-300 leading-relaxed mb-8 max-w-3xl text-lg">
                                    La Candelaria no es un evento aislado; es una respiración profunda que dura semanas.
                                    Es un tiempo litúrgico y festivo que transforma la vida cotidiana de Puno.
                                </p>

                                <div class="grid md:grid-cols-4 gap-6">
                                    <!-- Fase 1 -->
                                    <div
                                        class="bg-slate-800/50 p-6 rounded-xl border border-slate-700 hover:border-yellow-500/50 transition-colors">
                                        <div class="text-yellow-400 font-bold text-sm mb-2 uppercase tracking-wider">24
                                            Ene - 1 Feb</div>
                                        <h4 class="font-bold text-lg mb-2">Las Novenas</h4>
                                        <p class="text-sm text-slate-400">El tiempo del silencio y la oración. Los
                                            devotos acuden al Santuario para "preparar el alma" antes de la fiesta.</p>
                                    </div>
                                    <!-- Fase 2 -->
                                    <div
                                        class="bg-slate-800/50 p-6 rounded-xl border border-slate-700 hover:border-yellow-500/50 transition-colors">
                                        <div class="text-yellow-400 font-bold text-sm mb-2 uppercase tracking-wider">2
                                            de Febrero</div>
                                        <h4 class="font-bold text-lg mb-2">Día Central</h4>
                                        <p class="text-sm text-slate-400">La Misa de Fiesta y la Procesión. La ciudad se
                                            detiene para ver pasar a la "Mamita" sobre alfombras de flores.</p>
                                    </div>
                                    <!-- Fase 3 -->
                                    <div
                                        class="bg-slate-800/50 p-6 rounded-xl border border-slate-700 hover:border-yellow-500/50 transition-colors">
                                        <div class="text-yellow-400 font-bold text-sm mb-2 uppercase tracking-wider">La
                                            Octava</div>
                                        <h4 class="font-bold text-lg mb-2">El Esplendor</h4>
                                        <p class="text-sm text-slate-400">El Concurso de Trajes de Luces. 50,000
                                            danzantes toman el estadio y las calles en un estallido de color y música.
                                        </p>
                                    </div>
                                    <!-- Fase 4 -->
                                    <div
                                        class="bg-slate-800/50 p-6 rounded-xl border border-slate-700 hover:border-yellow-500/50 transition-colors">
                                        <div class="text-yellow-400 font-bold text-sm mb-2 uppercase tracking-wider">
                                            Cacharpari</div>
                                        <h4 class="font-bold text-lg mb-2">La Despedida</h4>
                                        <p class="text-sm text-slate-400">La fiesta termina con la promesa de volver. Se
                                            realiza el "Cacharpari" o despedida hasta el próximo año.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 3: MÁSCARAS -->
                    <div class="grid md:grid-cols-1 lg:grid-cols-12 gap-8 mb-16">
                        <div class="lg:col-span-12">
                            <h3 class="flex items-center gap-3 text-2xl font-bold text-gray-900 mb-6 font-heading">
                                <span
                                    class="bg-purple-100 text-purple-600 w-10 h-10 flex items-center justify-center rounded-lg"><i
                                        data-lucide="venetian-mask" class="w-5 h-5"></i></span>
                                El Poder de la Máscara
                            </h3>
                        </div>
                        <div class="lg:col-span-7 space-y-6">
                            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 h-full">
                                <p class="text-gray-700 leading-relaxed mb-6 text-justify">
                                    En la festividad puneña, la máscara no oculta, <strong>revela</strong>. Según la
                                    antropóloga Gisela Cánepa Koch, la máscara ritual funciona en una doble dimensión:
                                    permite al danzante entrar en un proceso de mímesis, apropiándose del poder del
                                    "otro" (el español, el diablo, el esclavo).
                                </p>
                                <p class="text-gray-700 leading-relaxed mb-0 text-justify">
                                    Al asumir roles foráneos —como el capataz en los Caporales—, el sujeto andino ejerce
                                    una forma de resistencia cultural, subvirtiendo el orden colonial a través de la
                                    sátira y la estética.
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
                            <span
                                class="bg-yellow-100 text-yellow-600 w-10 h-10 flex items-center justify-center rounded-lg"><i
                                    data-lucide="music" class="w-5 h-5"></i></span>
                            Mosaico de Resistencia: Las Danzas
                        </h3>

                        <div class="grid md:grid-cols-2 gap-10 mb-8">
                            <div>
                                <h4 class="font-bold text-lg text-gray-900 mb-3 text-candelaria-purple">Diablada Puneña
                                </h4>
                                <p class="text-sm text-gray-600 text-justify mb-4">
                                    Complejo entrelazamiento de catequización jesuita y mitología minera. El "Supay" no
                                    es el mal absoluto, sino el dueño del Uku Pacha (subsuelo).
                                </p>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-900 mb-3 text-candelaria-purple">Morenada</h4>
                                <p class="text-sm text-gray-600 text-justify mb-4">
                                    Homenaje doloroso y rítmico a la memoria de los esclavos africanos. El sonido de las
                                    matracas evoca el caminar encadenado.
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
                                <span
                                    class="bg-indigo-100 text-indigo-600 w-10 h-10 flex items-center justify-center rounded-lg"><i
                                        data-lucide="users" class="w-5 h-5"></i></span>
                                La Trama Invisible: Fe y Reciprocidad
                            </h3>

                            <div class="grid md:grid-cols-2 gap-12">
                                <div>
                                    <p class="text-gray-700 leading-relaxed mb-6 text-justify">
                                        Detrás del espectáculo visual, la Candelaria se sostiene sobre una maquinaria
                                        social antigua y poderosa. No es solo devoción; es un pacto de solidaridad
                                        comunitaria conocido como <strong>Ayni</strong> (reciprocidad).
                                    </p>
                                    <div class="space-y-6">
                                        <div class="flex gap-4">
                                            <div
                                                class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 text-candelaria-purple">
                                                <i data-lucide="crown" class="w-6 h-6"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">El Alferado</h4>
                                                <p class="text-sm text-gray-600 text-justify mt-1">
                                                    Es el mayordomo de la fiesta. Asumir este cargo implica un prestigio
                                                    inmenso pero también una carga económica brutal. El Alferado costea
                                                    bandas, comida y bebida, no por riqueza, sino por fe y servicio a su
                                                    comunidad.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex gap-4">
                                            <div
                                                class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 text-candelaria-purple">
                                                <i data-lucide="shirt" class="w-6 h-6"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">Maestros Artesanos</h4>
                                                <p class="text-sm text-gray-600 text-justify mt-1">
                                                    Bordadores y mascareros son los arquitectos de la fantasía. Sus
                                                    talleres trabajan todo el año creando obras de arte en hilo de oro y
                                                    pedrería, manteniendo vivas técnicas coloniales que son Patrimonio
                                                    Cultural de la Nación.
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
                                            <div class="text-xs text-gray-500 uppercase tracking-widest">Visitantes
                                                Anuales</div>
                                        </div>
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <div class="text-3xl font-bold text-green-600 mb-1">200+</div>
                                            <div class="text-xs text-gray-500 uppercase tracking-widest">Conjuntos
                                                Folklóricos</div>
                                        </div>
                                        <div class="border-t border-gray-200 pt-4 mt-2">
                                            <p class="text-xs text-gray-500 italic text-center">
                                                "La fiesta redistribuye la riqueza y refuerza los lazos de parentesco.
                                                Nadie baila solo; se baila en y para la comunidad."
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
                                <span class="text-yellow-500 font-bold tracking-widest text-xs mb-2 uppercase">Archivo
                                    Histórico</span>
                                <h3 class="text-white font-heading text-2xl font-bold mb-4">Voces del Pasado</h3>
                                <p class="text-slate-400 text-sm mb-6">
                                    Documentos audiovisuales que registran la evolución de la festividad. Entrevistas y
                                    registros de la década de los 80s y 90s.
                                </p>
                            </div>
                            <div class="md:w-2/3 bg-black relative aspect-video">
                                <iframe class="absolute inset-0 w-full h-full"
                                    src="https://www.youtube.com/embed/E2lx_G8kxFc?autoplay=1&mute=1"
                                    title="Archivo Candelaria" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                    <!-- REFERENCIAS -->
                    <div class="border-t border-gray-200 pt-8">
                        <h5 class="font-bold text-gray-900 text-sm mb-4 uppercase tracking-wider">Referencias
                            Bibliográficas</h5>
                        <div class="grid md:grid-cols-2 gap-4 text-xs text-gray-500">
                            <a href="https://ich.unesco.org/es/RL/la-fiesta-de-la-virgin-de-la-candelaria-en-puno-00956"
                                target="_blank" class="hover:text-candelaria-purple transition-colors truncate block">
                                [1] UNESCO (2014). La fiesta de la Virgen de la Candelaria en Puno.
                            </a>
                            <a href="https://doi.org/10.18800/anthropologica.199801.021" target="_blank"
                                class="hover:text-candelaria-purple transition-colors truncate block">
                                [2] Cánepa, G. (1998). Máscara, transformación e identidad.
                            </a>
                            <a href="https://revistas.pucp.edu.pe/index.php/historica/article/download/28718/26367"
                                target="_blank" class="hover:text-candelaria-purple transition-colors truncate block">
                                [3] Cahill, D. (2002). The Siege of La Paz and the Battle of Puno.
                            </a>
                            <a href="http://intranet.comunidadandina.org/documentos/BDA/pe-ca-0005.pdf" target="_blank"
                                class="hover:text-candelaria-purple transition-colors truncate block">
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
                        <span
                            class="bg-indigo-100 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block">Arquitectura
                            Cultural</span>
                        <h2 class="font-heading text-4xl md:text-5xl font-extrabold text-candelaria-purple mb-6">
                            Una Epopeya del Altiplano
                        </h2>
                        <p class="text-gray-700 text-lg leading-relaxed max-w-4xl mx-auto text-justify">
                            La Festividad no representa únicamente una manifestación de fe religiosa, sino el eje
                            gravitacional de la identidad del Altiplano. Reconocida por la UNESCO, es un complejo
                            sincretismo donde los conjuntos folklóricos actúan como reservorios de memoria colectiva y
                            motores de innovación estética. Estas agrupaciones, muchas centenarias, han forjado la
                            historia de Puno a través de la danza, la música y una devoción inquebrantable.
                        </p>
                    </header>

                    <!-- SECTION: GENESIS & TIMELINE -->
                    <!-- Contenido redundante removido para mejorar la experiencia de usuario -->
                    <div class="mb-12"></div>

                    <!-- SECTION: SIKURIS LEGENDARIOS -->
                    <div class="mb-20">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-px bg-gray-200 flex-1"></div>
                            <h3
                                class="font-heading text-3xl font-extrabold text-center text-gray-900 uppercase tracking-widest">
                                <span class="text-candelaria-gold">I.</span> Los Cimientos: Sikuris
                            </h3>
                            <div class="h-px bg-gray-200 flex-1"></div>
                        </div>
                        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">
                            La base espiritual reside en los sikuris, símbolo de la dualidad andina (arca/ira). Son las
                            instituciones más antiguas, manteniendo su estructura comunitaria.
                        </p>

                        <div class="grid md:grid-cols-3 gap-8">
                            <!-- CARD 1: MAÑAZO -->
                            <div
                                class="group relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                                <div
                                    class="absolute top-4 right-4 z-10 bg-candelaria-purple text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                    1892</div>
                                <div class="h-56 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10">
                                    </div>
                                    <img src="https://imgmedia.larepublica.pe/640x384/larepublica/migration/images/AUYVEJ2FDJGGXBBFODIK7OQQKY.webp"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                    <h4 class="absolute bottom-4 left-4 z-20 text-white font-heading text-xl font-bold">
                                        Sikuris Mañazo</h4>
                                </div>
                                <div class="p-6">
                                    <p class="text-sm text-gray-600 mb-4 text-justify">
                                        <strong>Resistencia de los Matarifes.</strong> Surgió del gremio de carniceros.
                                        Se sostiene que de aquí surgieron los primeros "diablos" con máscaras de toro.
                                        Guardianes del estilo de un solo bombo.
                                    </p>
                                    <div class="flex gap-2">
                                        <button onclick="openConjuntoModal('sikuris-manazo')"
                                            class="flex-1 py-2 text-candelaria-purple font-bold text-sm border border-candelaria-purple rounded hover:bg-purple-50 transition-colors">Ver
                                            Historia</button>
                                        <button onclick="generatePDF('sikuris-manazo')"
                                            class="px-3 py-2 bg-candelaria-gold text-purple-900 rounded hover:bg-yellow-400 transition-colors"><i
                                                data-lucide="download" class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD 2: JUVENTUD OBRERA -->
                            <div
                                class="group relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                                <div
                                    class="absolute top-4 right-4 z-10 bg-candelaria-purple text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                    1884</div>
                                <div class="h-56 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10">
                                    </div>
                                    <img src="https://www.punomagico.com/image/juventud%20obrera%202021.jpg"
                                        onerror="this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=JUVENTUD+OBRERA'"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                    <h4 class="absolute bottom-4 left-4 z-20 text-white font-heading text-xl font-bold">
                                        Juventud Obrera</h4>
                                </div>
                                <div class="p-6">
                                    <p class="text-sm text-gray-600 mb-4 text-justify">
                                        <strong>El Legado Obrero.</strong> Representa el vínculo entre el campesinado y
                                        la nueva clase obrera urbana. A través de sus talleres, han asegurado la
                                        transmisión de la técnica del siku por generaciones.
                                    </p>
                                    <div class="flex gap-2">
                                        <button onclick="openConjuntoModal('sikuris-juventud-obrera')"
                                            class="flex-1 py-2 text-candelaria-purple font-bold text-sm border border-candelaria-purple rounded hover:bg-purple-50 transition-colors">Ver
                                            Historia</button>
                                        <button onclick="generatePDF('sikuris-juventud-obrera')"
                                            class="px-3 py-2 bg-candelaria-gold text-purple-900 rounded hover:bg-yellow-400 transition-colors"><i
                                                data-lucide="download" class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- CARD 3: QHANTATI URURI -->
                            <div
                                class="group relative bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300">
                                <div
                                    class="absolute top-4 right-4 z-10 bg-candelaria-purple text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                    1913</div>
                                <div class="h-56 overflow-hidden relative">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-10">
                                    </div>
                                    <img src="https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/468534294_10160885465911295_6005985246805577581_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=0b6b33&_nc_eui2=AeF_HogN7k97sYMMtIX1sZWpdqNZLu11YW12o1ku7XVhbfchF8x_z-rA7g5q0O4YqDwgFWati0h75Z7IE3SMT1iO&_nc_ohc=vvTTmmsEzqQQ7kNvwGw1KTn&_nc_oc=AdkiUVkrpCNKzBNcPACNvZ1qZEhoQ_3022hNaWlRKxCkHPrNd66i_7VqyioQfJIJE8o&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=oTyCPorLYwjnd-R6A3wLVw&oh=00_AfrTbtgij2r8aSs4wEcMBRd7JhMFlJMvcvJNNIiKkjsOGQ&oe=6979AF7B"
                                        onerror="this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=QHANTATI+URURI'"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                    <h4 class="absolute bottom-4 left-4 z-20 text-white font-heading text-xl font-bold">
                                        Qhantati Ururi</h4>
                                </div>
                                <div class="p-6">
                                    <p class="text-sm text-gray-600 mb-4 text-justify">
                                        <strong>La Leyenda del Siku.</strong> Desde Conima (Moho). Aportaron una
                                        dimensión mística y melódica única ("estilo suave"). Su presencia subraya que la
                                        festividad integra a las provincias lejanas.
                                    </p>
                                    <div class="flex gap-2">
                                        <button onclick="openConjuntoModal('sikuris-qhantati-ururi')"
                                            class="flex-1 py-2 text-candelaria-purple font-bold text-sm border border-candelaria-purple rounded hover:bg-purple-50 transition-colors">Ver
                                            Historia</button>
                                        <button onclick="generatePDF('sikuris-qhantati-ururi')"
                                            class="px-3 py-2 bg-candelaria-gold text-purple-900 rounded hover:bg-yellow-400 transition-colors"><i
                                                data-lucide="download" class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: TRAJES DE LUCES -->
                    <div class="mb-20">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-px bg-gray-200 flex-1"></div>
                            <h3
                                class="font-heading text-3xl font-extrabold text-center text-gray-900 uppercase tracking-widest">
                                <span class="text-candelaria-gold">II.</span> El Resplandor: Trajes de Luces
                            </h3>
                            <div class="h-px bg-gray-200 flex-1"></div>
                        </div>
                        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">
                            A mediados del s. XX, la fiesta se transforma. Aparecen los bordados en oro, la pedrería y
                            las bandas de metales. Es la era de la "Diablada" y la "Morenada".
                        </p>

                        <!-- SUBSECTION: DIABLADAS -->
                        <h4
                            class="font-heading text-xl font-bold text-candelaria-purple mb-6 pl-4 border-l-4 border-candelaria-purple">
                            La Diablada: Lucifer en el Altiplano</h4>
                        <div class="grid md:grid-cols-2 gap-8 mb-12">
                            <!-- DIABLADA PORTEÑO -->
                            <div
                                class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row gap-6 items-center">
                                <div class="w-full md:w-1/3 h-40 shrink-0">
                                    <img src="assets/dporteno.png"
                                        onerror="this.src='https://placehold.co/400x400/b91c1c/ffffff?text=PORTEÑO'"
                                        class="w-full h-full object-cover rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <h5 class="font-bold text-lg">Tradicional Diablada Porteño</h5>
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded">1962</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 text-justify">
                                        Surgida en el Barrio Porteño, profesionalizó la danza y elevó los estándares
                                        artísticos. Un punto de inflexión en la competencia moderna.
                                    </p>
                                    <button onclick="openConjuntoModal('diablada-porteno')"
                                        class="text-candelaria-purple text-sm font-bold hover:underline">Leer
                                        más</button>
                                </div>
                            </div>
                            <!-- DIABLADA BELLAVISTA -->
                            <div
                                class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row gap-6 items-center">
                                <div class="w-full md:w-1/3 h-40 shrink-0">
                                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhE6LPtSpDH5jaLU0pg8jsFTPzL5Kg4e0YBV-QgmSDdtP0QKj7T3l7tYYJJJXPQ8VoCm9ArqO5fbnA6az1-o_G2UrFHo2umlKrsavvCWkDqGyGNtrkvHSkljM709uAyz5kwMFuU9troCBPF/s280/Diablos_Puno.jpg"
                                        class="w-full h-full object-cover rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <h5 class="font-bold text-lg">Diablada Bellavista</h5>
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">1963</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 text-justify">
                                        Su rival histórica. Fundada por Simón Rodríguez y Paulina Gómez. Famosa por la
                                        influencia de maestros bolivianos y el lujo de sus trajes.
                                    </p>
                                    <div class="flex gap-2">
                                        <button onclick="openConjuntoModal('diablada-bellavista')"
                                            class="text-candelaria-purple text-sm font-bold hover:underline">Leer
                                            más</button>
                                        <button onclick="generatePDF('diablada-bellavista')"
                                            class="text-candelaria-gold hover:text-yellow-600"><i data-lucide="download"
                                                class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBSECTION: MORENADAS -->
                        <h4
                            class="font-heading text-xl font-bold text-candelaria-purple mb-6 pl-4 border-l-4 border-candelaria-purple">
                            Morenadas: Elegancia y Peso</h4>
                        <div class="grid md:grid-cols-2 gap-8 mb-12">
                            <!-- ORKAPATA -->
                            <div
                                class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row gap-6 items-center">
                                <div class="w-full md:w-1/3 h-40 shrink-0">
                                    <img src="https://vivecandelaria.com/wp-content/uploads/2021/05/morenada-orkapata-1024x600.jpg"
                                        class="w-full h-full object-cover rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <h5 class="font-bold text-lg">Morenada Orkapata</h5>
                                        <span
                                            class="bg-amber-100 text-amber-800 text-xs font-bold px-2 py-1 rounded">1955</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 text-justify">
                                        Pionera. Sus miembros bailaban en Mañazo antes de institucionalizarse.
                                        Transición orgánica de lo autóctono a lo mestizo.
                                    </p>
                                    <div class="flex gap-2">
                                        <button onclick="openConjuntoModal('morenada-orkapata')"
                                            class="text-candelaria-purple text-sm font-bold hover:underline">Leer
                                            más</button>
                                        <button onclick="generatePDF('morenada-orkapata')"
                                            class="text-candelaria-gold hover:text-yellow-600"><i data-lucide="download"
                                                class="w-4 h-4"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- LAYKAKOTA -->
                            <div
                                class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row gap-6 items-center">
                                <div class="w-full md:w-1/3 h-40 shrink-0">
                                    <img src="https://www.punomagico.com/image/negritos%203.jpg"
                                        onerror="this.src='https://www.punomagico.com/image/negritos%203.jpg'"
                                        class="w-full h-full object-cover rounded-lg shadow-sm">
                                </div>
                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <h5 class="font-bold text-lg">Morenada Laykakota</h5>
                                        <span
                                            class="bg-amber-100 text-amber-800 text-xs font-bold px-2 py-1 rounded">1962</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 text-justify">
                                        Evolucionó de "Rey Moreno" a Morenada masiva (2007). Campeón de campeones en
                                        2012, representando la masificación moderna.
                                    </p>
                                    <button onclick="openConjuntoModal('morenada-laykakota')"
                                        class="text-candelaria-purple text-sm font-bold hover:underline">Leer
                                        más</button>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE: FUNDACIONES -->
                        <div class="bg-slate-900 rounded-xl p-6 text-white overflow-hidden">
                            <h4 class="font-bold mb-4 flex items-center gap-2"><i data-lucide="list"
                                    class="w-5 h-5 text-yellow-400"></i> Cronología Histórica de la Festividad</h4>

                            <!-- PERIODO: ORÍGENES -->
                            <div class="mb-6">
                                <h5
                                    class="text-yellow-400 text-xs font-bold uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                                    Período Colonial y Fundacional (1583 - 1900)
                                </h5>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-slate-300">
                                        <thead class="text-yellow-400 border-b border-slate-700 uppercase text-xs">
                                            <tr>
                                                <th class="px-4 py-2">Año</th>
                                                <th class="px-4 py-2">Evento / Conjunto</th>
                                                <th class="px-4 py-2">Importancia Histórica</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-700">
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1583</td>
                                                <td class="px-4 py-2">Fundación del pueblo de Puno</td>
                                                <td class="px-4 py-2">Llegada de la imagen de la Virgen de la Candelaria
                                                    de España, traída por los mineros de Laykakota.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1668</td>
                                                <td class="px-4 py-2">Milagro del Cerro Huajsapata</td>
                                                <td class="px-4 py-2">Leyenda fundacional: la Virgen defiende a los
                                                    indígenas durante la rebelión de Laykakota contra los españoles.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1871</td>
                                                <td class="px-4 py-2">Cabildo de Naturales</td>
                                                <td class="px-4 py-2">Primera procesión documentada con danzas
                                                    autóctonas (Sicuris, Wifala). Origen del calendario festivo actual.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1884</td>
                                                <td class="px-4 py-2">Sikuris Juventud Obrera</td>
                                                <td class="px-4 py-2">Uno de los primeros conjuntos de sikuris
                                                    institucionalizado en Puno. Símbolo del gremio obrero.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1892</td>
                                                <td class="px-4 py-2">Sikuris Mañazo</td>
                                                <td class="px-4 py-2">Fundado por el gremio de matarifes. Origen del
                                                    estilo de \"un solo bombo\". Raíz de la Diablada puneña.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- PERIODO: ERA DE LOS SIKURIS -->
                            <div class="mb-6">
                                <h5
                                    class="text-green-400 text-xs font-bold uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                                    Era de los Sikuris y Primeras Danzas de Luces (1900 - 1960)
                                </h5>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-slate-300">
                                        <thead class="text-green-400 border-b border-slate-700 uppercase text-xs">
                                            <tr>
                                                <th class="px-4 py-2">Año</th>
                                                <th class="px-4 py-2">Evento / Conjunto</th>
                                                <th class="px-4 py-2">Importancia Histórica</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-700">
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1913</td>
                                                <td class="px-4 py-2">Qhantati Ururi (Conima)</td>
                                                <td class="px-4 py-2">Conjunto mítico de sikuris de Moho. Creadores del
                                                    \"estilo suave\". Conecta las provincias con la capital.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1918</td>
                                                <td class="px-4 py-2">Sikuris 27 de Junio</td>
                                                <td class="px-4 py-2">Fundado en Juli (Chucuito). Representantes del
                                                    estilo Lupaka, con zampoñas de mayor tamaño.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1943</td>
                                                <td class="px-4 py-2">Primera Diablada en Puno</td>
                                                <td class="px-4 py-2">Aparecen los primeros \"diablos\" con máscaras de
                                                    yeso, inspirados en autos sacramentales y la Morenada.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1955</td>
                                                <td class="px-4 py-2">Morenada Orkapata</td>
                                                <td class="px-4 py-2">Primera morenada institucionalizada. Transición de
                                                    lo autóctono a lo mestizo. Pionera del género.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1956</td>
                                                <td class="px-4 py-2">Hermanos Velásquez (Taller)</td>
                                                <td class="px-4 py-2">Revolucionan la mascarería puneña: ojos de vidrio
                                                    soplado e iconografía local propia.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- PERIODO: ERA DORADA -->
                            <div class="mb-6">
                                <h5
                                    class="text-purple-400 text-xs font-bold uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <span class="w-3 h-3 bg-purple-400 rounded-full"></span>
                                    Era Dorada de los Trajes de Luces (1960 - 1985)
                                </h5>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-slate-300">
                                        <thead class="text-purple-400 border-b border-slate-700 uppercase text-xs">
                                            <tr>
                                                <th class="px-4 py-2">Año</th>
                                                <th class="px-4 py-2">Evento / Conjunto</th>
                                                <th class="px-4 py-2">Importancia Histórica</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-700">
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1962</td>
                                                <td class="px-4 py-2">Tradicional Diablada Porteño</td>
                                                <td class="px-4 py-2">Iniciadora de la era moderna. Profesionaliza la
                                                    danza con estándares artísticos y organizativos.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1962</td>
                                                <td class="px-4 py-2">Morenada Laykakota (Rey Moreno)</td>
                                                <td class="px-4 py-2">Nace como \"Rey Moreno\". Evoluciona a Morenada
                                                    masiva. Representa la masificación moderna.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1963</td>
                                                <td class="px-4 py-2">Diablada Bellavista</td>
                                                <td class="px-4 py-2">Fundada por Simón Rodríguez y Paulina Gómez.
                                                    Influencia de maestros bolivianos. Once veces campeona.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1965</td>
                                                <td class="px-4 py-2">Confraternidad Diablada Victoria</td>
                                                <td class="px-4 py-2">Expansión del folklore puneño a nivel nacional.
                                                    Rivalidad con Porteño y Bellavista.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1967</td>
                                                <td class="px-4 py-2">Visita de José María Arguedas</td>
                                                <td class="px-4 py-2">El escritor declara a Puno \"Capital del Folklore
                                                    Peruano\". Punto de inflexión para el reconocimiento nacional.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1970</td>
                                                <td class="px-4 py-2">Creación de la Fed. Regional de Folklore</td>
                                                <td class="px-4 py-2">Institucionaliza el concurso anual de danzas. Se
                                                    establecen categorías (Luces vs. Autóctonos).</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1975</td>
                                                <td class="px-4 py-2">Diablada Amigos de la PNP</td>
                                                <td class="px-4 py-2">Fundada por suboficiales de la policía. Disciplina
                                                    militar aplicada a la danza. Múltiples campeonatos.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1982</td>
                                                <td class="px-4 py-2">Caporales Huáscar</td>
                                                <td class="px-4 py-2">Primera agrupación de Caporales en Puno. Danza
                                                    recreada en Bolivia llega al Altiplano peruano.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- PERIODO: GLOBALIZACION -->
                            <div class="mb-6">
                                <h5
                                    class="text-blue-400 text-xs font-bold uppercase tracking-wider mb-3 flex items-center gap-2">
                                    <span class="w-3 h-3 bg-blue-400 rounded-full"></span>
                                    Globalización y Reconocimiento Mundial (1985 - Presente)
                                </h5>
                                <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-slate-300">
                                        <thead class="text-blue-400 border-b border-slate-700 uppercase text-xs">
                                            <tr>
                                                <th class="px-4 py-2">Año</th>
                                                <th class="px-4 py-2">Evento / Conjunto</th>
                                                <th class="px-4 py-2">Importancia Histórica</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-700">
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1985</td>
                                                <td class="px-4 py-2">Ley N° 24325 del Congreso</td>
                                                <td class="px-4 py-2">La ley reconoce oficialmente a Puno como \"Capital
                                                    del Folklore Peruano\".</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">1996</td>
                                                <td class="px-4 py-2">Caporales Centralistas Puno</td>
                                                <td class="px-4 py-2">Internacionalización del Caporal puneño.
                                                    Presentaciones en Miami y Nueva York.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">2003</td>
                                                <td class="px-4 py-2">Patrimonio Cultural de la Nación</td>
                                                <td class="px-4 py-2">El Instituto Nacional de Cultura (INC) declara la
                                                    festividad como Patrimonio Cultural.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">2014</td>
                                                <td class="px-4 py-2">Patrimonio UNESCO</td>
                                                <td class="px-4 py-2">La festividad es inscrita en la Lista
                                                    Representativa del Patrimonio Cultural Inmaterial de la Humanidad.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">2020</td>
                                                <td class="px-4 py-2">Última edición pre-pandemia</td>
                                                <td class="px-4 py-2">Diablada Bellavista gana con 94.26 pts. Más de 150
                                                    conjuntos participan antes del cierre mundial.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">2024</td>
                                                <td class="px-4 py-2">Retorno Post-Pandemia</td>
                                                <td class="px-4 py-2">Morenada Laykakota gana el concurso. La festividad
                                                    vuelve con más de 130,000 danzantes.</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2 font-medium text-white">2025</td>
                                                <td class="px-4 py-2">Morenada Santa Rosa / Wifalas Muñani</td>
                                                <td class="px-4 py-2">Campeones actuales. Santa Rosa (87.71 pts) y
                                                    Muñani (63.10 pts) lideran sus categorías respectivas.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- REFERENCIAS -->
                            <div class="mt-6 pt-4 border-t border-slate-700">
                                <h5 class="text-slate-400 text-xs uppercase tracking-wider mb-2">Referencias
                                    Bibliográficas</h5>
                                <ul class="text-xs text-slate-500 space-y-1">
                                    <li>• Cánepa Koch, G. (1998). <em>Máscara, transformación e identidad en los
                                            Andes</em>. PUCP.</li>
                                    <li>• UNESCO (2014). Expediente de inscripción de la Festividad Virgen de la
                                        Candelaria.</li>
                                    <li>• Núñez Butrón, M. (1959). <em>Estampas puneñas</em>. Ed. Los Andes.</li>
                                    <li>• Federación Regional de Folklore de Puno. Archivos históricos (1970-2025).</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- SECTION: INSTITUCIONALIZACIÓN & GLOBALIZACIÓN -->
                    <div class="grid md:grid-cols-2 gap-12 mb-20 items-center">
                        <div>
                            <span class="text-indigo-600 font-bold uppercase tracking-wider text-xs mb-2 block">1967 -
                                Presente</span>
                            <h3 class="font-heading text-2xl font-bold text-gray-900 mb-4">La Era de la
                                Institucionalización</h3>
                            <p class="text-gray-600 mb-6 text-justify">
                                La visita de <strong>José María Arguedas</strong> en 1967 fue clave. Al ver el
                                espectáculo en el Estadio Torres Belón, llamó a Puno la "Capital Simbólica de la Danza".
                                La creación de la Federación Regional de Folklore transformó la fiesta parroquial en un
                                concurso de escala global con más de 130,000 danzantes.
                            </p>
                            <h4 class="font-heading text-lg font-bold text-gray-900 mb-2 mt-8">Impacto Caporal</h4>
                            <p class="text-sm text-gray-600 text-justify">
                                En los 80s, los Caporales (recreados en Bolivia por los Hnos. Estrada) conquistaron a la
                                juventud. Agrupaciones como <em>Caporales Huáscar</em> (1982) y <em>Centralistas</em>
                                (1996) internacionalizaron la fiesta a Miami y NY.
                            </p>
                        </div>
                        <div class="bg-gray-100 rounded-xl p-6 relative">
                            <div
                                class="absolute -top-4 -right-4 bg-yellow-400 w-12 h-12 flex items-center justify-center rounded-full shadow-lg font-bold text-lg">
                                !</div>
                            <blockquote class="italic text-gray-600 text-center font-serif text-lg">
                                "La festividad redistribuye la riqueza y refuerza los lazos de parentesco. Nadie baila
                                solo; se baila en y para la comunidad."
                            </blockquote>
                        </div>
                    </div>

                    <!-- SECTION: ARTESANOS -->
                    <div class="bg-indigo-900 rounded-2xl p-8 md:p-12 text-white mb-20 relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10">
                        </div>
                        <div class="relative z-10 grid md:grid-cols-2 gap-12 items-center">
                            <div>
                                <h3 class="font-heading text-3xl font-bold mb-6">Maestros Mascareros y Bordadores</h3>
                                <p class="text-indigo-200 mb-6 text-justify leading-relaxed">
                                    La magnificencia visual es obra de los talleres de Puno. En 1956, los hermanos
                                    Velásquez revolucionaron la mascarería, reemplazando la importación por una
                                    iconografía propia de ojos de vidrio soplado. Los bordadores convirtieron cada traje
                                    en un "texto visual" de la identidad local.
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
                        <h3 class="font-heading text-2xl font-bold text-gray-900 mb-6 text-center">Archivos de la
                            Memoria</h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <a href="https://ich.unesco.org/es/10-lista-representativa-00748?include=slideshow_inc.php&id=00956&width=620&call=slideshow&mode=scroll"
                                target="_blank"
                                class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-candelaria-purple hover:shadow-lg transition-all">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600"><i data-lucide="globe"
                                            class="w-5 h-5"></i></div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-candelaria-purple">UNESCO
                                        Gallery</h4>
                                </div>
                                <p class="text-xs text-gray-500">Diapositivas históricas y contemporáneas oficiales.</p>
                            </a>
                            <a href="http://repositorio.unap.edu.pe/" target="_blank"
                                class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-candelaria-purple hover:shadow-lg transition-all">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="bg-candelaria-purple/10 p-2 rounded-lg text-candelaria-purple"><i
                                            data-lucide="book-open" class="w-5 h-5"></i></div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-candelaria-purple">Repositorio
                                        UNAP</h4>
                                </div>
                                <p class="text-xs text-gray-500">Investigaciones y fotos de campo históricas.</p>
                            </a>
                            <a href="https://www.punomagico.com/folklor%20historia.html" target="_blank"
                                class="group bg-white p-6 rounded-xl border border-gray-200 hover:border-candelaria-purple hover:shadow-lg transition-all">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="bg-amber-100 p-2 rounded-lg text-amber-600"><i data-lucide="image"
                                            class="w-5 h-5"></i></div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-candelaria-purple">Puno Mágico
                                    </h4>
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
            <div id="danzas" class="tab-content hidden w-full bg-gray-100 py-16 relative"
                style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
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
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2025</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Confraternidad Morenada
                                        Santa Rosa</h3>
                                    <span
                                        class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes
                                        de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Campeón de Campeones 2025 con 87.71 puntos.
                                    Destacó por la armonía de sus pasos y la espectacularidad de su banda.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('morenada-santa-rosa-2025')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2025</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Wifalas de Muñani</h3>
                                    <span
                                        class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Ganador oficial 2025 con 63.10 puntos. Prioridad
                                    ganada sobre criterios técnicos por su coreografía impecable.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('wifalas-munani-2025')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
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
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2024</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Morenada Laykakota</h3>
                                    <span
                                        class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes
                                        de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Campeón de Campeones 2024 con un puntaje final de
                                    86.32 puntos, liderando la categoría de Traje de Luces.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('rey-moreno-2024')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2024</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Cultural
                                        Unucajas de Azángaro</h3>
                                    <span
                                        class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Primer lugar 2024 con 88.68 puntos, reafirmando
                                    que la zona quechua continúa siendo la reserva técnica de las danzas.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('unucajas-2024')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
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
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2020</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Folklórica
                                        Espectacular Diablada Bellavista</h3>
                                    <span
                                        class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes
                                        de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Último gran ganador antes de la pandemia (94.26
                                    puntos). Sofisticación técnica en su bloque de arcángeles.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('diablada-bellavista-2020')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2020</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Cultural Musuq
                                        Illariy "Carnaval de Patambuco"</h3>
                                    <span
                                        class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Triunfo indiscutible con una puntuación de 88.84
                                    en el último concurso antes de la emergencia sanitaria.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('patambuco-2020')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
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
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2019</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Incomparable Gran Diablada
                                        Amigos de la PNP</h3>
                                    <span
                                        class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes
                                        de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Recuperaron el título con 88.66 puntos, destacando
                                    por su disciplina y consistencia en ambos escenarios.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('pnp-2019')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2019</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Cultural
                                        Chunchos de Esquilaya (Ayapata)</h3>
                                    <span
                                        class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Récord Histórico de 97.69 puntos. Emocionaron al
                                    jurado con su danza ancestral para evitar su extinción.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('chunchos-esquilaya-2019')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
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
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2018</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Confraternidad Morenada
                                        Orkapata</h3>
                                    <span
                                        class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes
                                        de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Retornaron al título máximo después de décadas
                                    (89.47 puntos), marcando el resurgimiento de la Morenada.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('morenada-orkapata-2018')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
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
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="https://www.punomagico.com/image/pnp%202021.png"
                                    onerror="this.src='https://placehold.co/600x400/b91c1c/ffffff?text=DIABLADA+PNP'"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Diablada PNP">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2017</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Incomparable Gran Diablada
                                        Amigos de la PNP</h3>
                                    <span
                                        class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes
                                        de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Sexto campeonato histórico con 90.53 puntos,
                                    definiendo la estética moderna con bloques masivos.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('pnp-2017')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2017</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Cultural
                                        Carnaval Chaku de Chucahuacas</h3>
                                    <span
                                        class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Campeón con 93.10 puntos. Danza ritual enérgica y
                                    vestimenta colorida que cautivó al jurado.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('chaku-2017')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
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
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2016</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Folklórica
                                        Diablada Centinelas del Altiplano</h3>
                                    <span
                                        class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes
                                        de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Primer campeonato absoluto con 91.54 puntos.
                                    Elogiado por su disciplina y simetría militar en la danza.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('centinelas-2016')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2016</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Conjunto de Wifalas San
                                        Antonio de Putina</h3>
                                    <span
                                        class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Triunfo con 94.00 puntos. Con cintas de colores y
                                    pinkillos evocan sonidos de la naturaleza.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('wifalas-putina-2016')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
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
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="trajes-luces">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2015</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Asociación Cultural
                                        Caporales Centralistas Puno</h3>
                                    <span
                                        class="bg-candelaria-purple text-white text-xs font-bold px-2 py-1 rounded-full">Trajes
                                        de Luces</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Campeón de Campeones con 90.37 puntos. Hito
                                    histórico en la categoría frente a su gran rival.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('caporales-centralistas-2015')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
                                        <i data-lucide="play" class="w-4 h-4"></i> Ver coreografía
                                    </button>
                                    <div class="flex items-center text-candelaria-gold">
                                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                        <span class="ml-1 text-sm font-bold">1er Lugar</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 reveal-up"
                            data-category="autoctonos">
                            <div class="h-48 overflow-hidden relative">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                                    alt="Cargando...">
                                <div
                                    class="absolute top-4 right-4 bg-candelaria-gold text-purple-900 px-2 py-1 rounded-lg text-xs font-bold">
                                    2015</div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="font-heading text-xl font-bold text-gray-900">Wifalas San Francisco
                                        Javier de Muñani (Azángaro)</h3>
                                    <span
                                        class="bg-candelaria-green text-white text-xs font-bold px-2 py-1 rounded-full">Autóctonos</span>
                                </div>
                                <p class="text-gray-600 mb-4 text-sm">Ganador oficial 2015. Patrimonio de la Nación de
                                    gran elegancia y pureza en la zona quechua.</p>
                                <div class="flex justify-between items-center">
                                    <button onclick="openGanadorModal('wifalas-munani-2015')"
                                        class="text-candelaria-purple font-medium hover:underline text-sm flex items-center gap-1">
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
                    <div
                        class="mt-16 bg-slate-900 rounded-2xl p-8 md:p-12 shadow-2xl relative overflow-hidden text-white reveal-up">
                        <div
                            class="absolute top-0 right-0 p-32 bg-red-600 rounded-full blur-3xl opacity-20 -mr-16 -mt-16">
                        </div>
                        <div class="relative z-10">
                            <h3 class="flex items-center gap-3 text-2xl font-bold mb-6 font-heading">
                                <span
                                    class="bg-red-600 text-white w-10 h-10 flex items-center justify-center rounded-lg"><i
                                        data-lucide="alert-triangle" class="w-5 h-5"></i></span>
                                El Silencio Progresivo (2021-2023)
                            </h3>
                            <div class="grid md:grid-cols-2 gap-8 items-start">
                                <div class="space-y-4">
                                    <p class="text-slate-300 leading-relaxed text-justify">
                                        Por primera vez en la era moderna, la festividad enfrentó tres años de
                                        suspensión consecutiva. Un vacío cultural y económico que puso a prueba la
                                        resiliencia de la Capital del Folklore.
                                    </p>
                                    <div class="bg-slate-800/50 p-6 rounded-xl border border-slate-700">
                                        <h4 class="font-bold text-red-400 mb-2">Impacto Económico</h4>
                                        <p class="text-sm text-slate-400">Se estima que la región dejó de percibir más
                                            de <span class="text-white font-bold">230 millones de soles</span> durante
                                            la crisis social y sanitaria.</p>
                                    </div>
                                </div>
                                <div class="space-y-6">
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700 text-slate-300 font-bold shrink-0">
                                            1</div>
                                        <div>
                                            <h4 class="font-bold text-lg">Pandemia (2021-2022)</h4>
                                            <p class="text-sm text-slate-400">Cancelación estricta por motivos de salud
                                                pública mundial (COVID-19).</p>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center border border-slate-700 text-slate-300 font-bold shrink-0">
                                            2</div>
                                        <div>
                                            <h4 class="font-bold text-lg">Crisis Social (2023)</h4>
                                            <p class="text-sm text-slate-400">El luto por los sucesos de Juliaca llevó a
                                                los conjuntos a votar por la cancelación total en señal de duelo.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center pt-12 reveal-up">
                        <a href="#" id="palmares-completo-btn"
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
                        <div
                            class="absolute left-5 md:left-1/2 transform -translate-x-1/2 h-full w-1 bg-candelaria-gold">
                        </div>

                        <!-- Elementos de la línea de tiempo -->
                        <div class="space-y-20">

                            <!-- Era 0: ORÍGENES COLONIALES (1583-1800) -->
                            <div class="relative flex flex-col md:flex-row items-center">
                                <div class="md:w-1/2 md:pr-12 mb-8 md:mb-0 md:text-right pl-12 md:pl-0">
                                    <div class="timeline-content">
                                        <h3 class="font-heading text-2xl font-bold text-candelaria-purple mb-2">Orígenes
                                            Coloniales (1583-1800)</h3>
                                        <p class="text-gray-700 mb-4">La imagen de la Virgen llega con los mineros
                                            españoles de Laykakota. En 1668, según la leyenda, la Virgen protege a los
                                            indígenas durante la rebelión. Nace el sincretismo entre la fe católica y la
                                            Pachamama andina.</p>
                                        <div class="flex flex-wrap gap-2 justify-end">
                                            <span
                                                class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-medium">Evangelización</span>
                                            <span
                                                class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-medium">Sincretismo</span>
                                            <span
                                                class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-medium">Minería</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-dot" onclick="toggleTimelineContent(0)"></div>
                                <div class="md:w-1/2 md:pl-12 pl-12">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Cerro_Rico_Potosi.jpg/1200px-Cerro_Rico_Potosi.jpg"
                                            class="w-full h-48 object-cover vintage-photo" alt="Minas coloniales"
                                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/92400e/fbbf24?text=COLONIA+1583';">
                                    </div>
                                </div>
                            </div>

                            <!-- Era 1: SIKURIS Y PRIMERAS COFRADÍAS (1870-1940) -->
                            <div class="relative flex flex-col md:flex-row items-center">
                                <div class="md:w-1/2 md:pr-12 order-2 md:order-1 pl-12 md:pl-0">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                        <img src="https://imgmedia.larepublica.pe/640x384/larepublica/migration/images/AUYVEJ2FDJGGXBBFODIK7OQQKY.webp"
                                            class="w-full h-48 object-cover vintage-photo" alt="Sikuris históricos"
                                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=SIKURIS+1892';">
                                    </div>
                                </div>
                                <div class="timeline-dot" onclick="toggleTimelineContent(1)"></div>
                                <div class="md:w-1/2 md:pl-12 mb-8 md:mb-0 order-1 md:order-2 pl-12">
                                    <div class="timeline-content">
                                        <h3 class="font-heading text-2xl font-bold text-candelaria-purple mb-2">Era de
                                            los Sikuris (1870-1940)</h3>
                                        <p class="text-gray-700 mb-4">Surgen las primeras cofradías formales: Sikuris
                                            Mañazo (1892) del gremio de matarifes y Juventud Obrera (1884). El siku
                                            (zampoña) domina el paisaje sonoro. Aparecen las primeras procesiones
                                            documentadas con danzas autóctonas.</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-medium">Sikuris</span>
                                            <span
                                                class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-medium">Gremios</span>
                                            <span
                                                class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-medium">Cofradías</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Era 2: DÉCADAS DE ORO (1950-1970) -->
                            <div class="relative flex flex-col md:flex-row items-center">
                                <div class="md:w-1/2 md:pr-12 mb-8 md:mb-0 md:text-right pl-12 md:pl-0">
                                    <div class="timeline-content">
                                        <h3 class="font-heading text-2xl font-bold text-candelaria-purple mb-2">Décadas
                                            de Oro (1950-1970)</h3>
                                        <p class="text-gray-700 mb-4">La época de las cofradías originales y el inicio
                                            de la formalización del concurso. Nace Morenada Orkapata (1955), Diablada
                                            Porteño (1962) y Bellavista (1963). Las máscaras de yeso y los trajes de
                                            lana definen esta era.</p>
                                        <div class="flex flex-wrap gap-2 justify-end">
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
                                <div class="timeline-dot" onclick="toggleTimelineContent(2)"></div>
                                <div class="md:w-1/2 md:pl-12 pl-12">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                        <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiijAyeVlb8shbRm-HMeE-XNwfbG4uRXlBUImio62n416pNahZ-iij-ug09YMBTqK4GwnEN2OXQh-iO8tNKai-pH7y8_PgSp3EXvIBSAg4TPiEMpxqI0phlGdujmt17EpqCXNL1icP7Q1Q/s1600/Edwin+Losa.jpg"
                                            class="w-full h-48 object-cover vintage-photo" alt="Candelaria años 50"
                                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=CANDELARIA+1950-1970';">
                                    </div>
                                </div>
                            </div>

                            <!-- Era 3: INSTITUCIONALIZACIÓN (1967-1985) -->
                            <div class="relative flex flex-col md:flex-row items-center">
                                <div class="md:w-1/2 md:pr-12 order-2 md:order-1 pl-12 md:pl-0">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                        <img src="https://www.punomagico.com/image/arguedas.jpg"
                                            class="w-full h-48 object-cover vintage-photo" alt="José María Arguedas"
                                            onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/8/8c/Jos%C3%A9_Mar%C3%ADa_Arguedas.jpg/220px-Jos%C3%A9_Mar%C3%ADa_Arguedas.jpg';">
                                    </div>
                                </div>
                                <div class="timeline-dot" onclick="toggleTimelineContent(3)"></div>
                                <div class="md:w-1/2 md:pl-12 mb-8 md:mb-0 order-1 md:order-2 pl-12">
                                    <div class="timeline-content">
                                        <h3 class="font-heading text-2xl font-bold text-candelaria-purple mb-2">
                                            Institucionalización (1967-1985)</h3>
                                        <p class="text-gray-700 mb-4">José María Arguedas visita Puno (1967) y declara
                                            la ciudad "Capital del Folklore". Se crea la Federación Regional de Folklore
                                            (1970). El Congreso promulga la Ley N° 24325 (1985) oficializando el título.
                                        </p>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Arguedas</span>
                                            <span
                                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Federación</span>
                                            <span
                                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Ley
                                                N° 24325</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Era 4: BOOM DEL BORDADO (1980-2000) -->
                            <div class="relative flex flex-col md:flex-row items-center">
                                <div class="md:w-1/2 md:pr-12 mb-8 md:mb-0 md:text-right pl-12 md:pl-0">
                                    <div class="timeline-content">
                                        <h3 class="font-heading text-2xl font-bold text-candelaria-purple mb-2">El Boom
                                            del Bordado (1980-2000)</h3>
                                        <p class="text-gray-700 mb-4">Ingresa la alta costura andina. Los trajes se
                                            vuelven más elaborados con lentejuelas y bordados de hilos de oro. Llegan
                                            los Caporales (1982). La rivalidad entre conjuntos se intensifica y la
                                            competencia alcanza estándares internacionales.</p>
                                        <div class="flex flex-wrap gap-2 justify-end">
                                            <span
                                                class="bg-candelaria-red/10 text-candelaria-red px-3 py-1 rounded-full text-xs font-medium">Alta
                                                Costura</span>
                                            <span
                                                class="bg-candelaria-red/10 text-candelaria-red px-3 py-1 rounded-full text-xs font-medium">Lentejuelas</span>
                                            <span
                                                class="bg-candelaria-red/10 text-candelaria-red px-3 py-1 rounded-full text-xs font-medium">Caporales</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-dot" onclick="toggleTimelineContent(4)"></div>
                                <div class="md:w-1/2 md:pl-12 pl-12">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                        <img src="https://static.wixstatic.com/media/27f42d_c1c0a0c4f82643a290333250b73e52f0~mv2.jpg/v1/fill/w_980,h_653,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/27f42d_c1c0a0c4f82643a290333250b73e52f0~mv2.jpg"
                                            class="w-full h-48 object-cover vintage-photo" alt="Candelaria años 80"
                                            onerror="this.onerror=null;this.src='https://vivecandelaria.com/wp-content/uploads/2017/02/candelaria-puno-1950.jpg';">
                                    </div>
                                </div>
                            </div>

                            <!-- Era 5: PATRIMONIO UNESCO (2003-2020) -->
                            <div class="relative flex flex-col md:flex-row items-center">
                                <div class="md:w-1/2 md:pr-12 order-2 md:order-1 pl-12 md:pl-0">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/UNESCO_logo.svg/1200px-UNESCO_logo.svg.png"
                                            class="w-full h-48 object-contain bg-white p-4" alt="UNESCO"
                                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/0ea5e9/ffffff?text=UNESCO+2014';">
                                    </div>
                                </div>
                                <div class="timeline-dot" onclick="toggleTimelineContent(5)"></div>
                                <div class="md:w-1/2 md:pl-12 mb-8 md:mb-0 order-1 md:order-2 pl-12">
                                    <div class="timeline-content">
                                        <h3 class="font-heading text-2xl font-bold text-candelaria-purple mb-2">
                                            Patrimonio Mundial (2003-2020)</h3>
                                        <p class="text-gray-700 mb-4">En 2003, el INC declara la festividad Patrimonio
                                            Cultural de la Nación. En 2014, la UNESCO la inscribe como Patrimonio
                                            Inmaterial de la Humanidad. El concurso supera los 150 conjuntos y 130,000
                                            danzantes.</p>
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">UNESCO
                                                2014</span>
                                            <span
                                                class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">INC
                                                2003</span>
                                            <span
                                                class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">130K
                                                Danzantes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Era 6: ERA DIGITAL Y PRESENTE (2020-2025) -->
                            <div class="relative flex flex-col md:flex-row items-center">
                                <div class="md:w-1/2 md:pr-12 mb-8 md:mb-0 md:text-right pl-12 md:pl-0">
                                    <div class="timeline-content">
                                        <h3 class="font-heading text-2xl font-bold text-candelaria-purple mb-2">Era
                                            Digital (2020 - Hoy)</h3>
                                        <p class="text-gray-700 mb-4">Tras la pausa pandémica (2021-2023), la festividad
                                            vuelve con fuerza en 2024. Morenada Laykakota y Wifalas Muñani lideran. En
                                            2025, Santa Rosa (87.71 pts) y Muñani (63.10 pts) son los nuevos campeones.
                                            La transmisión digital lleva la fiesta al mundo.</p>
                                        <div class="flex flex-wrap gap-2 justify-end">
                                            <span
                                                class="bg-candelaria-green/10 text-candelaria-green px-3 py-1 rounded-full text-xs font-medium">Streaming</span>
                                            <span
                                                class="bg-candelaria-green/10 text-candelaria-green px-3 py-1 rounded-full text-xs font-medium">Retorno
                                                2024</span>
                                            <span
                                                class="bg-candelaria-green/10 text-candelaria-green px-3 py-1 rounded-full text-xs font-medium">Santa
                                                Rosa 2025</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-dot" onclick="toggleTimelineContent(6)"></div>
                                <div class="md:w-1/2 md:pl-12 pl-12">
                                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                        <img src="https://vivecandelaria.com/wp-content/uploads/2024/12/festividad-virgen-candelaria-2025-una-puno.jpg"
                                            class="w-full h-48 object-cover vintage-photo" alt="Candelaria actual"
                                            onerror="this.onerror=null;this.src='https://placehold.co/600x400/4c1d95/fbbf24?text=CANDELARIA+2025';">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Referencias académicas -->
                    <div class="mt-12 bg-white rounded-xl p-6 shadow-sm border border-gray-200">
                        <h4 class="font-heading text-lg font-bold text-candelaria-purple mb-4 flex items-center gap-2">
                            <i data-lucide="book-open" class="w-5 h-5"></i> Referencias Bibliográficas
                        </h4>
                        <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div class="flex items-start gap-2">
                                <span class="text-candelaria-gold font-bold">[1]</span>
                                <p>Cánepa Koch, G. (1998). <em>Máscara, transformación e identidad en los Andes</em>.
                                    Fondo Editorial PUCP.</p>
                            </div>
                            <div class="flex items-start gap-2">
                                <span class="text-candelaria-gold font-bold">[2]</span>
                                <p>UNESCO (2014). <em>Expediente de inscripción: Festividad Virgen de la Candelaria de
                                        Puno</em>.</p>
                            </div>
                            <div class="flex items-start gap-2">
                                <span class="text-candelaria-gold font-bold">[3]</span>
                                <p>Núñez Butrón, M. (1959). <em>Estampas puneñas</em>. Editorial Los Andes, Puno.</p>
                            </div>
                            <div class="flex items-start gap-2">
                                <span class="text-candelaria-gold font-bold">[4]</span>
                                <p>Federación Regional de Folklore de Puno. <em>Archivos históricos del concurso</em>
                                    (1970-2025).</p>
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
                video: 'https://youtu.be/SJobNvlbgmQ?si=9lEgQW0DvTFlPOgl',
                image: 'https://scontent.flim6-4.fna.fbcdn.net/v/t1.6435-9/51704637_2036874863047509_6958451368663187456_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=cf85f3&_nc_eui2=AeGUUPSlOpJZ6eorRJiCo1eoaiklL8M5l1tqKSUvwzmXW12xTUKvEGv5EI27GaXaeZRGkUF2XD9XADzdAHjeJXSG&_nc_ohc=NFjwaFV28QkQ7kNvwF9Q9n_&_nc_oc=Adlwpv3-bFlcIiXwFkIFFSDgdFnajrSNArnGAqXMq1WtR4gsbfAeRdG25QklzqbQyCs&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=4eHI2HuNtLGBzChxVoNNBg&oh=00_AfqW-FDJ6T17fQvXLJsdP_vEeZDM3EFzSEJNjw6IAB85iA&oe=699B9070',
                gallery: [
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t1.6435-9/51924523_2036874833047512_231155135575752704_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=cf85f3&_nc_eui2=AeHqJv5DAbPV391Mvux6YsWONdZQKFWz4dE11lAoVbPh0TMP_Ch2rRNcokUeTrXLXEyhG7Y3n9kYi9xsittr6949&_nc_ohc=5XAbKxKg7a4Q7kNvwFTZttQ&_nc_oc=Adm7kVk2COv6SmDMxUzqeK9WruzeNWu4U4wLO_r3Z44HylLkx8uTz6XPaUZ1IhdqRKQ&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=C1QiLuBosWrMlQG9PfubCg&oh=00_AfqloxB22QMf3kW95abTSVs35-4X2WBOoD1Pjh5J2578jg&oe=699BA8D9',
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t1.6435-9/52358921_2036874876380841_5246194009650495488_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=cf85f3&_nc_eui2=AeGvq49pa1psioeE4lX9VoA9M3Tv-Kbdeb4zdO_4pt15vgk2V-YyqOjxHkPTPRYW25_Ie11rtS2onWfZqZvWqDtO&_nc_ohc=UaaRlJB7iTkQ7kNvwGXLcEj&_nc_oc=Adnov-E7uNGWoy-MlcGTbMP99voY95By3_lINNudHHQjI8VjND20pBqZkTtc3Te1MGs&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=qcOGJbxgL8Cy_KTi5XFvww&oh=00_AfpldiEzC3NBFAWMiu2quUfi8HVJj3Vjq91Q3OOhti1Qhg&oe=699B9B43',
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t1.6435-9/52365658_2036874936380835_671748493005553664_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=cf85f3&_nc_eui2=AeH5FUVVLOStOVr7eaAWEYqMulJNkdhmDrC6Uk2R2GYOsJ0l2oGAAzf_X5z1u1LKsXTx8B-PSPtmyX9sZuHV-Q6Q&_nc_ohc=AI_9OC3fqJIQ7kNvwHQed-b&_nc_oc=AdkxG6rmOcq9i6-eKQs8OOLp37fSMCuymWWbPKdE1cvF3DaWcqVyuRMrLerH7qX2xIM&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=lxdUt8lRxOFprhLo_TIvVA&oh=00_AfrgloNa1ply4MmSW5pHSzFo04ivP7G6xeENCDzY7y7aZw&oe=699B8DE6'
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
                video: 'https://youtu.be/Op6T-_Key48?si=eZfZmg4hDJ8X3pbm',
                image: 'https://portal.andina.pe/EDPfotografia3/Thumbnail/2019/07/11/000599669W.webp',
                gallery: [
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t1.6435-9/51140314_2027678007300528_9669362952699904_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeHRSkaG1Q6ofF4vo6fRh-yHE44_UR1hhRkTjj9RHWGFGQV8lK8f9nRHxyNADZq9hKZM8CCGC0u0WcwPMwc65Boy&_nc_ohc=BGUyZ1H7zbIQ7kNvwHA1LFC&_nc_oc=Adk4ZQf2gzt0VE7rKVLjQ7gX4KJNuzQxuAjHsZ7_nOWdj12JADtbeGDYzKOWoUiqN_E&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=AmSbpeSddN83JQeKdbQtRw&oh=00_AfqqEK4rKyOCO0dCFmtRTOkG2fcpoVc-xJnweUFaW4u3Iw&oe=699BABD6',
                    'https://radioondaazul.com/wp-content/uploads/2020/02/chunchos-de-esquilaya-.jpg',
                    'https://imgmedia.larepublica.pe/1000x590/larepublica/migration/images/CMFLXUFB5REINGYEEARFDHRUN4.webp'
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
                video: 'https://youtu.be/HLyyJjshT68?si=0U4OFynpbfw_MtWP',
                image: 'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0020-5-1024x681.jpg',
                gallery: [
                    'https://radioondaazul.com/wp-content/uploads/2024/02/Conjunto-Folklorico-Confraternidad-Morenada-Orkapata.jpg',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/DSC_0028-1-1024x681.jpg',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/IMG_4064-1024x683.jpg'
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
                video: 'https://youtu.be/hqyYKx_Co94?si=egfYk24YlpPzu9g5',
                image: 'https://radioondaazul.com/wp-content/uploads/2024/01/Conjunto-Wifalas-San-Francisco-Javier-de-Munani.jpg',
                gallery: [
                    'https://radioondaazul.com/wp-content/uploads/2025/01/Conjunto-Wifalas-San-Francisco-Javier-de-Munani-.jpg',
                    'https://radioondaazul.com/wp-content/uploads/2024/01/Wifalas-San-Francisco-Javier-de-Munani.jpg',
                    'https://scontent.cdninstagram.com/v/t51.75761-15/4…7vAqL1WJRisBs_TkWA-WLbyE3cZepLz9m3KQQ&oe=697A09BF'
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
                video: 'https://youtu.be/q10SZNt4Xb0?si=mS1ASfF2MZLbqb1E',
                image: 'https://larepublica.cronosmedia.glr.pe/original/2024/02/08/65c524794905c27f267fedc4.jpg',
                gallery: [
                    'https://f.rpp-noticias.io/2017/02/02/339023candejpg.jpg?imgdimension=look',
                    'https://f.rpp-noticias.io/2017/02/06/442844_341058.png?width=1020&quality=80',
                    'https://radioondaazul.com/wp-content/uploads/2023/01/Festividad-Virgen-Maria-de-la-Candelaria-2023.jpg'
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
                video: 'https://youtu.be/2seCpG4thpU?si=o8aQ-NaTYXt_kVzZ',
                image: 'https://scontent.flim6-3.fna.fbcdn.net/v/t39.30808-6/557698167_24613088208332853_952894828109069196_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=cf85f3&_nc_eui2=AeEdVfqP5LudyrT2kXA3mJsm46leD2skd2jjqV4PayR3aKKFdDm6ExM2dP0Ml1IPD5kn7r74aojbDnjeQSnPNV_1&_nc_ohc=DEsasFK3Kt8Q7kNvwEW8cEW&_nc_oc=Admy8L12jJKioIBC4R6nBeBVIBxT2hWNVfDIxEWbo7k2uCQ06Cv00qtKvkK41PBtUAs&_nc_zt=23&_nc_ht=scontent.flim6-3.fna&_nc_gid=5s8q2MxSoacg9BwvKAZLww&oh=00_Afr6Ia5phqGToen752OPUuhJBDAsZonzhELF17LnpXVfhQ&oe=697A0C09',
                gallery: [
                    'https://scontent.flim6-3.fna.fbcdn.net/v/t39.30808-6/557727800_24613088288332845_7778604945470394468_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=cf85f3&_nc_eui2=AeEsEngW6T2P1EA5VesceJtO9szYS8s0FxT2zNhLyzQXFCxa4itjOnpzQhXWJD53QYQazzy0ryPsmNRr55FKeKOx&_nc_ohc=-8__bPCke9MQ7kNvwHEPJRV&_nc_oc=AdmkiP_oCB0qlM6wg1hlWEsQMfqu6VQGi1TeoIX6AFXBkKBlFdcx_WLI3YUa5iwR8wQ&_nc_zt=23&_nc_ht=scontent.flim6-3.fna&_nc_gid=bnl2v-oa0rjQuDKqgALihA&oh=00_AfrjZXqi_Qc77troerE8xG_RV92KecAZb3FH-4ywGMcdHA&oe=697A1D3F',
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/558169878_24613088271666180_9098631694424042657_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=cf85f3&_nc_eui2=AeE-hyhwdoY87cRn0BVgC6FTHwG7-Thg2K8fAbv5OGDYrzC7dIvHYKGhKhoZxFlpWgcYrLQcB0gHT-EJcZyu3dtE&_nc_ohc=-2K6nTo2dIcQ7kNvwE7JEgb&_nc_oc=AdmK1UsK8KYeogr47S1Nm2-tv_SvTFlnPB-uctKtupXWotofWdVVPva22TVYW0j1BlE&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=n5aK66LFHxI28NLmt5H-vg&oh=00_AfrhFzW4rALHiQY1UYfJ57F0bxWPCA3RUDYDkH4LP0BrNw&oe=697A1A11',
                    'https://scontent.flim6-3.fna.fbcdn.net/v/t39.30808-6/557716016_24613088134999527_6676370662114461425_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=cf85f3&_nc_eui2=AeFPtA4Q4BE3iPepv2QsCoRoc2PPEiGPXlNzY88SIY9eUzTMHVljzibVHAie9h8GibIb1jftaQuCOTovszob-pKw&_nc_ohc=KuxCw8HCemwQ7kNvwFNoBsa&_nc_oc=AdnW9Bq87xtfloZ5vELcQxGJ3hGNBIDC4M9XcVCfY-g8W_-vQFigG24N5r9s-cdAycU&_nc_zt=23&_nc_ht=scontent.flim6-3.fna&_nc_gid=uoIYNXZAJpRLChc1_uRsdQ&oh=00_Afo0P0vJP5iH42qQrWqT7NGTcSyaHmeQoOwuFki50taJbA&oe=697A0FF1'
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
                video: 'https://youtu.be/00c7dFVkGbg?si=_VN6imtQX-QiAf3V',
                image: 'https://scontent.flim6-2.fna.fbcdn.net/v/t39.30808-6/487304193_1076542121177299_1524602493217469796_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFhVHOkChDcxTE_WoMGysHKKfO8718YO2kp87zvXxg7adRPM_YYU59A8soWg3li3paEKMcWbVjgBuPASOjJrqkQ&_nc_ohc=YC7pMA8wnH8Q7kNvwFvlqs9&_nc_oc=AdlsFoymW13yd61B1yrFY7N-ks3exOt1oEOCCA72CeyJg_z5KS3fdJedd3EKIhFz2s0&_nc_zt=23&_nc_ht=scontent.flim6-2.fna&_nc_gid=THkScNeOCuaq4UtjMZ1vRg&oh=00_Afq0pGzq0DTnZuDeBZhLKxBcihjCryZYhv4wKSEuUA6j6w&oe=697A0A48',
                gallery: [
                    'https://scontent.flim6-2.fna.fbcdn.net/v/t39.30808-6/486536833_1076542611177250_1768197648850752335_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeGMueIB1gwXKuOLqjD_O3ickVGQrf_swNORUZCt_-zA00X7UQ2OlQTHHhDBWE0KfGJqjceKdMG6UIEGiLV45JsX&_nc_ohc=9GZa242YT7gQ7kNvwH3o1P3&_nc_oc=AdkkQ3-iRQWMMJXNrM1oFDlcZ_Vm6HMoxf0CoEZv8CqjMGexlx9AKBecbN3INhVLSGg&_nc_zt=23&_nc_ht=scontent.flim6-2.fna&_nc_gid=aWeQdkQQUw1C_z_pYbmJ3g&oh=00_AfocPYO_pRQEkg1f2R5kpSgHOcaE0MSaeJebRdjCiJPFpA&oe=6979F81E',
                    'https://scontent.flim6-3.fna.fbcdn.net/v/t39.30808-6/486531276_1076542257843952_4621486364285369854_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeH0PtMzJT8Nh9VwWQPRBVSDKZXXatmj5Y4plddq2aPljlQ-VQyOHXeWCty31gky1cZES1uckakJFK6-TDkys62J&_nc_ohc=D37hVUZNipYQ7kNvwFjE1Th&_nc_oc=AdldAGyrB7-JSG1rG5Fydm3ftq7iSbXOkodrQJTJsAmdBUJ505Af838gob3ElnqZq8s&_nc_zt=23&_nc_ht=scontent.flim6-3.fna&_nc_gid=k1ISzdLob5StuahRLU08uA&oh=00_AfrvMNCfdss15E8i-4OBZ3ERRX6G3TTtn1a1O6PSmmWG7Q&oe=697A1719',
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/487240511_1076542531177258_2817840117068575207_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeGEkd_vycdVNQpYUDx4USXbSzmQXj7VuJFLOZBePtW4kbMn0P5uv2bzIhvg6qELLkszQP7rEDMT8tdHDjXtFTVu&_nc_ohc=a0m8OoMG5NsQ7kNvwFMP_Ds&_nc_oc=Adl1xmjGPRhsaHjia83xl4lLeLMBXhsD3dOOnEXVjS3jM4Ote_Ffg3KwVh6egGPpt3Y&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=qEjqFDS867AjTC7JPgPACw&oh=00_Afr-Frgxlf-DkNs12k6RTelMyEftTEim_EG8vgBAUNmXQg&oe=6979F50E'
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
                video: 'https://youtu.be/xvF-TTyBfFU?si=MHO8exlJhlyy9dpc',
                image: 'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/486092405_1072751258205977_7356115628292395866_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFQGegPgDXDjpUU-0x8J4qFVr8WxeXZwA5WvxbF5dnADpYVNXzNzBp6kPEorMCgEf0UswgQhz0UdhoJnld1KEGm&_nc_ohc=ikuXJfWQj5gQ7kNvwEt_UGw&_nc_oc=AdkhmoeaCBlceIzFWtOkdHSdg3B_Fponhaj2ct_SVU1LSQjnkiMNo5mZAl4-zz23I0Q&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=1e7FYdRwhiXDxs7NHfq00w&oh=00_AfoKba6BHHkhA9k1I_eeSb3b9WB8KnpzOnJKOJ1k4_20MA&oe=697A1863',
                gallery: [
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/486547378_1072751491539287_1690859207326763275_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFAoTsFawf7DPA62MHf647UCjGDR7CX2vEKMYNHsJfa8Uat-uQzFDR_teOxecUJX07o-pdGDjl0bUg-5YeW3oj0&_nc_ohc=0TxXwVuDrwoQ7kNvwEXd-Uz&_nc_oc=Adl_xs0xwqW5eh_Q-uVV6TPUcWHrcx2rka7pO1qDoypRHqTt1WIV8gQxTNU0MYpCtdo&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=55ZL2jJObZy5ArMQPR3J0Q&oh=00_AfrcpunUeS7Es9oz2K3V3Fd7AuLs8x2pSzLu1vgTQcvyhA&oe=6979F013',
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/485634477_977662561185420_9180665816111890085_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeFj8OrTOMYqoUOqhPYKNJ4IwP4lgyQcPIjA_iWDJBw8iB2QZ3lTVeTVNsL94dGNSQHIA5APwPrlmLy-i6WX4L1n&_nc_ohc=aS6OAu6j3oAQ7kNvwGv9k7z&_nc_oc=AdkcNzTANYNIVNVglEhQgOt3U00RnC3YXEXCZWxdQkekEhTvPlWD6aQtTHrFQmBSyiA&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=Klfz5Y_2FAjjhWJw7AOVYw&oh=00_Afo9Tc40xguM21p4iTT-ONySfoQWsm0hKyao0aqjrRlXsA&oe=6979EB47',
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/485884948_977662477852095_543861617827511592_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=127cfc&_nc_eui2=AeH1MEpwZyaMj8_dk0fiTX3EHGI37L8yyqEcYjfsvzLKoXZyD6ShM_QVLQUYENBBDZX4FQ4WGbrBkQzAvALn_6eR&_nc_ohc=pypaxlSTCVsQ7kNvwEra9zQ&_nc_oc=Admz7x-KNXsDt8dCxsrx1uDGvRQOcyKPYfRGdxVE1htmlXreR4OzCgUIT_11FeEV4cs&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=nepUmHQRXw1wo48MbueYpw&oh=00_Afq7q-J2j8KQz3xV8K7_gUW8Wo-MBFcA_3M3luUXnJgg_g&oe=6979FE19'
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
                video: 'https://youtu.be/eFmZbckl2Bo?si=Z6XOL81n1rca_4gB',
                image: 'https://radioondaazul.com/wp-content/uploads/2024/02/Asociacion-Cultural-Caporales-Centralistas-Puno.jpg',
                gallery: [
                    'https://i.ytimg.com/vi/jPJI9PSSDIk/maxresdefault.jpg',
                    'https://scontent.flim6-3.fna.fbcdn.net/v/t1.6435-9/56848010_2451569634854220_5183031039479513088_n.jpg?stp=dst-jpg_p180x540_tt6&_nc_cat=103&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeEkcObNid0_elUNwykwIPrxxqCA59DlV4PGoIDn0OVXgz4l9HX9VN2ju5Olo9jeJgNZKDkCdVDnfB5e5TcgtO7f&_nc_ohc=DIhC9Jc6WxEQ7kNvwGawc1f&_nc_oc=AdmcCfhmivtZZtM0h2yBrxqBouUyIpUXYFCPu6HtBMNrfdEM5Hu3FkLMCmJRa-2eCFo&_nc_zt=23&_nc_ht=scontent.flim6-3.fna&_nc_gid=r0EERZ0xs9_XGQz1zWVUCw&oh=00_Afo0ETSpdRMKVb2Z8AQapMIW7MB6qMhTjoJFMEsgmUY8pw&oe=699BA785',
                    'https://radioondaazul.com/wp-content/uploads/2024/02/IMG_6386-scaled.jpg'
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
                video: 'https://youtu.be/UZoxKITGGEQ?si=kedTCijbOOEjT7vW',
                image: 'https://diariocorreo.pe/resizer/cHMuGbYrd1C42a1aS-6-Ma2FfF0=/980x528/smart/filters:format(jpeg):quality(75)/arc-anglerfish-arc2-prod-elcomercio.s3.amazonaws.com/public/D6NM2YKZ4BHZXHGAMVH5BRZ7EA.jpg',
                gallery: [
                    'https://www.punomagico.com/image/wifala%20munani1.jpg',
                    'https://scontent.flim6-4.fna.fbcdn.net/v/t1.6435-9/137341712_1086650671747417_6859518839903103862_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFNxhsm7rLtwZxuRDwiR2syxcLAS4VEfN_FwsBLhUR832GN0ZClaTD5cnnibG0WzsfO6YhQS1kk7cyaWh6kRIrL&_nc_ohc=o0cEHVF6gMYQ7kNvwFVZ_VQ&_nc_oc=AdkiDQUoGiK9OkHG5D_Z2wAidcuMwtf6-HhvgqBjAebIEYEKauBhivszQFIhyeD8jgY&_nc_zt=23&_nc_ht=scontent.flim6-4.fna&_nc_gid=LtPmK0buMeanDsHvpIUkCQ&oh=00_AfpSX4r0-JO3YDmglnK1r8iPwsYgkkZPjiId2b_1cNceyw&oe=699B93AD',
                    'https://vivecandelaria.com/wp-content/uploads/2024/02/wifalas_san_francisco.jpg'
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

        // 10. Lógica para Palmarés Completo - Coming Soon
        function showPalmaresComingSoon() {
            showToast('📋 Palmarés Completo (1960 - Hoy) - ¡Disponible muy pronto! Estamos preparando una experiencia completa con todos los ganadores históricos.');
        }

        // Ejecución inmediata para evitar flicker
        (function () {
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

            // Agregar event listener para el botón de Palmarés Completo
            const palmaresBtn = document.getElementById('palmares-completo-btn');
            if (palmaresBtn) {
                palmaresBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    showPalmaresComingSoon();
                });
            }

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
                if (timelineContent) timelineContent.classList.add('active');
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
    <?= getAuthJS() ?>

    <?php
    $footerDepth = 1;
    include '../includes/standard-footer.php';
    ?>
</body>

</html>