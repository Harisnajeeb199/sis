<?php
header('Content-Type: application/json');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "irrigation_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

// Retrieve the email and password from POST data
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Compare the passwords (assuming the password is stored as plain text)
    if ($password == $user['password']) {
        echo json_encode(["status" => "success", "message" => "Login successful"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid email or password"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid email or password"]);
}

// Close the connection
$conn->close();

