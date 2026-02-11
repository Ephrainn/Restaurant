<?php
// check_users.php
require 'includes/db_connect.php';

echo "--- Database User Inspection ---\n";

try {
    $stmt = $pdo->query("SELECT id, username, password_hash, created_at FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Total Users Found: " . count($users) . "\n";
    echo "--------------------------------------------------\n";

    foreach ($users as $u) {
        echo "ID: " . $u['id'] . "\n";
        echo "Username: " . $u['username'] . "\n";
        echo "Hash Length: " . strlen($u['password_hash']) . "\n";
        echo "Hash Start: " . substr($u['password_hash'], 0, 10) . "...\n";
        echo "Created At: " . $u['created_at'] . "\n";
        echo "--------------------------------------------------\n";

        // Test 'password123' against this hash
        if (password_verify('password123', $u['password_hash'])) {
            echo " [MATCH] 'password123' works for this user.\n";
        }
        else {
            echo " [FAIL] 'password123' DOES NOT match.\n";
        }
        echo "--------------------------------------------------\n";
    }

}
catch (PDOException $e) {
    echo "DB Error: " . $e->getMessage() . "\n";
}
?>
