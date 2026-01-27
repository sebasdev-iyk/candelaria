/**
 * Tienda Core Logic
 * Handles Cart, API interactions, and user session binding
 */

window.Tienda = {
    cart: [],
    CART_KEY: 'candelaria_cart',

    init() {
        this.loadCart();
        this.updateCartCounter();
        console.log('Tienda initialized');

        // Listen for auth changes to maybe sync cart
        window.addEventListener('auth-changed', (e) => {
            if (e.detail) {
                this.syncCartWithUser(e.detail.id);
            }
        });
    },

    loadCart() {
        const stored = localStorage.getItem(this.CART_KEY);
        if (stored) {
            try {
                this.cart = JSON.parse(stored);
            } catch (e) {
                console.error('Error loading cart', e);
                this.cart = [];
            }
        }
    },

    saveCart() {
        localStorage.setItem(this.CART_KEY, JSON.stringify(this.cart));
        this.updateCartCounter();

        // If user logged in, optional: sync to DB background
        if (window.currentUser) {
            // TODO: Implement background sync
        }
    },

    addItem(productId, quantity = 1, productDetails = null) {
        console.log(`🛒 [DEBUG - Tienda] Adding Item: ID=${productId}, Qty=${quantity}`, productDetails);
        const existing = this.cart.find(item => item.id === productId);

        if (existing) {
            console.log("🛒 [DEBUG - Tienda] Item exists, updating quantity");
            existing.qty += quantity;
        } else {
            console.log("🛒 [DEBUG - Tienda] New item, pushing to cart");
            this.cart.push({
                id: productId,
                qty: quantity,
                ...productDetails
            });
        }

        this.saveCart();
        console.log("🛒 [DEBUG - Tienda] Cart saved:", this.cart);
        this.showFeedback('Producto agregado al carrito');
    },

    removeItem(productId) {
        this.cart = this.cart.filter(item => item.id !== productId);
        this.saveCart();
    },

    updateQuantity(productId, newQty) {
        if (newQty < 1) return this.removeItem(productId);

        const item = this.cart.find(item => item.id === productId);
        if (item) {
            item.qty = newQty;
            this.saveCart();
        }
    },

    updateCartCounter() {
        const totalQty = this.cart.reduce((sum, item) => sum + item.qty, 0);

        // Update all counters in DOM
        document.querySelectorAll('.cart-counter').forEach(el => {
            el.innerText = totalQty;
            el.style.display = totalQty > 0 ? 'flex' : 'none';
        });
    },

    showFeedback(msg) {
        // Use existing toast system if available
        if (window.showToast) {
            window.showToast(msg, 'success');
        } else {
            console.log(msg);
        }
    },

    async syncCartWithUser(userId) {
        console.log('Syncing cart for user:', userId);

        // 1. Get Server Cart
        try {
            const token = window.SupabaseCore ? window.SupabaseCore.getAccessToken() : '';
            const res = await fetch('../api/tienda/cart.php', {
                headers: { 'Authorization': 'Bearer ' + token }
            });
            const data = await res.json();

            if (data.success && data.cart) {
                const serverCart = data.cart;

                // Logic: Merge Server into Local (Server wins on conflict for simplicity in V1)
                // OR: If local has items and server empty -> Push Local.

                if (serverCart.length > 0) {
                    console.log('📥 [Tienda] Loaded cart from server:', serverCart.length, 'items');
                    // Merge logic: Add server items to local if not exist
                    // specific simple logic: Overwrite local with server? 
                    // Let's do: Server is Master.
                    this.cart = serverCart;
                    this.saveCart(false); // Save local but don't sync back immediately to avoid loop
                } else if (this.cart.length > 0) {
                    console.log('mw [Tienda] Pushing local cart to new account');
                    this.saveCart(); // Push local to server
                }
            }
        } catch (e) {
            console.error('Error syncing cart:', e);
        }
    },

    saveCart(syncToServer = true) {
        console.log("💾 [Tienda] Saving cart...", this.cart.length, "items");
        localStorage.setItem(this.CART_KEY, JSON.stringify(this.cart));
        this.updateCartCounter();
        this.renderCartPage();

        // Sync to Server if Logged In
        if (syncToServer && window.currentUser) {
            this.pushCartToServer();
        }
    },

    async pushCartToServer() {
        if (!window.currentUser) return;
        try {
            const token = window.SupabaseCore ? window.SupabaseCore.getAccessToken() : '';
            await fetch('../api/tienda/cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
                body: JSON.stringify({ cart: this.cart })
            });
            console.log('☁️ [Tienda] Cart saved to cloud');
        } catch (e) {
            console.error('Error pushing cart:', e);
        }
    },

    // --- UI Logic for carrito.php ---
    renderCartPage() {
        const container = document.getElementById('cart-items-container');
        const emptyState = document.getElementById('cart-empty');
        const contentState = document.getElementById('cart-content');
        const loadingState = document.getElementById('cart-loading');

        if (!container) return; // Not on cart page

        if (loadingState) loadingState.style.display = 'none';

        if (this.cart.length === 0) {
            contentState.classList.add('hidden');
            emptyState.classList.remove('hidden');
            return;
        }

        contentState.classList.remove('hidden');
        emptyState.classList.add('hidden');

        let total = 0;

        container.innerHTML = this.cart.map(item => {
            const subtotal = item.precio * item.qty;
            total += subtotal;
            const img = item.imagen && item.imagen.startsWith('assets') ? '../' + item.imagen : (item.imagen || '../assets/placeholder.png');

            return `
                <div class="flex flex-col sm:flex-row items-center gap-4 bg-white p-4 rounded-xl border border-gray-100 shadow-sm relative group">
                    <img src="${img}" class="w-24 h-24 object-cover rounded-lg bg-gray-100">
                    <div class="flex-1 w-full text-center sm:text-left">
                        <h3 class="font-bold text-gray-900">${item.nombre}</h3>
                        <p class="text-sm text-gray-500">S/ ${item.precio} x ${item.qty}</p>
                        <p class="font-bold text-purple-600 mt-1">S/ ${subtotal.toFixed(2)}</p>
                    </div>
                    <div class="flex items-center border border-gray-200 rounded-lg">
                        <button onclick="Tienda.updateQuantity(${item.id}, ${item.qty - 1})" class="px-3 py-1 hover:bg-gray-50 text-gray-600">-</button>
                        <span class="px-2 text-sm font-bold">${item.qty}</span>
                        <button onclick="Tienda.updateQuantity(${item.id}, ${item.qty + 1})" class="px-3 py-1 hover:bg-gray-50 text-gray-600">+</button>
                    </div>
                    <button onclick="Tienda.removeItem(${item.id})" class="absolute top-2 right-2 p-2 text-gray-300 hover:text-red-500 transition-colors">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
            `;
        }).join('');
        if (window.lucide) lucide.createIcons();
        document.getElementById('summary-subtotal').innerText = 'S/ ' + total.toFixed(2);
        document.getElementById('summary-total').innerText = 'S/ ' + total.toFixed(2);
    },

    async checkout() {
        if (this.cart.length === 0) {
            window.showToast('Tu carrito está vacío', 'warning');
            return;
        }

        const btn = document.querySelector('button[onclick="Tienda.checkout()"]');
        if (btn) btn.innerHTML = '<i class="animate-spin" data-lucide="loader-2"></i> Procesando...';

        // 1. Calculate Total
        const total = this.cart.reduce((sum, item) => sum + (item.precio * item.qty), 0);

        // 2. Build Message
        let msg = `Hola, quiero realizar el siguiente pedido de la web:\n\n`;
        this.cart.forEach(item => {
            msg += `• ${item.qty}x ${item.nombre} (S/ ${(item.precio * item.qty).toFixed(2)})\n`;
        });
        msg += `\n*TOTAL: S/ ${total.toFixed(2)}*\n\n`;

        // Add Contact Info if filled (optional now)
        const address = document.getElementById('checkout-address') ? document.getElementById('checkout-address').value : '';
        if (address) msg += `Dirección: ${address}\n`;

        // 3. Determine WhatsApp Number
        // Priority: 
        // 1. Use the number of the first item that has one.
        // 2. Fallback to a default number if none found.
        let targetNumber = '';
        const itemWithNumber = this.cart.find(item => item.whatsapp && item.whatsapp.length > 5);

        if (itemWithNumber) {
            targetNumber = itemWithNumber.whatsapp.replace(/[^0-9]/g, '');
        } else {
            // Fallback: If no products have a number, maybe alert user or use a default
            // Just asking user to contact main line
            targetNumber = '51951552140'; // Default Admin/Support Number (Placeholder)
        }

        // 4. Open WhatsApp
        const waLink = `https://wa.me/${targetNumber}?text=${encodeURIComponent(msg)}`;
        window.open(waLink, '_blank');

        // Reset UI
        if (btn) btn.innerHTML = 'Procesar Compra';

        // Optional: Clear cart or ask if sent?
        // Let's keep cart for now or clear it? Standard is to clear if order placed.
        // But since it's WhatsApp, we don't know if they sent it. 
        // Let's NOT clear automatically, maybe shows a "Did you send it?" modal?
        // For simplicity: Just open WA.
        window.showToast('Abriendo WhatsApp para enviar pedido...', 'success');
    },

    getSimpleToken() {
        const match = document.cookie.match(new RegExp('(^| )sb-access-token=([^;]+)'));
        return match ? decodeURIComponent(match[2]) : '';
    }
};

// Initialize
document.addEventListener('DOMContentLoaded', () => Tienda.init());
