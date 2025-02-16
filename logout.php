<?php
session_start();
include('Conn.php');

if (isset($_SESSION['USERID'])) {
    try {
        // Update the most recent login entry for this user
        $stmt = $connpdo->prepare("
            UPDATE user_logs 
            SET logout_time = NOW() 
            WHERE USERID = :userid 
            AND logout_time IS NULL 
            ORDER BY login_time DESC 
            LIMIT 1
        ");

        $stmt->execute([':userid' => $_SESSION['USERID']]);

        if ($stmt->rowCount() > 0) {
            error_log("User ID " . $_SESSION['USERID'] . " successfully logged out.");
        } else {
            error_log("Logout update failed for User ID " . $_SESSION['USERID']);
        }
    } catch (PDOException $e) {
        error_log("Logout error: " . $e->getMessage());
    }
}

// Destroy session properly
$_SESSION = []; // Clear all session variables
session_unset();
session_destroy();

// Redirect to login page
header("Location: login.php");
exit;
?>
