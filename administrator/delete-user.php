<?php
require 'Conn.php'; // Your database connection file

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['userid'])) {
    $userid = $_POST['userid'];

    // Delete user permanently
    $sql = "DELETE FROM users WHERE USERID = :userid";
    $stmt = $connpdo->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "User deleted permanently!";
    } else {
        echo "Error deleting user!";
    }
} else {
    echo "Invalid request!";
}
?>
