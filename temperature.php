<?php
include('Conn.php');
session_start();
date_default_timezone_set('Asia/Manila');


// Check if user is logged in
if (!isset($_SESSION['USERID'])) {
    header("Location: Login.php");
    exit();
} else {
    // Fetch user details
    $user_id = $_SESSION['USERID'];
    $statement = $connpdo->prepare("SELECT * FROM USERS WHERE USERID = :userid");
    $statement->bindParam(':userid', $user_id);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
}

try {
  // Fetch the last 5 temperature readings for the breakdown
  $sql = "SELECT last_saved, temperature FROM sensor_data ORDER BY last_saved DESC LIMIT 3";
  $stmt = $connpdo->query($sql);
  if (!$stmt) {
      throw new Exception("Failed to fetch the breakdown data.");
  }
  $breakdownData = $stmt->fetchAll(PDO::FETCH_ASSOC);

}  catch (PDOException $e) {
  // Log and handle database errors
  error_log("Database error: " . $e->getMessage());
  $error_message = "An error occurred while accessing the database. Please try again later.";
} catch (Exception $e) {
  // Log and handle general errors
  error_log("Error: " . $e->getMessage());
  $error_message = $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="/icon/PONDTECH__2_-removebg-preview 2.png">
  <title>Aqua Sense</title>
</head>
<body>
  <div class="header">
    <div class="right-portion">
      <img src="/icon/PONDTECH__2_-removebg-preview 2.png" class="head-right">
    </div>
    <div class="left-portion">
      <p class="tme" id="currentTime">
        <?php echo date("F j, Y - h:i:s A"); ?>
      </p>
      <img src="/icon/image.png" class="head-left">
      <div class="user-name">
        <p class="user-full-name">
          <?php echo $user['LNAME'] . ', ' . $user['FNAME']; ?>        </p>
        </p>
        <p class="user-type">
          User
        </p>
      </div>
    </div>
  </div>
  <div class="sidebar">
    <div class="upper-portion">
      <a href="User_Homepg.php">
      <img src="/icon/Vector.png" class="side-wat">
      <p class="drp">
        Water Parameters
      </p>
      </a>
    </div>
    <div class="middle-portion">
      <a href="ph.php">
      <button class="ph">
        <img src="/icon/Group.png" class="ph-icon">
        pH Level
      </button>
      </a>
      <button class="temp" style="background-color: #BFEDFE;">
        <img src="/icon/Vector (1).png" class="temp-icon">
        Temperature
      </button>
      <a href="ammonia.php">
        <button class="amn">
          <img src="/icon/Vector (2).png" class="amn-icon">
          Ammonia
        </button>
      </a>
      <button class="oxy">
        <img src="/icon/Vector (3).png" class="oxy-icon">
        Oxygen
      </button>
      <a href="notification.php">
        <button class="not">
          <img src="/icon/notifications.png" class="not-icon">
          Notification
        </button>
      </a>
    </div>
    <div class="bottom-portion">
      <button class="log-out">
        <img src="/icon/solar_logout-2-broken.png" class="side-log">
        <p class="log">
          Log Out
        </p>
      </button>
    </div>
  </div>
  <div class="content">
    <div class="head-content">
      <p class="heading-cont">
        Temperature Level
      </p>
      <div class="heading-level">
        <p class="ph-lvl-txt">
          Current Fish Pond Temperature Level
        </p>
        <p class="ph-count">
          20°C
        </p>
        <p class="ph-state">
          Healthy
        </p>
      </div>
      <div class="analytics">
        <img src="/mockup-pic/Group 1673.png" class="analytics">
      </div>

      <<div class="breakdown">
    <div class="first-row-break">
        <p>
            Breakdown Data As of <span class="first-head">
                <?php echo date('F j, Y, g:i A'); ?>
            </span>
        </p>
        <button class="ph-report">
            See All Reports
        </button>
    </div>
    <div class="second-row-break">
        <p>Date/Time</p>
        <p>Level</p>
        <p>AI Simulation</p>
        <p>Added Elements</p>
        <p>Measurement</p>
    </div>
    <?php foreach ($breakdownData as $data): ?>
        <div class="third-row-break">
            <p class="third-lvl-head">
                <?php echo date('F j, Y, g:i A', strtotime($data['last_saved'])); ?>
            </p>
            <p class="third-lvl">
                <?php echo number_format($data['temperature'], 1) . '°C'; ?>
            </p>
            <p class="third-hel">
                Healthy
            </p>
            <p class="third-elem">
                None
            </p>
            <p class="third-stab">
                Stable
            </p>
        </div>
             <?php endforeach; ?>
          </div>

      </div>
    </div>
  </div>

      <script>
        function updateTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        
        // Format time in 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // 0 should be 12
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        var strTime = now.toLocaleString('en-us', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) + ' - ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;

        // Set the time in the element with id "currentTime"
        document.getElementById('currentTime').textContent = strTime;
    }

    // Update the time every second
    setInterval(updateTime, 1000);
      </script>

</body>
</html>