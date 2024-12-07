<?php
session_start();
include('Conn.php');
// Fetch sensor data from ESP32
$esp32_url = 'http://192.168.5.100/sensor_data'; // Ensure this is the correct IP
$userID = $_SESSION['USERID'];
// Initialize variables with default values
$ph = '--';
$temperature = '--';
$ammonia = '--';
$do_level = '--';

  try {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $esp32_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Timeout after 5 seconds

        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            throw new Exception('Error fetching data from ESP32: ' . curl_error($ch));
        }

        // Get HTTP status code
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Check if the request was successful (HTTP 200)
        if ($http_code !== 200) {
            throw new Exception("HTTP status code $http_code");
        }

        // Decode the JSON data from ESP32
        $data = json_decode($response, true);

        // Ensure we have valid data before assigning to variables
        if ($data !== null) {
          $ph = isset($data['ph_level']) ? $data['ph_level'] : '--';
          $temperature = isset($data['temperature']) ? $data['temperature'] : '--';
          $ammonia = isset($data['ammonia_level']) ? $data['ammonia_level'] : '--';
          $do_level = isset($data['do_level']) ? $data['do_level'] : '--';
      }

    } catch (Exception $e) {
        // Log the error (optional)
        error_log($e->getMessage());
    }


if (!isset($_SESSION['USERID'])) {
    header("Location: Login.php");
    exit();
} else {
    $user_id = $_SESSION['USERID'];
    $statement = $connpdo->prepare("SELECT * FROM USERS WHERE USERID = :userid");
    $statement->bindParam(':userid', $user_id);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
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
        <?php echo $user['LNAME'] . ', ' . $user['FNAME']; ?>
        </p>
        <p class="user-type">
          User
        </p>
      </div>
    </div>
  </div>
  <div class="sidebar">
    <div class="upper-portion" style="background-color: #BFEDFE;">
      <a href="alt_home.php">
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
        PH Level
      </button>
      </a>
      <a href="temperature.php">
        <button class="temp">
          <img src="/icon/Vector (1).png" class="temp-icon">
          Temperature
        </button>
      </a>
      <a href="ammonia.php">
        <button class="amn">
          <img src="/icon/Vector (2).png" class="amn-icon">
          Amonia
        </button>
      </a>
      <a href="oxygen.php">
        <button class="oxy">
          <img src="/icon/Vector (3).png" class="oxy-icon">
          Oxygen
        </button>
      </a>
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
        <p class="log">
          Log Out
        </p>
        </a>
      </button>
    </div>
  </div>

  <div class="content">
    <div class="head-content">
      <p class="heading-cont-alt-heading">
        Water Parameters
      </p>
      <div class="all-portion-parameter-user">
        <div class="ph-level-stability-user">
          <p>
            <img src="/icon/Vector (19).png" style="width:14px;">PH Level Stability
          </p>
          <p>
             4 - 5 pH
          </p>
        </div>
        <div class="temp-level-stability-user">
          <p>
          <img src="/icon/Vector (18).png" style="width:8px;">Temperature Stability Level
          </p>
          <p>
            21 - 27 C
          </p>
        </div>
        <div class="amn-level-stability-user">
          <p>
            <img src="/icon/Vector (2).png" style="width:14px;">Amonia Stability Level
          </p>
          <p>
            1 - 2 ppm
          </p>
        </div>
        <div class="oxy-level-stability-user">
          <p>
          <img src="/icon/Vector (3).png" style="width:14px;">Oxygen Stability Level
          </p>
          <p>
            4 - 5 mg/L
          </p>
        </div>
      </div>
      <p class="heading-cont-alt-heading">
        Readings
      </p>
      <div class="reading-portion-parameter-user">
        <div class="ph-level-reading-user">
          <p>
            Current PH Level
          </p>
          <p style="font-size: 25px; margin-top: 15px; margin-bottom: 15px;">
          <span id="phReading" class="reading">
            <?php echo $ph; ?>
          </span>
          </p>
          <p style="color: #E37400;">
            Moderate
          </p>
        </div>
        <div class="temp-level-reading-user">
          <p>
            Current Temperature Level
          </p>
          <p style="font-size: 25px; margin-top: 15px; margin-bottom: 15px;">
          <span id="temperatureReading" class="reading">
            <?php echo $temperature; ?> °C
          </span>
          </p>
          <p style="color: #026C37;">
            Stable
          </p>
        </div>
        <div class="amn-level-reading-user">
          <p>
            Current Amonia Level
          </p>
          <p style="font-size: 25px; margin-top: 15px; margin-bottom: 15px;">
          <span id="ammoniaReading" class="reading">
            <?php echo $ammonia; ?> ppm
          </span>
          </p>
          <p style="color: #FF0000;">
            Moderate
          </p>
        </div>
        <div class="oxy-level-reading-user">
          <p>
            Current Oxygen Level
          </p>
          <p style="font-size: 25px; margin-top: 15px; margin-bottom: 15px;">
          <span id="doReading" class="reading">
            <?php echo $do_level; ?> mg/L
          </span>
          </p>
          <p style="color: #026C37;">
            Stable
          </p>
        </div>
      </div>
      <!-- BUton for executing test.js for automatic insertdata and notification -->
       <form method="post">
        <button type="submit" name="startCron">Start Readings Parameters</button>
        </form>

        <?php
        if (isset($_POST['startCron'])) {
            // Run the Node.js script
            $output = shell_exec('test.js');
            echo "<pre>$output</pre>";
        }
        ?>

      <div class="breakdown">
        <div class="first-row-break">
          <p>
            Breakdown Data As of <span class="first-head">October 28, 12:00 PM</span>
          </p>
          <button class="ph-report">
            See All Reports
          </button>
        </div>
        <div class="second-row-break">
          <p>
            Date/Time
          </p>
          <p>
            Level
          </p>
          <p>
            AI Simulation
          </p>
          <p>
            Added Elements
          </p>
          <p>
            Measurement
          </p>
        </div>
        <div class="third-row-break">
          <p class="third-lvl-head">
            October 26,2024, 12:00 PM
          </p>
          <p class="third-lvl">
            6.5PH
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
        <div class="third-row-break">
          <p class="third-lvl-head">
            October 28,2024, 14:00 PM
          </p>
          <p class="third-lvl">
            6.5PH
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
      </div>
    </div>

    <!--
    <div class="ai">
      <button class="ai-btn">
        <img src="/icon/Group (1).png" class="ai-icon">
      </button>
    </div>
     -->

  </div>


  <script>
// Function to fetch sensor data from ESP32 and update the page
function fetchSensorData() {
    fetch('http://192.168.190.100/sensor_data')  // Use your ESP32's IP address

    .then(response => response.json())  // Convert the response to JSON
    .then(data => {
        // Update pH level reading
        document.getElementById('phReading').innerHTML = data.ph_level.toFixed(2) + '<br><span>pH</span>';
        
        // Update Ammonia level reading
        document.getElementById('ammoniaReading').innerHTML = data.ammonia_level.toFixed(2) + ' <span>ppm</span>';
        
        // Update Temperature reading
        document.getElementById('temperatureReading').innerHTML = data.temperature.toFixed(2) + '°C';  // Ensure temperature includes °C

        // Update Dissolved Oxygen reading (if available in the response)
        if (data.do_level) {
            document.getElementById('doReading').innerHTML = data.do_level.toFixed(2) + ' mg/L';
        }
    })
    .catch(error => console.error('Error fetching sensor data:', error));  // Handle any fetch errors
}

// Fetch the data initially on page load
fetchSensorData();

// Update the data every 2 seconds (ensure it only runs once)
setInterval(fetchSensorData, 2000);  // 120000 ms = 2 minutes



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

    updateTime();

    // Update the time every second
    setInterval(updateTime, 1000);

</script>
</body>
</html>