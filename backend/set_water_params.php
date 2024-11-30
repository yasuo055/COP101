<?php 
include('../Conn.php');
session_start();
if (!isset($_SESSION['USERID'])){
    header("Location: ../Login.php");
  }

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])){

$user_id = $_SESSION['USERID'];
    $input_minph = filter_var($_POST['min_ph'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input_maxph = filter_var($_POST['max_ph'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input_mintemp = filter_var($_POST['min_temp'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input_maxtemp = filter_var($_POST['max_temp'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input_minnh3 = filter_var($_POST['min_nh3'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input_maxnh3 = filter_var($_POST['max_nh3'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $input_mino2 = filter_var($_POST['min_o2'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

$statement = $connpdo->prepare("INSERT INTO USERPOND (USERID, MinimO2, MinimNH3, MaxNH3,  MinimPH, MaxPH,  Mintemp_Celsius, Maxtemp_Celsius)
VALUES (:userid, :mino2, :minnh3, :maxnh3, :minph, :maxph, :mintemp, :maxtemp)");
$statement->bindParam(':userid', $user_id);
$statement->bindParam(':mino2', $input_mino2);
$statement->bindParam(':minnh3', $input_minnh3);
$statement->bindParam(':maxnh3', $input_maxnh3);
$statement->bindParam(':minph', $input_minph);
$statement->bindParam(':maxph', $input_maxph);
$statement->bindParam(':mintemp', $input_mintemp);
$statement->bindParam(':maxtemp', $input_maxtemp);
$statement->execute();

if($statement->rowCount() > 0){
    echo "<script type='text/javascript'>
    alert('Water Parameters Set!');
    window.location.href = '../User_Homepg.php';
            </script>";
}else{
    echo "<script type='text/javascript'>
    alert('error failed');
    window.location.href = '../User_Homepg.php';
            </script>";
}

}

?>