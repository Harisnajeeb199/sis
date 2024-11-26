<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "irrigation_system"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare data for insertion
$temperature = $_GET['temperature'];
$humidity = $_GET['humidity'];
$soil_moisture = $_GET['soil_moisture'];
$rain_status = $_GET['rain_status'];
$timestamp = date('Y-m-d H:i:s');

// Check if pump_status is set
if (isset($_GET['pump_status'])) {
    $pump_status = $_GET['pump_status'] == 'on' ? 1 : 0;
} else {
    // Fetch the latest pump status
    $result = $conn->query("SELECT pump_status FROM sensor_data ORDER BY id DESC LIMIT 1");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pump_status = $row['pump_status'];
    } else {
        $pump_status = 0;
    }
}

// Insert data into database
$sql = "INSERT INTO sensor_data (temperature, humidity, soil_moisture, rain_status, timestamp, pump_status)
        VALUES ('$temperature', '$humidity', '$soil_moisture', '$rain_status', '$timestamp', '$pump_status')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
