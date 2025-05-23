<?php
header('Content-Type: application/json');
include '../jwt-login-app/database/db.php';

$token = $_GET['mkttrk_token'] ?? '';
$product_id = $_GET['product_id'] ?? '';

if (!$token || !$product_id || !is_numeric($product_id)) {
    echo json_encode(["success" => false, "message" => "Missing or invalid token/product_id"]);
    exit;
}

try {
    // Check if token is already used
    $stmt = $conn->prepare("SELECT id FROM product_visits WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Token already used"]);
        exit;
    }

    // Insert token and update visit count
    $conn->begin_transaction();

    $insert = $conn->prepare("INSERT INTO product_visits (token, product_id) VALUES (?, ?)");
    $insert->bind_param("si", $token, $product_id);
    $insert->execute();

    $update = $conn->prepare("INSERT INTO product_visit_counter (product_id, visit_count)
        VALUES (?, 1)
        ON DUPLICATE KEY UPDATE visit_count = visit_count + 1");
    $update->bind_param("i", $product_id);
    $update->execute();

    $conn->commit();

    echo json_encode(["success" => true, "message" => "Visit counted"]);
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(["success" => false, "message" => "Error", "error" => $e->getMessage()]);
}
?>
