<?php
session_start();
include('../database/db.php');
require_once '../vendor/autoload.php';

use \Firebase\JWT\JWT;

$secret_key = "your_secret_key";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Email already registered.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $fullname, $email, $hashed_password);

            if ($stmt->execute()) {
                $id = $stmt->insert_id;

                $issuedAt   = time();
                $expiration = $issuedAt + 3600; 
                $payload = [
                    "iss" => "localhost",
                    "aud" => "localhost",
                    "iat" => $issuedAt,
                    "exp" => $expiration,
                    "data" => [
                        "id" => $id,
                        "email" => $email
                    ]
                ];

                $jwt = JWT::encode($payload, $secret_key, 'HS256');

                echo "<script>
                    localStorage.setItem('token', '$jwt');
                    localStorage.setItem('email', '$email');
                    localStorage.setItem('fullname', '$fullname');
                    window.location.href = '../../../index.php';
                </script>";
                exit;
            } else {
                $error = "Registration failed: " . $stmt->error;
            }

            $stmt->close();
        }
        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="POST">
  <h2>Register</h2>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <input type="text" name="fullname" placeholder="Full Name" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="password" name="confirm" placeholder="Confirm Password" required>
  <button type="submit">Register</button>
  <p>Already have an account? <a href="login.php">Login here</a></p>
</form>
</body>
</html>
