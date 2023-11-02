// add_to_cart.php
<?php
session_start();
include '../../assets/pages/db_connect.php'; // Подключение к БД

if (isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_SESSION['user_id'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION['user_id'];

    // Проверка, есть ли уже такой товар в корзине
    $checkQuery = "SELECT * FROM cart WHERE user_id = $userId AND product_id = $productId";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Обновление количества, если товар уже в корзине
        $updateQuery = "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $userId AND product_id = $productId";
        $conn->query($updateQuery);
    } else {
        // Добавление нового товара в корзину
        $insertQuery = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($userId, $productId, $quantity)";
        $conn->query($insertQuery);
    }
}
header('Location: ../../index.php');

?>