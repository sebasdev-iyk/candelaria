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
            </ul>
        </div>

        <!-- Contact Link -->
        <div class="text-center">
            <h3
                class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300 mb-4 uppercase tracking-wider">
                Contacto</h3>
            <ul class="space-y-2 text-xs text-slate-400">
                <li>
                    <a href="<?= $basePath ?>contacto.php"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-800 hover:bg-slate-700 text-blue-400 hover:text-blue-300 transition-all font-semibold group">
                        <i data-lucide="mail" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                        Contáctanos
                    </a>
                </li>
            </ul>
        </div>

        <!-- Social Media -->
        <div class="text-center">
            <h3
                class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-500 mb-4 uppercase tracking-wider">
                Síguenos</h3>
            <div class="flex justify-center gap-4">
                <a href="#"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-blue-500 hover:bg-blue-600 hover:text-white transition-all transform hover:scale-110">
                    <i data-lucide="facebook" class="w-4 h-4"></i>
                </a>
                <a href="#"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-pink-500 hover:bg-pink-600 hover:text-white transition-all transform hover:scale-110">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>
                <a href="#"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-red-500 hover:bg-red-600 hover:text-white transition-all transform hover:scale-110">
                    <i data-lucide="youtube" class="w-4 h-4"></i>
                </a>
                <a href="#"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-white hover:bg-white hover:text-black transition-all transform hover:scale-110">
                    <i data-lucide="tiktok" class="w-4 h-4"></i>
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

<?php include __DIR__ . '/grok-chatbot.php'; ?>