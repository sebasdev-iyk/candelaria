<?php
/**
 * Standard Footer Component
 */
$basePath = isset($footerDepth) ? str_repeat('../', $footerDepth) : './';
?>
<footer class="bg-slate-900 border-t border-slate-800 text-white pt-10 pb-6 relative z-10">
    <div class="max-w-5xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

        <!-- Legal -->
        <div class="md:text-left text-center">
            <h3 class="text-sm font-bold text-slate-300 mb-4 uppercase tracking-wider">Legal</h3>
            <ul class="space-y-2 text-xs text-slate-400">
                <li><a href="<?= $basePath ?>privacy.php" class="hover:text-yellow-400 transition-colors">Política de
                        Privacidad</a></li>
                <li><a href="<?= $basePath ?>terms.php" class="hover:text-yellow-400 transition-colors">Términos y
                        Condiciones</a></li>
            </ul>
        </div>

        <!-- Contact Info (Simplified) -->
        <div class="md:text-right text-center">
            <h3 class="text-sm font-bold text-slate-300 mb-4 uppercase tracking-wider">Contacto</h3>
            <div class="text-xs text-slate-400 space-y-2">
                <p>922191501</p>
                <p>974526627</p>
                <p>antonyzapana550@gmail.com</p>
                <p>p.sebastian.bn@gmail.com</p>
                <p class="mt-2 text-slate-500 italic">Escríbenos para más información.</p>
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