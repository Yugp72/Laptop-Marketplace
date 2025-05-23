<?php
session_start();
require_once '../vendor/autoload.php';
include('../database/db.php');

use \Firebase\JWT\JWT;
$secret_key = "XYZ1234567890";
$jwt = null;  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
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
        // print hwt token

        
        echo "<script>
            localStorage.setItem('token', '$jwt');
            localStorage.setItem('email', '$email');
            window.location.href = '../../../index.php';
        </script>";
        exit;
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: sans-serif; padding: 40px; }
        input, button { display: block; margin: 10px 0; }
    </style>
</head>
<body>
<form method="POST">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Login</button>
</form>
</body>
</html>
