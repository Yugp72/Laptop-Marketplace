<?php
header("Content-Type: application/json"); // Set response type as JSON
header("Access-Control-Allow-Origin: *"); // Allow external API requests

include('db.php'); // Include MySQL database connection

$stmt = $conn->prepare("SELECT id, fullname, email, created_at FROM users");
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode(["status" => "success", "data" => $users]);
?>
