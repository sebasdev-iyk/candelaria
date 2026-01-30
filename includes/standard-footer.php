<?php
/**
 * Standard Footer Component - Updated Version 3.0 - FORCE REFRESH
 */
$basePath = isset($footerDepth) ? str_repeat('../', $footerDepth) : './';
$footerVersion = '3.0.' . time(); // Force cache refresh
// Add cache-busting headers
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<footer class="bg-slate-900 border-t border-slate-800 text-white pt-10 pb-6 relative z-10" data-footer-version="<?= $footerVersion ?>" data-developers="sam-sebastian-only">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">

        <!-- Legal -->
        <div class="text-center">
            <h3
                class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-200 mb-4 uppercase tracking-wider">
                Legal</h3>
            <ul class="space-y-2 text-xs text-slate-400">
                <li><a href="<?= $basePath ?>privacy.php" class="hover:text-yellow-400 transition-colors">Política de
                        Privacidad</a></li>
                <li><a href="<?= $basePath ?>terms.php" class="hover:text-yellow-400 transition-colors">Términos y
                        Condiciones</a></li>
                <li><a href="<?= $basePath ?>delete-data.php" class="hover:text-yellow-400 transition-colors">Eliminar
                        Mis
                        Datos</a></li>
            </ul>
        </div>

        <!-- Contact Link -->
        <div class="text-center">
            <h3
                class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-200 mb-4 uppercase tracking-wider">
                Contacto</h3>
            <ul class="space-y-2 text-xs text-slate-400">
                <li>
                    <a href="<?= $basePath ?>contacto.php"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white transition-all font-medium group border border-slate-700">
                        <i data-lucide="mail"
                            class="w-4 h-4 text-yellow-500 group-hover:scale-110 transition-transform"></i>
                        Contáctanos
                    </a>
                </li>
            </ul>
        </div>

        <!-- Social Media -->
        <div class="text-center">
            <h3
                class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-yellow-200 mb-4 uppercase tracking-wider">
                Síguenos</h3>
            <div class="flex justify-center gap-4">
                <a href="https://www.facebook.com/MiPuno.pe/" target="_blank" rel="noopener noreferrer"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition-all transform hover:scale-110">
                    <i data-lucide="facebook" class="w-4 h-4"></i>
                </a>
                <a href="https://www.instagram.com/mipuno.pe/" target="_blank" rel="noopener noreferrer"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-pink-600 hover:text-white transition-all transform hover:scale-110">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>
                <a href="https://www.youtube.com/@MiPuno" target="_blank" rel="noopener noreferrer"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-red-600 hover:text-white transition-all transform hover:scale-110">
                    <i data-lucide="youtube" class="w-4 h-4"></i>
                </a>
            </div>
        </div>

        <!-- Developers -->
        <div class="text-center developers-section">
            <h3
                class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300 mb-6 uppercase tracking-wider">
                Desarrolladores</h3>
            <div class="space-y-4 text-xs">
                <!-- Developer 1: Sam Zapana -->
                <div class="bg-gradient-to-br from-slate-800/60 to-slate-900/80 rounded-xl p-4 border border-slate-600/50 hover:border-emerald-400/60 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/20 backdrop-blur-sm">
                    <div class="flex flex-col items-center space-y-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            SZ
                        </div>
                        <div class="text-center">
                            <h4 class="text-white font-bold text-sm mb-1">Sam Zapana</h4>
                            <p class="text-emerald-300 text-xs font-medium mb-3">Full Stack Developer</p>
                        </div>
                        <div class="flex justify-center gap-3">
                            <a href="https://wa.me/51987654321" target="_blank" rel="noopener noreferrer"
                                class="w-8 h-8 rounded-lg bg-green-600 flex items-center justify-center text-white hover:bg-green-500 transition-all transform hover:scale-110 hover:shadow-lg"
                                title="WhatsApp">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                            </a>
                            <a href="https://linkedin.com/in/samzapana" target="_blank" rel="noopener noreferrer"
                                class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white hover:bg-blue-500 transition-all transform hover:scale-110 hover:shadow-lg"
                                title="LinkedIn">
                                <i data-lucide="linkedin" class="w-4 h-4"></i>
                            </a>
                            <a href="https://github.com/samzapana" target="_blank" rel="noopener noreferrer"
                                class="w-8 h-8 rounded-lg bg-gray-700 flex items-center justify-center text-white hover:bg-gray-600 transition-all transform hover:scale-110 hover:shadow-lg"
                                title="GitHub">
                                <i data-lucide="github" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Developer 2: Sebastian Barriga -->
                <div class="bg-gradient-to-br from-slate-800/60 to-slate-900/80 rounded-xl p-4 border border-slate-600/50 hover:border-emerald-400/60 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/20 backdrop-blur-sm">
                    <div class="flex flex-col items-center space-y-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            SB
                        </div>
                        <div class="text-center">
                            <h4 class="text-white font-bold text-sm mb-1">Sebastian Barriga</h4>
                            <p class="text-emerald-300 text-xs font-medium mb-3">Full Stack Developer</p>
                        </div>
                        <div class="flex justify-center gap-3">
                            <a href="https://wa.me/51976543210" target="_blank" rel="noopener noreferrer"
                                class="w-8 h-8 rounded-lg bg-green-600 flex items-center justify-center text-white hover:bg-green-500 transition-all transform hover:scale-110 hover:shadow-lg"
                                title="WhatsApp">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                            </a>
                            <a href="https://linkedin.com/in/sebastianbarriga" target="_blank" rel="noopener noreferrer"
                                class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white hover:bg-blue-500 transition-all transform hover:scale-110 hover:shadow-lg"
                                title="LinkedIn">
                                <i data-lucide="linkedin" class="w-4 h-4"></i>
                            </a>
                            <a href="https://github.com/sebastianbarriga" target="_blank" rel="noopener noreferrer"
                                class="w-8 h-8 rounded-lg bg-gray-700 flex items-center justify-center text-white hover:bg-gray-600 transition-all transform hover:scale-110 hover:shadow-lg"
                                title="GitHub">
                                <i data-lucide="github" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="max-w-6xl mx-auto px-6 pt-6 border-t border-slate-800 text-center">
        <p class="text-slate-600 text-xs">
            &copy; 2026 Candelaria Digital. 
            <span class="text-emerald-400 font-mono text-xs ml-2" title="Footer Version">
                v<?= $footerVersion ?> | Developers: Sam & Sebastian
            </span>
        </p>
    </div>
</footer>

<!-- Initialize Lucide Icons -->
<script>
    // Initialize Lucide icons when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined' && lucide.createIcons) {
            lucide.createIcons();
        }
        
        // Debug footer loading
        console.log('Footer loaded - Version: <?= $footerVersion ?>');
        console.log('Developers: Sam Zapana & Sebastian Barriga only');
        
        // Force refresh if old content detected
        const developerElements = document.querySelectorAll('.developers-section h4');
        developerElements.forEach(el => {
            if (el.textContent.includes('Carlos') || el.textContent.includes('Ana') || el.textContent.includes('Luis')) {
                console.warn('Old developer names detected - forcing page refresh');
                setTimeout(() => location.reload(true), 1000);
            }
        });
    });
</script>

<style>
/* Footer Developers Section Responsive Styles */
@media (max-width: 768px) {
    .developers-section .space-y-4 {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .developers-section .bg-gradient-to-br {
        padding: 1rem;
    }
    
    .developers-section h4 {
        font-size: 0.875rem;
    }
    
    .developers-section p {
        font-size: 0.75rem;
    }
    
    .developers-section .w-12.h-12 {
        width: 2.5rem;
        height: 2.5rem;
        font-size: 0.875rem;
    }
    
    .developers-section .w-8.h-8 {
        width: 1.75rem;
        height: 1.75rem;
    }
    
    .developers-section .gap-3 {
        gap: 0.5rem;
    }
}

@media (max-width: 640px) {
    .developers-section {
        grid-column: 1 / -1;
        margin-top: 1.5rem;
    }
    
    .developers-section .space-y-4 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 1rem;
    }
    
    .developers-section h4 {
        font-size: 0.8rem;
    }
    
    .developers-section p {
        font-size: 0.7rem;
    }
}

@media (max-width: 480px) {
    .developers-section .space-y-4 {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }
    
    .developers-section .bg-gradient-to-br {
        padding: 0.75rem;
    }
    
    .developers-section .w-12.h-12 {
        width: 2.25rem;
        height: 2.25rem;
        font-size: 0.8rem;
    }
    
    .developers-section .w-8.h-8 {
        width: 1.5rem;
        height: 1.5rem;
    }
    
    .developers-section .gap-3 {
        gap: 0.375rem;
    }
}
</style>

<?php 
// Include Auth Modal and JS globally
if (!function_exists('getAuthModalHTML') && file_exists(__DIR__ . '/auth-header.php')) {
    include_once __DIR__ . '/auth-header.php';
}

if (function_exists('getAuthModalHTML')) {
    echo getAuthModalHTML();
}

if (function_exists('getAuthJS')) {
    echo getAuthJS();
}

include __DIR__ . '/grok-chatbot.php'; 
?>