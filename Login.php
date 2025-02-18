<?php
session_start();
include('Conn.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $password = $_POST['password'] ?? '';

    try {
        // ✅ Fetch only users who are not archived (ARCHIVED = 0)
        $stmt = $connpdo->prepare("
            SELECT USERID, CONCAT(FNAME, ' ', MNAME, ' ', LNAME) AS NAME, PASSWORD, ROLE, EMAIL, ARCHIVED 
            FROM USERS 
            WHERE USERNAME = :username AND ARCHIVED = 0
        ");

        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Debugging: Check password values (Remove in production)
            error_log("Entered password: " . $password);
            error_log("Stored hash: " . $user['PASSWORD']);

            if (password_verify($password, $user['PASSWORD'])) {
                $_SESSION['USERID'] = $user['USERID'];
                $_SESSION['ROLE'] = $user['ROLE']; // Store role in session

                // ✅ Insert Login Activity into `user_logs`
                $log_stmt = $connpdo->prepare("
                    INSERT INTO user_logs (USERID, name, role, email, login_time) 
                    VALUES (:userid, :name, :role, :email, NOW())
                ");
                $log_stmt->execute([
                    ':userid' => $user['USERID'],
                    ':name'   => $user['NAME'] ?? 'Unknown',
                    ':role'   => $user['ROLE'] ?? 'Unknown',
                    ':email'  => $user['EMAIL'] ?? 'Unknown'
                ]);

                // ✅ Redirect based on role
                if ($user['ROLE'] === 'Admin') {
                    header("Location: /administrator/user-management-dashboard.php");
                } else {
                    header("Location: User_Homepg.php");
                }
                exit;
            } else {
                echo "<script>alert('Incorrect Password');</script>";
            }
        } else {
            echo "<script>alert('No active user found with this username. If you were archived, contact an administrator.');</script>";
        }
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        echo "<p style='color: red;'>An error occurred. Please try again.</p>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/icon/PONDTECH__2_-removebg-preview 2.png">
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Aqua Sense</title>
  <link rel="stylesheet" href="style.css">
</head>
<body style="overflow: hidden; "> 
  <div class="cont">
    <div class="left-por-log">
      <img src="/asset/image 15.png" class="img-left-log">
    </div>
    <form method ="POST">
    <div class="right-por-log">
      <div class="head-log">
        <img src="/icon/PONDTECH__2_-removebg-preview 2.png" class="head-log-sub">
        <p class="up-head-log-txt">
          Login
        </p>
        <p class="sub-heading-log">
          Enter your username and password to continue
        </p>
      </div>
      <div class="sub-log">
        <p class="us-head-log-txt">
          Username
        </p>
        <input type="text" name="username" placeholder="Enter Username" class="us-log-inp" required>
      </div>
      <div class="sub-log">
        <p class="pas-head-log-txt">
          Password
        </p>
        <input type="password" name="password" placeholder="Enter Password" class="us-log-inp" required>
      </div>
      <div class="sub-log">
        <div class="input-log">
          <div class="rem-pas">
            <input type="checkbox" class="check-rem-pas">
            <p class="rem-pas-txt">
              Remember password
            </p>
          </div>
          <div class="forg-pas">
            <a href="email_otp.php">
              <p class="forg-pas-txt">
                Forgot Password
              </p>
            </a>
          </div>
        </div>
      </div>
        <a href="/signup.html">
        <button type="submit" class="btn-log">Login</button>
       </a>
</form>
        <p class="bot-head-log-txt">
          Don't you have an account yes? 
          <a href="Signup.php">
          <span class="sgn-up-log"> Sign Up </span>
          </a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>