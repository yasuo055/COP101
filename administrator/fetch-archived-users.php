<?php
include('Conn.php');

$role = isset($_GET['role']) ? $_GET['role'] : '';

// Base query for archived users
$sql = "SELECT * FROM users WHERE archived = 1";

// Apply role filter if selected
if (!empty($role)) {
    $sql .= " AND ROLE = :role";  // Ensure role is filtered correctly
}

$stmt = $connpdo->prepare($sql);

if (!empty($role)) {
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
}

$stmt->execute();

// Check if data exists
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['USERID']}</td>
                <td>{$row['FNAME']} {$row['MNAME']} {$row['LNAME']}</td>
                <td>{$row['USERNAME']}</td>
                <td>{$row['EMAIL']}</td>
                <td>" . (!empty($row['CONTACT']) ? $row['CONTACT'] : 'N/A') . "</td>
                <td>{$row['DATECREATED']}</td>
                <td>{$row['ROLE']}</td>
                <td>
                    <a href='restore-user.php?userid={$row['USERID']}'>
                        <button class='action-btn restore-btn'>Restore</button>
                    </a>
                    <a href='delete-user.php?userid={$row['USERID']}'>
                        <button class='action-btn delete-btn'>Delete</button>
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No archived users found</td></tr>";
}
?>
