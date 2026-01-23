<?php
/**
 * Standard Footer Component
 */
$basePath = isset($footerDepth) ? str_repeat('../', $footerDepth) : './';
?>
<footer class="bg-slate-900 border-t border-slate-800 text-white pt-16 pb-8 relative z-10">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
        <!-- Brand -->
        <div class="col-span-1 md:col-span-1">
            <div class="flex items-center gap-3 mb-4">
                <img src="<?= $basePath ?>principal/logoc.png" alt="Logo" class="h-12 w-auto object-contain">
            </div>
            <p class="text-slate-400 text-sm leading-relaxed">
                La festividad más grande del Perú. Celebrando la fe, cultura y tradición de Puno para el mundo.
            </p>
        </div>

        <!-- Navigation -->
        <div>
            <h3 class="text-lg font-bold text-white mb-6 border-b border-yellow-500 inline-block pb-1">Explorar</h3>
            <ul class="space-y-3 text-sm text-slate-400">
                <li><a href="<?= $basePath ?>index.php" class="hover:text-yellow-400 transition-colors">Inicio</a></li>
                <li><a href="<?= $basePath ?>noticias/index.php"
                        class="hover:text-yellow-400 transition-colors">Noticias</a></li>
                <li><a href="<?= $basePath ?>servicios/index.php"
                        class="hover:text-yellow-400 transition-colors">Servicios</a></li>
                <li><a href="<?= $basePath ?>horarios_y_danzas/index.php"
                        class="hover:text-yellow-400 transition-colors">Horarios</a></li>
            </ul>
        </div>

        <!-- Contact Info (Merged) -->
        <div>
            <h3 class="text-lg font-bold text-white mb-6 border-b border-yellow-500 inline-block pb-1">Contacto</h3>
            <ul class="space-y-3 text-sm text-slate-400">
                <li class="flex items-start gap-3">
                    <i data-lucide="phone" class="w-4 h-4 text-yellow-500 mt-1"></i>
                    <div class="flex flex-col">
                        <span>922191501</span>
                        <span class="text-xs text-slate-500">antonyzapana550@gmail.com</span>
                    </div>
                </li>
                <li class="flex items-start gap-3">
                    <i data-lucide="phone" class="w-4 h-4 text-yellow-500 mt-1"></i>
                    <div class="flex flex-col">
                        <span>974526627</span>
                        <span class="text-xs text-slate-500">p.sebastian.bn@gmail.com</span>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Social -->
        <div>
            <h3 class="text-lg font-bold text-white mb-6 border-b border-yellow-500 inline-block pb-1">Síguenos</h3>
            <div class="flex gap-4">
                <a href="#"
                    class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 transition-colors text-white">
                    <i data-lucide="facebook" class="w-5 h-5"></i>
                </a>
                <a href="#"
                    class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-pink-600 transition-colors text-white">
                    <i data-lucide="instagram" class="w-5 h-5"></i>
                </a>
                <a href="#"
                    class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-red-600 transition-colors text-white">
                    <i data-lucide="youtube" class="w-5 h-5"></i>
                </a>
            </div>
        </div>

        <!-- Legal -->
        <div>
            <h3 class="text-lg font-bold text-white mb-6 border-b border-yellow-500 inline-block pb-1">Legal</h3>
            <ul class="space-y-3 text-sm text-slate-400">
                <li><a href="<?= $basePath ?>privacy.php" class="hover:text-yellow-400 transition-colors">Política de
                        Privacidad</a></li>
                <li><a href="<?= $basePath ?>terms.php" class="hover:text-yellow-400 transition-colors">Términos y
                        Condiciones</a></li>
                <li><a href="<?= $basePath ?>delete-data.php"
                        class="hover:text-red-400 transition-colors flex items-center gap-2"><i data-lucide="trash-2"
                            class="w-3 h-3"></i> Eliminar Mis Datos</a></li>
            </ul>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-slate-800 text-center">
        <p class="text-slate-500 text-sm">
            &copy; 2026 Candelaria Digital. Hecho con <i data-lucide="heart"
                class="w-3 h-3 inline text-red-500 fill-current"></i> en Puno.
        </p>
    </div>
</footer>

<?php include __DIR__ . '/grok-chatbot.php'; ?>