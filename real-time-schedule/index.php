<!DOCTYPE html>
<html class="dark" lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Candelaria Live - Real-Time Schedule</title>
<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet"/>
<!-- Material Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Theme Configuration -->
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#ec1325",
                    "background-light": "#f8f6f6",
                    "background-dark": "#221012",
                    "surface-dark": "#2f1b1d",
                    "border-dark": "#543b3d",
                    "text-muted": "#b99d9f",
                },
                fontFamily: {
                    "display": ["Manrope", "sans-serif"]
                },
                borderRadius: {"DEFAULT": "1rem", "lg": "2rem", "xl": "3rem", "full": "9999px"},
            },
        },
    }
</script>
<style>
    /* Custom scrollbar for cleaner look */
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #221012; 
    }
    ::-webkit-scrollbar-thumb {
        background: #543b3d; 
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #ec1325; 
    }
</style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-white antialiased min-h-screen flex flex-col overflow-x-hidden">
<!-- Top Navigation -->
<header class="sticky top-0 z-50 w-full border-b border-border-dark bg-background-dark/95 backdrop-blur-sm">
<div class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto w-full">
<div class="flex items-center gap-8">
<a class="flex items-center gap-3 text-white hover:opacity-80 transition-opacity" href="/candelaria/index.php">
<div class="text-primary">
<span class="material-symbols-outlined text-4xl">festival</span>
</div>
<h2 class="text-xl font-bold tracking-tight">Candelaria Live</h2>
</a>
<nav class="hidden lg:flex items-center gap-8">
<a class="text-primary font-bold text-sm leading-normal" href="#">Schedule</a>
<a class="text-white/80 hover:text-white text-sm font-medium transition-colors" href="/candelaria/live-platform/index.php">Livestream</a>
<a class="text-white/80 hover:text-white text-sm font-medium transition-colors" href="#">Route Map</a>
<a class="text-white/80 hover:text-white text-sm font-medium transition-colors" href="#">Results</a>
</nav>
</div>
<div class="flex items-center gap-6">
<label class="hidden md:flex flex-col min-w-40 !h-10 max-w-64 relative group">
<div class="flex w-full flex-1 items-center rounded-xl h-full bg-surface-dark border border-transparent focus-within:border-primary/50 transition-all">
<div class="text-text-muted flex items-center justify-center pl-3">
<span class="material-symbols-outlined text-[20px]">search</span>
</div>
<input id="search-input" class="w-full bg-transparent border-none text-white placeholder:text-text-muted px-3 focus:ring-0 text-sm" placeholder="Find fraternity..."/>
</div>
</label>
<button class="flex items-center justify-center rounded-full h-10 px-6 bg-primary hover:bg-red-600 text-white text-sm font-bold tracking-wide transition-colors shadow-lg shadow-primary/20">
<span>Login</span>
</button>
</div>
</div>
</header>
<!-- Main Content -->
<main class="flex-1 flex flex-col items-center w-full px-4 sm:px-6 py-8">
<div class="w-full max-w-4xl flex flex-col gap-8">
<!-- Heading & Tabs -->
<div class="flex flex-col gap-6">
<div class="flex flex-wrap justify-between items-end gap-4">
<div class="flex flex-col gap-2">
<h1 class="text-white text-3xl md:text-5xl font-black tracking-tight">Real-Time Schedule</h1>
<p class="text-text-muted text-lg max-w-2xl">Follow the official order of presentation for the Festividad de la Virgen de la Candelaria.</p>
</div>
<!-- Date Toggle -->
<div class="bg-surface-dark p-1 rounded-full inline-flex border border-border-dark self-start md:self-end">
<button id="btn-day-1" class="day-btn px-5 py-2 rounded-full text-sm font-bold text-text-muted hover:text-white transition-colors" data-day="Day 1">
                            Day 1
                        </button>
<button id="btn-day-2" class="day-btn px-5 py-2 rounded-full bg-primary text-white shadow-md text-sm font-bold" data-day="Day 2">
                            Day 2: Trajes de Luces
                        </button>
<button id="btn-day-3" class="day-btn px-5 py-2 rounded-full text-sm font-bold text-text-muted hover:text-white transition-colors" data-day="Day 3">
                            Day 3
                        </button>
</div>
</div>
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
<div class="flex flex-col gap-1 rounded-2xl p-5 bg-surface-dark border border-border-dark">
<div class="flex items-center gap-2 text-text-muted mb-1">
<span class="material-symbols-outlined text-xl">groups</span>
<span class="text-sm font-bold uppercase tracking-wider">Participation</span>
</div>
<p class="text-white text-3xl font-bold"><span id="stat-progress">45</span> <span class="text-text-muted text-xl font-medium">/ <span id="stat-total">80</span></span></p>
<p class="text-xs text-text-muted">Groups performed</p>
</div>
<div class="flex flex-col gap-1 rounded-2xl p-5 bg-surface-dark border border-border-dark">
<div class="flex items-center gap-2 text-text-muted mb-1">
<span class="material-symbols-outlined text-xl">schedule</span>
<span class="text-sm font-bold uppercase tracking-wider">Avg. Delay</span>
</div>
<p class="text-primary text-3xl font-bold">+25 min</p>
<p class="text-xs text-text-muted">Behind schedule</p>
</div>
<div class="flex flex-col gap-1 rounded-2xl p-5 bg-surface-dark border border-border-dark sm:col-span-2 lg:col-span-1">
<div class="flex items-center gap-2 text-text-muted mb-1">
<span class="material-symbols-outlined text-xl">sunny</span>
<span class="text-sm font-bold uppercase tracking-wider">Weather (Puno)</span>
</div>
<p class="text-white text-3xl font-bold">14°C</p>
<p class="text-xs text-text-muted">Partly Cloudy, UV High</p>
</div>
</div>
</div>
<!-- Mobile Search (Visible only on small screens) -->
<div class="md:hidden">
<label class="flex flex-col w-full h-12">
<div class="flex w-full flex-1 items-center rounded-xl h-full bg-surface-dark border border-border-dark">
<div class="text-text-muted flex items-center justify-center pl-4">
<span class="material-symbols-outlined">search</span>
</div>
<input id="search-input-mobile" class="w-full bg-transparent border-none text-white placeholder:text-text-muted px-4 focus:ring-0" placeholder="Search for a fraternity..."/>
</div>
</label>
</div>
<!-- Timeline Section -->
<div class="relative mt-4">
<!-- Vertical Line -->
<div class="absolute left-6 top-4 bottom-0 w-0.5 bg-gradient-to-b from-border-dark via-border-dark to-transparent"></div>
<div id="timeline-container" class="flex flex-col gap-10">
    <!-- Content injected via JS -->
</div>
<div class="flex justify-center py-8">
<button id="btn-load-more" class="flex items-center gap-2 text-text-muted hover:text-white transition-colors text-sm font-bold uppercase tracking-wide">
<span>Load remaining groups</span>
<span class="material-symbols-outlined">expand_more</span>
</button>
</div>
</div>
</div>
</div>
</main>
<script src="script.js"></script>
</body></html>
