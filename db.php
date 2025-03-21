<?php
$servername = "localhost"; 
$username = "root";
$password = "16081997";
$database = "laptop_marketplace";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
