<?php
// debug_admin.php
require 'includes/db_connect.php';

echo "--- Debugging Admin Login ---\n";

// 1. Check DB Connection
if ($pdo) {
    echo "Database: Connected\n";
}
else {
    echo "Database: Connection Failed\n";
    exit;
}

// 2. Check if admin user exists
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "User 'admin': Found\n";
    echo "ID: " . $user['id'] . "\n";
    echo "Stored Hash: " . $user['password_hash'] . "\n";

    // 3. Test Password Verification
    $password = 'password123';
    if (password_verify($password, $user['password_hash'])) {
        echo "Password 'password123': MATCHES hash\n";
    }
    else {
        echo "Password 'password123': DOES NOT MATCH hash\n";

        // Detailed check
        echo "Re-hashing 'password123' to compare info:\n";
        $info = password_get_info($user['password_hash']);
        print_r($info);
    }
}
else {
    echo "User 'admin': NOT FOUND\n";
}

// 4. Check Session Save Path (sometimes an issue on XAMPP)
echo "Session Save Path: " . session_save_path() . "\n";

?>
