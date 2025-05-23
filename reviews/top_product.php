<?php
header('Content-Type: application/json');

include '../jwt-login-app/database/db.php';

$sql = "
    SELECT 
        p.id AS product_id, 
        p.name AS product_name, 
        p.price, 
        p.image_path,
        AVG(r.rating) AS avg_rating
    FROM products p
    JOIN reviews r ON p.id = r.product_id
    GROUP BY p.id
    ORDER BY avg_rating DESC
    LIMIT 5
";

$result = $conn->query($sql);

$response = [
    "success" => true,
    "source" => "LapCart",
    "category" => "tech",
    "data_type" => "top5",
    "timestamp" => date("c"),
    "data" => []
];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response["data"][] = [
            "id" => $row["product_id"],
            "name" => $row["product_name"],
            "price" => (float)$row["price"],
            "image_url" => $row["image_path"],
            "avg_rating" => round($row["avg_rating"], 2)
        ];
    }
} else {
    $response["data"] = [];
    $response["message"] = "No products found.";
}

echo json_encode($response);
$conn->close();
?>
