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

    // Check if the user already exists
    $checkSql = "SELECT * FROM users WHERE USERNAME = ? OR EMAIL = ? OR CONTACT = ?";
    $checkStmt = $connpdo->prepare($checkSql);
    $checkStmt->execute([$username, $email, $contact]);

    if ($checkStmt->rowCount() > 0) {
        $existingUser = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingUser['USERNAME'] === $username) {
            echo "Username already exists!";
        } elseif ($existingUser['EMAIL'] === $email) {
            echo "Email already registered!";
        } elseif ($existingUser['CONTACT'] === $contact) {
            echo "Contact number already in use!";
        }
    } else {
        // Set the default password based on the role
        $defaultPassword = $role === 'Admin' ? 'admin123' : 'user123';
        $password = password_hash($defaultPassword, PASSWORD_BCRYPT);

        // Get the current date and time
        $dateCreated = date('Y-m-d H:i:s');

        // Insert the user if no duplicate is found
        $sql = "INSERT INTO users (FNAME, MNAME, LNAME, USERNAME, PASSWORD, EMAIL, CONTACT, ROLE, archived, DATECREATED) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $connpdo->prepare($sql);
        $result = $stmt->execute([$fname, $mname, $lname, $username, $password, $email, $contact, $role, $archived, $dateCreated]);

        echo $result ? "User added successfully" : "Error adding user.";
    }
}
?>
