<?php
// reset_admin.php
require 'includes/db_connect.php';

$username = 'admin';
$password = 'password123';
$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    // Check if admin exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->fetch()) {
        // Update existing admin
        $updateFor = $pdo->prepare("UPDATE users SET password_hash = ? WHERE username = ?");
        $updateFor->execute([$hash, $username]);
        echo "<h1>Success!</h1><p>Admin password has been reset to: <strong>$password</strong></p>";
        echo "<p>User '$username' updated.</p>";
    }
    else {
        // Create admin if missing
        $insert = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
        $insert->execute([$username, $hash]);
        echo "<h1>Success!</h1><p>Admin user created with password: <strong>$password</strong></p>";
    }
    echo "<br><a href='admin/login.php'>Go to Login</a>";

}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
