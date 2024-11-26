<?php
header('Content-Type: application/json');

include 'insert_data.php';

$sql = "SELECT * FROM sensor_data";
$result = $conn->query($sql);

$sensor_data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sensor_data[] = $row;
    }
    echo json_encode($sensor_data);
} else {
    echo json_encode(array('message' => 'No data found'));
}

$conn->close();
