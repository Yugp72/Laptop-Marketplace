<?php
include '../jwt-login-app/database/db.php';
include '../includes/header.php';

$product_id = $_GET['id'] ?? null;

if (!$product_id || !is_numeric($product_id)) {
    echo "<h2 style='text-align:center;'>Invalid product ID.</h2>";
    include '../includes/footer.php';
    exit;
}

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<h2 style='text-align:center;'>Product not found.</h2>";
    include '../includes/footer.php';
    exit;
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($product['name']); ?> - LapCart</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    .product-wrapper {
      max-width: 1100px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
      display: flex;
      flex-wrap: wrap;
      padding: 20px;
      gap: 30px;
    }
    .product-image {
      flex: 1 1 400px;
    }
    .product-image img {
      width: 100%;
      max-height: 400px;
      object-fit: cover;
      border-radius: 10px;
    }
    .product-details {
      flex: 1 1 500px;
    }
    .product-details h1 {
      font-size: 2rem;
      margin-bottom: 10px;
    }
    .product-details .brand {
      font-size: 1rem;
      color: #666;
      margin-bottom: 5px;
    }
    .product-details .price {
      font-size: 1.8rem;
      color: #28a745;
      font-weight: bold;
      margin: 15px 0;
    }
    .product-details .description {
      line-height: 1.6;
      color: #333;
    }
    @media (max-width: 768px) {
      .product-wrapper {
        flex-direction: column;
        padding: 15px;
      }
    }
  </style>
</head>
<body>

<div class="product-wrapper">
  <div class="product-image">
    <img src="../<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
  </div>
  <div class="product-details">
    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
    <p class="brand">Brand: <?php echo htmlspecialchars($product['brand']); ?></p>
    <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
    <div class="description">
      <?php echo nl2br(htmlspecialchars($product['description'])); ?>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>

<?php
if (isset($_GET['mkttrk_token']) && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $token = htmlspecialchars($_GET['mkttrk_token'], ENT_QUOTES);
    $productId = (int) $_GET['id'];
    echo "<script>
      fetch('../reviews/track_token_visit.php?mkttrk_token={$token}&product_id={$productId}')
        .then(res => res.json())
        .then(data => console.log('Visit tracking:', data))
        .catch(err => console.error('Tracking error:', err));
    </script>";
}
?>



