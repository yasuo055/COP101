<?php
include 'Conn.php';

$sql = "SELECT USERID, FNAME, MNAME, LNAME, USERNAME, EMAIL, CONTACT, DATECREATED, ROLE FROM users";
$sql = "SELECT * FROM users WHERE archived = 0"; // Show only non-archived users
$stmt = $connpdo->prepare($sql);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
