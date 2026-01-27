<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil | Candelaria 2026</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&family=Manrope:wght@200..800&display=swap"
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
                            light: '#f5f3ff',
                            primary: '#ec1325',
                            'background-light': '#f8f6f6',
                            'surface-light': '#ffffff'
                        }
                    },
                    fontFamily: {
                        sans: ['Open Sans', 'sans-serif'],
                        heading: ['Montserrat', 'sans-serif'],
                        display: ['Manrope', 'sans-serif'],
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
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Montserrat', sans-serif;
        }

        /* Header Manta Premium Style - Lliclla Pattern */
        .header-manta-premium {
            height: 140px;
            background-image: linear-gradient(rgba(45, 10, 80, 0.45), rgba(15, 5, 30, 0.65)), url('principal/headerfondo2.jpg');
            background-size: auto 100%;
            background-repeat: repeat-x;
            background-position: center;
            position: relative;
            border-bottom: 3px solid #fbbf24;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .header-manta-premium::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, transparent 30%, rgba(0, 0, 0, 0.2) 100%);
            pointer-events: none;
        }

        .header-manta-premium>div {
            position: relative;
            z-index: 2;
        }
    </style>

    <!-- Spark Effect CSS -->
    <link rel="stylesheet" href="assets/css/sparks.css">
</head>

<body class="bg-gray-50">
    <?php include 'includes/auth-header.php'; ?>

    <!-- Header Section -->
    <header class="header-manta-premium text-white shadow-lg sticky top-0 z-40">
        <div class="w-full px-6 md:px-12 h-20 md:h-22 flex items-center">
            <div class="flex justify-between items-center w-full h-full">
                <a href="index.php" class="flex items-center cursor-pointer group h-full relative spark-container">
                    <img src="principal/logoc.png" alt="Candelaria"
                        class="h-full w-auto object-contain transition-transform duration-300 group-hover:scale-105 relative z-10">
                </a>
                <div class="flex items-center gap-6">
                    <nav class="hidden md:flex items-center gap-2">
                        <a href="servicios/index.php" class="nav-link-custom">Servicios</a>
                        <a href="cultura/cultura.php" class="nav-link-custom">Cultura</a>
                        <a href="horarios_y_danzas/index.php" class="nav-link-custom">Festividad</a>
                        <a href="noticias/index.php" class="nav-link-custom">Noticias</a>
                    </nav>
                    <?= getAuthButtonHTML() ?>
                    <a href="live-platform/index.php" class="btn-live group !p-2.5 md:!px-6 md:!py-2.5">
                        <div class="live-dot"></div>
                        <span class="tracking-wider hidden md:inline">EN TIEMPO REAL</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Profile Header -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-candelaria-purple to-purple-800 h-32"></div>
            <div class="px-8 pb-8">
                <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-16 sm:-mt-12">
                    <div class="relative group">
                        <img id="profile-avatar" src="" alt="Avatar"
                            class="w-32 h-32 rounded-full border-4 border-white shadow-xl object-cover bg-white">
                    </div>

                    <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left flex-grow">
                        <h1 id="profile-name" class="text-3xl font-bold text-gray-900">Cargando...</h1>
                        <p id="profile-email" class="text-gray-600 mt-1">email@ejemplo.com</p>
                        <div class="flex flex-col sm:flex-row items-center gap-4 mt-3">
                            <div class="flex items-center gap-2">
                                <span id="profile-provider-badge"
                                    class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full uppercase">
                                    Email
                                </span>
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full uppercase">
                                    Miembro
                                </span>
                            </div>
                            <!-- Edit Button -->
                            <button onclick="openEditProfileModal()"
                                class="flex items-center gap-2 px-4 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold rounded-full transition-colors">
                                <i data-lucide="edit-2" class="w-3 h-3"></i> Editar Perfil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Details -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <i data-lucide="user" class="w-6 h-6 text-candelaria-purple"></i>
                Información de la Cuenta
            </h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Nombre completo</span>
                    <span id="detail-name" class="text-gray-900 font-bold">-</span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Correo electrónico</span>
                    <span id="detail-email" class="text-gray-900 font-bold">-</span>
                </div>
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="text-gray-600 font-medium">Método de inicio de sesión</span>
                    <span id="detail-provider" class="text-gray-900 font-bold">-</span>
                </div>
                <div class="flex items-center justify-between py-3">
                    <span class="text-gray-600 font-medium">Miembro desde</span>
                    <span id="detail-joined" class="text-gray-900 font-bold">Hoy</span>
                </div>
            </div>
        </div>

        <!-- Reservations Section -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <i data-lucide="ticket" class="w-6 h-6 text-candelaria-purple"></i>
                Mis Reservaciones
            </h2>
            <div id="reservations-loading" class="text-center py-8">
                <i data-lucide="loader" class="w-8 h-8 animate-spin mx-auto text-purple-600"></i>
                <p class="mt-2 text-gray-500">Cargando reservaciones...</p>
            </div>
            <div id="reservations-list" class="space-y-4">
                <!-- Injected via JS -->
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <i data-lucide="zap" class="w-6 h-6 text-candelaria-gold"></i>
                Acciones Rápidas
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="horarios_y_danzas/index.php"
                    class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all group">
                    <div class="p-3 bg-purple-100 rounded-lg group-hover:bg-purple-200 transition-colors">
                        <i data-lucide="calendar" class="w-6 h-6 text-candelaria-purple"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Ver Horarios</h3>
                        <p class="text-sm text-gray-600">Programación completa</p>
                    </div>
                </a>
                <a href="live-platform/index.php"
                    class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-red-300 hover:bg-red-50 transition-all group">
                    <div class="p-3 bg-red-100 rounded-lg group-hover:bg-red-200 transition-colors">
                        <i data-lucide="video" class="w-6 h-6 text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">En Vivo</h3>
                        <p class="text-sm text-gray-600">Transmisiones en directo</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="mt-8 text-center">
            <button onclick="handleLogout()"
                class="px-8 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-colors shadow-lg hover:shadow-xl">
                <i data-lucide="log-out" class="w-5 h-5 inline-block mr-2"></i>
                Cerrar Sesión
            </button>
        </div>
    </main>

    <!-- Footer -->
    <?php
    $footerDepth = 0;
    include 'includes/standard-footer.php';
    ?>

    <!-- Auth Modal -->
    <?= getAuthModalHTML() ?>

    <!-- Edit Profile Modal -->
    <div id="edit-profile-modal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" onclick="closeEditProfileModal()">
        </div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all w-full max-w-md border border-gray-100">
                    <div class="px-6 py-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900">Editar Perfil</h3>
                        <button onclick="closeEditProfileModal()"
                            class="text-gray-400 hover:text-gray-600 rounded-full p-1 hover:bg-gray-100">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <form id="edit-profile-form" class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Nombre Completo</label>
                            <input type="text" id="edit-name" required
                                class="w-full rounded-xl border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-purple-500 focus:ring-purple-500 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Foto de Perfil</label>
                            <div class="flex flex-col gap-2">
                                <input type="file" id="upload-picture"
                                    accept="image/jpeg,image/png,image/webp,image/gif"
                                    class="w-full rounded-xl border border-gray-300 bg-gray-50 p-2 text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                <p class="text-xs text-gray-500">Máximo 5MB (JPG, PNG)</p>
                            </div>
                        </div>

                        <div class="pt-4 flex gap-3">
                            <button type="button" onclick="closeEditProfileModal()"
                                class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="flex-1 px-4 py-2 bg-candelaria-purple text-white font-bold rounded-xl hover:bg-purple-800 shadow-md hover:shadow-lg transition-all">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Auth JS -->
    <?= getAuthJS() ?>

    <!-- Spark Effect -->
    <script src="assets/js/spark-effect.js"></script>

    <!-- Profile Page Logic -->
    <script>
        // Load user data
        async function loadUserProfile() {
            let user = null;

            // 1. Try Supabase Core first (Async)
            if (typeof SupabaseCore !== 'undefined') {
                try {
                    const { user: sbUser } = await SupabaseCore.getCurrentUser();
                    if (sbUser) {
                        user = {
                            name: sbUser.user_metadata?.full_name || sbUser.user_metadata?.name || sbUser.email?.split('@')[0] || 'Usuario',
                            email: sbUser.email,
                            picture: sbUser.user_metadata?.avatar_url || sbUser.user_metadata?.picture,
                            provider: 'supabase' // Generic for now, or derive from metadata
                        };
                        // Derive provider more accurately
                        // Check identities array to see connected providers
                        const identities = sbUser.identities || [];
                        const providers = identities.map(i => i.provider);

                        if (providers.includes('facebook')) user.provider = 'facebook';
                        // If logged in via Google recently or usually
                        if (sbUser.app_metadata?.provider === 'google') user.provider = 'google';

                        // If multiple, maybe show primary or last
                        console.log('[Profile] Providers:', providers);

                        // Sync to LS just in case
                        localStorage.setItem('candelaria_user', JSON.stringify(user));
                    }
                } catch (e) {
                    console.log('Supabase check failed in profile:', e);
                }
            }

            // 2. Fallback to LocalStorage
            if (!user) {
                const userDataStr = localStorage.getItem('candelaria_user');
                if (userDataStr) {
                    try {
                        user = JSON.parse(userDataStr);
                    } catch (e) {
                        console.error('Error parsing local user data:', e);
                    }
                }
            }

            // 3. Final Decision
            if (!user) {
                console.warn('No user found. Redirecting...');
                // Not logged in, redirect to home
                window.location.href = 'index.php';
                return;
            }

            try {
                // Update profile UI
                const avatarEl = document.getElementById('profile-avatar');
                if (avatarEl) avatarEl.src = user.picture || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(user.name);

                document.getElementById('profile-name').textContent = user.name;
                document.getElementById('profile-email').textContent = user.email || 'Email no disponible';

                document.getElementById('detail-name').textContent = user.name;
                document.getElementById('detail-email').textContent = user.email || 'No disponible';

                // Provider badge
                const providerBadge = document.getElementById('profile-provider-badge');
                const providerDetail = document.getElementById('detail-provider');

                if (user.provider === 'google') {
                    providerBadge.textContent = 'Google';
                    providerBadge.className = 'px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full uppercase';
                    providerDetail.textContent = 'Google';
                } else if (user.provider === 'facebook') {
                    providerBadge.textContent = 'Facebook';
                    providerBadge.className = 'px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full uppercase';
                    providerDetail.textContent = 'Facebook';
                } else {
                    providerBadge.textContent = 'Email';
                    providerBadge.className = 'px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full uppercase';
                    providerDetail.textContent = 'Email/Contraseña';
                }

                loadReservations();

            } catch (e) {
                console.error('Error updating profile UI:', e);
            }
        }

        async function loadReservations() {
            const list = document.getElementById('reservations-list');
            const loading = document.getElementById('reservations-loading');

            try {
                // Get token from cookie (SupabaseCore sets it)
                const token = document.cookie.match(new RegExp('(^| )sb-access-token=([^;]+)'))?.[2];

                if (!token) {
                    loading.innerHTML = '<p class="text-gray-500">Inicia sesión nuevamente para ver tus reservas.</p>';
                    return;
                }

                const res = await fetch('api/mis-reservas.php', {
                    headers: { 'Authorization': 'Bearer ' + token }
                });

                if (!res.ok) throw new Error('Error fetching');

                const reservations = await res.json();

                loading.classList.add('hidden');

                if (reservations.length === 0) {
                    list.innerHTML = `
                        <div class="text-center py-6 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                            <i data-lucide="calendar-x" class="w-10 h-10 text-gray-300 mx-auto mb-2"></i>
                            <p class="text-gray-500">No tienes reservaciones activas</p>
                            <a href="servicios/index.php" class="mt-4 inline-block text-candelaria-purple font-bold hover:underline">Explorar Hospedajes</a>
                        </div>
                    `;
                    lucide.createIcons();
                    return;
                }

                list.innerHTML = reservations.map(r => `
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 flex flex-col md:flex-row gap-4 items-start md:items-center">
                        <div class="flex-grow">
                            <h4 class="font-bold text-gray-900">${r.hospedaje_nombre}</h4>
                            <p class="text-sm text-gray-600">${r.habitacion_nombre} • ${r.num_huespedes} Huéspedes</p>
                            <div class="text-xs text-gray-500 mt-1">
                                <i data-lucide="calendar" class="w-3 h-3 inline mr-1"></i>
                                ${r.fecha_entrada} - ${r.fecha_salida}
                            </div>
                        </div>
                        <div class="text-right w-full md:w-auto flex flex-row md:flex-col justify-between items-center md:items-end">
                            <span class="block font-bold text-lg text-candelaria-purple">$${r.precio_total}</span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase ${getStatusColor(r.estado)}">
                                ${r.estado}
                            </span>
                        </div>
                    </div>
                `).join('');

                lucide.createIcons();

            } catch (e) {
                console.error(e);
                loading.innerHTML = '<p class="text-red-500">Error al cargar reservaciones.</p>';
            }
        }

        function getStatusColor(status) {
            const colors = {
                'pendiente': 'bg-yellow-100 text-yellow-800',
                'confirmada': 'bg-green-100 text-green-800',
                'cancelada': 'bg-red-100 text-red-800',
                'completada': 'bg-blue-100 text-blue-800'
            };
            return colors[status] || 'bg-gray-100 text-gray-800';
        }

        // --- Edit Profile Logic ---
        function openEditProfileModal() {
            const modal = document.getElementById('edit-profile-modal');
            const currentUser = window.currentUser || JSON.parse(localStorage.getItem('candelaria_user'));

            if (currentUser) {
                document.getElementById('edit-name').value = currentUser.name || '';
                // Clear file input
                const fileIn = document.getElementById('upload-picture');
                if (fileIn) fileIn.value = '';
            }

            modal.classList.remove('hidden');
            lucide.createIcons();
        }

        function closeEditProfileModal() {
            document.getElementById('edit-profile-modal').classList.add('hidden');
        }

        document.getElementById('edit-profile-form').addEventListener('submit', async (e) => {
            e.preventDefault();

            const name = document.getElementById('edit-name').value.trim();
            const btn = e.target.querySelector('button[type="submit"]');

            if (!name) return showToast('El nombre es obligatorio', 'warning');

            // UI Loading
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i data-lucide="loader" class="w-4 h-4 animate-spin inline mr-2"></i> Guardando...';
            btn.disabled = true;
            lucide.createIcons();
            
            try {
                if (typeof SupabaseCore === 'undefined') throw new Error('Supabase no cargado');
                
                let pictureUrl = null;
                const fileInput = document.getElementById('upload-picture');

                // 1. Upload Image (if selected)
                if (fileInput && fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const formData = new FormData();
                    formData.append('image', file);
                    
                    const token = SupabaseCore.getAccessToken(); // Use cookie
                    
                    const uploadRes = await fetch('api/upload_profile_image.php', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        body: formData
                    });
                    
                    if (!uploadRes.ok) {
                         const errJson = await uploadRes.json().catch(()=>({}));
                         throw new Error(errJson.message || 'Error al subir imagen');
                    }
                    
                    const uploadData = await uploadRes.json();
                    if (uploadData.success && uploadData.url) {
                        pictureUrl = uploadData.url;
                    } else {
                        throw new Error(uploadData.message || 'Error desconocido al subir');
                    }
                }

                // 2. Update Profile
                const updates = { name: name };
                if (pictureUrl) updates.picture = pictureUrl;

                const { error } = await SupabaseCore.updateUser(updates);

                if (error) throw error;

                showToast('Perfil actualizado correctamente', 'success');
                closeEditProfileModal();

                // Reload UI immediately without refresh
                loadUserProfile();

                // Update header too if possible
                if (window.showLoggedInState && window.currentUser) {
                    window.currentUser.name = name;
                    if(pictureUrl) window.currentUser.picture = pictureUrl;
                    window.showLoggedInState(window.currentUser);
                }

            } catch (e) {
                console.error(e);
                showToast(e.message || 'Error al actualizar perfil', 'error');
            } finally {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });

        // confirmLogout removed - using global handleLogout from auth-header.php

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function () {
            loadUserProfile();
            lucide.createIcons();
        });
    </script>

    <style>
        .btn-live {
            position: relative;
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 10px 24px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            overflow: hidden;
            animation: pulseLive 2s infinite;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .live-dot {
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            animation: blinkDot 1s infinite;
        }

        @keyframes blinkDot {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        @keyframes pulseLive {

            0%,
            100% {
                box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
            }

            50% {
                box-shadow: 0 4px 25px rgba(220, 38, 38, 0.7), 0 0 30px rgba(220, 38, 38, 0.4);
            }
        }

        .nav-link-custom {
            color: #e9d5ff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 16px;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link-custom:hover {
            color: #fbbf24;
        }
    </style>
</body>

</html>