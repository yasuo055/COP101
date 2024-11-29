<?php 
include('Conn.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['verify_otp'])) {

    $input_username = $_SESSION['username'];
    $hashedpass = $_SESSION['password'];
    $input_contact =$_SESSION['contact'];


    if (isset($_SESSION['otp'], $_SESSION['otp_expiration'])) {
        if (time() > $_SESSION['otp_expiration']) {
            // OTP has expired
            unset($_SESSION['otp'], $_SESSION['otp_expiration']); // Clear expired OTP
            echo "The OTP has expired. Please request a new one.";
        } elseif ($user_otp == $_SESSION['otp']) {
            // OTP is valid
            unset($_SESSION['otp'], $_SESSION['otp_expiration']); // Clear OTP after successful verification
            echo "OTP verified successfully!";
        } else {
            // OTP is invalid
            echo "Invalid OTP. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>

<script>
    window.addEventListener('beforeunload', function () {
    // Make a request to the server to unset session data
    navigator.sendBeacon('unset_session.php');
  });
</script>
</html>