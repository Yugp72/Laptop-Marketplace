<?php
header('Content-Type: application/json');
include '../jwt-login-app/database/db.php';

$service_key = $_GET['service_key'] ?? 'all';

if ($service_key === 'all') {
    $sql = "SELECT * FROM service_reviews";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT * FROM service_reviews WHERE service_key = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $service_key);
}

$stmt->execute();
$result = $stmt->get_result();

$reviews = [];
$total_reviews = 0;
$rating_sum = 0;

while ($row = $result->fetch_assoc()) {
    $reviews[] = [
        "service_key" => $row['service_key'],
        "marketplace_username" => $row['marketplace_username'],
        "rating" => (int)$row['rating'],
        "review_text" => $row['review_text']
    ];
    $total_reviews++;
    $rating_sum += $row['rating'];
}

$average_rating = $total_reviews > 0 ? number_format($rating_sum / $total_reviews, 2) : "0.00";

echo json_encode([
    "success" => true,
    "service_key" => $service_key,
    "total_reviews" => $total_reviews,
    "average_rating" => $average_rating,
    "reviews" => $reviews
]);
?>
