<?php
include('Conn.php');

// Get filters and search query from POST or GET requests
$todayFilter = $_REQUEST['todayFilter'] ?? '';
$dayFilter = $_REQUEST['dayFilter'] ?? '';
$monthFilter = $_REQUEST['monthFilter'] ?? '';
$yearFilter = $_REQUEST['yearFilter'] ?? '';
$roleFilter = $_REQUEST['roleFilter'] ?? '';
$searchQuery = trim($_REQUEST['searchQuery'] ?? '');

// Set limit (adjust as needed)
$limit = 5;

// Set the base query to select log details
$query = "SELECT ul.log_id, ul.USERID, 
                 CONCAT(u.FNAME, ' ', u.MNAME, ' ', u.LNAME) AS NAME, 
                 u.ROLE, u.EMAIL, 
                 DATE_FORMAT(ul.login_time, '%Y-%m-%d %h:%i:%s %p') AS login_time, 
                 DATE_FORMAT(ul.logout_time, '%Y-%m-%d %h:%i:%s %p') AS logout_time
          FROM user_logs ul
          ORDER BY ul.login_time DESC
          JOIN users u ON ul.USERID = u.USERID
          WHERE 1";

// Prepare an array to bind parameters
$bindParams = [];

// Apply the Search Filter
if (!empty($searchQuery)) {
    $query .= " AND (ul.USERID LIKE ? OR 
                     u.FNAME LIKE ? OR 
                     u.MNAME LIKE ? OR 
                     u.LNAME LIKE ? OR 
                     CONCAT(u.FNAME, ' ', u.MNAME, ' ', u.LNAME) LIKE ? )";
    $searchParam = '%' . $searchQuery . '%';
    array_push($bindParams, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
}

// Apply filters (Today, Day, Month, Year, Role)
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
    }
}

if (!empty($dayFilter)) {
    $query .= " AND ul.login_time >= NOW() - INTERVAL ? DAY";
    $bindParams[] = (int)filter_var($dayFilter, FILTER_SANITIZE_NUMBER_INT);
}

if (!empty($monthFilter)) {
    $query .= " AND MONTH(ul.login_time) = ?";
    $bindParams[] = $monthFilter;
}

if (!empty($yearFilter)) {
    $query .= " AND YEAR(ul.login_time) = ?";
    $bindParams[] = $yearFilter;
}

if (!empty($roleFilter)) {
    $query .= " AND u.ROLE = ?";
    $bindParams[] = $roleFilter;
}

// Add ORDER BY and LIMIT
$limit = isset($_REQUEST['limit']) ? (int)$_REQUEST['limit'] : 5;
$query .= " ORDER BY ul.login_time DESC LIMIT " . $limit;


// Prepare and execute the query
$stmt = $connpdo->prepare($query);

// Bind the limit as an integer
$stmt->bindValue(':limit', 100, PDO::PARAM_INT);

$stmt->execute($bindParams);


// Render logs
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

<!-- Let me know if you want me to add pagination or tweak the limit further! 🚀 -->