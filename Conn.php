<?php 
    //database config
    $host = 'localhost'; //hostname
    $dbname ='aquasensedb'; //dbname
    $username = 'ponduser'; //username
    $password = 'happyfishday'; //password

    //pdo conn string
    $conn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    try{
        //PDO instance(connect to db)
        $connpdo = new PDO ($conn,$username,$password);

        //error mode to exception
        $connpdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        // Handle Error
        echo "connection failed: " . $e->getMessage();
        exit;}
?>