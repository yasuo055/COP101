
<?php
require 'Conn.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT USERID, CONCAT(FNAME, ' ', COALESCE(MNAME, ''), ' ', LNAME) AS FULLNAME, 
               USERNAME, EMAIL, 
               COALESCE(CONTACT, 'N/A') AS CONTACT, 
               DATE_FORMAT(DATECREATED, '%Y-%m-%d %r') AS DATECREATED, 
               ROLE 
        FROM users 
        WHERE archived = 1 
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
            // echo "<td>" . htmlspecialchars($row['FNAME'] . " " . $row['MNAME'] . " " . $row['LNAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['FULLNAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['USERNAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['EMAIL']) . "</td>";
            echo "<td>" . ($row['CONTACT'] ? htmlspecialchars($row['CONTACT']) : 'N/A') . "</td>"; 
            echo "<td>" . htmlspecialchars($row['DATECREATED']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ROLE']) . "</td>";
            echo "<td>
                    <a href='restore-user.php?userid=" . $row['USERID'] . "'>
                        <button class='action-btn restore-btn'>Restore</button>
                    </a>
                    <a href='delete-user.php?userid=" . $row['USERID'] . "' onclick='return'>
                        <button class='action-btn delete-btn'>Delete</button>
                    </a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No archived users found</td></tr>";
    }

?>

