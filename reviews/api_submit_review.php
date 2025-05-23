<?php
header('Content-Type: application/json');
include '../jwt-login-app/database/db.php';

// Show MySQL errors during development
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Parse JSON body
$data = json_decode(file_get_contents("php://input"), true);

// Required fields
$required = ['service_key', 'marketplace_user_id', 'marketplace_username', 'rating', 'review_text'];
foreach ($required as $key) {
    if (!isset($data[$key]) || $data[$key] === '') {
        echo json_encode(["success" => false, "message" => "Missing $key"]);
        exit;
    }
}

$service_key = trim($data['service_key']);
$uid = trim($data['marketplace_user_id']);
$username = trim($data['marketplace_username']);
$rating = (int) $data['rating'];
$review_text = trim($data['review_text']);

$check = $conn->prepare("SELECT id FROM service_reviews WHERE service_key = ? AND marketplace_user_id = ?");
$check->bind_param("ss", $service_key, $uid);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["success" => false, "already_reviewed" => true]);
    exit;
}

// ✅ Insert (or update if needed)
$insert = $conn->prepare("
    INSERT INTO service_reviews 
    (service_key, marketplace_user_id, marketplace_username, rating, review_text)
    VALUES (?, ?, ?, ?, ?)
");
$insert->bind_param("sssis", $service_key, $uid, $username, $rating, $review_text);

if ($insert->execute()) {
    echo json_encode(["success" => true, "message" => "Review submitted"]);
} else {
    echo json_encode(["success" => false, "message" => "Insert failed", "error" => $insert->error]);
}
?>
