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

    try {
        // Check for duplicate username, email, or contact (excluding the current user)
        $checkSql = "SELECT USERNAME, EMAIL, CONTACT FROM users WHERE (USERNAME = ? OR EMAIL = ? OR CONTACT = ?) AND USERID != ?";
        $checkStmt = $connpdo->prepare($checkSql);
        $checkStmt->execute([$username, $email, $contact, $userid]);

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
            // No duplicates, proceed with the update
            $sql = "UPDATE users SET FNAME=?, MNAME=?, LNAME=?, USERNAME=?, EMAIL=?, CONTACT=?, ROLE=? WHERE USERID=?";
            $stmt = $connpdo->prepare($sql);
            
            if ($stmt->execute([$fname, $mname, $lname, $username, $email, $contact, $role, $userid])) {
                echo "success"; // Send a plain "success" message
            } else {
                echo "Failed to update user. Please try again.";
            }
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>


