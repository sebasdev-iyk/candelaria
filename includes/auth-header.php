<?php
/**
 * Global Auth Header Component
 * Include this in all pages that need user authentication UI
 * 
 * Usage: 
 * 1. Include this file in your PHP page
 * 2. Call renderAuthHeader() where you want the button
 * 3. Include the modal HTML before </body>
 * 4. Include the JS at the end
 */

function getAuthModalHTML()
{
    return <<<HTML
    <!-- Auth Modal -->
    <div id="auth-modal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm" onclick="closeAuthModal()"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
                    <button onclick="closeAuthModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                    
                    <!-- Login Tab -->
                    <div id="auth-login-tab">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Iniciar Sesión</h2>
                        <form id="auth-login-form" class="space-y-4">
                            <input type="email" id="auth-login-email" placeholder="Correo electrónico" required 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                            <input type="password" id="auth-login-password" placeholder="Contraseña" required 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                            <button type="submit" class="w-full bg-purple-700 text-white py-3 rounded-xl font-bold hover:bg-purple-800">
                                Iniciar Sesión
                            </button>
                        </form>
                        <p class="text-center mt-4 text-sm text-gray-600">
                            ¿No tienes cuenta? <button onclick="switchAuthTab('register')" class="text-purple-700 font-bold">Registrarse</button>
                        </p>
                    </div>
                    
                    <!-- Register Tab -->
                    <div id="auth-register-tab" class="hidden">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Crear Cuenta</h2>
                        <form id="auth-register-form" class="space-y-4">
                            <input type="text" id="auth-reg-nombre" placeholder="Nombre completo" required 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                            <input type="email" id="auth-reg-email" placeholder="Correo electrónico" required 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                            <input type="tel" id="auth-reg-telefono" placeholder="Teléfono" required 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                            <input type="password" id="auth-reg-password" placeholder="Contraseña" required 
                                class="w-full p-3 rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500">
                            <button type="submit" class="w-full bg-purple-700 text-white py-3 rounded-xl font-bold hover:bg-purple-800">
                                Crear Cuenta
                            </button>
                        </form>
                        <p class="text-center mt-4 text-sm text-gray-600">
                            ¿Ya tienes cuenta? <button onclick="switchAuthTab('login')" class="text-purple-700 font-bold">Iniciar Sesión</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- User Dropdown (when logged in) -->
    <div id="user-dropdown" class="fixed top-16 right-4 bg-white rounded-xl shadow-xl border border-gray-200 w-64 z-50 hidden">
        <div class="p-4 border-b border-gray-100">
            <p class="font-bold text-gray-900" id="dropdown-user-name"></p>
            <p class="text-sm text-gray-500" id="dropdown-user-email"></p>
        </div>
        <div class="p-2">
            <a href="#" onclick="navigateToProfile(); return false;" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-purple-50 text-gray-700">
                <i data-lucide="user" class="w-5 h-5"></i>
                Mi Perfil
            </a>
            <button onclick="authLogout()" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-red-50 text-red-600">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                Cerrar Sesión
            </button>
        </div>
    </div>
HTML;
}

function getAuthButtonHTML()
{
    return <<<HTML
    <button id="auth-user-btn" onclick="toggleAuthDropdown()" class="btn-profile" style="width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #475569, #1e293b); display: flex; align-items: center; justify-content: center; color: #fbbf24; font-size: 1.2rem; border: 2px solid rgba(251, 191, 36, 0.3); transition: all 0.3s ease; cursor: pointer;" title="Mi Cuenta">
        <i data-lucide="user" class="w-5 h-5"></i>
    </button>
HTML;
}

function getAuthJS($apiBasePath = '')
{
    return <<<SCRIPT
    <script>
    // Auth State
    let currentUser = null;
    const API_BASE = '{$apiBasePath}';
    
    // Initialize auth on page load
    document.addEventListener('DOMContentLoaded', function() {
        initAuth();
    });
    
    function initAuth() {
        const token = localStorage.getItem('clientToken');
        const userData = localStorage.getItem('clientUser');
        
        if (token && userData) {
            try {
                currentUser = JSON.parse(userData);
                updateAuthUI();
            } catch (e) {
                authLogout();
            }
        }
        
        setupAuthForms();
    }
    
    function updateAuthUI() {
        const btn = document.getElementById('auth-user-btn');
        const dropdownName = document.getElementById('dropdown-user-name');
        const dropdownEmail = document.getElementById('dropdown-user-email');
        
        if (currentUser) {
            // Logged in: golden border
            if (btn) {
                btn.style.borderColor = '#fbbf24';
                btn.style.boxShadow = '0 0 15px rgba(251, 191, 36, 0.3)';
            }
            if (dropdownName) dropdownName.textContent = currentUser.nombre;
            if (dropdownEmail) dropdownEmail.textContent = currentUser.email;
        } else {
            // Not logged in: subtle border
            if (btn) {
                btn.style.borderColor = 'rgba(251, 191, 36, 0.3)';
                btn.style.boxShadow = 'none';
            }
        }
        
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }
    
    function toggleAuthDropdown() {
        if (currentUser) {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.classList.toggle('hidden');
        } else {
            openAuthModal();
        }
    }
    
    function openAuthModal() {
        document.getElementById('auth-modal').classList.remove('hidden');
        switchAuthTab('login');
        if (typeof lucide !== 'undefined') lucide.createIcons();
    }
    
    function closeAuthModal() {
        document.getElementById('auth-modal').classList.add('hidden');
    }
    
    function switchAuthTab(tab) {
        document.getElementById('auth-login-tab').classList.toggle('hidden', tab !== 'login');
        document.getElementById('auth-register-tab').classList.toggle('hidden', tab !== 'register');
    }
    
    function setupAuthForms() {
        const loginForm = document.getElementById('auth-login-form');
        const registerForm = document.getElementById('auth-register-form');
        
        if (loginForm) {
            loginForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const email = document.getElementById('auth-login-email').value;
                const password = document.getElementById('auth-login-password').value;
                
                try {
                    const res = await fetch(API_BASE + 'api/clientes.php?action=login', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ email, password })
                    });
                    const data = await res.json();
                    
                    if (res.ok && data.token) {
                        localStorage.setItem('clientToken', data.token);
                        localStorage.setItem('clientUser', JSON.stringify(data.cliente));
                        currentUser = data.cliente;
                        updateAuthUI();
                        closeAuthModal();
                        if (typeof showToast === 'function') showToast('¡Bienvenido!', 'success');
                        location.reload();
                    } else {
                        alert(data.message || 'Error al iniciar sesión');
                    }
                } catch (err) {
                    alert('Error de conexión');
                }
            });
        }
        
        if (registerForm) {
            registerForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const data = {
                    nombre: document.getElementById('auth-reg-nombre').value,
                    email: document.getElementById('auth-reg-email').value,
                    telefono: document.getElementById('auth-reg-telefono').value,
                    password: document.getElementById('auth-reg-password').value
                };
                
                try {
                    const res = await fetch(API_BASE + 'api/clientes.php?action=register', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    });
                    const result = await res.json();
                    
                    if (res.ok && result.token) {
                        localStorage.setItem('clientToken', result.token);
                        localStorage.setItem('clientUser', JSON.stringify(result.cliente));
                        currentUser = result.cliente;
                        updateAuthUI();
                        closeAuthModal();
                        if (typeof showToast === 'function') showToast('¡Cuenta creada!', 'success');
                        location.reload();
                    } else {
                        alert(result.message || 'Error al crear cuenta');
                    }
                } catch (err) {
                    alert('Error de conexión');
                }
            });
        }
    }
    
    function authLogout() {
        localStorage.removeItem('clientToken');
        localStorage.removeItem('clientUser');
        currentUser = null;
        updateAuthUI();
        document.getElementById('user-dropdown').classList.add('hidden');
        location.reload();
    }
    
    // Navigate to profile page dynamically
    function navigateToProfile() {
        const path = window.location.pathname;
        // Find the base path to /candelaria/
        const candelariaIndex = path.indexOf('/candelaria/');
        if (candelariaIndex !== -1) {
            const basePath = path.substring(0, candelariaIndex + '/candelaria/'.length);
            window.location.href = basePath + 'perfil.php';
        } else {
            // Fallback: try relative path
            window.location.href = 'perfil.php';
        }
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        const dropdown = document.getElementById('user-dropdown');
        const btn = document.getElementById('auth-user-btn');
        if (dropdown && !dropdown.contains(e.target) && !btn.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
    </script>
SCRIPT;
}
