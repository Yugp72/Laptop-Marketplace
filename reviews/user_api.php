<?php
header('Content-Type: application/json');
include '../jwt-login-app/database/db.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

if ($method === 'POST' && $action === 'register') {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user';

    if (!$fullname || !$email || !$password) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User registered successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => $stmt->error]);
    }

} elseif ($method === 'GET') {
    // FETCH USERS
    $user_id = $_GET['id'] ?? null;

    if ($user_id) {
        $stmt = $conn->prepare("SELECT id, fullname, email, role, created_at FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            echo json_encode(["success" => true, "user" => $user]);
        } else {
            echo json_encode(["success" => false, "message" => "User not found."]);
        }
    } else {
        $result = $conn->query("SELECT id, fullname, email, role, created_at FROM users ORDER BY id DESC");
        $users = [];

        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }

        echo json_encode([
            "success" => true,
            "count" => count($users),
            "users" => $users
        ]);
    }

} else {
    echo json_encode(["success" => false, "message" => "Invalid request. Use GET to fetch or POST with action=register."]);
}
?>
