<?php 
include('Conn.php');

// Fetch sensor data from ESP32
$esp32_url = 'http://192.168.190.100/sensor_data'; // Ensure this is the correct IP

// Initialize variables with default values
$ph = '--';
$temperature = '--';
$ammonia = '--';
$do_level = '--';

// Initialize a cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $esp32_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);  // Timeout after 5 seconds

$response = curl_exec($ch);

// Check for errors
if ($response === FALSE) {
    die('Error fetching data from ESP32: ' . curl_error($ch));
}

// Get HTTP status code
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Check if the request was successful (HTTP 200)
if ($http_code !== 200) {
    die("Error fetching data from ESP32: HTTP status code $http_code");
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
  <title>Aqua Sense</title>
</head>
<body>
  <div class="header">
    <div class="right-portion">
      <img src="/icon/PONDTECH__2_-removebg-preview 2.png" class="head-right">
    </div>
    <div class="left-portion">
      <p class="tme">
        October 26, 2024 - 12:00:06PM
      </p>
      <img src="/icon/image.png" class="head-left">
      <div class="user-name">
        <p class="user-full-name">
          Imee Nold G. Villarde
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
        <p class="log">
          Log Out
        </p>
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
            <h2>Connect to Sensor</h2>
            <button class="button">Connect</button>

            <div class="readings">
                <h2>Readings</h2>
                <span>pH Reading: <span id="phReading"><?php echo $ph; ?></span></span><br>
                <span>Temperature Reading: <span id="temperatureReading"><?php echo $temperature; ?> °C</span></span><br>
                <span>Ammonia Reading: <span id="ammoniaReading"><?php echo $ammonia; ?> ppm</span></span><br>
                <span>Dissolved Oxygen Reading: <span id="doReading"><?php echo $do_level; ?> mg/L</span></span><br>
            </div>

            <button class="button">Test</button>
        </div>
        <!-- Right Column: Set Water Parameters -->
        <div class="section">
            <h2>SET WATER PARAMETERS OF THE SAFE AND CRITICAL LEVEL OF THE POND</h2>

            <div class="set-params">
                <label for="phMin">PH:</label>
                <div class="min-max">
                    <input type="number" id="phMin" class="input-field" placeholder="Min">
                    <input type="number" id="phMax" class="input-field" placeholder="Max">
                </div>

                <label for="tempMin">Temperature (°C):</label>
                <div class="min-max">
                    <input type="number" id="tempMin" class="input-field" placeholder="Min">
                    <input type="number" id="tempMax" class="input-field" placeholder="Max">
                </div>

                <label for="ammoniaMin">Ammonia Level (ppm):</label>
                <div class="min-max">
                    <input type="number" id="ammoniaMin" class="input-field" placeholder="Min">
                    <input type="number" id="ammoniaMax" class="input-field" placeholder="Max">
                </div>

                <label for="doMin">Dissolved Oxygen (mg/L):</label>
                <div class="min-max">
                    <input type="number" id="doMin" class="input-field" placeholder="Min">
                    <input type="number" id="doMax" class="input-field" placeholder="Max">
                </div>

                <button class="button">SET PARAMETERS</button>
            </div>
        </div>
    </div>
  </div>

  <!-- JavaScript to update readings -->
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

// Update the data every 2 seconds
setInterval(fetchSensorData, 2000);  // 2000 ms = 2 seconds
</script>

</body>
</html>