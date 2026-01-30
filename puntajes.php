<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puntajes Oficiales | Candelaria 2026</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        candelaria: { purple: '#4c1d95', gold: '#fbbf24', lake: '#0ea5e9', light: '#f5f3ff' }
                    },
                    fontFamily: { sans: ['Open Sans', 'sans-serif'], heading: ['Montserrat', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: #0f172a;
            color: white;
        }

        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="min-h-screen bg-slate-900 hero-pattern">

    <!-- Navigation (Simplified version of main site nav) -->
    <nav class="bg-black/80 backdrop-blur-md border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='index.php'">
                    <i data-lucide="award" class="w-8 h-8 text-candelaria-gold"></i>
                    <span class="font-heading font-bold text-xl tracking-wider">CANDELARIA <span
                            class="text-candelaria-gold">2026</span></span>
                </div>
                <div class="hidden md:block">
                    <a href="index.php"
                        class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Inicio</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1
                class="text-4xl md:text-6xl font-black mb-4 text-transparent bg-clip-text bg-gradient-to-r from-candelaria-gold via-yellow-200 to-candelaria-gold">
                PUNTAJES OFICIALES
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">Resultados actualizados del Concurso en el Estadio
                Enrique Torres Belón y la Veneración.</p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex justify-center mb-10">
            <div class="bg-slate-800 p-1.5 rounded-full inline-flex shadow-xl border border-white/10">
                <button onclick="switchTab('Autoctonos')" id="tab-autoctonos"
                    class="px-8 py-3 rounded-full text-sm font-bold transition-all duration-300 bg-candelaria-purple text-white shadow-lg">
                    DANZAS AUTÓCTONAS
                </button>
                <button onclick="switchTab('Luces Parada')" id="tab-luces"
                    class="px-8 py-3 rounded-full text-sm font-bold transition-all duration-300 text-gray-400 hover:text-white">
                    TRAJES DE LUCES
                </button>
            </div>
        </div>

        <!-- Results Table -->
        <div
            class="bg-slate-800/50 backdrop-blur-sm rounded-2xl border border-white/10 overflow-hidden shadow-2xl relative min-h-[400px]">
            <div id="loader"
                class="absolute inset-0 flex items-center justify-center bg-slate-900/80 z-10 transition-opacity">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-candelaria-gold"></div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-900/80 text-gray-400 uppercase text-xs font-bold tracking-wider">
                        <tr>
                            <th class="px-6 py-4 text-center w-20">Puesto</th>
                            <th class="px-6 py-4">Conjunto</th>
                            <th class="px-6 py-4 text-center">Puntaje Estadio</th>
                            <th class="px-6 py-4 text-center">Puntaje Parada</th>
                            <th class="px-6 py-4 text-right pr-8">Total</th>
                        </tr>
                    </thead>
                    <tbody id="results-body" class="divide-y divide-white/5 text-sm">
                        <!-- Content populated by JS -->
                    </tbody>
                </table>
            </div>

            <div id="empty-state" class="hidden py-16 text-center">
                <i data-lucide="clipboard-list" class="w-16 h-16 text-gray-600 mx-auto mb-4"></i>
                <p class="text-gray-400 text-lg">Aún no hay resultados publicados para esta categoría.</p>
            </div>
        </div>
    </main>

    <?php 
    $footerDepth = 0;
    require_once 'includes/standard-footer.php'; 
    ?>

    <script>
        let allScores = [];
        let activeTab = 'Autoctonos';

        async function init() {
            try {
                // Fetch from the backend API that we created for admin, but it has a public read mode 
                // OR we can create a public endpoint. Since we used "api/admin/puntajes.php" which might have RBAC,
                // we should check permissions. Wait, `puntajes.php` checks for `requireRole(['superadmin'])`.
                // WE NEED A PUBLIC API ENDPOINT.

                // Correction: Creating a public endpoint quickly via creating `php-admin/api/public/puntajes.php` 
                // OR simple inline PHP here? Best practice is separate file. 
                // Given constraints, I'll fetch `api/danzas.php` (which is public) and if I added the columns to database, 
                // `api/danzas.php` (which does SELECT *) will return them automatically! A nice side effect of `SELECT *`.

                // Let's verify `api/danzas.php`. It does `SELECT * FROM candela_list`.
                // So I can reuse `candelaria/api/danzas.php` or `php-admin/api/admin/danzas.php`?
                // `candelaria/api/danzas.php` is the public one. Let's assume it exists or use `php-admin/api/danzas.php`?
                // Checking file list... `candelaria/index.php` calls `./api/danzas.php`.

                const response = await fetch('./api/danzas.php?pageSize=1000');
                const data = await response.json();

                // Data format might be {data: [...], pagination: ...} or just [...]
                const rows = Array.isArray(data) ? data : (data.data || []);

                allScores = rows.map(r => ({
                    conjunto: r.conjunto,
                    categoria: r.categoria,
                    estadio: parseFloat(r.puntaje_estadio || 0),
                    parada: parseFloat(r.puntaje_parada || 0),
                    total: parseFloat(r.puntaje_estadio || 0) + parseFloat(r.puntaje_parada || 0)
                }));

                render();
            } catch (e) {
                console.error("Error fetching scores:", e);
                // Fallback demo data if API fails during dev
                document.getElementById('empty-state').classList.remove('hidden');
            } finally {
                document.getElementById('loader').classList.add('opacity-0');
                setTimeout(() => document.getElementById('loader').classList.add('hidden'), 300);
            }
        }

        function switchTab(tab) {
            activeTab = tab;

            // Update UI
            const btnAuto = document.getElementById('tab-autoctonos');
            const btnLuces = document.getElementById('tab-luces');

            if (tab === 'Autoctonos') {
                btnAuto.className = "px-8 py-3 rounded-full text-sm font-bold transition-all duration-300 bg-candelaria-purple text-white shadow-lg";
                btnLuces.className = "px-8 py-3 rounded-full text-sm font-bold transition-all duration-300 text-gray-400 hover:text-white";
            } else {
                btnLuces.className = "px-8 py-3 rounded-full text-sm font-bold transition-all duration-300 bg-candelaria-purple text-white shadow-lg";
                btnAuto.className = "px-8 py-3 rounded-full text-sm font-bold transition-all duration-300 text-gray-400 hover:text-white";
            }

            render();
        }

        function render() {
            const tbody = document.getElementById('results-body');
            tbody.innerHTML = '';

            // Filter and Sort
            // Note: 'Luces Parada' matches 'Traje de Luces' loosely in our system sometimes, checking loose match
            const filtered = allScores.filter(s => {
                if (activeTab === 'Autoctonos') return (s.categoria || '').includes('Autoctonos');
                // For Luces, match 'Luces'
                return (s.categoria || '').includes('Luces');
            });

            // Sort Descending by Total
            filtered.sort((a, b) => b.total - a.total);

            if (filtered.length === 0) {
                document.getElementById('empty-state').classList.remove('hidden');
                return;
            } else {
                document.getElementById('empty-state').classList.add('hidden');
            }

            filtered.forEach((item, index) => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-white/5 transition-colors group";

                // Medal colors
                let rankClass = "text-gray-400 font-mono";
                let rankIcon = "";
                if (index === 0) { rankClass = "text-yellow-400 font-bold text-lg"; rankIcon = "🥇"; }
                if (index === 1) { rankClass = "text-gray-300 font-bold text-lg"; rankIcon = "🥈"; }
                if (index === 2) { rankClass = "text-amber-600 font-bold text-lg"; rankIcon = "🥉"; }

                tr.innerHTML = `
                    <td class="px-6 py-4 text-center">
                        <span class="${rankClass}">${rankIcon || (index + 1)}</span>
                    </td>
                    <td class="px-6 py-4 font-medium text-white group-hover:text-candelaria-gold transition-colors">
                        ${item.conjunto}
                    </td>
                    <td class="px-6 py-4 text-center text-gray-300 font-mono">
                        ${item.estadio.toFixed(2)}
                    </td>
                    <td class="px-6 py-4 text-center text-gray-300 font-mono">
                        ${item.parada.toFixed(2)}
                    </td>
                    <td class="px-6 py-4 text-right pr-8 font-bold text-xl text-candelaria-gold font-mono">
                        ${item.total.toFixed(2)}
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        lucide.createIcons();
        init();
    </script>
</body>

</html>