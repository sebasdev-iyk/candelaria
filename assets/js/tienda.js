/**
 * Tienda Core Logic
 * Handles Cart, API interactions, and user session binding
 */

const Tienda = {
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

    syncCartWithUser(userId) {
        console.log('Syncing cart for user:', userId);
        // Implement merging local cart with server cart here
    }
};

// Initialize
document.addEventListener('DOMContentLoaded', () => Tienda.init());
