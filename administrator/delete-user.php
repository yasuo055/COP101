<?php
require 'Conn.php'; // Your database connection file

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    // Delete user permanently
    $sql = "DELETE FROM users WHERE USERID = :userid";
    $stmt = $connpdo->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted permanently!'); window.location.href='archived-users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user!'); window.history.back();</script>";
    }
}
?>
