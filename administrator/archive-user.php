<?php
include('Conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userid'];

    $sql = "UPDATE users SET archived = 1 WHERE USERID = :userID";
    $stmt = $connpdo->prepare($sql);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "User archived successfully!";
    } else {
        echo "Error archiving user.";
    }
}
?>
