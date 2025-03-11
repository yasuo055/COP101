<?php
include('Conn.php');

$role = isset($_GET['role']) ? $_GET['role'] : '';

// Base query for archived users
$sql = "SELECT USERID, FNAME, MNAME, LNAME, USERNAME, EMAIL, CONTACT, 
           DATE_FORMAT(DATECREATED, '%Y-%m-%d %r') AS DATECREATED, ROLE 
    FROM users 
    WHERE archived = 1
    ";

// Apply role filter if selected
if (!empty($role)) {
    $sql .= " AND ROLE = :role";  // Ensure role is filtered correctly
}


// Apply the "Today" filter based on the dropdown value
// if (!empty($todayFilter)) {
//     switch ($todayFilter) {
//         case 'today':
//             $sql .= " AND DATE(ul.login_time) = CURDATE()";
//             break;
//         case 'day':
//             $sql .= " AND DATEDIFF(CURDATE(), DATE(ul.login_time)) = 1";
//             break;
//         case 'week':
//             $sql .= " AND WEEK(ul.login_time) = WEEK(CURDATE())";
//             break;
//         case 'month':
//             $sql .= " AND MONTH(ul.login_time) = MONTH(CURDATE())";
//             break;
//         default:
//             break;
//     }
// }


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
                     <button class='action-btn restore-btn' data-id='{$row['USERID']}'>Restore</button
                    <a href='delete-user.php?userid={$row['USERID']}'>
                       
                    </a>
                     <button class='action-btn delete-btn' data-id='{$row['USERID']}'>Delete</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No archived users found</td></tr>";
}
?>
