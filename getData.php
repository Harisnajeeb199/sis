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

// Fetch latest sensor data
$sql = "SELECT * FROM sensor_data ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        'temperature' => $row['temperature'],
        'humidity' => $row['humidity'],
        'soil_moisture' => $row['soil_moisture'],
        'rain_status' => $row['rain_status'],
        'pump_status' => $row['pump_status'] // Ensure this column exists in your table
    ]);
} else {
    echo json_encode([
        'temperature' => 'N/A',
        'humidity' => 'N/A',
        'soil_moisture' => 'N/A',
        'rain_status' => 'N/A',
        'pump_status' => 'N/A'
    ]);
}

$conn->close();
?>
