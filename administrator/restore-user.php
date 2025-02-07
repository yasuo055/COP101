<?php
require 'Conn.php';

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    $sql = "UPDATE users SET archived = 0 WHERE USERID = :userid";
    $stmt = $connpdo->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('User restored successfully!'); window.location.href='archived-users.php';</script>";
        header("Location: archive-users.php"); // Redirect back to the user management page
        exit();
    } else {
        echo "<script>alert('Error restoring user!'); window.history.back();</script>";
    }
}



?>
