<?php
/**
 * Standard Footer Component
 */
$basePath = isset($footerDepth) ? str_repeat('../', $footerDepth) : './';
?>
<footer class="bg-slate-900 border-t border-slate-800 text-white pt-10 pb-6 relative z-10">
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
                class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-purple-200 mb-4 uppercase tracking-wider">
                Desarrolladores</h3>
            <div class="space-y-3 text-xs">
                <!-- Developer 1 -->
                <div class="bg-slate-800/50 rounded-lg p-3 border border-slate-700 hover:border-purple-500 transition-colors">
                    <h4 class="text-white font-semibold mb-2 text-sm">Carlos Mendoza</h4>
                    <p class="text-slate-400 text-xs mb-2">Full Stack Developer</p>
                    <div class="flex justify-center gap-2">
                        <a href="https://wa.me/51987654321" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-green-600 flex items-center justify-center text-white hover:bg-green-500 transition-all transform hover:scale-110"
                            title="WhatsApp">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        </a>
                        <a href="https://linkedin.com/in/carlosmendoza" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-blue-600 flex items-center justify-center text-white hover:bg-blue-500 transition-all transform hover:scale-110"
                            title="LinkedIn">
                            <i data-lucide="linkedin" class="w-3.5 h-3.5"></i>
                        </a>
                        <a href="https://github.com/carlosmendoza" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-gray-700 flex items-center justify-center text-white hover:bg-gray-600 transition-all transform hover:scale-110"
                            title="GitHub">
                            <i data-lucide="github" class="w-3.5 h-3.5"></i>
                        </a>
                        <a href="https://gitlab.com/carlosmendoza" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-orange-600 flex items-center justify-center text-white hover:bg-orange-500 transition-all transform hover:scale-110"
                            title="GitLab">
                            <i data-lucide="git-branch" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>

                <!-- Developer 2 -->
                <div class="bg-slate-800/50 rounded-lg p-3 border border-slate-700 hover:border-purple-500 transition-colors">
                    <h4 class="text-white font-semibold mb-2 text-sm">Ana Rodriguez</h4>
                    <p class="text-slate-400 text-xs mb-2">Frontend Developer</p>
                    <div class="flex justify-center gap-2">
                        <a href="https://wa.me/51976543210" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-green-600 flex items-center justify-center text-white hover:bg-green-500 transition-all transform hover:scale-110"
                            title="WhatsApp">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        </a>
                        <a href="https://linkedin.com/in/anarodriguez" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-blue-600 flex items-center justify-center text-white hover:bg-blue-500 transition-all transform hover:scale-110"
                            title="LinkedIn">
                            <i data-lucide="linkedin" class="w-3.5 h-3.5"></i>
                        </a>
                        <a href="https://github.com/anarodriguez" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-gray-700 flex items-center justify-center text-white hover:bg-gray-600 transition-all transform hover:scale-110"
                            title="GitHub">
                            <i data-lucide="github" class="w-3.5 h-3.5"></i>
                        </a>
                        <a href="https://gitlab.com/anarodriguez" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-orange-600 flex items-center justify-center text-white hover:bg-orange-500 transition-all transform hover:scale-110"
                            title="GitLab">
                            <i data-lucide="git-branch" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>

                <!-- Developer 3 -->
                <div class="bg-slate-800/50 rounded-lg p-3 border border-slate-700 hover:border-purple-500 transition-colors">
                    <h4 class="text-white font-semibold mb-2 text-sm">Luis Quispe</h4>
                    <p class="text-slate-400 text-xs mb-2">Backend Developer</p>
                    <div class="flex justify-center gap-2">
                        <a href="https://wa.me/51965432109" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-green-600 flex items-center justify-center text-white hover:bg-green-500 transition-all transform hover:scale-110"
                            title="WhatsApp">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                        </a>
                        <a href="https://linkedin.com/in/luisquispe" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-blue-600 flex items-center justify-center text-white hover:bg-blue-500 transition-all transform hover:scale-110"
                            title="LinkedIn">
                            <i data-lucide="linkedin" class="w-3.5 h-3.5"></i>
                        </a>
                        <a href="https://github.com/luisquispe" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-gray-700 flex items-center justify-center text-white hover:bg-gray-600 transition-all transform hover:scale-110"
                            title="GitHub">
                            <i data-lucide="github" class="w-3.5 h-3.5"></i>
                        </a>
                        <a href="https://gitlab.com/luisquispe" target="_blank" rel="noopener noreferrer"
                            class="w-7 h-7 rounded-full bg-orange-600 flex items-center justify-center text-white hover:bg-orange-500 transition-all transform hover:scale-110"
                            title="GitLab">
                            <i data-lucide="git-branch" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="max-w-6xl mx-auto px-6 pt-6 border-t border-slate-800 text-center">
        <p class="text-slate-600 text-xs">
            &copy; 2026 Candelaria Digital.
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
    });
</script>

<style>
/* Footer Developers Section Responsive Styles */
@media (max-width: 768px) {
    .developers-section .space-y-3 {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .developers-section .bg-slate-800\/50 {
        padding: 0.75rem;
    }
    
    .developers-section h4 {
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }
    
    .developers-section p {
        font-size: 0.65rem;
        margin-bottom: 0.5rem;
    }
    
    .developers-section .flex.gap-2 {
        gap: 0.375rem;
    }
    
    .developers-section .w-7.h-7 {
        width: 1.5rem;
        height: 1.5rem;
    }
}

@media (max-width: 640px) {
    .developers-section {
        grid-column: 1 / -1;
        margin-top: 1rem;
    }
    
    .developers-section .space-y-3 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 0.75rem;
    }
    
    .developers-section h4 {
        font-size: 0.75rem;
    }
    
    .developers-section p {
        font-size: 0.6rem;
    }
}

@media (max-width: 480px) {
    .developers-section .space-y-3 {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .developers-section .bg-slate-800\/50 {
        padding: 0.5rem;
    }
    
    .developers-section .flex.gap-2 {
        gap: 0.25rem;
    }
    
    .developers-section .w-7.h-7 {
        width: 1.25rem;
        height: 1.25rem;
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