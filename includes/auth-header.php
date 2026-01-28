<?php
/**
 * Global Auth Header Component
 * Theme: Light (Clean/Modern)
 */
require_once __DIR__ . '/auth_config.php';

function getAuthModalHTML()
{
    // Client IDs for JS
    $googleClientId = GOOGLE_CLIENT_ID;
    $fbAppId = FB_APP_ID;

    // Base URL for links
    $baseUrl = defined('BASE_URL') ? BASE_URL : '/candelaria/';

    // Check login state to conditionally render Google One Tap
    $canShowGoogleOneTap = !isset($_COOKIE['sb-access-token']) || empty($_COOKIE['sb-access-token']);

    $googleSDKBlock = '';
    if ($canShowGoogleOneTap) {
        $googleSDKBlock = <<<GSDK
    <!-- Legacy Google SDK (fallback) -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <div id="g_id_onload"
         data-client_id="{$googleClientId}"
         data-context="signin"
         data-ux_mode="popup"
         data-callback="handleGoogleCredentialResponse"
         data-auto_select="false">
    </div>
GSDK;
    }

    return <<<HTML
    <!-- Auth Modal (Light Theme) -->
    <div id="auth-modal" class="fixed inset-0 z-[100] hidden transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div id="auth-backdrop" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0" onclick="closeAuthModal()"></div>

        <!-- Modal Panel -->
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div id="auth-panel" class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all opacity-0 scale-95 sm:my-8 sm:w-full sm:max-w-[480px] border border-gray-100">
                    
                    <!-- Close Button -->
                    <button type="button" onclick="closeAuthModal()" class="absolute top-4 right-4 p-2 rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors z-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="px-8 py-10">
                        <!-- Logo / Header -->
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-black font-heading text-gray-900 tracking-tight">Iniciar Sesión</h2>
                            <p class="mt-2 text-sm text-gray-500 font-medium">Accede a contenido exclusivo de Candelaria 2026</p>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="space-y-3">
                            <!-- Google Button -->
                            <button onclick="handleGoogleLogin()" class="relative flex w-full items-center justify-center gap-3 rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm font-bold text-gray-700 shadow-sm hover:bg-gray-50 hover:shadow-md transition-all duration-200">
                                <svg class="h-5 w-5" viewBox="0 0 24 24">
                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                </svg>
                                <span>Continuar con Google</span>
                            </button>

                            <!-- Facebook Button -->
                            <button onclick="handleFacebookLogin()" class="relative flex w-full items-center justify-center gap-3 rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm font-bold text-gray-700 shadow-sm hover:bg-gray-50 hover:shadow-md transition-all duration-200">
                                <svg class="h-5 w-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                <span>Continuar con Facebook</span>
                            </button>
                        </div>

                        <!-- Divider -->
                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="bg-white px-2 text-xs font-semibold uppercase text-gray-400 tracking-wider">O continúa con email</span>
                            </div>
                        </div>

                        <!-- Email Login/Register Toggle -->
                        <div id="email-auth-section">
                            <!-- Login Form (Default) -->
                            <div id="email-login-form-container">
                                <form id="email-login-form" class="space-y-4">
                                    <div>
                                        <label for="email-login-input" class="sr-only">Correo electrónico</label>
                                        <input type="email" id="email-login-input" required class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 text-gray-900 placeholder-gray-400 focus:border-purple-500 focus:ring-purple-500 sm:text-sm" placeholder="Correo electrónico">
                                    </div>
                                    <div>
                                        <label for="email-login-password" class="sr-only">Contraseña</label>
                                        <input type="password" id="email-login-password" required class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 text-gray-900 placeholder-gray-400 focus:border-purple-500 focus:ring-purple-500 sm:text-sm" placeholder="Contraseña">
                                    </div>
                                    <button type="submit" class="w-full rounded-xl bg-candelaria-purple py-3 text-sm font-bold text-white hover:bg-purple-800 transition-colors">
                                        Iniciar Sesión
                                    </button>
                                    <div class="text-center">
                                        <a href="{$baseUrl}forgot_password.php" class="text-xs text-purple-600 hover:text-purple-700 font-medium">¿Olvidaste tu contraseña?</a>
                                    </div>
                                    <p class="text-center text-xs text-gray-500">
                                        ¿No tienes cuenta? <button type="button" onclick="toggleEmailAuth('register')" class="font-bold text-purple-600 hover:text-purple-700">Regístrate aquí</button>
                                    </p>
                                </form>
                            </div>

                            <!-- Register Form (Hidden by default) -->
                            <div id="email-register-form-container" class="hidden">
                                <form id="email-register-form" class="space-y-4">
                                    <div>
                                        <label for="email-register-name" class="sr-only">Nombre completo</label>
                                        <input type="text" id="email-register-name" required class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 text-gray-900 placeholder-gray-400 focus:border-purple-500 focus:ring-purple-500 sm:text-sm" placeholder="Nombre completo">
                                    </div>
                                    <div>
                                        <label for="email-register-input" class="sr-only">Correo electrónico</label>
                                        <input type="email" id="email-register-input" required class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 text-gray-900 placeholder-gray-400 focus:border-purple-500 focus:ring-purple-500 sm:text-sm" placeholder="Correo electrónico">
                                    </div>
                                    <div>
                                        <label for="email-register-password" class="sr-only">Contraseña</label>
                                        <input type="password" id="email-register-password" required class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 text-gray-900 placeholder-gray-400 focus:border-purple-500 focus:ring-purple-500 sm:text-sm" placeholder="Contraseña (mín. 6 caracteres)">
                                    </div>
                                    <button type="submit" class="w-full rounded-xl bg-candelaria-purple py-3 text-sm font-bold text-white hover:bg-purple-800 transition-colors">
                                        Crear Cuenta
                                    </button>
                                    <p class="text-center text-xs text-gray-500">
                                        ¿Ya tienes cuenta? <button type="button" onclick="toggleEmailAuth('login')" class="font-bold text-purple-600 hover:text-purple-700">Inicia sesión</button>
                                    </p>
                                </form>
                            </div>
                        </div>

                        <p class="mt-8 text-center text-xs text-gray-500">
                            Al continuar, aceptas nuestros <a href="{$baseUrl}terms.php" target="_blank" class="font-semibold text-purple-600 hover:text-purple-500">Términos de Servicio</a> y <a href="{$baseUrl}privacy.php" target="_blank" class="font-semibold text-purple-600 hover:text-purple-500">Política de Privacidad</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Simple Toast Notification Container -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-[200] flex flex-col gap-2"></div>

    <!-- Supabase SDK -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script src="/candelaria/assets/js/supabase-core.js?v=<?= time() ?>"></script>

    {$googleSDKBlock}

    <!-- Facebook SDK -->
    <!-- Facebook SDK Removed -->
    HTML;
}

function getAuthButtonHTML()
{
    // --- SERVER-SIDE AUTH CHECK (SSR) ---
    // Read Supabase cookie to determine initial state
    $isLoggedIn = isset($_COOKIE['sb-access-token']) && !empty($_COOKIE['sb-access-token']);

    // CSS classes for visibility
    $loginClass = $isLoggedIn ? 'hidden' : 'flex';
    $loginMobileClass = $isLoggedIn ? 'hidden' : 'flex';
    $profileClass = $isLoggedIn ? 'flex' : 'hidden';

    // Inline styles for display
    $loginStyle = $isLoggedIn ? 'display:none;' : '';
    $profileStyle = $isLoggedIn ? '' : 'display:none;';

    // If logged in, try to get basic info from JWT
    $userName = 'Usuario';
    $userEmail = '';

    if ($isLoggedIn) {
        try {
            $parts = explode('.', $_COOKIE['sb-access-token']);
            if (count($parts) === 3) {
                $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[1])), true);
                if (isset($payload['email']))
                    $userEmail = htmlspecialchars($payload['email']);
                if (isset($payload['user_metadata']['full_name'])) {
                    $userName = htmlspecialchars(explode(' ', $payload['user_metadata']['full_name'])[0]);
                } elseif (isset($payload['user_metadata']['name'])) {
                    $userName = htmlspecialchars(explode(' ', $payload['user_metadata']['name'])[0]);
                } elseif (!empty($userEmail)) {
                    $userName = htmlspecialchars(explode('@', $userEmail)[0]);
                }
            }
        } catch (Exception $e) { /* Ignore parsing errors */
        }
    }

    $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=4c1d95&color=fff';

    return <<<HTML
    <div id="auth-header-container" class="relative" style="view-transition-name: auth-container;">
        <!-- Logged Out State Button -->
        <button id="auth-btn-login" onclick="openAuthModal()" class="{$loginClass} hidden md:flex items-center gap-2 px-5 py-2.5 rounded-full bg-white text-gray-900 font-bold border border-gray-200 hover:bg-gray-50 hover:shadow-md hover:border-purple-200 transition-all duration-300" style="{$loginStyle}">
            <span class="bg-gray-100 p-1 rounded-full"><i data-lucide="user" class="w-4 h-4 text-gray-600"></i></span>
            <span>Ingresar</span>
        </button>

        <!-- Mobile Icon (Only Icon) -->
        <button id="auth-btn-login-mobile" onclick="openAuthModal()" class="md:hidden {$loginMobileClass} flex items-center justify-center w-10 h-10 rounded-full bg-white text-gray-900 border border-gray-200 shadow-md hover:scale-105 transition-transform" style="{$loginStyle}">
            <i data-lucide="user" class="w-5 h-5"></i>
        </button>

        <!-- Logged In State -->
        <div id="auth-user-profile" class="relative group {$profileClass}" style="{$profileStyle}">
            <button class="flex items-center gap-2 focus:outline-none">
                <img id="user-avatar" src="{$avatarUrl}" alt="Profile" class="h-10 w-10 rounded-full border-2 border-white shadow-sm object-cover ring-2 ring-transparent group-hover:ring-purple-500 transition-all" style="view-transition-name: auth-avatar;">
                <div class="hidden md:block text-left">
                    <p id="user-name" class="text-sm font-bold text-white leading-tight">{$userName}</p>
                    <p class="text-[10px] text-purple-200 uppercase font-bold tracking-wider">Miembro</p>
                </div>
            </button>

            <!-- Dropdown Menu -->
            <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50 border border-gray-100">
                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                    <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">Conectado como</p>
                    <p id="dropdown-email" class="text-sm font-medium text-gray-900 truncate">{$userEmail}</p>
                </div>
                <a href="/candelaria/perfil.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                    <i data-lucide="user" class="w-4 h-4 inline-block mr-2"></i> Mi Perfil
                </a>
                <hr class="my-1 border-gray-100">
                <button onclick="handleLogout()" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                    <i data-lucide="log-out" class="w-4 h-4 inline-block mr-2"></i> Cerrar Sesión
                </button>
            </div>
        </div>
    </div>
    HTML;
    HTML;
}

function getAuthJS()
{
    // Fix: Add showToast function and simple close logic
    return <<<SCRIPT
    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QX9MYN69SZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-QX9MYN69SZ');
    </script>

    <script>
    // --- Auth State Management ---
    
    async function initAuth() {
        console.log('[Auth] initAuth called');
        
        // The server (PHP) has already rendered the initial state based on cookies.
        // JS will now "hydrate" the state with fresh data from Supabase/LocalStorage without layout shift.
        
        // Fallback to legacy localStorage if cookie was missing but LS exists
        const cachedUserStr = localStorage.getItem('candelaria_user');
        
        // STEP 1: Fast Client-Side Hydration
        if (cachedUserStr) {
            try {
                const userData = JSON.parse(cachedUserStr);
                // Only update if server didn't already render logged in state
                // Or to update avatar/name with latest cached info
                showLoggedInState(userData); 
            } catch(e) {}
        }
        
        // STEP 2: Verify with Supabase in background (async)
        if (typeof SupabaseCore !== 'undefined') {
            try {
                // getCurrentUser returns { user, error }, not just user
                const result = await SupabaseCore.getCurrentUser();
                const supabaseUser = result.user || result; // Handle both formats
                
                console.log('[Auth] Supabase user result:', supabaseUser);
                
                if (supabaseUser && supabaseUser.id) {
                    const userData = {
                        id: supabaseUser.id,
                        name: supabaseUser.user_metadata?.full_name || supabaseUser.user_metadata?.name || supabaseUser.email?.split('@')[0] || 'Usuario',
                        email: supabaseUser.email || 'Email no disponible',
                        picture: supabaseUser.user_metadata?.avatar_url || supabaseUser.user_metadata?.picture || null,
                        provider: 'supabase'
                    };
                    
                    // Sync to localStorage
                    localStorage.setItem('candelaria_user', JSON.stringify(userData));
                    
                    window.currentUser = userData;
                    showLoggedInState(userData);
                    console.log('[Auth] Supabase session active & synced.', userData.email);
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                    setupEmailAuthForms();
                    return;
                } else {
                    // Supabase says no session
                    // Only clear if we were previously thought to be logged in
                    if (cachedUserStr) {
                        console.log('[Auth] Session invalid/expired - clearing state');
                        // Optional: Don't auto-logout immediately to avoid jarring experience if network blip
                        // But for security, usually we should.
                        // For now, let's keep UI stable if LS exists, assuming offline support or valid token.
                    }
                }
            } catch (e) {
                console.log('[Auth] Error checking Supabase session:', e);
            }
        }
        
        // If we reach here and have no cached user and no supabase user, ensure logged out state is clean
        if (!cachedUserStr && !window.currentUser) {
             // Only force update if PHP rendered logged in state erroneously (rare)
             // showLoggedOutState(); 
        }
        
        // Setup email auth forms
        setupEmailAuthForms();
        
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }

    function showLoggedInState(user) {
        window.currentUser = user; // Ensure global sync
        // console.log('[Auth] Showing logged in state for:', user?.email);
        
        // --- FIX: Remove Google One Tap if present ---
        try {
            if (typeof google !== 'undefined' && google.accounts && google.accounts.id) {
                google.accounts.id.cancel();
            }
            const gId = document.getElementById('g_id_onload');
            if (gId) {
                gId.parentNode.removeChild(gId);
            }
            // Force remove any container Google might have created
            const layers = document.querySelectorAll('[id^="credential_picker_container"]');
            layers.forEach(layer => layer.remove());
        } catch (e) {
            console.log('[Auth] Error clearing Google prompt:', e);
        }
        // ---------------------------------------------
        
        const btnLogin = document.getElementById('auth-btn-login');
        const btnLoginMobile = document.getElementById('auth-btn-login-mobile');
        const profileDiv = document.getElementById('auth-user-profile');

        // HIDE login buttons (safely remove styles)
        if(btnLogin) {
            btnLogin.style.display = 'none';
        }
        if(btnLoginMobile) {
            btnLoginMobile.style.display = 'none';
        }
        
        // SHOW profile section
        if(profileDiv) {
            profileDiv.style.display = ''; // Reset inline style
            profileDiv.classList.remove('hidden');
            
            const avatar = document.getElementById('user-avatar');
            const userName = document.getElementById('user-name');
            const userEmail = document.getElementById('dropdown-email');
            
            if(avatar && user.picture) {
                let picUrl = user.picture;
                // Fix relative paths for local uploads
                if (picUrl && !picUrl.startsWith('http') && !picUrl.startsWith('/')) {
                     picUrl = '/candelaria/' + picUrl; // Prepend base path
                }
                avatar.src = picUrl;
            }
            if(userName && user.name) {
                userName.innerText = user.name.split(' ')[0]; // First name only
            }
            if(userEmail && user.email) {
                userEmail.innerText = user.email;
            }
        }
        
        window.dispatchEvent(new CustomEvent('auth-changed', { detail: user }));
    }

    function showLoggedOutState() {
        // console.log('[Auth] showLoggedOutState called');
        window.currentUser = null; 
        
        const btnLogin = document.getElementById('auth-btn-login');
        const btnLoginMobile = document.getElementById('auth-btn-login-mobile');
        const profileDiv = document.getElementById('auth-user-profile');

        // SHOW login buttons
        if(btnLogin) {
            btnLogin.style.display = ''; // Reset
            // Responsive check is handled by CSS classes (hidden md:flex)
        }
        if(btnLoginMobile) {
            btnLoginMobile.style.display = ''; // Reset
        }
        
        // HIDE profile dropdown
        if(profileDiv) {
            profileDiv.style.display = 'none';
            profileDiv.classList.add('hidden');
        }
        
        window.dispatchEvent(new CustomEvent('auth-changed', { detail: null }));
    }

    // --- Modal Control (ID based for robustness) ---
    window.openAuthModal = function() {
        const modal = document.getElementById('auth-modal');
        const backdrop = document.getElementById('auth-backdrop');
        const panel = document.getElementById('auth-panel');
        
        modal.classList.remove('hidden');
        
        // Small delay to allow display:block to apply before transition
        setTimeout(() => {
            if(backdrop) {
                backdrop.classList.remove('opacity-0');
            }
            if(panel) {
                panel.classList.remove('opacity-0', 'scale-95');
                panel.classList.add('opacity-100', 'scale-100');
            }
        }, 10);
    }

    window.closeAuthModal = function() {
        const modal = document.getElementById('auth-modal');
        const backdrop = document.getElementById('auth-backdrop');
        const panel = document.getElementById('auth-panel');
        
        if(backdrop) backdrop.classList.add('opacity-0');
        if(panel) {
            panel.classList.remove('opacity-100', 'scale-100');
            panel.classList.add('opacity-0', 'scale-95');
        }
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // --- Logout ---
    window.handleLogout = async function() {
        if(confirm('¿Estás seguro de cerrar sesión?')) {
            console.log('[Auth] Starting logout...');
            
            // Clear Supabase session first (priority)
            if (typeof SupabaseCore !== 'undefined') {
                try {
                    await SupabaseCore.signOut();
                    console.log('[Auth] Supabase session cleared');
                } catch (e) {
                    console.error('[Auth] Error clearing Supabase session:', e);
                }
            }
            
            // Clear ALL localStorage items related to auth
            localStorage.removeItem('candelaria_user');
            localStorage.removeItem('clientToken');
            localStorage.removeItem('clientUser');
            
            // Clear Supabase cookies manually as backup
            document.cookie = 'sb-access-token=; path=/; max-age=0';
            document.cookie = 'sb-refresh-token=; path=/; max-age=0';
            
            // Also logout from Google if possible
            if (typeof google !== 'undefined' && google.accounts) {
                google.accounts.id.disableAutoSelect();
            }
            // Logout Facebook
            if (typeof FB !== 'undefined') {
                try { FB.logout(); } catch(e) {}
            }
            
            // Force UI update BEFORE reload
            showLoggedOutState();
            
            showToast('Has cerrado sesión correctamente', 'info');
            
            // Reload page to fully clear state
            setTimeout(() => location.reload(), 800);
        }
    }

    // --- Google Login Handler (Supabase OAuth) ---
    window.handleGoogleLogin = async function() {
        console.log('[Auth] Google login button clicked');
        
        // Use Supabase OAuth for Google login
        if (typeof SupabaseCore !== 'undefined') {
            try {
                showToast('Redirigiendo a Google...', 'info');
                await SupabaseCore.signInWithGoogle();
                // This will redirect to Google OAuth
                return;
            } catch (e) {
                console.error('[Auth] Supabase Google login error:', e);
                showToast('Error al conectar con Google. Intenta de nuevo.', 'error');
            }
        } else {
            console.warn('[Auth] SupabaseCore not loaded, falling back to legacy Google SDK');
            // Fallback to legacy Google SDK
            handleLegacyGoogleLogin();
        }
    }

    // --- Facebook Login Handler (Supabase) ---
    window.handleFacebookLogin = async function() {
        console.log('[Auth] Facebook login button clicked');
        
        if (typeof SupabaseCore !== 'undefined') {
            try {
                showToast('Redirigiendo a Facebook...', 'info');
                await SupabaseCore.signInWithFacebook();
                return;
            } catch (e) {
                console.error('[Auth] Supabase Facebook login error:', e);
                showToast('Error al conectar con Facebook. Intenta de nuevo.', 'error');
            }
        } else {
             showToast('Error: Sistema de autenticación no cargado. Recarga la página.', 'error');
        }
    }
    
    // Legacy Google login (fallback)
    function handleLegacyGoogleLogin() {
        if (typeof google === 'undefined' || !google.accounts) {
            showToast('Cargando Google... Espera un momento y vuelve a intentar.', 'warning');
            setTimeout(() => location.reload(), 2000);
            return;
        }

        try {
            google.accounts.id.initialize({
                client_id: '<?= GOOGLE_CLIENT_ID ?>',
                callback: handleGoogleCredentialResponse,
                auto_select: false
            });

            google.accounts.id.prompt((notification) => {
                if (notification.isNotDisplayed()) {
                    console.log('Google prompt not displayed:', notification.getNotDisplayedReason());
                    
                    const googleBtnContainer = document.createElement('div');
                    googleBtnContainer.id = 'google-signin-btn-temp';
                    googleBtnContainer.style.cssText = 'position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.3);';
                    
                    const closeBtn = document.createElement('button');
                    closeBtn.textContent = '✕';
                    closeBtn.style.cssText = 'position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 20px; cursor: pointer;';
                    closeBtn.onclick = () => document.body.removeChild(googleBtnContainer);
                    
                    googleBtnContainer.appendChild(closeBtn);
                    document.body.appendChild(googleBtnContainer);
                    
                    google.accounts.id.renderButton(googleBtnContainer, {
                        theme: 'outline',
                        size: 'large',
                        text: 'continue_with',
                        shape: 'rectangular'
                    });
                }
            });
        } catch (e) {
            console.error('Google login error:', e);
            showToast('Error al iniciar Google. Revisa tu conexión.', 'error');
        }
    }

    // Callback from Google
    window.handleGoogleCredentialResponse = function(response) {
        // Decode JWT
        const responsePayload = parseJwt(response.credential);
        
        // Save User
        const user = {
            name: responsePayload.name,
            email: responsePayload.email,
            picture: responsePayload.picture,
            provider: 'google'
        };
        
        loginUser(user);
    }

    function parseJwt (token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));

        return JSON.parse(jsonPayload);
    }

    // --- Legacy Facebook Handler Removed ---
    // (Consolidated with Supabase handler above)

    // --- Email Auth Toggle ---
    window.toggleEmailAuth = function(mode) {
        const loginContainer = document.getElementById('email-login-form-container');
        const registerContainer = document.getElementById('email-register-form-container');
        
        if (mode === 'register') {
            loginContainer.classList.add('hidden');
            registerContainer.classList.remove('hidden');
        } else {
            registerContainer.classList.add('hidden');
            loginContainer.classList.remove('hidden');
        }
    }

    // --- Email Login Handler ---
    function setupEmailAuthForms() {
        const loginForm = document.getElementById('email-login-form');
        const registerForm = document.getElementById('email-register-form');

        if (loginForm) {
            loginForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const email = document.getElementById('email-login-input').value.trim();
                const password = document.getElementById('email-login-password').value;

                if (!email || !password) {
                    showToast('Por favor completa todos los campos', 'warning');
                    return;
                }

                if (typeof SupabaseCore === 'undefined') {
                    showToast('Error: Sistema de autenticación no cargado', 'error');
                    return;
                }

                try {
                    // showToast('Iniciando sesión...', 'info');
                    const { data, error } = await SupabaseCore.signInWithEmail(email, password);

                    if (error) throw error;

                    if (data.user) {
                        const user = {
                            id: data.user.id,
                            name: data.user.user_metadata?.full_name || data.user.user_metadata?.name || email.split('@')[0],
                            email: data.user.email,
                            picture: data.user.user_metadata?.avatar_url || null,
                            provider: 'email'
                        };
                        loginUser(user);
                        showToast('¡Bienvenido de nuevo!', 'success');
                    }
                } catch (error) {
                    console.error('Login error:', error);
                    let msg = error.message || 'Error al iniciar sesión.';
                    
                    // Supabase Error Translations
                    if (msg.includes('Invalid login')) msg = 'Correo o contraseña incorrectos.';
                    if (msg.includes('Email not confirmed')) msg = 'Debes confirmar tu correo electrónico primero.';
                    if (msg.includes('rate limit')) msg = 'Demasiados intentos. Espera unos minutos.';

                    showToast(msg, 'error');
                }
            });
        }

        if (registerForm) {
            registerForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const name = document.getElementById('email-register-name').value.trim();
                const email = document.getElementById('email-register-input').value.trim();
                const password = document.getElementById('email-register-password').value;

                if (!name || !email || !password) {
                    showToast('Por favor completa todos los campos', 'warning');
                    return;
                }

                if (password.length < 6) {
                    showToast('La contraseña debe tener al menos 6 caracteres', 'warning');
                    return;
                }

                if (typeof SupabaseCore === 'undefined') {
                    showToast('Error: Sistema de autenticación no cargado', 'error');
                    return;
                }

                try {
                    showToast('Creando cuenta...', 'info');
                    const { data, error } = await SupabaseCore.signUpWithEmail(email, password, { full_name: name });

                    if (error) throw error;

                    // Check for implicit duplicate (Email Enumeration Protection)
                    if (data.user && data.user.identities && data.user.identities.length === 0) {
                        showToast('Este correo ya está registrado. Intenta iniciar sesión.', 'warning');
                        return;
                    }

                    // If email confirmation is enabled, session might be null
                    if (data.user && !data.session) {
                        showToast('Cuenta creada o ya existente. ¡Revisa tu email!', 'success');
                        closeAuthModal();
                    } else if (data.user && data.session) {
                        const user = {
                            id: data.user.id,
                            name: name,
                            email: email,
                            picture: null,
                            provider: 'email'
                        };
                        loginUser(user);
                        showToast('¡Cuenta creada exitosamente!', 'success');
                    }
                } catch (error) {
                    console.error('Register error:', error);
                    let msg = error.message || 'Error al crear cuenta.';
                    
                    // Supabase Error Translations
                    if (msg.includes('already registered')) msg = 'Este correo ya está registrado.';
                    if (msg.includes('is invalid')) msg = 'El formato del correo no es válido.';
                    if (msg.includes('password should be')) msg = 'La contraseña es muy débil.';
                    if (msg.includes('rate limit')) msg = 'Demasiados intentos. Espera unos minutos.';
                    
                    showToast(msg, 'error');
                }
            });
        }
    }

    // --- Global Login Finalizer ---
    async function loginUser(user) {
        console.log('Logging in user:', user);
        
        // 1. Save to Local Storage
        localStorage.setItem('candelaria_user', JSON.stringify(user));
        
        // 2. Feedback (Immediate)
        closeAuthModal();
        showToast('Iniciando sesión...', 'info');

        // 3. Backend Sync (Await this to ensure Session is set before UI components react)
        const apiBase = window.location.origin + '/candelaria/api/';
        try {
            const response = await fetch(apiBase + 'auth.php', { 
                method: 'POST', 
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(user) 
            });
            const data = await response.json();
            console.log('Backend Sync Result:', data);
            
            if (!data.success) {
                console.warn('Backend sync warning:', data);
            }
        } catch (error) {
            console.error('Error syncing session:', error);
            // We proceed anyway so client-side works
        }
        
        // 4. Update UI & Fire Events (Now safe to call Cart Sync)
        showLoggedInState(user);
        
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        showToast('¡Bienvenido ' + user.name.split(' ')[0] + '! Sesión iniciada.', 'success');
    }

    // --- Toast Notification System ---
    window.showToast = function(message, type = 'info') {
        const container = document.getElementById('toast-container');
        if (!container) return; // Should exist in HTML above

        // Colors
        let bgClass = 'bg-gray-800';
        let icon = '<i data-lucide="info" class="w-5 h-5 text-white"></i>';

        if (type === 'success') {
            bgClass = 'bg-green-600';
            icon = '<i data-lucide="check-circle" class="w-5 h-5 text-white"></i>';
        } else if (type === 'error') {
            bgClass = 'bg-red-600';
            icon = '<i data-lucide="alert-circle" class="w-5 h-5 text-white"></i>';
        } else if (type === 'warning') {
            bgClass = 'bg-yellow-600';
            icon = '<i data-lucide="alert-triangle" class="w-5 h-5 text-white"></i>';
        }

        const toast = document.createElement('div');
        toast.className = `flex items-center gap-3 px-6 py-4 rounded-xl shadow-2xl text-white transform transition-all duration-300 translate-y-10 opacity-0 \${bgClass}`;
        toast.innerHTML = `
            \${icon}
            <span class="font-bold text-sm">\${message}</span>
        `;

        container.appendChild(toast);

        // Initialize icons for new element
        if (typeof lucide !== 'undefined') lucide.createIcons();

        // Animate In
        requestAnimationFrame(() => {
            toast.classList.remove('translate-y-10', 'opacity-0');
        });

        // Remove after 3s
        setTimeout(() => {
            toast.classList.add('transform', 'translate-y-10', 'opacity-0');
            setTimeout(() => {
                if(container.contains(toast)) container.removeChild(toast);
            }, 300);
        }, 3000);
    }

    // Auto-init
    document.addEventListener('DOMContentLoaded', initAuth);

    </script>
SCRIPT;
}
?>