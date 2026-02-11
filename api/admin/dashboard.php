<?php
// admin/dashboard.php
session_start();
require_once '../includes/db_connect.php';

// Auth Check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("UPDATE products SET is_available = 0 WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: dashboard.php");
    exit;
}

// Fetch Products
$stmt = $pdo->query("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.is_available = 1 ORDER BY p.id DESC");
$products = $stmt->fetchAll();

// Fetch Stats
$total_products = $pdo->query("SELECT COUNT(*) FROM products WHERE is_available = 1")->fetchColumn();
$total_categories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$recent_products = $pdo->query("SELECT COUNT(*) FROM products WHERE is_available = 1 AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)")->fetchColumn();

// Get username
$username = $_SESSION['username'];
$user_initial = strtoupper(substr($username, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bite Hive Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="admin-body">

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar Navigation -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <i class="fas fa-utensils"></i>
            <h2>Bite Hive</h2>
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="dashboard.php" class="active">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="reservations.php">
                    <i class="fas fa-calendar-check"></i>
                    <span>Reservations</span>
                </a>
            </li>
            <li>
                <a href="orders.php">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li>
                <a href="add_product.php">
                    <i class="fas fa-plus-circle"></i>
                    <span>Add Product</span>
                </a>
            </li>
            <li>
                <a href="../menu.php" target="_blank">
                    <i class="fas fa-eye"></i>
                    <span>View Website</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar"><?php echo $user_initial; ?></div>
            <div class="sidebar-user-info">
                <h4><?php echo htmlspecialchars($username); ?></h4>
                <p>Administrator</p>
            </div>
        </div>
    </div>
</aside>

<!-- Main Content -->
<main class="admin-main">
    <!-- Header -->
    <header class="admin-header">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Dashboard</h1>
        </div>
        <div class="admin-header-actions">
            <a href="add_product.php" class="btn-primary-admin">
                <i class="fas fa-plus"></i>
                Add New Item
            </a>
        </div>
    </header>
    
    <!-- Content -->
    <div class="admin-content">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
                <div class="stat-card-value"><?php echo $total_products; ?></div>
                <div class="stat-card-label">Total Products</div>
                <div class="stat-card-trend up">
                    <i class="fas fa-arrow-up"></i>
                    Active Items
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
                <div class="stat-card-value"><?php echo $total_categories; ?></div>
                <div class="stat-card-label">Categories</div>
                <div class="stat-card-trend">
                    <i class="fas fa-minus"></i>
                    All Categories
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
                <div class="stat-card-value"><?php echo $recent_products; ?></div>
                <div class="stat-card-label">Recent Additions</div>
                <div class="stat-card-trend">
                    <i class="fas fa-calendar"></i>
                    Last 7 Days
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-card-header">
                    <div class="stat-card-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="stat-card-value">100%</div>
                <div class="stat-card-label">Availability</div>
                <div class="stat-card-trend up">
                    <i class="fas fa-check-circle"></i>
                    All Online
                </div>
            </div>
        </div>
        
        <!-- Products Table -->
        <div class="content-card">
            <div class="content-card-header">
                <h2>Menu Items</h2>
                <span style="color: var(--admin-text-light); font-size: 0.9rem;">
                    <?php echo count($products); ?> items total
                </span>
            </div>
            <div class="content-card-body">
                <?php if (count($products) > 0): ?>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $p): ?>
                            <tr>
                                <td>
                                    <img src="../<?php echo htmlspecialchars($p['image_url']); ?>" 
                                         alt="<?php echo htmlspecialchars($p['name']); ?>"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="product-name"><?php echo htmlspecialchars($p['name']); ?></div>
                                    <?php if (!empty($p['description'])): ?>
                                    <div style="font-size: 0.85rem; color: var(--admin-text-light); margin-top: 0.25rem;">
                                        <?php echo htmlspecialchars(substr($p['description'], 0, 50)) . '...'; ?>
                                    </div>
                                    <?php
        endif; ?>
                                </td>
                                <td>
                                    <span class="product-category">
                                        <?php echo htmlspecialchars($p['category_name']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="product-price">$<?php echo number_format($p['price'], 2); ?></span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="add_product.php?edit=<?php echo $p['id']; ?>" class="btn-action btn-edit">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <a href="dashboard.php?delete=<?php echo $p['id']; ?>" 
                                           class="btn-action btn-delete"
                                           onclick="return confirm('Are you sure you want to hide this item?');">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
    endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
else: ?>
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h3>No Products Yet</h3>
                    <p>Start by adding your first product to the menu.</p>
                    <a href="add_product.php" class="btn-primary-admin">
                        <i class="fas fa-plus"></i>
                        Add Your First Product
                    </a>
                </div>
                <?php
endif; ?>
            </div>
        </div>
    </div>
</main>

<script>
// Mobile menu toggle
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const adminSidebar = document.getElementById('adminSidebar');
const sidebarOverlay = document.getElementById('sidebarOverlay');

if (mobileMenuToggle) {
    mobileMenuToggle.addEventListener('click', function() {
        adminSidebar.classList.toggle('active');
        sidebarOverlay.classList.toggle('active');
    });
}

if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', function() {
        adminSidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
    });
}
</script>

</body>
</html>
