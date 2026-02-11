<?php
// admin/orders.php
session_start();
require_once '../includes/db_connect.php';

// Auth Check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Handle Status Updates
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = (int)$_GET['id'];
    $status = $_GET['status'];
    $allowed_status = ['pending', 'processing', 'delivered', 'cancelled'];
    if (in_array($status, $allowed_status)) {
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }
    header("Location: orders.php");
    exit;
}

// Fetch Orders
$stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
$orders = $stmt->fetchAll();

// Get username
$username = $_SESSION['username'];
$user_initial = strtoupper(substr($username, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Bite Hive Admin</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="admin-body">

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <i class="fas fa-utensils"></i>
            <h2>Bite Hive</h2>
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-th-large"></i><span>Dashboard</span></a></li>
            <li><a href="reservations.php"><i class="fas fa-calendar-check"></i><span>Reservations</span></a></li>
            <li><a href="orders.php" class="active"><i class="fas fa-shopping-bag"></i><span>Orders</span></a></li>
            <li><a href="add_product.php"><i class="fas fa-plus-circle"></i><span>Add Product</span></a></li>
            <li><a href="../menu.php" target="_blank"><i class="fas fa-eye"></i><span>View Website</span></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
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

<main class="admin-main">
    <header class="admin-header">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Manage Orders</h1>
        </div>
    </header>
    
    <div class="admin-content">
        <div class="content-card">
            <div class="content-card-header">
                <h2>All Orders</h2>
                <span style="color: var(--admin-text-light); font-size: 0.9rem;">
                    <?php echo count($orders); ?> orders total
                </span>
            </div>
            <div class="content-card-body">
                <?php if (count($orders) > 0): ?>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Address</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $o): ?>
                            <tr>
                                <td>#<?php echo $o['id']; ?></td>
                                <td>
                                    <div style="font-weight: 600;"><?php echo htmlspecialchars($o['customer_name']); ?></div>
                                    <div style="font-size: 0.85rem;"><?php echo htmlspecialchars($o['phone']); ?></div>
                                </td>
                                <td style="max-width: 200px; font-size: 0.9rem;"><?php echo htmlspecialchars($o['address']); ?></td>
                                <td style="font-weight: 700; color: var(--admin-primary);">$<?php echo number_format($o['total_amount'], 2); ?></td>
                                <td>
                                    <span class="badge status-<?php echo $o['status']; ?>" style="padding: 0.4rem 0.8rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">
                                        <?php echo $o['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <select onchange="window.location.href='orders.php?id=<?php echo $o['id']; ?>&status='+this.value">
                                            <option value="">Update Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="processing">Processing</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
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
                    <i class="fas fa-shopping-basket"></i>
                    <h3>No Orders Yet</h3>
                    <p>Orders from the cart will appear here after customers checkout.</p>
                </div>
                <?php
endif; ?>
            </div>
        </div>
    </div>
</main>

<style>
.badge.status-pending { background: #fff3e0; color: #ef6c00; }
.badge.status-processing { background: #e3f2fd; color: #1976d2; }
.badge.status-delivered { background: #e8f5e9; color: #2e7d32; }
.badge.status-cancelled { background: #ffebee; color: #c62828; }
.action-buttons select { padding: 0.4rem; border-radius: 4px; border: 1px solid #ddd; outline: none; }
</style>

<script>
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
