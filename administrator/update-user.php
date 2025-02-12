<?php
include 'Conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET FNAME=?, MNAME=?, LNAME=?, USERNAME=?, EMAIL=?, CONTACT=?, ROLE=? WHERE USERID=?";
    $stmt = $connpdo->prepare($sql);
    $result = $stmt->execute([$fname, $mname, $lname, $username, $email, $contact, $role, $userid]);

    echo $result ? "User updated successfully!" : "Error updating user.";
}
?>
