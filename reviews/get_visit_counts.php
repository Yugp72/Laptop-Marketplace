<?php
header('Content-Type: application/json');
include '../jwt-login-app/database/db.php';

try {
    $query = "
        SELECT 
            p.id AS product_id, 
            p.name AS product_name,
            pvc.visit_count
        FROM products p
        LEFT JOIN product_visit_counter pvc ON p.id = pvc.product_id
        ORDER BY pvc.visit_count DESC
    ";

    $result = $conn->query($query);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "product_id" => (int)$row['product_id'],
            "product_name" => $row['product_name'],
            "visit_count" => (int)($row['visit_count'] ?? 0)
        ];
    }

    echo json_encode([
        "success" => true,
        "total_tracked_products" => count($data),
        "data" => $data
    ]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Query failed", "error" => $e->getMessage()]);
}
?>
