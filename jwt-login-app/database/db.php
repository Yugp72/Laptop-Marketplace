<?php
$servername = "localhost";
$username = "root";
$password = "16081997";
$dbname = "laptop_marketplace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
