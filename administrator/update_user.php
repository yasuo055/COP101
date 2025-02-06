<?php
include('db_connection.php');  // Ensure your DB connection is included

// Get JSON input data
$data = json_decode(file_get_contents("php://input"));

if (isset($data->USERID)) {
    // Prepare SQL statement to update user data
    $sql = "UPDATE users SET FNAME = :fname, MNAME = :mname, LNAME = :lname, EMAIL = :email, CONTACT = :contact, ROLE = :role WHERE USERID = :userid";
    $stmt = $connpdo->prepare($sql);

    // Bind the parameters
    $stmt->bindParam(':fname', $data->FNAME);
    $stmt->bindParam(':mname', $data->MNAME);
    $stmt->bindParam(':lname', $data->LNAME);
    $stmt->bindParam(':email', $data->EMAIL);
    $stmt->bindParam(':contact', $data->CONTACT);
    $stmt->bindParam(':role', $data->ROLE);
    $stmt->bindParam(':userid', $data->USERID);

    // Execute the update query
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}
?>
