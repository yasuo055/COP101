<?php
include('Conn.php');

// Set the ESP32 URL
$esp32_url = 'http://192.168.5.143/sensor_data'; // Ensure this is the correct IP

// Initialize variables with default values 
$ph = '--';
$temperature = '--';
$ammonia = '--';
$do_level = '--';

// Get current timestamp
$current_timestamp = date('Y-m-d H:i:s', time());

// Fetch data from ESP32 and insert into the database every time
try {
    // Initialize a cURL session
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $esp32_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Timeout after 5 seconds

    $response = curl_exec($ch);

    // Check for errors during cURL execution
    if ($response === false) {
        throw new Exception('Error fetching data from ESP32: ' . curl_error($ch));
    }

    // Get the HTTP status code
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Check if the request was successful (HTTP 200)
    if ($http_code === 200) {
        // Decode the JSON response from ESP32
        $data = json_decode($response, true);

        // Ensure we have valid data before assigning it to variables
        if ($data !== null) {
            $ph = isset($data['ph_level']) ? $data['ph_level'] : '--';
            $temperature = isset($data['temperature']) ? $data['temperature'] : '--';
            $ammonia = isset($data['ammonia_level']) ? $data['ammonia_level'] : '--';
            $do_level = isset($data['do_level']) ? $data['do_level'] : '--';

            // Prepare the SQL query to insert the data into the database
            $insert_query = "INSERT INTO sensor_data (ph_level, temperature, ammonia_level, do_level, last_saved) 
                             VALUES (:ph, :temperature, :ammonia, :do_level, :last_saved)";

            // Prepare and execute the SQL query
            $stmt = $connpdo->prepare($insert_query);
            $stmt->bindParam(':ph', $ph);
            $stmt->bindParam(':temperature', $temperature);
            $stmt->bindParam(':ammonia', $ammonia);
            $stmt->bindParam(':do_level', $do_level);
            $stmt->bindParam(':last_saved', $current_timestamp);
            $stmt->execute();
        }
    } else {
        throw new Exception("HTTP status code $http_code");
    }
} catch (Exception $e) {
    // Log any errors encountered
    error_log($e->getMessage());
}
?>
