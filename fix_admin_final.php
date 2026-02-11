<?php
// fix_admin_final.php
require 'includes/db_connect.php';

echo "--- FINAL ADMIN FIX ---\n";

try {
    // 1. Delete existing admin to clear any bad state
    $pdo->exec("DELETE FROM users WHERE username = 'admin'");
    echo "Deleted existing 'admin' user (if any).\n";

    // 2. Create new hash
    $password = 'password123';
    $hash = password_hash($password, PASSWORD_DEFAULT);
    echo "Generated new hash for '$password'.\n";

    // 3. Insert fresh record
    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES ('admin', ?)");
    $stmt->execute([$hash]);
    echo "Inserted new 'admin' user.\n";

    // 4. Verify immediately
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        echo "VERIFICATION SUCCESS: Login will work now.\n";
    }
    else {
        echo "VERIFICATION FAILED: Something is very wrong with the DB or PHP env.\n";
    }

}
catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
