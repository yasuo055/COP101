<?php
include('Conn.php'); // Your database connection file

try {
    // Fetch all users with plain text passwords
    $stmt = $connpdo->query("SELECT USERID, PASSWORD FROM USERS");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        $userId = $user['USERID'];
        $plainPassword = $user['PASSWORD'];

        // Check if already hashed (bcrypt starts with '$2y$')
        if (!password_get_info($plainPassword)['algo']) {
            // Hash the password using bcrypt
            $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

            // Update the database with the hashed password
            $updateStmt = $connpdo->prepare("UPDATE USERS SET PASSWORD = :hashedPassword WHERE USERID = :userId");
            $updateStmt->bindParam(':hashedPassword', $hashedPassword);
            $updateStmt->bindParam(':userId', $userId);
            $updateStmt->execute();

            echo "✅ Updated USERID $userId password successfully!<br>";
        }
    }

    echo "✅ All passwords are now hashed using bcrypt!";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
