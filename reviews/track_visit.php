<?php
header('Content-Type: application/json');
include '../jwt-login-app/database/db.php';

$service_key = $_GET['service_key'] ?? '';

if (empty($service_key)) {
    echo json_encode(["success" => false, "message" => "Missing service_key"]);
    exit;
}

// Try to update existing service visit count
$stmt = $conn->prepare("
    INSERT INTO service_visits (service_key, visit_count) 
    VALUES (?, 1)
    ON DUPLICATE KEY UPDATE 
    visit_count = visit_count + 1, 
    last_visit = CURRENT_TIMESTAMP
");
$stmt->bind_param("s", $service_key);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Visit tracked for $service_key"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to track visit", "error" => $stmt->error]);
}
?>
