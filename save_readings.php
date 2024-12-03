<?php
include('Conn.php'); // Ensure this includes your database connection

// Get the current time
$current_timestamp = time();

// Check if 2 minutes have passed since the last insert
$query = "SELECT last_saved FROM sensor_data ORDER BY last_saved DESC LIMIT 1";
$stmt = $connpdo->prepare($query);
$stmt->execute();
$last_saved = $stmt->fetchColumn();

// If it's been 2 minutes or more, save new data
if (!$last_saved || strtotime($last_saved) <= ($current_timestamp - 120)) {

    // Ensure you receive the actual sensor data (sent via POST from JavaScript)
    $ph = isset($_POST['ph']) ? $_POST['ph'] : '--';
    $temperature = isset($_POST['temperature']) ? $_POST['temperature'] : '--';
    $ammonia = isset($_POST['ammonia']) ? $_POST['ammonia'] : '--';
    $do_level = isset($_POST['do_level']) ? $_POST['do_level'] : '--';

    // Sanitize the input values to ensure they are valid
    $ph = number_format((float)$ph, 2, '.', '');  // Format pH to 2 decimal places
    $temperature = number_format((float)$temperature, 2, '.', '');  // Format temperature to 2 decimal places
    $ammonia = number_format((float)$ammonia, 2, '.', '');  // Format ammonia to 2 decimal places
    $do_level = number_format((float)$do_level, 2, '.', '');  // Format dissolved oxygen to 2 decimal places

    // Get the current timestamp and format it properly
    $formatted_timestamp = date("Y-m-d H:i:s", $current_timestamp);  // Ensure correct timestamp format (Y-m-d H:i:s)

    // Prepare SQL query to insert data into the database
    $query = "INSERT INTO sensor_data (ph_level, temperature, ammonia_level, do_level, last_saved) 
              VALUES (:ph, :temperature, :ammonia, :do_level, :last_saved)";

    // Prepare and execute the SQL query
    $stmt = $connpdo->prepare($query);
    $stmt->bindParam(':ph', $ph);
    $stmt->bindParam(':temperature', $temperature);
    $stmt->bindParam(':ammonia', $ammonia);
    $stmt->bindParam(':do_level', $do_level);
    $stmt->bindParam(':last_saved', $formatted_timestamp);

    // Check if the query executes successfully
    if ($stmt->execute()) {
        echo "Data saved successfully";
    } else {
        // Log error message to help troubleshoot
        error_log("Error: " . implode(" ", $stmt->errorInfo()));
        echo "Error saving data: " . implode(" ", $stmt->errorInfo());
    }
}

// Close the connection after the request
$connpdo = null; // Not required to close the statement, but good to close the connection
?>