<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../../assets/pages/login.php');
    exit;
}

include '../../assets/pages/db_connect.php';

$query = "SELECT id, name, email, is_admin FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Управление пользователями | CopyStar</title>
    <link rel="stylesheet" href="../../assets/css/manage_users.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
</head>

<body>
    <h1>Управление пользователями</h1>
    <a href="../../assets/pages/admin.php" style="margin-bottom: 20px; display: inline-block;">&larr; Назад в админ-панель</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>
                    <?php echo $row['id']; ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['name']); ?>
                </td>
                <td>
                    <?php echo htmlspecialchars($row['email']); ?>
                </td>
                <td>
                    <?php echo $row['is_admin'] == 1 ? 'Админ' : 'Пользователь'; ?>
                </td>
                <td>
                    <a href="#?id=<?php echo $row['id']; ?>">Редактировать</a>
                    <a href="#?id=<?php echo $row['id']; ?>">Удалить</a>
                    <a
                        href="toggle_admin.php?id=<?php echo $row['id']; ?>&admin=<?php echo $row['is_admin'] ? '0' : '1'; ?>">
                        <?php echo $row['is_admin'] ? 'Снять администратора' : 'Назначить админом'; ?>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>