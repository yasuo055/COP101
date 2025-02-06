<?php
include('Conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET 
            FNAME = :fname,
            MNAME = :mname,
            LNAME = :lname,
            USERNAME = :username,
            EMAIL = :email,
            CONTACT = :contact,
            ROLE = :role
            WHERE USERID = :userid";

    $stmt = $connpdo->prepare($sql);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':mname', $mname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Error updating user: " . implode(" ", $stmt->errorInfo());
    }
}