<?php
include('Conn.php'); // Your database connection file

try {
    // Define default passwords
    $defaultAdminPassword = password_hash("Admin123", PASSWORD_DEFAULT);
    $defaultUserPassword = password_hash("User123", PASSWORD_DEFAULT);

    // Update admin passwords
    $updateAdmin = $connpdo->prepare("UPDATE USERS SET PASSWORD = :hashedPassword WHERE ROLE = 'Admin'");
    $updateAdmin->bindParam(':hashedPassword', $defaultAdminPassword);
    $updateAdmin->execute();

    // Update user passwords
    $updateUser = $connpdo->prepare("UPDATE USERS SET PASSWORD = :hashedPassword WHERE ROLE = 'User'");
    $updateUser->bindParam(':hashedPassword', $defaultUserPassword);
    $updateUser->execute();

    echo "✅ Default passwords set successfully!<br>";
    echo "🔹 Admin Password: Admin123<br>";
    echo "🔹 User Password: User123<br>";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
