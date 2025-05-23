<?php
session_start();
include 'db.php';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $page = $_SERVER['REQUEST_URI'];
    $company = 'ElectroTech'; // or dynamic

    $stmt = $pdo->prepare("INSERT INTO visit_logs (user, page, company, visited_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$user, $page, $company]);
}
?>

