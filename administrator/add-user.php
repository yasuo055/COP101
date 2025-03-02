<?php
include 'Conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];
    $archived = 0; // New account default value

    // Set the default password based on the role
    $defaultPassword = $role === 'admin' ? 'admin123' : 'user123';
    $password = password_hash($defaultPassword, PASSWORD_BCRYPT);

    // Get the current date and time
    $dateCreated = date('Y-m-d H:i:s');

    // Updated query to include DATECREATED column
    $sql = ("INSERT INTO users (FNAME, MNAME, LNAME, USERNAME, PASSWORD, EMAIL, CONTACT, ROLE, archived, DATECREATED) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt = $connpdo->prepare($sql);
    $result = $stmt->execute([$fname, $mname, $lname, $username, $password, $email, $contact, $role, $archived, $dateCreated]);

    echo $result ? "User added successfully with default password: $defaultPassword" : "Error adding user.";
}
?>
