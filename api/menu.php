<?php

include 'includes/header.php';

include 'includes/db_connect.php';


// Fetch Categories
$categories = [];
try {
    $stmt = $pdo->query("SELECT * FROM categories");
    $categories = $stmt->fetchAll();
}
catch (PDOException $e) {
// Fail silently/gracefully if DB not set up yet
}

// Fetch Products
$products = [];
try {
    $stmt = $pdo->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.is_available = 1");
    $products = $stmt->fetchAll();
}
catch (PDOException $e) {
}

// Fallback data if DB is empty (for demo purposes before import)
if (empty($products)) {
    $products = [
        ['id' => 1, 'name' => 'Demo Jollof Rice', 'description' => 'Spicy and delicious (DB not connected)', 'price' => 12.00, 'image_url' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19', 'category_name' => 'Rice Dishes'],
        ['id' => 2, 'name' => 'Demo Burger', 'description' => 'Juicy beef burger (DB not connected)', 'price' => 8.50, 'image_url' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd', 'category_name' => 'Snacks']
    ];
    $categories = [
        ['id' => 1, 'name' => 'Rice Dishes'],
        ['id' => 2, 'name' => 'Snacks']
    ];
}
?>

<!-- Menu Hero -->
<section style="background: linear-gradient(135deg, #e53935 0%, #b71c1c 100%); color: white; padding: 4rem 0 6rem; position: relative;">
    <div class="container text-center">
        <h1 class="menu-hero-title" style="margin-bottom: 1rem;">Our Full Menu</h1>
        <p class="menu-hero-subtitle" style="opacity: 0.95; max-width: 600px; margin: 0 auto;">Browse through our delicious selection of freshly prepared dishes.</p>
    </div>
</section>

<div class="container" style="padding: 2rem 1rem; margin-top: -3rem; position: relative; z-index: 10;">
    
    <!-- Search Bar -->
    <div style="background: white; padding: 1.5rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); margin-bottom: 2rem;">
        <div style="position: relative;">
            <i class="fas fa-search" style="position: absolute; left: 1.2rem; top: 50%; transform: translateY(-50%); color: #999; font-size: 1.1rem;"></i>
            <input type="text" 
                   id="searchInput" 
                   placeholder="Search for dishes..." 
                   style="width: 100%; padding: 1rem 1rem 1rem 3.5rem; border: 2px solid #eee; border-radius: 50px; font-size: 1rem; transition: var(--transition);">
            <button id="clearSearch" style="display: none; position: absolute; right: 1.2rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #999; cursor: pointer; font-size: 1.2rem;">
                <i class="fas fa-times-circle"></i>
            </button>
        </div>
    </div>
    
    <!-- Category Filter -->
    <div class="category-filter-wrapper" style="overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 3rem; padding-bottom: 1rem; scrollbar-width: none;">
        <div class="flex" style="justify-content: center; flex-wrap: nowrap; gap: 0.75rem; width: max-content; min-width: 100%;">
            <button class="btn category-btn active-filter" data-filter="all" style="background-color: var(--color-primary); color: white; border: 2px solid var(--color-primary); padding: 0.75rem 1.5rem; border-radius: 50px; white-space: nowrap;">
                <i class="fas fa-th"></i> All <span class="category-count">(<?php echo count($products); ?>)</span>
            </button>
            <?php
$category_icons = ['utensils', 'hamburger', 'pizza-slice', 'ice-cream', 'coffee', 'drumstick-bite'];
$icon_index = 0;
foreach ($categories as $cat):
    $icon = $category_icons[$icon_index % count($category_icons)];
    $icon_index++;
    $count = count(array_filter($products, function ($p) use ($cat) {
        return $p['category_name'] == $cat['name'];
    }));
?>
                <button class="btn category-btn" data-filter="<?php echo htmlspecialchars($cat['name']); ?>" style="background: white; border: 2px solid #eee; color: var(--color-text); padding: 0.75rem 1.5rem; border-radius: 50px; transition: all 0.3s ease; white-space: nowrap;">
                    <i class="fas fa-<?php echo $icon; ?>"></i> <?php echo htmlspecialchars($cat['name']); ?> <span class="category-count">(<?php echo $count; ?>)</span>
                </button>
            <?php
endforeach; ?>
        </div>
    </div>
    
    <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;" id="productsGrid">
        <?php
$badge_types = ['new', 'popular', 'spicy', '', ''];
$badge_index = 0;
foreach ($products as $product):
    $badge = $badge_types[$badge_index % count($badge_types)];
    $badge_index++;
?>
            <!-- Product Card -->
            <div class="card product-card" data-category="<?php echo htmlspecialchars($product['category_name']); ?>" data-name="<?php echo strtolower(htmlspecialchars($product['name'])); ?>" style="position: relative; cursor: pointer; overflow: hidden;">
                <?php if ($badge == 'new'): ?>
                <span class="badge-new" style="position: absolute; top: 15px; left: 15px; background: #4ecdc4; color: white; padding: 0.4rem 0.8rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                    <i class="fas fa-sparkles"></i> NEW
                </span>
                <?php
    elseif ($badge == 'popular'): ?>
                <span class="badge-popular" style="position: absolute; top: 15px; left: 15px; background: #FFD700; color: #333; padding: 0.4rem 0.8rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                    <i class="fas fa-fire"></i> POPULAR
                </span>
                <?php
    elseif ($badge == 'spicy'): ?>
                <span class="badge-spicy" style="position: absolute; top: 15px; left: 15px; background: #ff4444; color: white; padding: 0.4rem 0.8rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                    <i class="fas fa-pepper-hot"></i> SPICY
                </span>
                <?php
    endif; ?>
                
                <button class="wishlist-btn" style="position: absolute; top: 15px; right: 15px; width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.95); border: none; cursor: pointer; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.15); transition: var(--transition);">
                    <i class="far fa-heart" style="color: var(--color-primary); font-size: 1.1rem;"></i>
                </button>
                
                <div style="position: relative; overflow: hidden;">
                    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" loading="lazy" style="height: 220px; width: 100%; object-fit: cover; transition: transform 0.5s ease;">
                    <div class="quick-view-overlay" style="position: absolute; inset: 0; background: rgba(0,0,0,0.7); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;">
                        <button class="btn" style="background: white; color: var(--color-primary); padding: 0.75rem 1.5rem; border: none; font-weight: 600;">
                            <i class="fas fa-eye"></i> Quick View
                        </button>
                    </div>
                </div>
                
                <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                        <span style="font-size: 0.8rem; color: var(--color-secondary); text-transform: uppercase; font-weight: 600; background: rgba(239, 108, 0, 0.1); padding: 0.25rem 0.75rem; border-radius: 50px;"><?php echo htmlspecialchars($product['category_name']); ?></span>
                        <div style="color: #FFD700; font-size: 0.9rem;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <h3 style="margin-bottom: 0.75rem; font-size: 1.3rem;"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p style="color: var(--color-text-light); font-size: 0.95rem; margin-bottom: 1.5rem; flex-grow: 1; line-height: 1.6;">
                        <?php echo htmlspecialchars($product['description']); ?>
                    </p>
                    <div class="flex" style="justify-content: space-between; align-items: center; margin-top: auto;">
                        <span style="font-weight: 700; font-size: 1.4rem; color: var(--color-primary);">$<?php echo number_format($product['price'], 2); ?></span>
                        <button 
                            class="btn btn-primary btn-sm add-to-cart-btn" 
                            data-id="<?php echo $product['id']; ?>"
                            data-name="<?php echo htmlspecialchars($product['name']); ?>"
                            data-price="<?php echo $product['price']; ?>"
                            style="padding: 0.7rem 1.3rem;"
                        >
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        <?php
endforeach; ?>
    </div>
    
    <div id="no-items-msg" class="text-center" style="display: none; padding: 4rem 2rem;">
        <i class="fas fa-search" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem;"></i>
        <h3 style="color: #999; margin-bottom: 0.5rem;">No items found</h3>
        <p style="color: #999;">Try a different search term or category.</p>
    </div>
</div>

<!-- Quick View Modal -->
<div id="quickViewModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.8); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
    <div style="background: white; max-width: 700px; width: 90%; max-height: 90vh; overflow-y: auto; border-radius: var(--border-radius); position: relative; animation: scaleIn 0.3s ease;">
        <button id="closeModal" style="position: absolute; top: 1rem; right: 1rem; width: 40px; height: 40px; border-radius: 50%; background: white; border: none; font-size: 1.5rem; cursor: pointer; box-shadow: var(--box-shadow); z-index: 10;">
            <i class="fas fa-times"></i>
        </button>
        
        <div id="modalContent">
            <!-- Content injected via JS -->
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes scaleIn {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.product-card:hover img {
    transform: scale(1.1);
}

.product-card:hover .quick-view-overlay {
    opacity: 1;
}

.wishlist-btn:hover {
    transform: scale(1.1);
    background: var(--color-primary) !important;
}

.wishlist-btn:hover i {
    color: white !important;
}

.category-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15) !important;
}

.active-filter {
    background-color: var(--color-primary) !important;
    color: white !important;
    border-color: var(--color-primary) !important;
}

#searchInput:focus {
    outline: none;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.1);
}
@media (max-width: 768px) {
    .menu-hero-title { font-size: 2.2rem !important; }
    .menu-hero-subtitle { font-size: 1rem !important; }
    .category-filter-wrapper { justify-content: flex-start !important; }
    #productsGrid { grid-template-columns: 1fr !important; }
}

.category-filter-wrapper::-webkit-scrollbar {
    display: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const clearSearch = document.getElementById('clearSearch');
    const productCards = document.querySelectorAll('.product-card');
    const noItemsMsg = document.getElementById('no-items-msg');
    const productsGrid = document.getElementById('productsGrid');
    const filterButtons = document.querySelectorAll('.category-btn');
    let currentFilter = 'all';
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        clearSearch.style.display = searchTerm ? 'block' : 'none';
        filterProducts();
    });
    
    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        this.style.display = 'none';
        filterProducts();
    });
    
    // Category Filtering
    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all
            filterButtons.forEach(b => b.classList.remove('active-filter'));
            btn.classList.add('active-filter');
            
            currentFilter = btn.dataset.filter;
            filterProducts();
        });
    });
    
    function filterProducts() {
        const searchTerm = searchInput.value.toLowerCase();
        let visibleCount = 0;
        
        productCards.forEach(card => {
            const cardCategory = card.dataset.category;
            const cardName = card.dataset.name;
            
            const matchesCategory = currentFilter === 'all' || cardCategory === currentFilter;
            const matchesSearch = !searchTerm || cardName.includes(searchTerm);
            
            if (matchesCategory && matchesSearch) {
                card.style.display = 'flex';
                card.style.animation = 'fadeIn 0.5s ease';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        noItemsMsg.style.display = visibleCount === 0 ? 'block' : 'none';
        productsGrid.style.display = visibleCount === 0 ? 'none' : 'grid';
    }
    
    // Quick View Modal
    const modal = document.getElementById('quickViewModal');
    const modalContent = document.getElementById('modalContent');
    const closeModal = document.getElementById('closeModal');
    
    productCards.forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('.add-to-cart-btn') || e.target.closest('.wishlist-btn')) return;
            
            const img = this.querySelector('img').src;
            const name = this.querySelector('h3').textContent;
            const category = this.querySelector('span').textContent;
            const price = this.querySelector('.flex span').textContent;
            const description = this.querySelector('p').textContent;
            const productId = this.querySelector('.add-to-cart-btn').dataset.id;
            const productPrice = this.querySelector('.add-to-cart-btn').dataset.price;
            
            modalContent.innerHTML = `
                <img src="${img}" style="width: 100%; height: 300px; object-fit: cover;">
                <div style="padding: 2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span style="background: rgba(239, 108, 0, 0.1); color: var(--color-secondary); padding: 0.5rem 1rem; border-radius: 50px; font-weight: 600; font-size: 0.9rem;">${category}</span>
                        <div style="color: #FFD700; font-size: 1.1rem;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <h2 style="margin-bottom: 1rem; font-size: 2rem;">${name}</h2>
                    <p style="color: var(--color-text-light); margin-bottom: 2rem; line-height: 1.8; font-size: 1.1rem;">${description}</p>
                    <div style="border-top: 1px solid #eee; padding-top: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                            <span style="font-size: 2rem; font-weight: 700; color: var(--color-primary);">${price}</span>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <button onclick="decrementQty()" style="width: 40px; height: 40px; border: 2px solid #ddd; background: white; border-radius: 50%; cursor: pointer; font-weight: 700;">-</button>
                                <span id="modalQuantity" style="font-size: 1.3rem; font-weight: 600; min-width: 30px; text-align: center;">1</span>
                                <button onclick="incrementQty()" style="width: 40px; height: 40px; border: 2px solid #ddd; background: white; border-radius: 50%; cursor: pointer; font-weight: 700;">+</button>
                            </div>
                        </div>
                        <button class="btn btn-primary" onclick="addFromModal('${productId}', '${name}', '${productPrice}')" style="width: 100%; padding: 1.2rem; font-size: 1.1rem;">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                </div>
            `;
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    });
    
    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
    
    // Wishlist functionality (visual only)
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const icon = this.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.style.background = 'var(--color-primary)';
                icon.style.color = 'white';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.style.background = 'rgba(255,255,255,0.95)';
                icon.style.color = 'var(--color-primary)';
            }
        });
    });
    
    // Add to Cart
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const item = {
                id: this.dataset.id,
                name: this.dataset.name,
                price: parseFloat(this.dataset.price),
                quantity: 1
            };
            
            if (typeof addToCart === 'function') {
                addToCart(item);
            }
            
            // Visual feedback
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check"></i> Added!';
            this.style.backgroundColor = 'var(--color-secondary)';
            this.classList.add('pulse');
            setTimeout(() => {
                this.innerHTML = originalText;
                this.style.backgroundColor = '';
                this.classList.remove('pulse');
            }, 1500);
        });
    });
});

// Modal quantity controls
function incrementQty() {
    const qtyEl = document.getElementById('modalQuantity');
    qtyEl.textContent = parseInt(qtyEl.textContent) + 1;
}

function decrementQty() {
    const qtyEl = document.getElementById('modalQuantity');
    const current = parseInt(qtyEl.textContent);
    if (current > 1) {
        qtyEl.textContent = current - 1;
    }
}

function addFromModal(id, name, price) {
    const quantity = parseInt(document.getElementById('modalQuantity').textContent);
    const item = {
        id: id,
        name: name,
        price: parseFloat(price),
        quantity: quantity
    };
    
    if (typeof addToCart === 'function') {
        addToCart(item);
    }
    
    // Close modal and show feedback
    document.getElementById('quickViewModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}
</script>

<?php include 'includes/footer.php'; ?>
