<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../../assets/pages/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель | CopyStar</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
</head>

<body>
    <h1>Добро пожаловать в админ-панель,
        <?php echo htmlspecialchars($_SESSION['name']); ?>!
    </h1>
    <a href="../../index.php" class="back-to-main">&larr; Назад на главную</a>


    <div class="admin-nav">
        <a href="manage_users.php">Управление пользователями</a>
        <a href="manage_products.php">Управление товарами</a>
    </div>

</body>

</html>