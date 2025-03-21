<?php
include 'Conn.php'; // Include your PDO database connection

// Fetch parameters from POST
$role = isset($_POST['role']) ? trim($_POST['role']) : '';
$timePeriod = isset($_POST['timePeriod']) ? trim($_POST['timePeriod']) : '';

// Base SQL Query
$sql = "SELECT 
    USERID, 
    CONCAT(FNAME, ' ', MNAME, ' ', LNAME) AS FULLNAME,  -- Combine names
    USERNAME, 
    EMAIL, 
    CONTACT, 
    DATE_FORMAT(DATECREATED, '%Y-%m-%d') AS DATECREATED, 
    ROLE 
FROM users 
WHERE archived != 1";  // Base WHERE condition

// Prepare parameters
$params = [];

// Apply role filter
if (!empty($role)) {
    $sql .= " AND ROLE = :role";
    $params[':role'] = $role;
}

// Apply timePeriod filter (if any)
if (!empty($timePeriod)) {
    switch ($timePeriod) {
        case 'today':
            $sql .= " AND DATE(DATECREATED) = CURDATE()";
            break;
        case 'day':
            $sql .= " AND DATEDIFF(CURDATE(), DATECREATED) = 1";
            break;
        case 'week':
            $sql .= " AND WEEK(DATECREATED) = WEEK(CURDATE())";
            break;
        case 'month':
            $sql .= " AND MONTH(DATECREATED) = MONTH(CURDATE())";
            break;
    }
}

// Finalize with ORDER BY
$sql .= " ORDER BY DATECREATED DESC";

$stmt = $connpdo->prepare($sql);

// Bind parameters
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value, PDO::PARAM_STR);
}

$stmt->execute();   

// Output results
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
