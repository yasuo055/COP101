<?php
require_once 'Conn.php';

$records_per_page = isset($_GET['records']) ? (int)$_GET['records'] : 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Get filters and search query from POST or GET requests
$todayFilter = $_REQUEST['todayFilter'] ?? '';
$dayFilter = $_REQUEST['dayFilter'] ?? '';
$monthFilter = $_REQUEST['monthFilter'] ?? '';
$yearFilter = $_REQUEST['yearFilter'] ?? '';
$roleFilter = $_REQUEST['roleFilter'] ?? '';
$searchQuery = trim($_REQUEST['searchQuery'] ?? '');

$query = "
    SELECT ul.log_id, ul.USERID, 
           CONCAT(u.FNAME, ' ', u.MNAME, ' ', u.LNAME) AS NAME, 
           u.ROLE, u.EMAIL, 
           DATE_FORMAT(ul.login_time, '%Y-%m-%d %h:%i:%s %p') AS login_time,
           DATE_FORMAT(ul.logout_time, '%Y-%m-%d %h:%i:%s %p') AS logout_time
    FROM user_logs ul
    JOIN USERS u ON ul.USERID = u.USERID
    WHERE 1=1
";

$bindParams = [];

// Apply the Search Filter
if (!empty($searchQuery)) {
    $query .= " AND (ul.USERID LIKE ? OR 
                     u.FNAME LIKE ? OR 
                     u.MNAME LIKE ? OR 
                     u.LNAME LIKE ? OR 
                     CONCAT(u.FNAME, ' ', u.MNAME, ' ', u.LNAME) LIKE ?)
    ";
    $searchParam = '%' . $searchQuery . '%';
    array_push($bindParams, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
}

// Apply filters (Today, Day, Month, Year, Role)
if (!empty($todayFilter)) {
    switch ($todayFilter) {
        case 'today':
            $query .= " AND DATE(ul.login_time) = CURDATE()";
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
$query .= " ORDER BY ul.login_time DESC LIMIT ?, ?";
array_push($bindParams, $offset, $records_per_page);

$stmt = $connpdo->prepare($query);

// Bind parameters dynamically
foreach ($bindParams as $key => $value) {
    $stmt->bindValue($key + 1, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
}

$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get total count for pagination
$total_records_query = "SELECT COUNT(*)
                        FROM user_logs ul
                        JOIN USERS u ON ul.USERID = u.USERID
                        WHERE 1=1";

if (!empty($searchQuery)) {
    $total_records_query .= " AND (ul.USERID LIKE ? OR 
                                   u.FNAME LIKE ? OR 
                                   u.MNAME LIKE ? OR 
                                   u.LNAME LIKE ? OR 
                                   CONCAT(u.FNAME, ' ', u.MNAME, ' ', u.LNAME) LIKE ?)
    ";
}

$count_stmt = $connpdo->prepare($total_records_query);

if (!empty($searchQuery)) {
    foreach (array_fill(0, 5, '%' . $searchQuery . '%') as $key => $value) {
        $count_stmt->bindValue($key + 1, $value, PDO::PARAM_STR);
    }
}

$count_stmt->execute();
$total_records = $count_stmt->fetchColumn();
$total_pages = ceil($total_records / $records_per_page);

header('Content-Type: application/json');
echo json_encode([
    'logs' => $records,
    'total_pages' => $total_pages
]);

?>
