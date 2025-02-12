<?php
include('Conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["userid"])) {
    $userid = $_POST["userid"];

    // Update the `archived` column in the database
    $sql = "UPDATE users SET archived = 1 WHERE USERID = ?";
    $stmt = $connpdo->prepare($sql);
    
    if ($stmt->execute([$userid])) {
        echo "User archived successfully!";
    } else {
        echo "Failed to archive user.";
    }
} else {
    echo "Invalid request.";
}
?>
