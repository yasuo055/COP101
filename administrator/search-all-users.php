<?php
require 'Conn.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT * FROM users 
        WHERE archived = 0 
        AND (CONCAT(FNAME, ' ', MNAME, ' ', LNAME) LIKE :search 
        OR USERNAME LIKE :search 
        OR USERID LIKE :search 
        OR EMAIL LIKE :search)";


$stmt = $connpdo->prepare($sql);
$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
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
                  
 
    <button class='action-btn edit-btn' 
        data-userid='" . $row['USERID'] . "' 
        data-fname='" . $row['FNAME'] . "' 
        data-mname='" . $row['MNAME'] . "' 
        data-lname='" . $row['LNAME'] . "' 
        data-username='" . $row['USERNAME'] . "' 
        data-email='" . $row['EMAIL'] . "' 
        data-contact='" . $row['CONTACT'] . "' 
        data-role='" . $row['ROLE'] . "'>
        Edit
    </button>

    <button class='action-btn archive-btn' data-id='" . $row['USERID'] . "'>Archive</button>
</td>
";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No users found</td></tr>";
    }

?>
