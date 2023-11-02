<?php
// manage_products.php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../../assets/pages/login.php');
    exit;
}

// Подключение к базе данных
include '../../assets/pages/db_connect.php'; // Исправленный путь

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Подготовка и выполнение запроса к базе данных
    $stmt = $conn->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $description, $price);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p>Товар добавлен успешно.</p>";
    } else {
        echo "<p>Ошибка при добавлении товара.</p>";
    }

    $stmt->close();
}

// Получение списка товаров
$query = "SELECT * FROM products";
$result = $conn->query($query);

// Далее идет ваш HTML-код...
?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление товарами | CopyStar</title>
    <link rel="stylesheet" href="../../assets/css/manage_products.css">
</head>

<body>
    <h1>Управление товарами</h1>
    <a href="admin.php" class="back-to-admin">&larr; Назад в админ-панель</a>

    <!-- Форма для добавления нового товара -->
    <h2>Добавить новый товар</h2>
    <form action="manage_products.php" method="post">
        <input type="text" name="name" placeholder="Название товара" required>
        <input type="text" name="description" placeholder="Описание товара" required>
        <input type="number" name="price" placeholder="Цена" required>
        <input type="submit" name="add_product" value="Добавить товар">
    </form>

    <!-- Список существующих товаров с возможностью редактирования и удаления -->
    <h2>Существующие товары</h2>
    <table>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>
                    <?php echo htmlspecialchars($row['name']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['description']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['price']); ?>
                </td>
                <td>
                    <a href="../../assets/pages/edit_product.php?id=<?php echo $row['id']; ?>">Редактировать</a>
                    <a href="../../assets/pages/delete_product.php?id=<?php echo $row['id']; ?>">Удалить</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>