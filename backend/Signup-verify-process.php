<?php 
include('../Conn.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])){

    if (time() > $_SESSION['otp_expiration']) {
        // OTP has expired
        unset($_SESSION['otp'], $_SESSION['otp_expiration']); // Clear expired OTP
        // JavaScript to show the pop-up message
            echo "<script type='text/javascript'>
                    alert('The OTP has expired. Please request a new one.');
                    window.location.href = '../Signup_Verify.php';
                  </script>";
        }

    if (isset($_SESSION['otp'],$_SESSION['otp_expiration'])) {
        

        // Retrieve the submitted OTP from the form
        $input_otp = $_POST['input_otp'] ?? ''; 

        // Retrieve the session data
        $fname = $_SESSION['fname'];
        $lname = $_SESSION['lname'];
        $mname = $_SESSION['mname'];
        $username = $_SESSION['username'];
        $hashedpass = $_SESSION['password'];
        $contact = $_SESSION['contact'];
        $email = $_SESSION['email'];

        // Check if the OTP matches
        if ($input_otp == $_SESSION['otp']) {
            $statement = $connpdo->prepare("INSERT INTO USERS (FNAME, LNAME, MNAME, USERNAME, PASSWORD, EMAIL, CONTACT, DATECREATED)
                                VALUES (:fname, :lname, :mname, :username, :password, :email, :contact, NOW())");
            $statement->bindParam(':fname', $fname);
            $statement->bindParam(':lname', $lname);
            $statement->bindParam(':mname', $mname);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $hashedpass);
            $statement->bindParam(':contact', $contact);
            $statement->bindParam(':email', $email);
            $statement->execute();
            
            if ($statement->rowCount() > 0) {
                session_unset();
                session_destroy();
                // JavaScript to show the pop-up message
                    echo "<script type='text/javascript'>
                            alert('Verified. Please Login...');
                            window.location.href = '../Login.php';
                          </script>";
            } else {
                echo "Error: Data insertion failed.";
            }
            
        } else {
            echo "<script type='text/javascript'>
                        alert('Invalid OTP. Please try again.');
                  </script>";
        }
    } else {
        echo "Session data is missing. Please check your session.";
    }
}

?>