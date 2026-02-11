<?php
// admin/reservations.php
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
    if (in_array($status, ['confirmed', 'cancelled', 'pending'])) {
        $stmt = $pdo->prepare("UPDATE reservations SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }
    header("Location: reservations.php");
    exit;
}

// Fetch Reservations
$stmt = $pdo->query("SELECT * FROM reservations ORDER BY reservation_date DESC, reservation_time DESC");
$reservations = $stmt->fetchAll();

// Get username
$username = $_SESSION['username'];
$user_initial = strtoupper(substr($username, 0, 1));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations - Bite Hive Admin</title>
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
            <li>
                <a href="dashboard.php">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="reservations.php" class="active">
                    <i class="fas fa-calendar-check"></i>
                    <span>Reservations</span>
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

<main class="admin-main">
    <header class="admin-header">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Manage Reservations</h1>
        </div>
    </header>
    
    <div class="admin-content">
        <div class="content-card">
            <div class="content-card-header">
                <h2>All Bookings</h2>
                <span style="color: var(--admin-text-light); font-size: 0.9rem;">
                    <?php echo count($reservations); ?> reservations total
                </span>
            </div>
            <div class="content-card-body">
                <?php if (count($reservations) > 0): ?>
                <div class="admin-table-wrapper">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Contact</th>
                                <th>Date & Time</th>
                                <th>Guests</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reservations as $r): ?>
                            <tr>
                                <td>
                                    <div style="font-weight: 600;"><?php echo htmlspecialchars($r['customer_name']); ?></div>
                                    <div style="font-size: 0.85rem; color: var(--admin-text-light);">
                                        <?php echo htmlspecialchars($r['special_requests']); ?>
                                    </div>
                                </td>
                                <td>
                                    <div style="font-size: 0.9rem;"><?php echo htmlspecialchars($r['email']); ?></div>
                                    <div style="font-size: 0.9rem;"><?php echo htmlspecialchars($r['phone']); ?></div>
                                </td>
                                <td>
                                    <div style="font-weight: 500;"><?php echo date('M d, Y', strtotime($r['reservation_date'])); ?></div>
                                    <div style="font-size: 0.9rem; color: var(--admin-text-light);"><?php echo date('h:i A', strtotime($r['reservation_time'])); ?></div>
                                </td>
                                <td>
                                    <span style="background: #eee; padding: 0.2rem 0.6rem; border-radius: 50px; font-size: 0.85rem;">
                                        <?php echo $r['guest_count']; ?> Guests
                                    </span>
                                </td>
                                <td>
                                    <?php
        $status_class = '';
        if ($r['status'] == 'confirmed')
            $status_class = 'status-confirmed';
        elseif ($r['status'] == 'cancelled')
            $status_class = 'status-cancelled';
        else
            $status_class = 'status-pending';
?>
                                    <span class="badge <?php echo $status_class; ?>" style="padding: 0.4rem 0.8rem; border-radius: 50px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase;">
                                        <?php echo $r['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <?php if ($r['status'] != 'confirmed'): ?>
                                        <a href="reservations.php?id=<?php echo $r['id']; ?>&status=confirmed" class="btn-action btn-edit" style="color: #2e7d32;">
                                            <i class="fas fa-check"></i> Confirm
                                        </a>
                                        <?php
        endif; ?>
                                        <?php if ($r['status'] != 'cancelled'): ?>
                                        <a href="reservations.php?id=<?php echo $r['id']; ?>&status=cancelled" class="btn-action btn-delete" style="color: #c62828;">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                        <?php
        endif; ?>
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
                    <i class="fas fa-calendar-times"></i>
                    <h3>No Reservations Yet</h3>
                    <p>When customers book tables, they will appear here.</p>
                </div>
                <?php
endif; ?>
            </div>
        </div>
    </div>
</main>

<style>
.badge.status-confirmed { background: #e8f5e9; color: #2e7d32; }
.badge.status-cancelled { background: #ffebee; color: #c62828; }
.badge.status-pending { background: #fff3e0; color: #ef6c00; }
</style>

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
