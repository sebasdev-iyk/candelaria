<?php
// Mock Data
$articles = [
    1 => [
        'title' => 'La Diablada Aymara en Juli: origen histórico de los diablos del altiplano',
        'date' => 'Hace 47 minutos',
        'category' => 'Cultura',
        'image' => '../principal/Festividad.png',
        'content' => '<p class="mb-4">Hablar de diablos y diabladas implica comprender un profundo sincretismo cultural que se remonta a siglos de historia en la región altiplánica. La Diablada Aymara de Juli representa una de las manifestaciones más antiguas y genuinas de esta tradición.</p>
                      <p class="mb-4">Durante el reciente congreso llevado a cabo en la "Pequeña Roma de América", historiadores y cultores debatieron sobre los orígenes precoloniales de las danzas de demonios, vinculándolos a rituales agrarios y deidades locales que, tras la llegada de los evangelizadores, fueron reinterpretadas bajo la iconografía católica del diablo.</p>
                      <p class="mb-4">"No es solo un baile, es resistencia cultural", afirmó uno de los ponentes. La vestimenta, caracterizada por máscaras expresivas y trajes bordados con hilos de oro y plata, narra la lucha entre el bien y el mal, pero también la cosmovisión andina del Supay.</p>
                      <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Impacto en la Candelaria 2026</h3>
                      <p>Se espera que las conclusiones de este congreso influyan en las presentaciones de los conjuntos folclóricos en la próxima Festividad de la Virgen de la Candelaria, promoviendo una mayor autenticidad y respeto por las raíces históricas de la danza.</p>'
    ],
    2 => [
        'title' => 'Ni partidos ni candidatos: la Candelaria 2026 se blinda',
        'date' => 'Hace 13 horas',
        'category' => 'Política',
        'image' => 'https://picsum.photos/seed/puno1/800/400',
        'content' => '<p>La Federación Regional de Folklore y Cultura de Puno ha emitido un comunicado contundente: la Festividad de la Virgen de la Candelaria 2026 será un espacio libre de proselitismo político.</p><p>Ante la cercanía de las elecciones regionales y municipales, se han establecido multas severas para aquellos conjuntos que permitan el uso de sus espacios o indumentaria para propaganda partidaria.</p>'
    ],
    3 => [
        'title' => 'Congreso de la Diablada inició en Juli con gran acogida',
        'date' => 'Hace 13 horas',
        'category' => 'Actualidad',
        'image' => 'https://picsum.photos/seed/diablada/800/400',
        'content' => '<p>Con la participación de más de 50 delegaciones, inició en Juli el Primer Congreso Internacional de la Diablada. El evento busca salvaguardar la danza como Patrimonio Cultural e Inmaterial de la Humanidad.</p>'
    ],
    4 => [
        'title' => 'Perú rompe barreras: el Túnel Ollachea conquista un Récord Guinness',
        'date' => 'Hace 2 días',
        'category' => 'Infraestructura',
        'image' => 'https://picsum.photos/seed/tunel/800/400',
        'content' => '<p>El Túnel Ollachea, ubicado en la región Puno, ha sido reconocido por el Guinness World Records por su ingeniería de vanguardia en condiciones geográficas extremas.</p>'
    ]
];

$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$article = isset($articles[$id]) ? $articles[$id] : $articles[1];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $article['title'] ?> - Candelaria 2025
    </title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        candelaria: { purple: '#4c1d95', gold: '#fbbf24', lake: '#0ea5e9' }
                    },
                    fontFamily: { heading: ['Montserrat', 'sans-serif'], sans: ['Open Sans', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        .nav-link-custom {
            color: #e9d5ff;
            text-decoration: none;
            font-weight: 600;
            padding: 8px 16px;
            position: relative;
        }

        .nav-link-custom:hover {
            color: #fbbf24;
        }

        .article-content p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            color: #374151;
            font-size: 1.1rem;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Header (Condensed) -->
    <header class="bg-candelaria-purple text-white shadow-lg">
        <div class="w-full px-4 py-4 flex justify-between items-center max-w-7xl mx-auto">
            <a href="../index.php" class="flex items-center"><img src="../principal/virgencandelariaa.png"
                    class="h-10"></a>
            <nav class="hidden md:flex gap-4">
                <a href="../servicios/index.php" class="nav-link-custom">Servicios</a>
                <a href="../noticias/index.php" class="nav-link-custom text-candelaria-gold font-bold">Noticias</a>
            </nav>
            <a href="index.php"
                class="text-sm font-bold border border-white/30 rounded-full px-4 py-2 hover:bg-white/10">
                <i data-lucide="arrow-left" class="w-4 h-4 inline mr-1"></i> Volver a Noticias
            </a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-10">
        <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <img src="<?= $article['image'] ?>" class="w-full h-[400px] object-cover">

            <div class="p-8 md:p-12">
                <div class="flex items-center gap-4 mb-6 text-sm">
                    <span class="bg-candelaria-purple text-white px-3 py-1 rounded-full font-bold uppercase">
                        <?= $article['category'] ?>
                    </span>
                    <span class="text-gray-500 flex items-center gap-1"><i data-lucide="clock" class="w-4 h-4"></i>
                        <?= $article['date'] ?>
                    </span>
                </div>

                <h1 class="text-3xl md:text-5xl font-bold font-heading text-gray-900 mb-8 leading-tight">
                    <?= $article['title'] ?>
                </h1>

                <div class="article-content">
                    <?= $article['content'] ?>
                </div>

                <div class="mt-12 pt-8 border-t border-gray-100 flex justify-between items-center">
                    <div class="text-gray-500 text-sm">Compártelo:</div>
                    <div class="flex gap-4">
                        <button class="text-blue-600 hover:text-blue-800"><i data-lucide="facebook"
                                class="w-6 h-6"></i></button>
                        <button class="text-blue-400 hover:text-blue-600"><i data-lucide="twitter"
                                class="w-6 h-6"></i></button>
                        <button class="text-green-500 hover:text-green-700"><i data-lucide="share-2"
                                class="w-6 h-6"></i></button>
                    </div>
                </div>
            </div>
        </article>
    </main>

    <footer class="bg-gray-900 text-white py-8 text-center mt-12">
        <p class="text-gray-500 text-sm">&copy; 2025 Candelaria Puno</p>
    </footer>

    <script>lucide.createIcons();</script>
</body>

</html>