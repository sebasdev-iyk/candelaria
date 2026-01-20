<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Candelaria</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        candelaria: {
                            purple: '#4c1d95',
                            gold: '#fbbf24',
                            lake: '#0ea5e9',
                            light: '#f5f3ff'
                        }
                    },
                    fontFamily: {
                        sans: ['Open Sans', 'sans-serif'],
                        heading: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }

        h1,
        h2,
        h3 {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-gradient-to-r from-candelaria-purple to-purple-800 text-white shadow-lg">
        <div class="max-w-5xl mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">Mi Perfil</h1>
                    <p class="text-purple-200 text-sm">Gestiona tu cuenta y reservaciones</p>
                </div>
                <a href="index.php"
                    class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-full font-bold flex items-center gap-2">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Inicio
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-8">
        <!-- Loading State -->
        <div id="loading-state" class="text-center py-12">
            <i data-lucide="loader-2" class="w-12 h-12 mx-auto animate-spin text-candelaria-purple"></i>
            <p class="mt-4 text-gray-500">Cargando perfil...</p>
        </div>

        <!-- Not Logged In -->
        <div id="not-logged-in" class="hidden text-center py-12">
            <i data-lucide="user-x" class="w-16 h-16 mx-auto text-gray-300 mb-4"></i>
            <h2 class="text-xl font-bold text-gray-700 mb-2">No has iniciado sesión</h2>
            <p class="text-gray-500 mb-4">Inicia sesión para ver tu perfil y reservaciones</p>
            <a href="index.php"
                class="inline-block bg-candelaria-purple text-white px-6 py-3 rounded-xl font-bold hover:bg-purple-800">
                Ir al Inicio
            </a>
        </div>

        <!-- Profile Content -->
        <div id="profile-content" class="hidden">
            <!-- User Info Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <div class="flex items-center gap-4 mb-6">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-candelaria-purple to-purple-600 rounded-full flex items-center justify-center text-white text-3xl font-bold">
                        <span id="user-initial">U</span>
                    </div>
                    <div class="flex-1">
                        <h2 id="user-name" class="text-2xl font-bold text-gray-900"></h2>
                        <p id="user-email" class="text-gray-500"></p>
                    </div>
                    <button onclick="logout()"
                        class="flex items-center gap-2 px-4 py-2 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition-colors font-semibold">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        Cerrar Sesión
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <p class="text-sm text-gray-500 mb-1">Correo Electrónico</p>
                        <p id="info-email" class="font-medium text-gray-800"></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <p class="text-sm text-gray-500 mb-1">Teléfono</p>
                        <p id="info-telefono" class="font-medium text-gray-800"></p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <p class="text-sm text-gray-500 mb-1">Miembro desde</p>
                        <p id="info-fecha" class="font-medium text-gray-800"></p>
                    </div>
                </div>
            </div>

            <!-- Reservations Section -->
            <div id="reservaciones" class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i data-lucide="calendar-check" class="w-6 h-6 text-candelaria-purple"></i>
                    Mis Reservaciones
                </h3>

                <div id="reservations-container">
                    <div class="text-center py-8 text-gray-500">
                        <i data-lucide="loader-2" class="w-8 h-8 mx-auto animate-spin"></i>
                        <p class="mt-2">Cargando reservaciones...</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let currentUser = null;

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            checkAuth();
        });

        function checkAuth() {
            const token = localStorage.getItem('clientToken');
            const userData = localStorage.getItem('clientUser');

            if (token && userData) {
                try {
                    currentUser = JSON.parse(userData);
                    showProfile();
                } catch (e) {
                    showNotLoggedIn();
                }
            } else {
                showNotLoggedIn();
            }
        }

        function showNotLoggedIn() {
            document.getElementById('loading-state').classList.add('hidden');
            document.getElementById('not-logged-in').classList.remove('hidden');
        }

        function logout() {
            localStorage.removeItem('clientToken');
            localStorage.removeItem('clientUser');
            window.location.href = 'index.php';
        }

        function showProfile() {
            document.getElementById('loading-state').classList.add('hidden');
            document.getElementById('profile-content').classList.remove('hidden');

            // Fill user info
            document.getElementById('user-initial').textContent = currentUser.nombre.charAt(0).toUpperCase();
            document.getElementById('user-name').textContent = currentUser.nombre;
            document.getElementById('user-email').textContent = currentUser.email;
            document.getElementById('info-email').textContent = currentUser.email;
            document.getElementById('info-telefono').textContent = currentUser.telefono || 'No registrado';
            document.getElementById('info-fecha').textContent = new Date(currentUser.created_at || Date.now()).toLocaleDateString('es-ES', { year: 'numeric', month: 'long' });

            loadReservations();
            lucide.createIcons();
        }

        async function loadReservations() {
            const token = localStorage.getItem('clientToken');
            const container = document.getElementById('reservations-container');

            try {
                const res = await fetch('api/clientes.php?action=reservaciones', {
                    headers: { 'Authorization': `Bearer ${token}` }
                });

                if (res.ok) {
                    const data = await res.json();
                    renderReservations(data.reservaciones || []);
                } else {
                    container.innerHTML = '<p class="text-center text-red-500 py-4">Error al cargar reservaciones</p>';
                }
            } catch (e) {
                container.innerHTML = '<p class="text-center text-red-500 py-4">Error de conexión</p>';
            }
        }

        function renderReservations(reservations) {
            const container = document.getElementById('reservations-container');

            if (reservations.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8">
                        <i data-lucide="calendar-x" class="w-12 h-12 mx-auto text-gray-300 mb-3"></i>
                        <p class="text-gray-500">No tienes reservaciones aún</p>
                        <a href="servicios/index.php" class="inline-block mt-4 bg-candelaria-purple text-white px-6 py-2 rounded-lg font-bold hover:bg-purple-800">
                            Explorar Hospedajes
                        </a>
                    </div>
                `;
                lucide.createIcons();
                return;
            }

            const estadoColors = {
                'pendiente': 'bg-yellow-100 text-yellow-800 border-yellow-300',
                'confirmada': 'bg-green-100 text-green-800 border-green-300',
                'cancelada': 'bg-red-100 text-red-800 border-red-300',
                'completada': 'bg-blue-100 text-blue-800 border-blue-300'
            };

            const estadoIcons = {
                'pendiente': 'clock',
                'confirmada': 'check-circle',
                'cancelada': 'x-circle',
                'completada': 'check-check'
            };

            container.innerHTML = reservations.map(r => `
                <div class="border rounded-xl p-4 mb-4 ${estadoColors[r.estado]} border">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-bold text-gray-900">${r.hospedaje_nombre || 'Hospedaje'}</h4>
                            <p class="text-sm text-gray-600">${r.habitacion_nombre || 'Habitación'}</p>
                        </div>
                        <div class="flex items-center gap-1 px-3 py-1 rounded-full text-sm font-bold ${estadoColors[r.estado]}">
                            <i data-lucide="${estadoIcons[r.estado]}" class="w-4 h-4"></i>
                            ${r.estado.charAt(0).toUpperCase() + r.estado.slice(1)}
                        </div>
                    </div>
                    <div class="mt-3 grid grid-cols-2 md:grid-cols-4 gap-2 text-sm">
                        <div>
                            <span class="text-gray-500">Check-in:</span>
                            <span class="font-medium">${r.fecha_entrada}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Check-out:</span>
                            <span class="font-medium">${r.fecha_salida}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Huéspedes:</span>
                            <span class="font-medium">${r.num_huespedes}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Total:</span>
                            <span class="font-bold text-candelaria-purple">$${parseFloat(r.precio_total).toFixed(0)}</span>
                        </div>
                    </div>
                    ${r.notas ? `<p class="mt-2 text-sm text-gray-600 italic">"${r.notas}"</p>` : ''}
                </div>
            `).join('');

            lucide.createIcons();
        }
    </script>
</body>

</html>