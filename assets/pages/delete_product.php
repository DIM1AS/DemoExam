<?php
session_start();

// Проверка, является ли пользователь администратором
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../../assets/pages/login.php');
    exit;
}

include '../../assets/pages/db_connect.php'; // Подключение к базе данных

// Получение ID товара
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    // SQL-запрос на удаление товара
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Товар удален.";
    } else {
        echo "Ошибка при удалении товара.";
    }
}

// Перенаправление обратно в админ-панель
header('Location: ../../assets/pages/manage_products.php');
exit;
?>
