<?php
header('Content-Type: application/json');
require_once 'Conn.php'; // Include your existing database connection

try {
    // Default query to fetch only non-archived users
    $sql = "SELECT USERID, FNAME, MNAME, LNAME, USERNAME, EMAIL, CONTACT, DATECREATED, ROLE FROM users WHERE archived = 0";

    // Check if a role filter is applied
    if (isset($_GET['role']) && !empty($_GET['role'])) {
        $sql .= " AND ROLE = :role";
    }

    $stmt = $connpdo->prepare($sql);

    if (isset($_GET['role']) && !empty($_GET['role'])) {
        $stmt->bindParam(":role", $_GET['role'], PDO::PARAM_STR);
    }

    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database query failed: " . $e->getMessage()]);
}
?>
