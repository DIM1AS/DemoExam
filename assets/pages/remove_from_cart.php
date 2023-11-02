<?php
session_start();
include '../../assets/pages/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../assets/pages/login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$productId = $_GET['product_id'] ?? 0;

// Удаление товара из корзины
$query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $userId, $productId);
$stmt->execute();

header('Location: ../../assets/pages/cart.php'); // Возвращение обратно в корзину
?>
