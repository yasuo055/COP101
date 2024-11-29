<?php 
include('Conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $input_username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $input_password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $input_contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_STRING);
    $hashedpass = password_hash($input_password, PASSWORD_BCRYPT);
    
    $statement = $connpdo->prepare(" INSERT INTO USERS VALUES(:username,:password,:contact,CURRENT_STAMP)");
    $statement->bindParam(':username',$input_username);
    $statement->bindParam(':password',$hashedpass);
    $statement->bindParam(':password',$input_contact);
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    


}
?>