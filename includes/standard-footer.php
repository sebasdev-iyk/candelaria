<?php
/**
 * Standard Footer Component
 */
$basePath = isset($footerDepth) ? str_repeat('../', $footerDepth) : './';
?>
<footer class="bg-slate-900 border-t border-slate-800 text-white pt-10 pb-6 relative z-10">
    <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

        <!-- Legal & Contact Links -->
        <div class="md:text-left text-center">
            <h3 class="text-sm font-bold text-slate-300 mb-4 uppercase tracking-wider">Enlaces</h3>
            <ul class="space-y-2 text-xs text-slate-400">
                <li><a href="<?= $basePath ?>privacy.php" class="hover:text-yellow-400 transition-colors">Política de
                        Privacidad</a></li>
                <li><a href="<?= $basePath ?>terms.php" class="hover:text-yellow-400 transition-colors">Términos y
                        Condiciones</a></li>
                <li><a href="<?= $basePath ?>contacto.php"
                        class="hover:text-yellow-400 transition-colors font-semibold">Contacto</a></li>
            </ul>
        </div>

        <!-- Social Media (Restored) -->
        <div class="md:text-right text-center flex flex-col md:items-end items-center">
            <h3 class="text-sm font-bold text-slate-300 mb-4 uppercase tracking-wider">Síguenos</h3>
            <div class="flex gap-4">
                <a href="#"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 transition-colors text-white">
                    <i data-lucide="facebook" class="w-4 h-4"></i>
                </a>
                <a href="#"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-pink-600 transition-colors text-white">
                    <i data-lucide="instagram" class="w-4 h-4"></i>
                </a>
                <a href="#"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-red-600 transition-colors text-white">
                    <i data-lucide="youtube" class="w-4 h-4"></i>
                </a>
                <a href="#"
                    class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-black transition-colors text-white">
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