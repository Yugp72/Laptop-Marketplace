<?php
header('Content-Type: application/json');
include '../jwt-login-app/database/db.php'; // ensure $conn is defined (mysqli)

// Query all products
$sql = "SELECT id, name, description, brand, price, image_path, created_at FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);

$products = [];

while ($row = $result->fetch_assoc()) {
    $products[] = [
        "id" => (int)$row['id'],
        "name" => $row['name'],
        "description" => $row['description'],
        "price" => number_format($row['price'], 2),
        "imageUrl" => "https://yug-patel-profile.top/" . ltrim($row['image_path'], '/'),
        "created_at" => $row['created_at'],
        "learnMoreUrl" => "https://yug-patel-profile.top/pages/item_template.php?id={$row['id']}"
    ];
}

// Output as JSON
echo json_encode([
    "success" => true,
    "total" => count($products),
    "products" => $products
]);
?>
