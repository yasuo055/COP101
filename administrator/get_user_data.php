<?php
include('db_connection.php');  // Ensure your DB connection is included

if (isset($_GET['userid'])) {
    $userId = $_GET['userid'];

    // Prepare SQL statement to get user data
    $sql = "SELECT USERID, FNAME, MNAME, LNAME, USERNAME, EMAIL, CONTACT, ROLE FROM users WHERE USERID = :userid";
    $stmt = $connpdo->prepare($sql);
    $stmt->bindParam(':userid', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode($user);  // Send user data as JSON response
    } else {
        echo json_encode(['error' => 'User not found']);
    }
}
?>
