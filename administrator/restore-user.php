<?php
require 'Conn.php';

if (isset($_POST['userid'])) {  // Use POST to match fetch request
    $userid = $_POST['userid'];

    $sql = "UPDATE users SET archived = 0 WHERE USERID = :userid";
    $stmt = $connpdo->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "User restored successfully!";
    } else {
        echo "Error restoring user!";
    }
}
?>
