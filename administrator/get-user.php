<?php
include('Conn.php');

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    
    $sql = "SELECT USERID, FNAME, MNAME, LNAME, USERNAME, EMAIL, CONTACT, ROLE 
            FROM users 
            WHERE USERID = :userid";
    $stmt = $connpdo->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        header('Content-Type: application/json');
        echo json_encode($user);
        exit();
    }
}

http_response_code(404);
echo json_encode(['error' => 'User not found']);