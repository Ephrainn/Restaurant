<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; background-attachment: fixed; height: 90vh; display: flex; align-items: center; color: white; position: relative; overflow: hidden;">
    <!-- Animated floating elements -->
    <div class="hero-float" style="position: absolute; top: 10%; left: 10%; width: 80px; height: 80px; background: rgba(255,255,255,0.1); border-radius: 50%; animation: float 6s ease-in-out infinite;"></div>
    <div class="hero-float" style="position: absolute; bottom: 20%; right: 15%; width: 120px; height: 120px; background: rgba(255,255,255,0.08); border-radius: 50%; animation: float 8s ease-in-out infinite reverse;"></div>
    <div class="hero-float" style="position: absolute; top: 40%; right: 25%; width: 60px; height: 60px; background: rgba(255,255,255,0.12); border-radius: 50%; animation: float 7s ease-in-out infinite 1s;"></div>
    
    <div class="container text-center" style="position: relative; z-index: 2; padding: 0 1rem;">
        <h1 class="hero-title" style="margin-bottom: 1.5rem; color: var(--color-white); text-shadow: 2px 4px 8px rgba(0,0,0,0.3); animation: fadeInUp 1s ease;">Taste the Real Flavor</h1>
        <p class="hero-subtitle" style="margin-bottom: 2.5rem; opacity: 0.95; max-width: 700px; margin-left: auto; margin-right: auto; text-shadow: 1px 2px 4px rgba(0,0,0,0.3); animation: fadeInUp 1s ease 0.2s both;">Fresh ingredients, authentic recipes, delivered hot to your door.</p>
        <div class="mt-2 hero-btns" style="animation: fadeInUp 1s ease 0.4s both; display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
            <a href="menu.php" class="btn btn-primary" style="font-size: 1.1rem; padding: 0.8rem 2rem; box-shadow: 0 8px 20px rgba(211, 47, 47, 0.4);">
                <i class="fas fa-utensils"></i> Order Now
            </a>
            <a href="#featured" class="btn" style="background: rgba(255,255,255,0.95); color: var(--color-text); font-size: 1.1rem; padding: 0.8rem 2rem; box-shadow: 0 4px 12px rgba(0,0,0,0.2);">
                <i class="fas fa-arrow-down"></i> View Menu
            </a>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); animation: bounce 2s infinite;">
        <i class="fas fa-chevron-down" style="font-size: 2rem; color: rgba(255,255,255,0.7);"></i>
    </div>
</section>



<!-- Featured Categories -->
<section id="featured" style="padding: 5rem 0; background: var(--color-bg);">
    <div class="container">
        <h2 class="text-center mb-1" style="font-size: 2.5rem;">Our Favorites</h2>
        <p class="text-center" style="max-width: 600px; margin: 0 auto 3rem; color: var(--color-text-light); font-size: 1.1rem;">
            Handpicked dishes that our customers can't get enough of.
        </p>
        
        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
            <!-- Feature Card 1 -->
            <div class="card" style="position: relative;">
                <span class="badge-popular" style="position: absolute; top: 15px; right: 15px; background: #FFD700; color: #333; padding: 0.4rem 0.8rem; border-radius: 50px; font-size: 0.8rem; font-weight: 600; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                    <i class="fas fa-star"></i> Popular
                </span>
                <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Special Rice" style="height: 250px; width: 100%; object-fit: cover;">
                <div style="padding: 2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="font-size: 0.85rem; color: var(--color-secondary); text-transform: uppercase; font-weight: 600; background: rgba(239, 108, 0, 0.1); padding: 0.25rem 0.75rem; border-radius: 50px;">Rice Dishes</span>
                        <div style="color: #FFD700;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <h3 style="margin-bottom: 0.75rem; font-size: 1.5rem;">Signature Jollof Rice</h3>
                    <p style="color: var(--color-text-light); margin-bottom: 1.5rem; line-height: 1.6;">Smokey, spicy, and served with perfectly grilled chicken.</p>
                    <div class="flex" style="justify-content: space-between; align-items: center;">
                        <span style="font-weight: 700; font-size: 1.5rem; color: var(--color-primary);">$12.99</span>
                        <a href="menu.php" class="btn btn-primary btn-sm" style="padding: 0.7rem 1.5rem;">
                            <i class="fas fa-cart-plus"></i> Order
                        </a>
                    </div>
                </div>
            </div>

            <!-- Feature Card 2 -->
            <div class="card">
                <span class="badge-new" style="position: absolute; top: 15px; right: 15px; background: #4ecdc4; color: white; padding: 0.4rem 0.8rem; border-radius: 50px; font-size: 0.8rem; font-weight: 600; z-index: 2; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                    <i class="fas fa-sparkles"></i> New
                </span>
                <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Burger" style="height: 250px; width: 100%; object-fit: cover;">
                <div style="padding: 2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="font-size: 0.85rem; color: var(--color-secondary); text-transform: uppercase; font-weight: 600; background: rgba(239, 108, 0, 0.1); padding: 0.25rem 0.75rem; border-radius: 50px;">Snacks</span>
                        <div style="color: #FFD700;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <h3 style="margin-bottom: 0.75rem; font-size: 1.5rem;">Classic Smash Burger</h3>
                    <p style="color: var(--color-text-light); margin-bottom: 1.5rem; line-height: 1.6;">Double patty, melted cheese, and our secret sauce.</p>
                    <div class="flex" style="justify-content: space-between; align-items: center;">
                        <span style="font-weight: 700; font-size: 1.5rem; color: var(--color-primary);">$9.99</span>
                        <a href="menu.php" class="btn btn-primary btn-sm" style="padding: 0.7rem 1.5rem;">
                            <i class="fas fa-cart-plus"></i> Order
                        </a>
                    </div>
                </div>
            </div>

            <!-- Feature Card 3 -->
            <div class="card">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Salad" style="height: 250px; width: 100%; object-fit: cover;">
                <div style="padding: 2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="font-size: 0.85rem; color: var(--color-secondary); text-transform: uppercase; font-weight: 600; background: rgba(239, 108, 0, 0.1); padding: 0.25rem 0.75rem; border-radius: 50px;">Healthy</span>
                        <div style="color: #FFD700;">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        </div>
                    </div>
                    <h3 style="margin-bottom: 0.75rem; font-size: 1.5rem;">Green Power Bowl</h3>
                    <p style="color: var(--color-text-light); margin-bottom: 1.5rem; line-height: 1.6;">Avocado, quinoa, fresh kale, and zesty lemon dressing.</p>
                    <div class="flex" style="justify-content: space-between; align-items: center;">
                        <span style="font-weight: 700; font-size: 1.5rem; color: var(--color-primary);">$10.50</span>
                        <a href="menu.php" class="btn btn-primary btn-sm" style="padding: 0.7rem 1.5rem;">
                            <i class="fas fa-cart-plus"></i> Order
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Call to Action Section -->
<section style="background: linear-gradient(135deg, #e53935 0%, #b71c1c 100%); color: white; padding: 5rem 0; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
    <div style="position: absolute; bottom: -80px; left: -80px; width: 250px; height: 250px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
    <div class="container text-center" style="position: relative; z-index: 2;">
        <h2 style="font-size: 3rem; margin-bottom: 1rem;">Ready to Order?</h2>
        <p style="font-size: 1.3rem; margin-bottom: 2.5rem; opacity: 0.95; max-width: 700px; margin-left: auto; margin-right: auto;">
            Don't wait! Order your favorite dishes now and enjoy hot, delicious food delivered right to your doorstep.
        </p>
        <a href="menu.php" class="btn" style="background: white; color: var(--color-primary); font-size: 1.2rem; padding: 1.2rem 3rem; box-shadow: 0 8px 24px rgba(0,0,0,0.3); font-weight: 700;">
            <i class="fas fa-shopping-bag"></i> Browse Menu Now
        </a>
        <p style="margin-top: 2rem; font-size: 1.1rem;">
            <i class="fab fa-whatsapp" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>
            Or call us: <a href="tel:0550384768" style="color: white; text-decoration: none; font-weight: 700; border-bottom: 2px solid white;">055 038 4768</a>
        </p>
    </div>
</section>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .hero h1.hero-title { font-size: 2.5rem !important; }
    .hero p.hero-subtitle { font-size: 1.1rem !important; }
    .hero-btns { flex-direction: column; width: 100%; max-width: 300px; margin-left: auto; margin-right: auto; }
    .hero-btns .btn { margin: 0 !important; width: 100%; }
}
</style>

<script>
// Counter animation removed
document.addEventListener('DOMContentLoaded', () => {
    // Other animations
});
</script>

<?php include 'includes/footer.php'; ?>
