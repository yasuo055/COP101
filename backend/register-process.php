<?php
include('../Conn.php'); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $input_fname = htmlspecialchars($_POST['fname'] ?? '', ENT_QUOTES, 'UTF-8');
    $input_lname = htmlspecialchars($_POST['lname'] ?? '', ENT_QUOTES, 'UTF-8');
    $input_mname = htmlspecialchars($_POST['mname'] ?? '', ENT_QUOTES, 'UTF-8');
    $input_username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $input_password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
    $input_contact = htmlspecialchars($_POST['contact'] ?? '', ENT_QUOTES, 'UTF-8');
    $hashedpass = password_hash($input_password, PASSWORD_BCRYPT);
    $input_email = '';
    $raw_email = $_POST['email'] ?? '';
    // Validate email format
        if (filter_var($raw_email, FILTER_VALIDATE_EMAIL)) {
            // Sanitize for safe HTML output
           $input_email = htmlspecialchars($raw_email, ENT_QUOTES, 'UTF-8');
        }

        $otp = rand(100000, 999999);// Generate and send OTP
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_expiration'] = time() + 300;
        $_SESSION['fname'] = $input_fname;
        $_SESSION['lname'] = $input_lname;
        $_SESSION['mname'] = $input_mname;
        $_SESSION['username'] = $input_username;
        $_SESSION['password'] = $hashedpass;
        $_SESSION['email'] = $input_email;
        $_SESSION['contact'] = $input_contact;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = '4quas3nse@gmail.com'; 
            $mail->Password = 'ontariqamuplakdu';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('4quas3nse@gmail.com', 'AQUASENSE');
            $mail->addAddress($input_email);
            $mail->Subject = 'Your OTP Code';
            $mail->Body = "Your OTP code is $otp. It will expire in 5 minutes.";


            $mail->send();
            header("Location: ../Signup_Verify.php");
            exit();
        } catch (Exception $e) {
            echo "Failed to send OTP. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to register user in the database.";
    }
<<<<<<< Updated upstream
 //else {
   // echo "Invalid form submission.";
//}

=======
 
>>>>>>> Stashed changes
?>