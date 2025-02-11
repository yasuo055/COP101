
<?php
include 'Conn.php'; // Include your PDO database connection

$role = isset($_POST['role']) ? trim($_POST['role']) : '';

// Base SQL Query
$sql = "SELECT * FROM users WHERE archived != 1";
$params = [];

if (!empty($role)) {
    $sql .= " AND ROLE = :role";
    $params[':role'] = $role;
}

$stmt = $connpdo->prepare($sql);

foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value, PDO::PARAM_STR);
}

$stmt->execute();   

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['USERID']) . "</td>";
        echo "<td>" . htmlspecialchars($row['FNAME'] . " " . $row['MNAME'] . " " . $row['LNAME']) . "</td>";
        echo "<td>" . htmlspecialchars($row['USERNAME']) . "</td>";
        echo "<td>" . htmlspecialchars($row['EMAIL']) . "</td>";
        echo "<td>" . ($row['CONTACT'] ? htmlspecialchars($row['CONTACT']) : 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['DATECREATED']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ROLE']) . "</td>";
        echo "<td>
                <a href='edit-user.php?userid=" . htmlspecialchars($row['USERID']) . "'>
                    <button class='action-btn edit-btn'>Edit</button>
                </a>
                <button class='action-btn archive-btn' data-id='" . htmlspecialchars($row['USERID']) . "'>Archive</button>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No users found</td></tr>";
}
?>

