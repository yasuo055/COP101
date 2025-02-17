<?php
require 'Conn.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT USERID, CONCAT(FNAME, ' ', COALESCE(MNAME, ''), ' ', LNAME) AS FULLNAME, 
               USERNAME, EMAIL, 
               COALESCE(CONTACT, 'N/A') AS CONTACT, 
               DATE_FORMAT(DATECREATED, '%Y-%m-%d %r') AS DATECREATED, 
               ROLE 
        FROM users 
        WHERE archived = 0 
        AND (CONCAT(FNAME, ' ', COALESCE(MNAME, ''), ' ', LNAME) LIKE :search 
        OR USERNAME LIKE :search 
        OR USERID LIKE :search 
        OR EMAIL LIKE :search) 
        ORDER BY DATECREATED DESC";

$stmt = $connpdo->prepare($sql);
$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['USERID']) . "</td>";
        echo "<td>" . htmlspecialchars($row['FULLNAME']) . "</td>";
        echo "<td>" . htmlspecialchars($row['USERNAME']) . "</td>";
        echo "<td>" . htmlspecialchars($row['EMAIL']) . "</td>";
        echo "<td>" . htmlspecialchars($row['CONTACT']) . "</td>"; 
        echo "<td>" . htmlspecialchars($row['DATECREATED']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ROLE']) . "</td>";
        echo "<td>
            <button class='action-btn edit-btn' 
                data-userid='" . htmlspecialchars($row['USERID']) . "' 
                data-fname='" . htmlspecialchars($row['FULLNAME']) . "' 
                data-username='" . htmlspecialchars($row['USERNAME']) . "' 
                data-email='" . htmlspecialchars($row['EMAIL']) . "' 
                data-contact='" . htmlspecialchars($row['CONTACT']) . "' 
                data-role='" . htmlspecialchars($row['ROLE']) . "'>
                Edit
            </button>

            <button class='action-btn archive-btn' data-id='" . htmlspecialchars($row['USERID']) . "'>Archive</button>
        </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No users found</td></tr>";
}
?>
