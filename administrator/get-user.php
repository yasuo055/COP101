<?php
include('Conn.php');

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    $sql = "SELECT * FROM users WHERE USERID = :userid";
    $stmt = $connpdo->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($user);
}
?>
