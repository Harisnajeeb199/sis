<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "irrigation_system"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

if (isset($email) && isset($password)) {
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success", "message" => "Registration successful"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error: " . $sql . "<br>" . $conn->error));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Missing email or password"));
}

$conn->close();

