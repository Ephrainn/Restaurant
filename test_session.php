<?php
// test_session.php
session_start();

if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
    echo "Session started. Count initialized.";
}
else {
    $_SESSION['count']++;
    echo "Session active. Count: " . $_SESSION['count'];
}

echo "<br>Session ID: " . session_id();
echo "<br>Save Path: " . session_save_path();
echo "<br>Writable? " . (is_writable(session_save_path()) ? 'Yes' : 'No');
?>
