<?php
// includes/header.php
// Get the current page name for active state styling
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bite Hive - Authentic Flavors Delivered</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- PWA -->
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#e53935">
    <link rel="apple-touch-icon" href="assets/images/icon-192.png">
    
    <style>
    .main-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .main-header.scrolled {
        padding: 0.5rem 0 !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .main-header.hidden {
        transform: translateY(-100%);
    }
    
    .cart-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background: var(--color-secondary);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.2rem 0.5rem;
        border-radius: 50px;
        min-width: 20px;
        text-align: center;
    }
    
    .cart-badge.pulse {
        animation: pulse 0.5s ease;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.3); }
    }
    
    /* Hide mobile toggle on desktop */
    @media (min-width: 768px) {
        .mobile-toggle {
            display: none !important;
        }
    }
    </style>
</head>
<body>

<header class="main-header">
    <div class="container flex" style="justify-content: space-between; align-items: center; padding: 1rem 0;">
        <div class="logo">
            <a href="index.php" style="text-decoration: none;">
                <h2>🐝 Bite Hive</h2>
            </a>
        </div>
        
        <!-- Desktop Nav -->
        <nav class="desktop-nav">
            <ul class="flex" style="list-style: none; gap: 2rem;">
                <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>" style="color: var(--color-text); text-decoration: none; font-weight: 600;">Home</a></li>
                <li><a href="menu.php" class="<?php echo $current_page == 'menu.php' ? 'active' : ''; ?>" style="color: var(--color-text); text-decoration: none; font-weight: 600;">Menu</a></li>
                <li><a href="reservations.php" class="<?php echo $current_page == 'reservations.php' ? 'active' : ''; ?>" style="color: var(--color-text); text-decoration: none; font-weight: 600;">Reservations</a></li>
                <li><a href="about.php" class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>" style="color: var(--color-text); text-decoration: none; font-weight: 600;">About</a></li>
                <li><a href="contact.php" class="<?php echo $current_page == 'contact.php' ? 'active' : ''; ?>" style="color: var(--color-text); text-decoration: none; font-weight: 600;">Contact</a></li>
            </ul>
        </nav>
        
        <div class="actions flex" style="align-items: center; gap: 0.5rem;">
            <a href="cart.php" class="cart-btn" style="position: relative; display: flex; align-items: center; justify-content: center; width: 44px; height: 44px; border-radius: 50%; background: rgba(211, 47, 47, 0.1); color: var(--color-primary); text-decoration: none; transition: var(--transition);">
                <i class="fas fa-shopping-cart" style="font-size: 1.2rem;"></i> 
                <span class="cart-badge" id="cart-badge" style="display: none;">0</span>
            </a>
            <!-- Mobile Toggle Button -->
            <button class="mobile-toggle" id="mobile-toggle" aria-label="Open Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Navigation Sidebar -->
<div class="mobile-nav-overlay" id="mobile-nav-overlay"></div>
<aside class="mobile-nav-menu" id="mobile-nav-menu">
    <div class="mobile-nav-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div class="logo">
            <h2 style="font-size: 1.5rem; margin: 0;">🐝 Bite Hive</h2>
        </div>
        <button class="close-btn" id="mobile-nav-close" style="font-size: 2rem; background: none; border: none; cursor: pointer; color: var(--color-text);">&times;</button>
    </div>
    
    <nav class="mobile-links">
        <ul style="list-style: none; padding: 0;">
            <li style="margin-bottom: 1rem;"><a href="index.php" style="display: flex; align-items: center; gap: 1rem; text-decoration: none; color: var(--color-text); font-size: 1.1rem; font-weight: 600; padding: 0.8rem; border-radius: 8px; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'"><i class="fas fa-home" style="width: 25px; color: var(--color-primary);"></i> Home</a></li>
            <li style="margin-bottom: 1rem;"><a href="menu.php" style="display: flex; align-items: center; gap: 1rem; text-decoration: none; color: var(--color-text); font-size: 1.1rem; font-weight: 600; padding: 0.8rem; border-radius: 8px; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'"><i class="fas fa-utensils" style="width: 25px; color: var(--color-primary);"></i> Menu</a></li>
            <li style="margin-bottom: 1rem;"><a href="reservations.php" style="display: flex; align-items: center; gap: 1rem; text-decoration: none; color: var(--color-text); font-size: 1.1rem; font-weight: 600; padding: 0.8rem; border-radius: 8px; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'"><i class="fas fa-calendar-alt" style="width: 25px; color: var(--color-primary);"></i> Reservations</a></li>
            <li style="margin-bottom: 1rem;"><a href="about.php" style="display: flex; align-items: center; gap: 1rem; text-decoration: none; color: var(--color-text); font-size: 1.1rem; font-weight: 600; padding: 0.8rem; border-radius: 8px; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'"><i class="fas fa-info-circle" style="width: 25px; color: var(--color-primary);"></i> About Us</a></li>
            <li style="margin-bottom: 1rem;"><a href="contact.php" style="display: flex; align-items: center; gap: 1rem; text-decoration: none; color: var(--color-text); font-size: 1.1rem; font-weight: 600; padding: 0.8rem; border-radius: 8px; transition: background 0.3s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'"><i class="fas fa-phone-alt" style="width: 25px; color: var(--color-primary);"></i> Contact</a></li>
        </ul>
    </nav>
    
    <div style="margin-top: auto;">
        <div style="background: var(--color-bg); padding: 1.5rem; border-radius: 12px; margin-bottom: 2rem;">
            <p style="font-weight: 700; margin-bottom: 0.5rem; color: var(--color-text);">Need Help?</p>
            <p style="color: var(--color-text-light); font-size: 0.9rem; margin-bottom: 1rem;">Available 9am - 10pm</p>
            <a href="tel:0550384768" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; color: var(--color-primary); font-weight: 700;">
                <i class="fas fa-phone-alt"></i> 055 038 4768
            </a>
        </div>
        <div class="social-links flex" style="gap: 1.5rem; justify-content: center;">
            <a href="#" style="color: var(--color-text-light); font-size: 1.2rem;"><i class="fab fa-facebook-f"></i></a>
            <a href="#" style="color: var(--color-text-light); font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
            <a href="#" style="color: var(--color-text-light); font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</aside>

<script>
// Header scroll effects
let lastScroll = 0;
const header = document.querySelector('.main-header');

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
    
    if (currentScroll > lastScroll && currentScroll > 300) {
        header.classList.add('hidden');
    } else {
        header.classList.remove('hidden');
    }
    
    lastScroll = currentScroll;
});

// Service Worker Registration
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('sw.js')
            .then(reg => console.log('Service Worker registered', reg))
            .catch(err => console.log('Service Worker not registered', err));
    });
}
</script>

<main>
