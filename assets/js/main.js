// assets/js/main.js

console.log('Restaurant Site Loaded');

// --- Cart Logic ---
let currentCartStep = 1;

// Helper to get cart from storage
function getCart() {
    return JSON.parse(localStorage.getItem('restaurant_cart')) || [];
}

// Helper to save cart to storage
function saveCart(cart) {
    localStorage.setItem('restaurant_cart', JSON.stringify(cart));
    updateCartCount();
}

// Update the cartilage icon count
function updateCartCount() {
    const cart = getCart();
    const count = cart.reduce((total, item) => total + item.quantity, 0);
    const countSpan = document.getElementById('cart-count');
    if (countSpan) {
        countSpan.textContent = count;
        // visual pulse
        countSpan.parentElement.classList.add('pulse');
        setTimeout(() => countSpan.parentElement.classList.remove('pulse'), 300);
    }
}

// Add item to cart (Global function to be called from inline or listeners)
function addToCart(item) {
    let cart = getCart();
    // Use loose equality or ensure types match for ID comparison
    const existingItem = cart.find(i => i.id == item.id);
    const qtyToAdd = item.quantity || 1;

    if (existingItem) {
        existingItem.quantity += qtyToAdd;
    } else {
        cart.push({ ...item, quantity: qtyToAdd });
    }

    saveCart(cart);
}

// Remove item from cart
function removeFromCart(id) {
    let cart = getCart();
    cart = cart.filter(item => item.id != id);
    saveCart(cart);
    renderCart(); // Re-render if on cart page
}

// Update quantity
function updateQuantity(id, change) {
    let cart = getCart();
    const item = cart.find(i => i.id == id);

    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(id);
            return;
        }
        saveCart(cart);
        renderCart();
    }
}

// --- Cart Page Rendering ---

// --- Cart Page Rendering ---

function renderCart() {
    const cartContainer = document.getElementById('cart-items-container');
    const cartSubtotalElement = document.getElementById('cart-subtotal');
    const cartTotalElement = document.getElementById('cart-total');
    const emptyMessage = document.getElementById('cart-empty-message');
    const orderSummary = document.getElementById('order-summary');
    const deliveryForm = document.getElementById('delivery-form');
    const cartActions = document.getElementById('cart-actions');
    const orderConfirmation = document.getElementById('order-confirmation');

    if (!cartContainer) return; // Not on cart page

    const cart = getCart();

    // Handle empty cart
    if (cart.length === 0) {
        cartContainer.innerHTML = '';
        emptyMessage.style.display = 'block';
        if (orderSummary) orderSummary.style.display = 'none';
        if (deliveryForm) deliveryForm.style.display = 'none';
        if (cartActions) cartActions.style.display = 'none';
        if (orderConfirmation) orderConfirmation.style.display = 'none';
        if (cartTotalElement) cartTotalElement.textContent = '$0.00';
        updateProgressIndicator(1);
        return;
    }

    emptyMessage.style.display = 'none';
    if (orderSummary) orderSummary.style.display = 'block';

    const subtotal = cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);
    updateTotals(subtotal);

    // Step-based visibility
    if (currentCartStep === 1) {
        cartContainer.parentElement.style.display = 'block';
        if (deliveryForm) deliveryForm.style.display = 'none';
        if (cartActions) cartActions.style.display = 'flex';
        if (orderConfirmation) orderConfirmation.style.display = 'none';

        // Render items for Step 1
        cartContainer.innerHTML = '';
        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            const row = document.createElement('div');
            row.className = 'cart-item';
            row.innerHTML = `
                <div style="flex: 1;">
                    <h4 style="margin-bottom: 0.25rem; font-size: 1.1rem;">${item.name}</h4>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <span style="color: var(--color-primary); font-weight: 700;">$${item.price.toFixed(2)}</span>
                        <span style="color: #999; font-size: 0.85rem;">Unit Price</span>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="display: flex; align-items: center; background: #f8f8f8; border-radius: 50px; padding: 0.25rem 0.5rem; border: 1px solid #eee;">
                        <button onclick="updateQuantity('${item.id}', -1)" style="width: 28px; height: 28px; border-radius: 50%; border: none; background: white; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); font-weight: bold;">-</button>
                        <span style="min-width: 30px; text-align: center; font-weight: 600;">${item.quantity}</span>
                        <button onclick="updateQuantity('${item.id}', 1)" style="width: 28px; height: 28px; border-radius: 50%; border: none; background: white; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05); font-weight: bold;">+</button>
                    </div>
                    <div style="min-width: 80px; text-align: right;">
                        <span style="font-weight: 700; font-size: 1.1rem;">$${itemTotal.toFixed(2)}</span>
                    </div>
                    <button onclick="removeFromCart('${item.id}')" style="background: none; border: none; color: #ff4444; cursor: pointer; padding: 0.5rem; transition: var(--transition);" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            `;
            cartContainer.appendChild(row);
        });

        if (cartSubtotalElement) cartSubtotalElement.textContent = '$' + subtotal.toFixed(2);
    }
    else if (currentCartStep === 2) {
        cartContainer.parentElement.style.display = 'none';
        if (deliveryForm) deliveryForm.style.display = 'block';
        if (orderConfirmation) orderConfirmation.style.display = 'none';
    }
    else if (currentCartStep === 3) {
        cartContainer.parentElement.style.display = 'none';
        if (deliveryForm) deliveryForm.style.display = 'none';
        if (orderConfirmation) orderConfirmation.style.display = 'block';
        renderConfirmation();
    }

    updateProgressIndicator(currentCartStep);
}

function updateTotals(subtotal) {
    const cartTotalElement = document.getElementById('cart-total');
    const detailsTotalElement = document.getElementById('details-total');
    const discountAmount = document.getElementById('discount-amount');
    const discountRow = document.getElementById('discount-row');

    let total = subtotal;
    if (discountRow && discountRow.style.display === 'flex') {
        const discountValue = parseFloat(discountAmount.textContent.replace('-$', ''));
        total -= discountValue;
    }

    const formattedTotal = '$' + total.toFixed(2);
    if (cartTotalElement) cartTotalElement.textContent = formattedTotal;
    if (detailsTotalElement) detailsTotalElement.textContent = formattedTotal;
}

function goToStep(step) {
    currentCartStep = step;
    renderCart();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function updateProgressIndicator(step) {
    for (let i = 1; i <= 3; i++) {
        const stepEl = document.getElementById(`step-id-${i}`);
        const lineEl = document.getElementById(`line-${i - 1}`);
        if (!stepEl) continue;

        const number = stepEl.querySelector('.step-number');
        const label = stepEl.querySelector('.step-label');

        if (i < step) {
            // Completed
            number.innerHTML = '<i class="fas fa-check"></i>';
            number.style.background = '#4ecdc4';
            number.style.color = 'white';
            label.style.color = '#4ecdc4';
            if (lineEl) lineEl.style.background = '#4ecdc4';
        } else if (i === step) {
            // Active
            number.textContent = i;
            number.style.background = 'var(--color-primary)';
            number.style.color = 'white';
            label.style.color = 'var(--color-text)';
            label.style.fontWeight = '700';
            if (lineEl) lineEl.style.background = '#ddd';
        } else {
            // Pending
            number.textContent = i;
            number.style.background = '#ddd';
            number.style.color = '#999';
            label.style.color = '#999';
            label.style.fontWeight = '600';
            if (lineEl) lineEl.style.background = '#ddd';
        }
    }
}

function renderConfirmation() {
    const container = document.getElementById('confirmation-details');
    if (!container) return;

    const name = document.getElementById('customer-name').value;
    const phone = document.getElementById('customer-phone').value;
    const address = document.getElementById('customer-address').value;
    const notes = document.getElementById('customer-notes').value;
    const cart = getCart();

    let itemsHtml = '';
    let subtotal = 0;
    cart.forEach(item => {
        subtotal += item.price * item.quantity;
        itemsHtml += `
            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.95rem;">
                <span style="color: #666;">${item.quantity}x ${item.name}</span>
                <span style="font-weight: 600;">$${(item.price * item.quantity).toFixed(2)}</span>
            </div>
        `;
    });

    container.innerHTML = `
        <div style="background: #fdfdfd; border: 1px solid #eee; border-radius: 8px; padding: 1.5rem; margin-bottom: 1.5rem;">
            <h4 style="margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; color: #333;">
                <i class="fas fa-truck" style="color: var(--color-primary); margin-right: 0.5rem;"></i> Delivery Info
            </h4>
            <p style="margin-bottom: 0.5rem;"><strong>Name:</strong> ${name}</p>
            <p style="margin-bottom: 0.5rem;"><strong>Phone:</strong> ${phone}</p>
            <p style="margin-bottom: 0.5rem;"><strong>Address:</strong> ${address}</p>
            ${notes ? `<p><strong>Notes:</strong> ${notes}</p>` : ''}
        </div>
        
        <div style="background: #fdfdfd; border: 1px solid #eee; border-radius: 8px; padding: 1.5rem;">
            <h4 style="margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 0.5rem; color: #333;">
                <i class="fas fa-receipt" style="color: var(--color-primary); margin-right: 0.5rem;"></i> Order Summary
            </h4>
            ${itemsHtml}
            <div style="border-top: 1px dashed #ddd; margin-top: 1rem; padding-top: 1rem; display: flex; justify-content: space-between; font-weight: 700; font-size: 1.1rem;">
                <span>Total Amount:</span>
                <span style="color: var(--color-primary);">${document.getElementById('cart-total').textContent}</span>
            </div>
        </div>
    `;
}

// --- WhatsApp Checkout ---

function submitOrder(e) {
    e.preventDefault();
    goToStep(3);
}

function sendWhatsAppOrder() {
    const name = document.getElementById('customer-name').value;
    const phone = document.getElementById('customer-phone').value;
    const address = document.getElementById('customer-address').value;
    const notes = document.getElementById('customer-notes').value;

    const cart = getCart();
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    // Construct Message
    let message = `*New Order from Website* %0A`;
    message += `---------------------------%0A`;
    message += `*Customer:* ${name}%0A`;
    message += `*Phone:* ${phone}%0A`;
    message += `*Address:* ${address}%0A`;
    if (notes) message += `*Notes:* ${notes}%0A`;
    message += `---------------------------%0A`;
    message += `*Order Context:*%0A`;

    let total = 0;
    cart.forEach(item => {
        message += `${item.quantity}x ${item.name} ($${(item.price * item.quantity).toFixed(2)})%0A`;
        total += item.price * item.quantity;
    });

    message += `---------------------------%0A`;
    message += `*TOTAL: $${total.toFixed(2)}*`;

    const restaurantPhone = "233550384768"; // Assuming Ghana (233) for 055 prefix
    const url = `https://wa.me/${restaurantPhone}?text=${message}`;

    // --- Save to Database ---
    const orderData = {
        name: name,
        phone: phone,
        address: address,
        total: total,
        items: cart,
        email: "" // Optional if you want to add an email field to the form
    };

    fetch('api/save_order.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(orderData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Order saved to database, order ID:', data.order_id);
                // Clear cart after order
                localStorage.removeItem('restaurant_cart');
                window.open(url, '_blank');
                window.location.href = 'index.php';
            } else {
                console.error('Error saving order:', data.message);
                alert('There was an error processing your order. Please try again.');
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            // Fallback: Still open WhatsApp even if DB save fails
            window.open(url, '_blank');
            localStorage.removeItem('restaurant_cart');
            window.location.href = 'index.php';
        });
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    renderCart();

    // Order Form
    const orderForm = document.getElementById('order-form');
    if (orderForm) {
        orderForm.addEventListener('submit', submitOrder);
    }

    const finalSubmit = document.getElementById('final-submit');
    if (finalSubmit) {
        finalSubmit.addEventListener('click', sendWhatsAppOrder);
    }

    // Mobile Menu Logic
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileNavMenu = document.getElementById('mobile-nav-menu');
    const mobileNavOverlay = document.getElementById('mobile-nav-overlay');
    const mobileNavClose = document.getElementById('mobile-nav-close');

    function toggleMenu() {
        mobileNavMenu.classList.toggle('active');
        mobileNavOverlay.classList.toggle('active');
    }

    if (mobileToggle) mobileToggle.addEventListener('click', toggleMenu);
    if (mobileNavClose) mobileNavClose.addEventListener('click', toggleMenu);
    if (mobileNavOverlay) mobileNavOverlay.addEventListener('click', toggleMenu);
});
