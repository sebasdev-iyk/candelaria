<?php
/**
 * Standard Header Component for Candelaria 2026
 * Includes: Logo, Navigation, Auth, Live Button
 */

// Determine base path based on current file location
$depth = isset($headerDepth) ? $headerDepth : 0;
$basePath = str_repeat('../', $depth);
?>

<!-- Header Section - Standardized -->
<header class="header-manta-premium text-white shadow-lg sticky top-0 z-40">
    <div class="w-full px-6 md:px-12 h-20 md:h-22 flex items-center relative z-50">
        <div class="w-full flex justify-between items-center h-full">
            <!-- Left: Candelaria Branding -->
            <a href="<?= $basePath ?>index.php" id="logo-container"
                class="flex items-center cursor-pointer group h-full relative spark-container">
                <img src="<?= $basePath ?>principal/logoc.png" alt="Candelaria"
                    class="h-full w-auto object-contain transition-transform duration-300 group-hover:scale-105 relative z-10">
            </a>

            <!-- Right: Navigation + EN TIEMPO REAL -->
            <div class="flex items-center gap-6">
                <nav class="hidden md:flex items-center gap-2">
                    <a href="<?= $basePath ?>servicios/index.php" class="nav-link-custom">Servicios</a>
                    <a href="<?= $basePath ?>cultura/cultura.php" class="nav-link-custom">Cultura</a>
                    <a href="<?= $basePath ?>horarios_y_danzas/index.php" class="nav-link-custom">Horarios</a>
                    <a href="<?= $basePath ?>noticias/index.php" class="nav-link-custom">Noticias</a>
                </nav>

                <?php 
                // Include auth header if not already included
                $authHeaderPath = $basePath . 'includes/auth-header.php';
                if (file_exists($authHeaderPath) && !function_exists('getAuthButtonHTML')) {
                    include_once $authHeaderPath;
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
    <div id="mobile-menu"
        class="hidden md:hidden bg-candelaria-purple absolute top-full left-0 w-full shadow-lg border-t border-purple-800 z-30 transition-all duration-300">
        <nav class="flex flex-col p-6 space-y-4">
            <a href="<?= $basePath ?>servicios/index.php"
                class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Servicios</a>
            <a href="<?= $basePath ?>cultura/cultura.php"
                class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Cultura</a>
            <a href="<?= $basePath ?>horarios_y_danzas/index.php"
                class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Horarios</a>
            <a href="<?= $basePath ?>noticias/index.php"
                class="block text-white text-lg hover:text-candelaria-gold font-semibold border-b border-purple-800 pb-2">Noticias</a>
        </nav>
    </div>
</header>

<style>
/* Header Styles - Anti-Shake Fix */
.header-manta-premium {
    position: sticky;
    top: 0;
    background: linear-gradient(135deg, #4c1d95 0%, #6d28d9 100%);
    will-change: transform;
    transform: translateZ(0);
    backface-visibility: hidden;
    -webkit-font-smoothing: subpixel-antialiased;
}

.nav-link-custom {
    color: #e9d5ff;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 8px 16px;
    transition: color 0.3s ease;
}

.nav-link-custom:hover {
    color: #fbbf24;
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
    0%, 100% { opacity: 1; }
    50% { opacity: 0.3; }
}

@keyframes pulseLive {
    0%, 100% { box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4); }
    50% { box-shadow: 0 4px 25px rgba(220, 38, 38, 0.7), 0 0 30px rgba(220, 38, 38, 0.4); }
}

/* Mobile Menu Toggle */
#mobile-menu-btn {
    z-index: 60;
}
</style>

<script>
// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', () => {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script>
