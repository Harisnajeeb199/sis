<!DOCTYPE html>
<html>
<head>
    <title>Sensor Data</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Sensor Data</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Temperature (°C)</th>
            <th>Humidity (%)</th>
            <th>Timestamp</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "irrigation_system";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from database
        $sql = "SELECT * FROM sensor_data";
        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["id"]."</td><td>".$row["temperature"]."</td><td>".$row["humidity"]."</td><td>".$row["timestamp"]."</td></tr>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
