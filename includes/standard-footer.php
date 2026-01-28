<?php
/**
 * Standard Footer Component
 */
$basePath = isset($footerDepth) ? str_repeat('../', $footerDepth) : './';
?>
<footer class="bg-slate-900 border-t border-slate-800 text-white pt-10 pb-6 relative z-10">
    <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">

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

    </div>

    <div class="max-w-5xl mx-auto px-6 pt-6 border-t border-slate-800 text-center">
        <p class="text-slate-600 text-xs">
            &copy; 2026 Candelaria Digital.
        </p>
    </div>
</footer>

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