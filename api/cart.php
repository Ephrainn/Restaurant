<?php include 'includes/header.php'; ?>

<!-- Cart Hero -->
<section style="background: linear-gradient(135deg, #e53935 0%, #b71c1c 100%); color: white; padding: 2.5rem 0;">
    <div class="container text-center">
        <h1 class="cart-title" style="margin-bottom: 0.5rem;">Your Cart</h1>
        <p class="cart-subtitle" style="opacity: 0.95;">Review your order before checkout</p>
    </div>
</section>

<!-- Progress Indicator -->
<div style="background: white; padding: 1.5rem 0; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow-x: auto;">
    <div class="container">
        <div style="display: flex; justify-content: center; align-items: center; gap: 1rem; max-width: 600px; margin: 0 auto; min-width: 320px;">
            <div style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem; flex: 1;" id="step-id-1">
                <div class="step-number" style="width: 32px; height: 32px; border-radius: 50%; background: var(--color-primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">1</div>
                <span class="step-label" style="font-weight: 600; font-size: 0.8rem;">Cart</span>
            </div>
            <div style="width: 40px; height: 2px; background: #ddd; margin-top: -20px;" id="line-1"></div>
            <div style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem; flex: 1;" id="step-id-2">
                <div class="step-number" style="width: 32px; height: 32px; border-radius: 50%; background: #ddd; color: #999; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">2</div>
                <span class="step-label" style="color: #999; font-size: 0.8rem;">Details</span>
            </div>
            <div style="width: 40px; height: 2px; background: #ddd; margin-top: -20px;" id="line-2"></div>
            <div style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem; flex: 1;" id="step-id-3">
                <div class="step-number" style="width: 32px; height: 32px; border-radius: 50%; background: #ddd; color: #999; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem;">3</div>
                <span class="step-label" style="color: #999; font-size: 0.8rem;">Confirm</span>
            </div>
        </div>
    </div>
</div>

<div class="container" style="padding: 3rem 1rem; max-width: 1100px;">
    
    <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 2rem;">
        
        <!-- Cart Items Column -->
        <div style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow);">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom:  1rem; margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.6rem;">Cart Items</h3>
                <button id="clearCart" style="background: none; border: none; color: var(--color-primary); cursor: pointer; font-weight: 600; padding: 0.5rem 1rem;">
                    <i class="fas fa-trash"></i> Clear All
                </button>
            </div>
            
            <div id="cart-items-container">
                <!-- Items injected via JS -->
            </div>
            
            <div id="cart-actions" style="margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="menu.php" class="btn" style="background: #f5f5f5; color: #666; font-weight: 600;">
                    <i class="fas fa-chevron-left"></i> Continue Shopping
                </a>
                <button onclick="goToStep(2)" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.1rem;">
                    Next: Delivery Details <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
            <div id="cart-empty-message" style="display: none; text-align: center; padding: 3rem 2rem;">
                <i class="fas fa-shopping-cart" style="font-size: 5rem; color: #ddd; margin-bottom: 1.5rem;"></i>
                <h3 style="color: #999; margin-bottom: 0.75rem;">Your cart is empty</h3>
                <p style="color: #999; margin-bottom: 2rem;">Add some delicious items from our menu!</p>
                <a href="menu.php" class="btn btn-primary" style="padding: 1rem 2rem;">
                    <i class="fas fa-utensils"></i> Browse Menu
                </a>
            </div>
        </div>
        
        <!-- Order Summary Column -->
        <div>
            <div id="order-summary" style="display: none; background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); position: sticky; top: 20px;">
                <h3 style="border-bottom: 2px solid #eee; padding-bottom: 1rem; margin-bottom: 1.5rem; font-size: 1.6rem;">Order Summary</h3>
                
                <div style="margin-bottom: 1.5rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: var(--color-text-light);">Subtotal:</span>
                        <span id="cart-subtotal" style="font-weight: 600;">$0.00</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="color: var(--color-text-light);">Delivery Fee:</span>
                        <span id="delivery-fee" style="font-weight: 600; color: #4ecdc4;">FREE</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;" id="discount-row" style="display: none;">
                        <span style="color: var(--color-text-light);">Discount:</span>
                        <span id="discount-amount" style="font-weight: 600; color: var(--color-secondary);">-$0.00</span>
                    </div>
                    <div style="border-top: 2px solid #eee; padding-top: 1rem; margin-top: 1rem; display: flex; justify-content: space-between;">
                        <span style="font-size: 1.3rem; font-weight: 700;">Total:</span>
                        <span id="cart-total" style="font-size: 1.5rem; font-weight: 700; color: var(--color-primary);">$0.00</span>
                    </div>
                </div>
                
                <!-- Promo Code -->
                <div style="border-top: 2px solid #eee; padding-top: 1.5rem; margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; font-size: 0.9rem;">Have a promo code?</label>
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" id="promoCode" placeholder="Enter code" style="flex: 1; padding: 0.75rem; border: 2px solid #eee; border-radius: 8px;">
                        <button id="applyPromo" class="btn btn-primary" style="padding: 0.75rem 1.5rem; white-space: nowrap;">Apply</button>
                    </div>
                    <p id="promoMessage" style="margin-top: 0.5rem; font-size: 0.85rem;"></p>
                </div>
            </div>
            
            <!-- Delivery Details Form -->
            <div id="delivery-form" style="display: none; background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); margin-top: 1.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 1rem; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.6rem; margin: 0;">Delivery Details</h3>
                    <div style="text-align: right;">
                        <span style="display: block; font-size: 0.85rem; color: #999; font-weight: 600; text-transform: uppercase;">Total to Pay</span>
                        <span id="details-total" style="font-size: 1.4rem; font-weight: 700; color: var(--color-primary);">$0.00</span>
                    </div>
                </div>
                
                <form id="order-form">
                    <div class="mb-1">
                        <label for="customer-name" class="form-label">
                            <i class="fas fa-user" style="margin-right: 0.5rem; color: var(--color-primary);"></i>Full Name
                        </label>
                        <input type="text" id="customer-name" required style="width: 100%; padding: 0.9rem 0.9rem 0.9rem 2.5rem; border: 2px solid #eee; border-radius: 8px; transition: var(--transition);" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#eee'">
                    </div>
                    
                    <div class="mb-1">
                        <label for="customer-phone" class="form-label">
                            <i class="fas fa-phone" style="margin-right: 0.5rem; color: var(--color-primary);"></i>Phone Number
                        </label>
                        <input type="tel" id="customer-phone" required style="width: 100%; padding: 0.9rem 0.9rem 0.9rem 2.5rem; border: 2px solid #eee; border-radius: 8px; transition: var(--transition);" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#eee'">
                    </div>
                    
                    <div class="mb-1">
                        <label for="customer-address" class="form-label">
                            <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem; color: var(--color-primary);"></i>Delivery Address
                        </label>
                        <textarea id="customer-address" required rows="3" style="width: 100%; padding: 0.9rem 0.9rem 0.9rem 2.5rem; border: 2px solid #eee; border-radius: 8px; font-family: inherit; transition: var(--transition);" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#eee'"></textarea>
                    </div>
                    
                    <div class="mb-1">
                        <label for="customer-notes" class="form-label">
                            <i class="fas fa-sticky-note" style="margin-right: 0.5rem; color: var(--color-primary);"></i>Special Instructions (Optional)
                        </label>
                        <textarea id="customer-notes" rows="2" maxlength="200" style="width: 100%; padding: 0.9rem 0.9rem 0.9rem 2.5rem; border: 2px solid #eee; border-radius: 8px; font-family: inherit; transition: var(--transition);" placeholder="e.g., No onions, Extra spicy" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#eee'"></textarea>
                        <div style="text-align: right; font-size: 0.8rem; color: #999; margin-top: 0.25rem;">
                            <span id="charCount">0</span>/200
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1.2rem; font-size: 1.1rem; margin-top: 0.5rem;">
                        Review Order <i class="fas fa-chevron-right"></i>
                    </button>
                    <button type="button" onclick="goToStep(1)" class="btn" style="width: 100%; margin-top: 1rem; color: #777;">
                        <i class="fas fa-chevron-left"></i> Back to Cart
                    </button>
                </form>
            </div>

            <!-- Step 3: Order Confirmation -->
            <div id="order-confirmation" style="display: none; background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); margin-top: 1.5rem;">
                <h3 style="border-bottom: 2px solid #eee; padding-bottom: 1rem; margin-bottom: 1.5rem; font-size: 1.6rem;">Confirm Your Order</h3>
                
                <div id="confirmation-details" style="margin-bottom: 2rem;">
                    <!-- Confirmation details injected via JS -->
                </div>

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <button id="final-submit" class="btn btn-primary" style="width: 100%; padding: 1.2rem; font-size: 1.1rem;">
                        <i class="fab fa-whatsapp"></i> Place Order on WhatsApp
                    </button>
                    <button onclick="goToStep(2)" class="btn" style="width: 100%; color: #777;">
                        <i class="fas fa-edit"></i> Edit Delivery Details
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.cart-item {
    display: flex;
    gap: 1.5rem;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border: 2px solid #f5f5f5;
    border-radius: var(--border-radius);
    transition: var(--transition);
}

.cart-item:hover {
    border-color: #eee;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--color-text);
}

@media (max-width: 768px) {
    .container { padding: 1.5rem 0.75rem !important; }
    .container > .grid {
        grid-template-columns: 1fr !important;
        gap: 1.5rem !important;
    }
    .cart-title { font-size: 2rem !important; }
    .cart-subtitle { font-size: 1rem !important; }
    .cart-item {
        flex-direction: column;
        gap: 1rem !important;
        padding: 1.25rem !important;
    }
    .cart-item img {
        width: 100% !important;
        height: 150px !important;
    }
    #cart-actions {
        flex-direction: column-reverse;
    }
    #cart-actions .btn {
        width: 100%;
    }
}
</style>

<script>
// Character counter for notes
document.getElementById('customer-notes')?.addEventListener('input', function() {
    document.getElementById('charCount').textContent = this.value.length;
});

// Clear cart
document.getElementById('clearCart')?.addEventListener('click', function() {
    if (confirm('Are you sure you want to clear your cart?')) {
        localStorage.removeItem('restaurant_cart');
        if (typeof renderCart === 'function') renderCart();
    }
});

// Promo code
document.getElementById('applyPromo')?.addEventListener('click', function() {
    const code = document.getElementById('promoCode').value.toUpperCase();
    const message = document.getElementById('promoMessage');
    
    if (code === 'SAVE10') {
        message.textContent = '✓ Code applied! You saved $10';
        message.style.color = '#4caf50';
        document.getElementById('discount-row').style.display = 'flex';
        document.getElementById('discount-amount').textContent = '-$10.00';
        // Recalculate total
        const currentTotal = parseFloat(document.getElementById('cart-total').textContent.replace('$', ''));
        document.getElementById('cart-total').textContent = '$' + (currentTotal - 10).toFixed(2);
    } else if (code === '') {
        message.textContent = 'Please enter a promo code';
        message.style.color = '#999';
    } else {
        message.textContent = '✗ Invalid promo code';
        message.style.color = '#f44336';
    }
});
</script>

<?php include 'includes/footer.php'; ?>
