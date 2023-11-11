<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];

$query = "SELECT p.id, p.name, p.price, c.quantity FROM products p INNER JOIN cart c ON p.id = c.product_id WHERE c.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина | CopyStar</title>
    <link rel="stylesheet" href="../../assets/css/cart.css">
</head>

<body>
    <header>
    </header>
    <main>
        <a href="../../index.php" class="back-button">Назад</a>
        <h1>Ваша корзина</h1>
        <table>
            <tr>
                <th>Товар</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Сумма</th>
                <th>Действия</th>
            </tr>
            <?php
            $total = 0;
            while ($row = $result->fetch_assoc()) {
                $subtotal = $row['price'] * $row['quantity'];
                $total += $subtotal;
                ?>
                <tr>
                    <td>
                        <?php echo htmlspecialchars($row['name']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($row['price']); ?> руб.
                    </td>
                    <td>
                        <?php echo htmlspecialchars($row['quantity']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($subtotal); ?> руб.
                    </td>
                    <td>
                        <a href="remove_from_cart.php?product_id=<?php echo $row['id']; ?>">Удалить</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="3">Итого:</td>
                <td>
                    <?php echo htmlspecialchars($total); ?> руб.
                </td>
                <td></td>
            </tr>
        </table>
        <a href="#">Оформить заказ</a>
    </main>

    <footer>
    </footer>

</body>

</html>