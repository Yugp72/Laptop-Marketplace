<?php
include '../jwt-login-app/database/db.php';

// Only process form data if this is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate all required fields are present
    if (
        isset($_POST['service_key']) &&
        isset($_POST['marketplace_username']) &&
        isset($_POST['rating']) &&
        isset($_POST['review_text'])
    ) {
        $service_key = $_POST['service_key'];
        $username = $_POST['marketplace_username'];
        $rating = (int) $_POST['rating'];
        $review_text = $_POST['review_text'];

        $stmt = $conn->prepare("INSERT INTO service_reviews (service_key, marketplace_username, rating, review_text) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $service_key, $username, $rating, $review_text);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Review added successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => $stmt->error]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Missing one or more required fields."]);
    }

    exit;
}
?>

<!-- Show the input form if it's not a POST request -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Submit a Review</title>
</head>
<body>
  <h2>Submit a Review</h2>
  <form method="POST" action="">
    <label for="service_key">Laptop Identifier (service_key):</label>
    <input type="text" name="service_key" id="service_key" required><br>

    <label for="marketplace_username">Your Name:</label>
    <input type="text" name="marketplace_username" id="marketplace_username" required><br>

    <label for="rating">Rating (1 to 5):</label>
    <select name="rating" id="rating" required>
      <option value="5">5 - Excellent</option>
      <option value="4">4 - Good</option>
      <option value="3">3 - Average</option>
      <option value="2">2 - Poor</option>
      <option value="1">1 - Terrible</option>
    </select><br>

    <label for="review_text">Review:</label>
    <textarea name="review_text" id="review_text" required></textarea><br>

    <input type="submit" value="Submit Review">
  </form>
</body>
</html>
