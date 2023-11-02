<?php
session_start();

// Проверка, является ли пользователь администратором
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../../assets/pages/login.php');
    exit;
}

include '../../assets/pages/db_connect.php'; // Подключение к базе данных

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обработка отправленной формы
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdi", $name, $description, $price, $product_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Товар обновлен.";
    } else {
        echo "Ошибка при обновлении товара.";
    }
} else {
    // Загрузка данных товара для редактирования
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    }
}

// Если товар не найден, перенаправить на управление товарами
if (!$product) {
    header('Location: ../../assets/pages/manage_products.php');
    exit;
}

// HTML-код для формы редактирования
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование товара</title>
    <!-- Стили и прочее -->

    <link rel="stylesheet" href="../../assets/css/edit_product.css">
</head>
<body>
    <h1>Редактирование товара</h1>
    <form action="edit_product.php?id=<?php echo $product_id; ?>" method="post">
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
        <input type="submit" value="Обновить товар">
    </form>
</body>
</html>
