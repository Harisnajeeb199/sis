<?php
$message = $_GET['message'];
// Here you can store the notification in your database or a file
$file = 'notifications.txt';
file_put_contents($file, $message . PHP_EOL, FILE_APPEND | LOCK_EX);
echo "Notification received: $message";
?>
