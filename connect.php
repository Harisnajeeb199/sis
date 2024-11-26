<html>
<body>

<?php

$dbname = 'example';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$connect = @mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$connect) {
    echo "Error: " . mysqli_connect_error();
    exit();
}

echo "Connection Success!<br><br>";

$temperature = isset($_GET["temperature"]) ? floatval($_GET["temperature"]) : 0.0;
$humidity = isset($_GET["humidity"]) ? floatval($_GET["humidity"]) : 0.0;

$query = "INSERT INTO weather_table (temperature, humidity) VALUES ('$temperature', '$humidity')";
$result = mysqli_query($connect, $query);

if ($result) {
    echo "Insertion Success!<br>";
} else {
    echo "Error: " . mysqli_error($connect);
}

?>
</body>
</html>
