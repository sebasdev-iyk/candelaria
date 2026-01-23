<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña | Candelaria 2026</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gradient-to-br from-purple-50 to-purple-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <div class="inline-block p-4 bg-purple-100 rounded-full mb-4">
                    <i data-lucide="lock" class="w-12 h-12 text-purple-600"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Nueva Contraseña</h1>
                <p class="text-gray-600 mt-2">Ingresa tu nueva contraseña</p>
            </div>

            <form id="reset-password-form" class="space-y-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nueva contraseña</label>
                    <input type="password" id="password" required minlength="6" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Mínimo 6 caracteres">
                </div>

                <div>
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-2">Confirmar contraseña</label>
                    <input type="password" id="confirm-password" required minlength="6" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Repite la contraseña">
                </div>

                <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-xl font-bold hover:bg-purple-700 transition-colors">
                    Restablecer contraseña
                </button>
            </form>

            <div id="success-message" class="hidden mt-6 p-4 bg-green-50 border border-green-200 rounded-xl text-center">
                <p class="text-green-800 font-medium mb-3">✓ Contraseña actualizada correctamente</p>
                <a href="index.php" class="inline-block bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700">
                    Ir al inicio
                </a>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token');

        if (!token) {
            alert('Token inválido');
            window.location.href = 'index.php';
        }

        document.getElementById('reset-password-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (password !== confirmPassword) {
                alert('Las contraseñas no coinciden');
                return;
            }

            const btn = e.target.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.textContent = 'Procesando...';

            try {
                const apiBase = window.location.origin + '/candelaria/api/';
                const response = await fetch(apiBase + 'profile.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'reset_password', token, password })
                });

                const data = await response.json();

                if (data.success) {
                    document.getElementById('reset-password-form').classList.add('hidden');
                    document.getElementById('success-message').classList.remove('hidden');
                } else {
                    alert(data.message || 'Error al restablecer contraseña');
                    btn.disabled = false;
                    btn.textContent = 'Restablecer contraseña';
                }
            } catch (error) {
                console.error(error);
                alert('Error de conexión. Intenta de nuevo.');
                btn.disabled = false;
                btn.textContent = 'Restablecer contraseña';
            }
        });
    </script>
</body>
</html>
