<?php
include('Conn.php');
if (isset($_SESSION['otp'], $_SESSION['otp_expiration'], $_SESSION['fname'], $_SESSION['lname'], $_SESSION['mname'],
$_SESSION['username'], $_SESSION['password'],  $_SESSION['email'],  $_SESSION['contact'])) {
    
        if (time() > $_SESSION['otp_expiration']) {
                unset($_SESSION['otp'], $_SESSION['otp_expiration']); // Clear expired OTP
                echo "<script type='text/javascript'>
                            alert('The OTP has expired. Please request a new one.');
                            window.location.href = '../Signup_Verify.php';
                    </script>";
                }
    }else{
        header('../Signup.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <style>

    .Grid-Container{
        display:Grid;
        justify-items: center;
        height: 100vh;
    }
    /* Remove spinner in Chrome, Safari, Edge */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Remove spinner in Firefox */
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

</head>
<body>
    <div class="Grid-Container">
    <form action="../backend/Signup-verify-process.php" method="POST">
    <input type="number" id="otp" placeholder="Enter OTP" maxlength="6" name="input_otp" autocomplete="off" required pattern="[0-9]{6}"/>
    <button name="submit" type="submit"> Verify </button>
    </form>
    <form action="../backend/resend-otp.php" medthod="POST">
        <p>Did not Receive Code? Click Resend for New OTP</p>
        <button name="resend" type="submit"> Resend </button>
    </form>

    </div>
    
</body>


</html>