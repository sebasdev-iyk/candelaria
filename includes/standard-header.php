<?php
/**
 * Standard Header Component for Candelaria 2026
 * Includes: Logo, Navigation, Auth, Live Button
 * 
 * Features:
 * - View Transitions API for smooth page navigation
 * - SSR auth state rendering to prevent flash
 */

// Determine base path based on current file location
$depth = isset($headerDepth) ? $headerDepth : 0;
$basePath = str_repeat('../', $depth);
$activePage = isset($activePage) ? $activePage : '';

// Helper for active class
function getActiveClass($page, $activePage)
{
    return $page === $activePage ? 'active' : '';
}
?>

<!-- View Transitions Meta Tag (enables cross-document transitions) -->
<meta name="view-transition" content="same-origin">


<!-- Header Section - Standardized (with view-transition-name for stability) -->
<header class="header-manta-premium text-white shadow-lg sticky top-0 z-40" style="view-transition-name: main-header;">
    <div class="w-full px-3 md:px-12 h-20 md:h-22 flex items-center relative z-50">
        <div class="w-full flex justify-between items-center h-full">
            <!-- Left: Candelaria Branding -->
            <a href="<?= $basePath ?>index.php" id="logo-container"
                class="flex items-center cursor-pointer group h-full relative spark-container">
                <img src="<?= $basePath ?>principal/logoc.webp" alt="Candelaria"
                    class="h-full w-auto object-contain transition-transform duration-300 group-hover:scale-105 relative z-10">
            </a>

            <!-- Right: Navigation + EN TIEMPO REAL -->
            <div class="flex items-center gap-2 md:gap-6">
                <nav class="hidden md:flex items-center gap-2">
                    <a href="<?= $basePath ?>horarios_y_danzas/index.php"
                        class="nav-link-custom <?= getActiveClass('horarios', $activePage) ?>">Festividad</a>
                    <a href="<?= $basePath ?>cultura/cultura.php"
                        class="nav-link-custom <?= getActiveClass('cultura', $activePage) ?>">Cultura</a>
                    <a href="<?= $basePath ?>servicios/index.php"
                        class="nav-link-custom <?= getActiveClass('servicios', $activePage) ?>">Servicios</a>
                    <a href="<?= $basePath ?>noticias/index.php"
                        class="nav-link-custom <?= getActiveClass('noticias', $activePage) ?>">Noticias</a>
                    <a href="https://www.joinnus.com/events/art-culture/puno-concurso-de-danzas-originarias-2026-74197"
                        class="nav-link-custom" target="_blank" rel="noopener noreferrer">Entradas</a>
                </nav>



                <?php
                // Include auth header if not already included
                $authHeaderPath = $basePath . 'includes/auth-header.php';
                // Check if getAuthButtonHTML exists to avoid re-include issues if manually included
                if (!function_exists('getAuthButtonHTML') && file_exists(__DIR__ . '/auth-header.php')) {
                    include_once __DIR__ . '/auth-header.php';
                }

                if (function_exists('getAuthButtonHTML')) {
                    echo getAuthButtonHTML();
                }
                ?>

                <!-- EN VIVO Button -->
                <a href="<?= $basePath ?>live-platform/index.php" class="btn-live group !p-2.5 md:!px-6 md:!py-2.5">
                    <div class="live-dot"></div>
                    <span class="tracking-wider hidden md:inline">EN TIEMPO REAL</span>
                </a>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-white hover:text-candelaria-gold transition-colors">
                    <i data-lucide="menu" class="w-8 h-8"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Hidden by default) -->
    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu"
        class="hidden md:hidden fixed top-[80px] left-0 w-full h-[calc(100vh-80px)] bg-[#2e1065] shadow-lg border-t border-purple-800 z-[100] overflow-y-auto transition-all duration-300">
        <nav class="flex flex-col p-6 space-y-4">
            <a href="<?= $basePath ?>horarios_y_danzas/index.php"
                class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2 <?= $activePage === 'horarios' ? 'text-candelaria-gold' : '' ?>">Festividad</a>
            <a href="<?= $basePath ?>cultura/cultura.php"
                class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2 <?= $activePage === 'cultura' ? 'text-candelaria-gold' : '' ?>">Cultura</a>
            <a href="<?= $basePath ?>servicios/index.php"
                class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2 <?= $activePage === 'servicios' ? 'text-candelaria-gold' : '' ?>">Servicios</a>
            <a href="<?= $basePath ?>noticias/index.php"
                class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2 <?= $activePage === 'noticias' ? 'text-candelaria-gold' : '' ?>">Noticias</a>
            <a href="https://www.joinnus.com/events/art-culture/puno-concurso-de-danzas-originarias-2026-74197"
                class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2"
                target="_blank" rel="noopener noreferrer">Entradas</a>
        </nav>
    </div>
</header>

<style>
    /* Header Styles - Premium */
    .header-manta-premium {
        height: 100px;
        /* Reduced from 140px to be less obtrusive but still premium */
        background-image: linear-gradient(rgba(45, 10, 80, 0.45), rgba(15, 5, 30, 0.65)), url('<?= $basePath ?>principal/headerfondo2.jpg');
        background-size: auto 100%;
        background-repeat: repeat-x;
        background-position: center;
        position: sticky;
        top: 0;
        border-bottom: 3px solid #fbbf24;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        display: flex;
        flex-direction: column;
        justify-content: center;
        will-change: transform;
        z-index: 40;
        /* View Transition: Keep header stable during page transitions */
        view-transition-name: main-header;
    }

    /* View Transitions API - Smooth page navigation */
    @view-transition {
        navigation: auto;
    }

    /* Header stays in place during transition */
    ::view-transition-old(main-header),
    ::view-transition-new(main-header) {
        animation: none;
        mix-blend-mode: normal;
    }

    /* Content area transitions smoothly */
    ::view-transition-old(root) {
        animation: fade-out 0.15s ease-out forwards;
    }

    ::view-transition-new(root) {
        animation: fade-in 0.15s ease-in;
    }

    @keyframes fade-out {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }

    @keyframes fade-in {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
        .header-manta-premium {
            height: 80px;
        }
    }

    .header-manta-premium::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, transparent 30%, rgba(0, 0, 0, 0.2) 100%);
        pointer-events: none;
    }

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
        animation: pulseLive 2s infinite;
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

    /* Mobile Menu Toggle */
    #mobile-menu-btn {
        z-index: 60;
        cursor: pointer;
    }
</style>

<script>
    // Mobile Menu Toggle
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        console.log('[Header] Init', { mobileMenuBtn, mobileMenu });

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('[Header] Menu clicked');
                mobileMenu.classList.toggle('hidden');
                console.log('[Header] State:', mobileMenu.classList.contains('hidden') ? 'Hidden' : 'Visible');
            });

            // Close on click outside
            document.addEventListener('click', (e) => {
                if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target) && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        } else {
            console.error('[Header] Mobile menu elements not found');
        }

        // Init icons if available
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>