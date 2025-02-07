<?php
require 'Conn.php'; // Your database connection file

$sql = "SELECT * FROM users WHERE archived = 1"; // Get only archived users
$stmt = $connpdo->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Users</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your styles -->
</head>
<body>
    <h2>Archived Users</h2>
    <a href="users.php">Back to Active Users</a>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Date Created</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        
        <?php if ($stmt->rowCount() > 0): ?>
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= $row['USERID'] ?></td>
                    <td><?= $row['FNAME'] . " " . $row['MNAME'] . " " . $row['LNAME'] ?></td>
                    <td><?= $row['USERNAME'] ?></td>
                    <td><?= $row['EMAIL'] ?></td>
                    <td><?= $row['CONTACT'] ?: 'N/A' ?></td>
                    <td><?= $row['DATECREATED'] ?></td>
                    <td><?= $row['ROLE'] ?></td>
                    <td>
                        <a href='restore-user.php?userid=<?= $row['USERID'] ?>' 
                           onclick='return confirm("Restore this user?")'>
                            <button class='action-btn restore-btn'>Restore</button>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8">No archived users found</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
