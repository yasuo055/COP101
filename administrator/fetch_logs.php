<?php
include('Conn.php');

// Get filters from POST request
$todayFilter = $_POST['todayFilter'] ?? '';
$dayFilter = $_POST['dayFilter'] ?? '';
$monthFilter = isset($_POST['monthFilter']) ? $_POST['monthFilter'] : ''; // Month Filter
$yearFilter = isset($_POST['yearFilter']) ? $_POST['yearFilter'] : ''; // Year Filter
$roleFilter = isset($_POST['roleFilter']) ? $_POST['roleFilter'] : ''; // Role Filter
$searchQuery = isset($_POST['searchQuery']) ? trim($_POST['searchQuery']) : ''; // New Search Query


// Set the base query to select log details
$query = "SELECT ul.log_id, ul.USERID, 
                 CONCAT(u.FNAME, ' ', u.MNAME, ' ', u.LNAME) AS NAME, 
                 u.ROLE, u.EMAIL, 
                 DATE_FORMAT(ul.login_time, '%Y-%m-%d %h:%i:%s %p') AS login_time, 
                 DATE_FORMAT(ul.logout_time, '%Y-%m-%d %h:%i:%s %p') AS logout_time
          FROM user_logs ul
          JOIN USERS u ON ul.USERID = u.USERID
          WHERE 1"; // Default condition

// Prepare an array to bind parameters
$bindParams = [];

// Apply the Search Filter for ID and Name
if (!empty($searchQuery)) {
    $query .= " AND (ul.USERID LIKE ? OR 
                     u.FNAME LIKE ? OR 
                     u.MNAME LIKE ? OR 
                     u.LNAME LIKE ? OR 
                     CONCAT(u.FNAME, ' ', u.MNAME, ' ', u.LNAME) LIKE ?)";
    $searchParam = '%' . $searchQuery . '%';
    array_push($bindParams, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
}

// Apply the "Today" filter based on the dropdown value
if (!empty($todayFilter)) {
    switch ($todayFilter) {
        case 'today':
            $query .= " AND DATE(ul.login_time) = CURDATE()";
            break;
        case 'day':
            $query .= " AND DATEDIFF(CURDATE(), DATE(ul.login_time)) = 1";
            break;
        case 'week':
            $query .= " AND WEEK(ul.login_time) = WEEK(CURDATE())";
            break;
        case 'month':
            $query .= " AND MONTH(ul.login_time) = MONTH(CURDATE())";
            break;
        default:
            break;
    }
}

// Apply the "Day" filter
if ($dayFilter) {
    if ($dayFilter === "1day") {
        $query .= " AND ul.login_time >= NOW() - INTERVAL 1 DAY";
    } elseif ($dayFilter === "2days") {
        $query .= " AND ul.login_time >= NOW() - INTERVAL 2 DAY";
    } elseif ($dayFilter === "3days") {
        $query .= " AND ul.login_time >= NOW() - INTERVAL 3 DAY";
    } elseif ($dayFilter === "4days") {
        $query .= " AND ul.login_time >= NOW() - INTERVAL 4 DAY";
    } elseif ($dayFilter === "5days") {
        $query .= " AND ul.login_time >= NOW() - INTERVAL 5 DAY";
    } elseif ($dayFilter === "6days") {
        $query .= " AND ul.login_time >= NOW() - INTERVAL 6 DAY";
    } elseif ($dayFilter === "7days") {
        $query .= " AND ul.login_time >= NOW() - INTERVAL 7 DAY";
    }
}

// Apply the Month Filter
if (!empty($monthFilter)) {
    $query .= " AND MONTH(ul.login_time) = ?";
    $bindParams[] = $monthFilter;
}

// Apply the Year Filter
if (!empty($yearFilter)) {
    $query .= " AND YEAR(ul.login_time) = ?";
    $bindParams[] = $yearFilter;
}

// Apply the Role Filter
if (!empty($roleFilter)) {
    $query .= " AND u.ROLE = ?";
    $bindParams[] = $roleFilter;
}

// Finalize the query with ORDER BY clause
$query .= " ORDER BY ul.login_time DESC"; // Sort by login time

// Prepare and execute the query
$stmt = $connpdo->prepare($query);
$stmt->execute($bindParams);

if ($stmt->rowCount() > 0) {
    while ($log = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . htmlspecialchars($log['USERID']) . "</td>
                <td>" . htmlspecialchars($log['NAME']) . "</td>
                <td>" . htmlspecialchars($log['ROLE']) . "</td>
                <td>" . htmlspecialchars($log['EMAIL']) . "</td>
                <td>" . htmlspecialchars($log['login_time']) . "</td>
                <td>" . ($log['logout_time'] ? htmlspecialchars($log['logout_time']) : 'Still logged in') . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No logs found</td></tr>";
}
?>
