<?php
session_start();
include('Conn.php');

if (isset($_SESSION['USERID'])) {
    $stmt = $connpdo->prepare("UPDATE user_logs SET logout_time = NOW() WHERE USERID = :userid ORDER BY login_time DESC LIMIT 1");
    $stmt->execute([':userid' => $_SESSION['USERID']]);
}

// Destroy session and redirect to login page
session_destroy();
header("Location: login.php");
exit;
?>
