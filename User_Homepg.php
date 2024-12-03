<?php
include('Conn.php');

// Fetch sensor data from ESP32
$esp32_url = 'http://192.168.5.100/sensor_data'; // Ensure this is the correct IP

// Initialize variables with default values
$ph = '--';
$temperature = '--';
$ammonia = '--';
$do_level = '--';

// Get the current timestamp
$current_timestamp = time();

// Retrieve the timestamp of the last recorded data from the database
$last_saved_query = "SELECT last_saved FROM sensor_data ORDER BY last_saved DESC LIMIT 1";
$stmt = $connpdo->prepare($last_saved_query);
$stmt->execute();
$last_saved = $stmt->fetchColumn();

// If the data was saved more than 2 minutes ago, fetch new data and save it
if (!$last_saved || ($current_timestamp - $last_saved) >= 120) {  // 120 seconds = 2 minutes
    // Try fetching data from ESP32
    try {
        // Initialize a cURL session
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

        // Insert the data into the database with the current timestamp
        $insert_query = "INSERT INTO sensor_data (ph_level, temperature, ammonia_level, do_level, last_saved) 
                         VALUES (:ph, :temperature, :ammonia, :do_level, :last_saved)";
        $stmt = $connpdo->prepare($insert_query);
        $stmt->bindParam(':ph', $ph);
        $stmt->bindParam(':temperature', $temperature);
        $stmt->bindParam(':ammonia', $ammonia);
        $stmt->bindParam(':do_level', $do_level);
        $stmt->bindParam(':last_saved', $current_timestamp);
        $stmt->execute();

    } catch (Exception $e) {
        // Log the error (optional)
        error_log($e->getMessage());
    }
} else {
    // Optionally, you can display a message if the data was not saved
    echo "Data not saved as it was updated less than 2 minutes ago.";
}

// Session handling for user authentication
session_start();

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
  <meta http-equiv="refresh" content="60">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <a href="temperature.php">
        <button class="temp">
          <img src="/icon/Vector (1).png" class="temp-icon">
          Temperature
        </button>
      </a>
      <a href="ammonia.php">
        <button class="amn">
          <img src="/icon/Vector (2).png" class="amn-icon">
          Ammonia
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
      <p class="heading-cont">
        Water Parameters
      </p>

    <div class="container">
        <!-- Left Column: Connect Sensor and Readings -->
        <div class="section">
            <div class="readings">
                <h1>Water Readings</h1>
                <span>pH Reading: <span id="phReading"><?php echo $ph; ?></span></span><br>
                <span>Temperature Reading: <span id="temperatureReading"><?php echo $temperature; ?> °C</span></span><br>
                <span>Ammonia Reading: <span id="ammoniaReading"><?php echo $ammonia; ?> ppm</span></span><br>
                <span>Dissolved Oxygen Reading: <span id="doReading"><?php echo $do_level; ?> mg/L</span></span><br>
            </div>
        </div>
    </div>
  </div>

  <!-- JavaScript to update readings -->
<script>
// Function to fetch sensor data from ESP32 and update the page
function fetchSensorData() {
    fetch('http://192.168.5.100/sensor_data')  // Use your ESP32's IP address
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

// Update the data every 2 seconds
setInterval(fetchSensorData, 2000);  // 2000 ms = 2 seconds

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

<?php
include('Conn.php');  // Include database connection

// Fetch the current timestamp
$current_timestamp = time();

// Query to check when the last data was saved
$query = "SELECT last_saved FROM sensor_data ORDER BY last_saved DESC LIMIT 1";
$stmt = $connpdo->prepare($query);
$stmt->execute();
$last_saved = $stmt->fetchColumn();

// Check if 2 minutes have passed since the last save
if (!$last_saved || ($current_timestamp - $last_saved) >= 120) {
    // Fetch new sensor data from ESP32 (via POST from JavaScript)
    $ph = isset($_POST['ph']) ? $_POST['ph'] : '--';
    $temperature = isset($_POST['temperature']) ? $_POST['temperature'] : '--';
    $ammonia = isset($_POST['ammonia']) ? $_POST['ammonia'] : '--';
    $do_level = isset($_POST['do_level']) ? $_POST['do_level'] : '--';

    // Ensure numeric values are properly formatted
    $ph = number_format((float)$ph, 2, '.', '');
    $temperature = number_format((float)$temperature, 2, '.', '');
    $ammonia = number_format((float)$ammonia, 2, '.', '');
    $do_level = number_format((float)$do_level, 2, '.', '');

    // Prepare the SQL insert query
    $query = "INSERT INTO sensor_data (ph_level, temperature, ammonia_level, do_level, last_saved) 
              VALUES (:ph, :temperature, :ammonia, :do_level, NOW())";
    
    $stmt = $connpdo->prepare($query);
    $stmt->bindParam(':ph', $ph);
    $stmt->bindParam(':temperature', $temperature);
    $stmt->bindParam(':ammonia', $ammonia);
    $stmt->bindParam(':do_level', $do_level);

    // Execute the query
    if ($stmt->execute()) {
        echo "Data saved successfully";
    } else {
        error_log("Error inserting sensor data: " . implode(" ", $stmt->errorInfo()));
        echo "Error saving data";
    }
} else {
    error_log("No insert needed as 2 minutes haven't passed yet.");
}
?>
