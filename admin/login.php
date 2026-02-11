<?php
// admin/login.php
session_start();
require_once '../includes/db_connect.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
$shake_class = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
        $shake_class = 'shake';
    }
    else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: dashboard.php");
                exit;
            }
            else {
                $error = "Invalid password.";
                $shake_class = 'shake';
            }
        }
        else {
            $error = "User not found.";
            $shake_class = 'shake';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Bite Hive</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card <?php echo $shake_class; ?>">
        <div class="login-header">
            <div class="login-logo">
                <i class="fas fa-utensils"></i>
            </div>
            <h1>Bite Hive Admin</h1>
            <p>Sign in to manage your restaurant</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo $error; ?></span>
            </div>
        <?php
endif; ?>
        
        <form method="POST" class="login-form">
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-user"></i>
                    Username
                </label>
                <input type="text" 
                       name="username" 
                       class="form-input"
                       placeholder="Enter your username"
                       required 
                       autofocus>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-lock"></i>
                    Password
                </label>
                <input type="password" 
                       name="password" 
                       class="form-input"
                       placeholder="Enter your password"
                       required>
            </div>
            
            <button type="submit" class="btn-primary-admin" style="width: 100%; padding: 1rem; font-size: 1rem;">
                <i class="fas fa-sign-in-alt"></i>
                Sign In
            </button>
        </form>
        
        <div class="login-footer">
            <p style="margin: 0 0 0.5rem; font-size: 0.85rem; color: var(--admin-text-muted);">
                Default credentials: <strong>admin</strong> / <strong>password123</strong>
            </p>
            <a href="../index.php">
                <i class="fas fa-home"></i>
                Back to Website
            </a>
        </div>
    </div>
</div>

</body>
</html>
