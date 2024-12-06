<?php
include('Conn.php');

// Set the interval in seconds (5 minutes = 300 seconds)
$interval = 300;

while (true) {
    // Fetch sensor data from ESP32
    $esp32_url = 'http://192.168.5.100/sensor_data';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $esp32_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Timeout after 5 seconds

    $response = curl_exec($ch);

    if ($response === FALSE) {
        echo 'Error fetching data from ESP32: ' . curl_error($ch) . "\n";
        curl_close($ch);
        sleep($interval);
        continue; // Skip to the next iteration
    }

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) {
        echo "Error fetching data from ESP32: HTTP status code $http_code\n";
        sleep($interval);
        continue; // Skip to the next iteration
    }

    // Decode the JSON data
    $data = json_decode($response, true);

    if ($data === null) {
        echo "Invalid data received from ESP32.\n";
        sleep($interval);
        continue; // Skip to the next iteration
    }

    // Assign variables
    $ph = isset($data['ph_level']) ? $data['ph_level'] : null;
    $temperature = isset($data['temperature']) ? $data['temperature'] : null;
    $ammonia = isset($data['ammonia_level']) ? $data['ammonia_level'] : null;
    $do_level = isset($data['do_level']) ? $data['do_level'] : null;

    // Validate and store data in the database
    try {
        $connpdo->beginTransaction();

        // Insert data into respective tables
        $stmt = $connpdo->prepare("INSERT INTO phreadings (POND_ID, PHLevel, Date_Time) VALUES (:pond_id, :ph_level, :datetime)");
        $stmt->execute([':pond_id' => 1, ':ph_level' => $ph, ':datetime' => date('Y-m-d H:i:s')]);

        $stmt = $connpdo->prepare("INSERT INTO tempreadings (POND_ID, TEMPLevel, Date_Time) VALUES (:pond_id, :temp_level, :datetime)");
        $stmt->execute([':pond_id' => 1, ':temp_level' => $temperature, ':datetime' => date('Y-m-d H:i:s')]);

        $stmt = $connpdo->prepare("INSERT INTO nh3readings (POND_ID, NH3Level, Date_Time) VALUES (:pond_id, :nh3_level, :datetime)");
        $stmt->execute([':pond_id' => 1, ':nh3_level' => $ammonia, ':datetime' => date('Y-m-d H:i:s')]);

        $stmt = $connpdo->prepare("INSERT INTO o2readings (POND_ID, O2Level, Date_Time) VALUES (:pond_id, :o2_level, :datetime)");
        $stmt->execute([':pond_id' => 1, ':o2_level' => $do_level, ':datetime' => date('Y-m-d H:i:s')]);

        $connpdo->commit();
        echo "Data stored successfully: " . date('Y-m-d H:i:s') . "\n";

    } catch (Exception $e) {
        $connpdo->rollBack();
        echo "Error storing data: " . $e->getMessage() . "\n";
    }

    // Wait for the next interval
    sleep($interval);
}
?>
