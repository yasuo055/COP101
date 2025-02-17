<?php
include('Conn.php');

$todayFilter = $_POST['todayFilter'] ?? '';
$dayFilter = $_POST['dayFilter'] ?? '';

// Set the base query to select log details
$query = "SELECT ul.log_id, ul.USERID, 
                 CONCAT(u.FNAME, ' ', u.MNAME, ' ', u.LNAME) AS NAME, 
                 u.ROLE, u.EMAIL, 
                 DATE_FORMAT(ul.login_time, '%Y-%m-%d %h:%i:%s %p') AS login_time, 
                 ul.logout_time
          FROM user_logs ul
          JOIN USERS u ON ul.USERID = u.USERID
          WHERE 1"; // Default condition

// Apply the "Today" filter based on the dropdown value
if ($todayFilter) {
    if ($todayFilter === "1hour") {
        $query .= " AND ul.login_time >= NOW() - INTERVAL 1 HOUR"; // Last 1 hour
    } elseif ($todayFilter === "4hours") {
        $query .= " AND ul.login_time >= NOW() - INTERVAL 4 HOUR"; // Last 4 hours
    } elseif ($todayFilter === "8hours") {
        $query .= " AND ul.login_time >= NOW() - INTERVAL 8 HOUR"; // Last 8 hours
    } elseif ($todayFilter === "today") {
        // Ensure the filter compares from midnight of today (start of the day)
        $startOfToday = date('Y-m-d') . ' 00:00:00'; // Start of today at 12:00 AM
        $currentTime = date('Y-m-d H:i:s'); // Current date and time

        // Filter from midnight today to the current time
        $query .= " AND ul.login_time >= '$startOfToday' AND ul.login_time <= '$currentTime'"; 
    }
}

// Apply the "Day" filter based on the dropdown value
if ($dayFilter) {
    if ($dayFilter === "1day") {
        // 1 Day Ago
        $query .= " AND ul.login_time >= NOW() - INTERVAL 1 DAY";
    } elseif ($dayFilter === "2days") {
        // 2 Days Ago
        $query .= " AND ul.login_time >= NOW() - INTERVAL 2 DAY";
    } elseif ($dayFilter === "3days") {
        // 3 Days Ago
        $query .= " AND ul.login_time >= NOW() - INTERVAL 3 DAY";
    } elseif ($dayFilter === "4days") {
        // 4 Days Ago
        $query .= " AND ul.login_time >= NOW() - INTERVAL 4 DAY";
    } elseif ($dayFilter === "5days") {
        // 5 Days Ago
        $query .= " AND ul.login_time >= NOW() - INTERVAL 5 DAY";
    } elseif ($dayFilter === "6days") {
        // 6 Days Ago
        $query .= " AND ul.login_time >= NOW() - INTERVAL 6 DAY";
    } elseif ($dayFilter === "7days") {
        // 7 Days Ago
        $query .= " AND ul.login_time >= NOW() - INTERVAL 7 DAY";
    }
}


$query .= " ORDER BY ul.login_time DESC"; // Sort by login time

// Prepare and execute the query
$stmt = $connpdo->prepare($query);
$stmt->execute();

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
