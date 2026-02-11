<?php
// setup_db.php
$host = 'localhost';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents('database.sql');

    // Execute the SQL commands
    // Execute the SQL commands from the file
    $pdo->exec($sql);

    // Force update the admin password to a valid hash
    // This ensures that regardless of what's in database.sql, the password 'password123' will work.
    $password = 'password123';
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // We need to connect to the specific database now to update the user
    $pdo->exec("USE restaurant_db");
    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE username = 'admin'");
    $stmt->execute([$hash]);

    echo "<h1>Setup Complete!</h1>";
    echo "<p>Database tables created and Admin user configured.</p>";
    echo "<p><strong>Admin Credentials:</strong> admin / password123</p>";
    echo "<br><a href='index.php'>Go to Home</a> | <a href='admin/login.php'>Go to Admin Login</a>";

}
catch (PDOException $e) {
    die("DB Setup Failed: " . $e->getMessage());
}
?>
