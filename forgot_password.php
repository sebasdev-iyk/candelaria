<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña | Candelaria 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gradient-to-br from-purple-50 to-purple-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="inline-block p-4 bg-purple-100 rounded-full mb-4">
                    <i data-lucide="key" class="w-12 h-12 text-purple-600"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">¿Olvidaste tu contraseña?</h1>
                <p class="text-gray-600 mt-2">No te preocupes, te ayudaremos a recuperarla</p>
            </div>

            <form id="forgot-password-form" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo electrónico</label>
                    <input type="email" id="email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="tu@email.com">
                </div>

                <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-xl font-bold hover:bg-purple-700 transition-colors">
                    Enviar instrucciones
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="index.php" class="text-purple-600 hover:text-purple-700 font-medium text-sm">
                    ← Volver al inicio
                </a>
            </div>

            <!-- Success Message (Hidden) -->
            <div id="success-message" class="hidden mt-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                <p class="text-green-800 text-sm font-medium">✓ Si el email existe, recibirás instrucciones para recuperar tu contraseña</p>
                <div id="debug-link-container" class="mt-2"></div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        document.getElementById('forgot-password-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const email = document.getElementById('email').value.trim();
            const btn = e.target.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.textContent = 'Enviando...';

            try {
                const apiBase = window.location.origin + '/candelaria/api/';
                const response = await fetch(apiBase + 'profile.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'forgot_password', email })
                });

                const data = await response.json();

                if (data.success) {
                    document.getElementById('forgot-password-form').classList.add('hidden');
                    const successMsg = document.getElementById('success-message');
                    successMsg.classList.remove('hidden');

                    // Debug link (remove in production)
                    if (data.debug_link) {
                        document.getElementById('debug-link-container').innerHTML = 
                            `<a href="${data.debug_link}" class="text-blue-600 underline text-xs">Link de recuperación (solo desarrollo)</a>`;
                    }
                } else {
                    alert(data.message || 'Error al procesar la solicitud');
                }
            } catch (error) {
                console.error(error);
                alert('Error de conexión. Intenta de nuevo.');
            } finally {
                btn.disabled = false;
                btn.textContent = 'Enviar instrucciones';
            }
        });
    </script>
</body>
</html>
