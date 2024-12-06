<?php
include('Conn.php'); // Include the database connection
session_start();

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

// Handle AJAX requests for real-time data
if (isset($_GET['fetch_data'])) {
    $stmt = $connpdo->prepare("SELECT ph_level, last_saved FROM sensor_data ORDER BY last_saved DESC LIMIT 1");
    $stmt->execute();
    $sensorData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($sensorData) {
        $currentPH = $sensorData['ph_level'];
        $phState = ($currentPH >= 6.5 && $currentPH <= 8.5) ? 'Healthy' : 'Unhealthy';

        echo json_encode([
            'ph_level' => number_format($currentPH, 2),
            'ph_state' => $phState,
            'last_saved' => date("M d, h:i A", strtotime($sensorData['last_saved']))
        ]);
    } else {
        echo json_encode([
            'ph_level' => 'N/A',
            'ph_state' => 'No Data',
            'last_saved' => 'No Data'
        ]);
    }
    exit();
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
  <link rel="stylesheet" href="style.css">
  <link rel="icon" href="/icon/PONDTECH__2_-removebg-preview 2.png">
  <title>Aqua Sense - PH Level</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function fetchRealTimeData() {
      $.ajax({
        url: 'ph.php', // Current file
        method: 'GET',
        data: { fetch_data: true },
        dataType: 'json',
        success: function(data) {
          // Update the pH level, status, and timestamp
          $('.ph-count').text(data.ph_level + ' PH');
          $('.ph-state').text(data.ph_state);
          $('.tme').text(data.last_saved);
        },
        error: function() {
          console.error('Error fetching real-time data');
        }
      });
    }

    // Fetch data every 5 seconds
    setInterval(fetchRealTimeData, 5000);
    $(document).ready(fetchRealTimeData); // Fetch data on page load
  </script>
</head>
<body>
  <div class="header">
    <div class="right-portion">
      <img src="/icon/PONDTECH__2_-removebg-preview 2.png" class="head-right">
    </div>
    <div class="left-portion">
      <p class="tme">
        <!-- Initial timestamp placeholder -->
        Loading...
      </p>
      <img src="/icon/image.png" class="head-left">
      <div class="user-name">
        <p class="user-full-name">
          <?php echo $user['LNAME'] . ', ' . $user['FNAME']; ?>
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
      <p class="drp">Water Parameters</p>
      </a>
    </div>
    <div class="middle-portion">
      <a href="ph.php">
      <button class="ph" style="background-color: #BFEDFE;">
        <img src="/icon/Group.png" class="ph-icon">
        pH Level
      </button>
      </a>
      <a href="temperature.php">
      <button class="temp">
        <img src="/icon/Vector (1).png" class="temp-icon">
        Temperature
      </button>
      </a>
      <button class="amn">
        <img src="/icon/Vector (2).png" class="amn-icon">
        Ammonia
      </button>
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
        <a href="../backend/unset_session.php">
        <p class="log">Log Out</p>
        </a>
      </button>
    </div>
  </div>
  <div class="content">
    <div class="head-content">
      <p class="heading-cont">PH Level</p>
      <div class="heading-level">
        <p class="ph-lvl-txt">Current Fish Pond pH Level</p>
        <p class="ph-count">
          <!-- Initial pH level placeholder -->
          Loading...
        </p>
        <p class="ph-state">
          <!-- Initial pH state placeholder -->
          Loading...
        </p>
      </div>
      <div class="analytics">
        <!-- Placeholder image for future dynamic chart -->
        <img src="/mockup-pic/Group 1673.png" class="analytics">
      </div>
      <div class="breakdown">
        <div class="first-row-break">
          <p>
            Breakdown Data As of <span class="first-head">Real-time</span>
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
        <div class="third-row-break">
          <p class="third-lvl-head">Oct 26, 12:00 PM</p>
          <p class="third-lvl">6.5 PH</p>
          <p class="third-hel">Healthy</p>
          <p class="third-elem">None</p>
          <p class="third-stab">Stable</p>
        </div>
        <div class="third-row-break">
          <p class="third-lvl-head">Oct 28, 14:00 PM</p>
          <p class="third-lvl">6.5 PH</p>
          <p class="third-hel">Healthy</p>
          <p class="third-elem">None</p>
          <p class="third-stab">Stable</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
