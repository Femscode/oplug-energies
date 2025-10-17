// Cart functionality for frontend pages
class CartManager {
    constructor() {
        this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        this.init();
    }

    init() {
        this.updateCartCount();
        this.initializeProductButtons();
        this.bindEvents();
    }

    bindEvents() {
        // Bind click events for add to cart buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('.add-to-cart-btn')) {
                e.preventDefault();
                const button = e.target.closest('.add-to-cart-btn');
                const productId = button.dataset.productId;
                this.addToCart(productId, 1);
            }

            if (e.target.closest('.cart-quantity-plus')) {
                e.preventDefault();
                const button = e.target.closest('.cart-quantity-plus');
                const productId = button.dataset.productId;
                this.increaseQuantity(productId);
            }

            if (e.target.closest('.cart-quantity-minus')) {
                e.preventDefault();
                const button = e.target.closest('.cart-quantity-minus');
                const productId = button.dataset.productId;
                this.decreaseQuantity(productId);
            }

            if (e.target.closest('.remove-from-cart-btn')) {
                e.preventDefault();
                const button = e.target.closest('.remove-from-cart-btn');
                const productId = button.dataset.productId;
                this.removeFromCart(productId);
            }
        });
    }

    async addToCart(productId, quantity = 1) {
        console.log('🛒 Adding to cart - Product ID:', productId, 'Quantity:', quantity);
        try {
            const response = await fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            });

            const data = await response.json();
            console.log('🛒 Server response:', data);
            
            if (data.success) {
                this.updateCartCount();
                console.log('🛒 About to update product button');
                // Add a small delay to ensure the backend has processed the request
                setTimeout(() => {
                    this.updateProductButton(productId);
                }, 100);
                this.showNotification(data.message, 'success');
            } else {
                console.log('🛒 Failed to add to cart:', data.message);
                this.showNotification(data.message || 'Error adding product to cart', 'error');
            }
        } catch (error) {
            console.error('🛒 Error adding to cart:', error);
            this.showNotification('Error adding product to cart', 'error');
        }
    }

    async updateCart(productId, quantity) {
        try {
            const response = await fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            });

            const data = await response.json();
            
            if (data.success) {
                this.updateCartCount();
                if (quantity === 0) {
                    this.updateProductButton(productId);
                } else {
                    this.updateQuantityDisplay(productId, quantity);
                }
                this.showNotification(data.message, 'success');
            } else {
                this.showNotification(data.message || 'Error updating cart', 'error');
            }
        } catch (error) {
            console.error('Error updating cart:', error);
            this.showNotification('Error updating cart', 'error');
        }
    }

    async removeFromCart(productId) {
        try {
            const response = await fetch('/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                },
                body: JSON.stringify({
                    product_id: productId
                })
            });

            const data = await response.json();
            
            if (data.success) {
                this.updateCartCount();
                this.updateProductButton(productId);
                this.showNotification(data.message, 'success');
            } else {
                this.showNotification(data.message || 'Error removing product from cart', 'error');
            }
        } catch (error) {
            console.error('Error removing from cart:', error);
            this.showNotification('Error removing product from cart', 'error');
        }
    }

    async increaseQuantity(productId) {
        const currentQuantity = await this.getProductQuantity(productId);
        this.updateCart(productId, currentQuantity + 1);
    }

    async decreaseQuantity(productId) {
        const currentQuantity = await this.getProductQuantity(productId);
        if (currentQuantity > 1) {
            this.updateCart(productId, currentQuantity - 1);
        } else {
            this.removeFromCart(productId);
        }
    }

    async getProductQuantity(productId) {
        try {
            const response = await fetch(`/cart/product-quantity?product_id=${productId}`);
            const data = await response.json();
            return data.success ? data.quantity : 0;
        } catch (error) {
            console.error('Error getting product quantity:', error);
            return 0;
        }
    }

    async updateCartCount() {
        try {
            // Use the enhanced updateCartCount function if available
            if (typeof window.updateCartCount === 'function') {
                // Try to get cart count from server
                const response = await fetch('/cart/count');
                if (response.ok) {
                    const count = await response.text();
                    window.updateCartCount(parseInt(count) || 0);
                } else {
                    // If route doesn't exist, just update with a default count
                    window.updateCartCount(0);
                }
            } else {
                // Fallback to original method
                const response = await fetch('/cart/count');
                const count = await response.text();
                const cartCountElements = document.querySelectorAll('.cart-count');
                cartCountElements.forEach(element => {
                    element.textContent = count;
                });
            }
        } catch (error) {
            console.error('Error updating cart count:', error);
            // If there's an error and we have the enhanced function, just set count to 0
            if (typeof window.updateCartCount === 'function') {
                window.updateCartCount(0);
            }
        }
    }

    async initializeProductButtons() {
        const productElements = document.querySelectorAll('[data-product-id]');
        
        for (const element of productElements) {
            const productId = element.dataset.productId;
            if (productId) {
                await this.updateProductButton(productId);
            }
        }
    }

    async updateProductButton(productId) {
        console.log('🔄 Updating product button for ID:', productId);
        const quantity = await this.getProductQuantity(productId);
        console.log('🔄 Current quantity:', quantity);
        const productContainers = document.querySelectorAll(`[data-product-id="${productId}"]`);
        console.log('🔄 Found containers:', productContainers.length);
        
        productContainers.forEach((container, index) => {
            console.log(`🔄 Processing container ${index + 1}:`, container);
            // Find add to cart button - check both as child and as the element itself
            let addToCartBtn = container.querySelector('.add-to-cart-btn');
            if (!addToCartBtn && container.classList.contains('add-to-cart-btn')) {
                addToCartBtn = container;
            }
            console.log('🔄 Add to cart button:', addToCartBtn);
            
            // Find quantity controls
            let quantityControls = container.querySelector('.quantity-controls');
            console.log('🔄 Existing quantity controls:', quantityControls);
            
            // Find the action container - prioritize shop-now-wrapper for best seller section
            let actionContainer = container;
            
            // If current container doesn't have action classes, look for them
            if (!container.classList.contains('shop-now-wrapper') &&
                !container.classList.contains('solar-inverters-product-action') && 
                !container.classList.contains('solar-panels-product-action') && 
                !container.classList.contains('solar-categories-best-action')) {
                
                // Look for action containers in order of priority
                actionContainer = container.querySelector('.shop-now-wrapper') ||
                                container.querySelector('.solar-inverters-product-action') ||
                                container.querySelector('.solar-panels-product-action') ||
                                container.querySelector('.solar-categories-best-action') ||
                                container.querySelector('.solar-product-details-cart') ||
                                container.querySelector('.frame-7');
                
                if (actionContainer) {
                    quantityControls = actionContainer.querySelector('.quantity-controls');
                }
            }
            console.log('🔄 Action container:', actionContainer);
            
            if (quantity > 0) {
                console.log('🔄 Quantity > 0, showing controls');
                // Hide add to cart button
                if (addToCartBtn) {
                    addToCartBtn.style.display = 'none';
                    console.log('🔄 Hidden add to cart button');
                }
                
                // Show or create quantity controls
                if (quantityControls) {
                    quantityControls.style.display = 'flex';
                    this.updateQuantityDisplay(productId, quantity);
                    console.log('🔄 Showed existing quantity controls');
                } else {
                    // Create quantity controls in the appropriate container
                    console.log('🔄 Creating new quantity controls in:', actionContainer || container);
                    this.createQuantityControls(actionContainer || container, productId, quantity);
                }
            } else {
                console.log('🔄 Quantity = 0, showing add to cart button');
                // Show add to cart button, hide quantity controls
                if (addToCartBtn) {
                    addToCartBtn.style.display = 'block';
                }
                if (quantityControls) {
                    quantityControls.style.display = 'none';
                }
            }
        });
    }

    createQuantityControls(container, productId, quantity) {
        console.log('🔧 Creating quantity controls for product:', productId, 'in container:', container);
        
        // Look for action containers in all product sections
        let actionContainer = container.querySelector('.solar-inverters-product-action');
        if (!actionContainer) actionContainer = container.querySelector('.solar-panels-product-action');
        if (!actionContainer) actionContainer = container.querySelector('.solar-categories-best-action');
        if (!actionContainer) actionContainer = container.querySelector('.solar-product-details-cart');
        if (!actionContainer) actionContainer = container.querySelector('.shop-now-wrapper');
        if (!actionContainer) actionContainer = container.querySelector('.frame-7');
        
        // If container itself has the action class, use it
        if (!actionContainer && (container.classList.contains('solar-inverters-product-action') || 
                                container.classList.contains('solar-panels-product-action') || 
                                container.classList.contains('solar-categories-best-action') ||
                                container.classList.contains('shop-now-wrapper') ||
                                container.classList.contains('solar-product-details-cart') ||
                                container.classList.contains('frame-7'))) {
            actionContainer = container;
        }
        
        console.log('🔧 Final action container:', actionContainer);
        
        if (actionContainer) {
            const quantityControls = document.createElement('div');
            quantityControls.className = 'quantity-controls';
            quantityControls.style.cssText = 'display: flex; align-items: center; gap: 10px; justify-content: center; margin-top: 5px;';
            
            quantityControls.innerHTML = `
                <button class="cart-quantity-minus" data-product-id="${productId}" style="background: #dc3545; color: white; border: none; border-radius: 4px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 16px; font-weight: bold;">-</button>
                <span class="quantity-display" style="font-weight: bold; min-width: 30px; text-align: center; font-size: 14px;">${quantity}</span>
                <button class="cart-quantity-plus" data-product-id="${productId}" style="background: #f7982a; color: white; border: none; border-radius: 4px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 16px; font-weight: bold;">+</button>
            `;
            
            actionContainer.appendChild(quantityControls);
            console.log('🔧 Successfully created and appended quantity controls');
        } else {
            console.error('🔧 No action container found for creating quantity controls');
        }
    }

    updateQuantityDisplay(productId, quantity) {
        const quantityDisplays = document.querySelectorAll(`[data-product-id="${productId}"] .quantity-display`);
        quantityDisplays.forEach(display => {
            display.textContent = quantity;
        });
    }

    showNotification(message, type = 'info') {
        // Use the enhanced cart notification if available, otherwise fallback to basic notification
        if (typeof window.showCartNotification === 'function' && type === 'success') {
            // Extract product name from message if possible
            const productName = message.includes('added to cart') ? 
                message.replace(' added to cart successfully', '').replace('Product added to cart successfully', '') : 
                '';
            window.showCartNotification(productName);
        } else {
            // Fallback to basic notification for error messages
            const notification = document.createElement('div');
            notification.className = `cart-notification cart-notification-${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 8px;
                color: white;
                font-weight: bold;
                z-index: 10000;
                max-width: 300px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            
            // Set background color based on type
            const colors = {
                success: '#f7982a',
                error: '#dc3545',
                info: '#17a2b8'
            };
            notification.style.backgroundColor = colors[type] || colors.info;
            
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }
    }
}

// Initialize cart manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.cartManager = new CartManager();
});