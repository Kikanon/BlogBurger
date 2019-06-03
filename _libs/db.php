<?php
$host = "localhost";
$username = "root";
$user_pass = "usbw";
$database_in_use = "Main";

$conn = new mysqli($host, $username, $user_pass, $database_in_use);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>