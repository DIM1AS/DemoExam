<?php
session_start();

$host = '127.0.0.1';
$db = 'CopyStar';
$user = 'root';
$pass = '';
$port = "3306";
$charset = 'utf8mb4';
    
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$current_user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT name, surname, patronymic, email FROM users WHERE id = ?");
$stmt->execute([$current_user_id]);
$user = $stmt->fetch();

$stmt = $pdo->prepare("SELECT p.name, o.quantity, o.total_price, o.order_date 
                        FROM orders o 
                        JOIN products p ON o.product_id = p.id 
                        WHERE o.user_id = ?");
$stmt->execute([$current_user_id]);
$orders = $stmt->fetchAll();



if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $patronymic = $_POST['patronymic'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET name = ?, surname = ?, patronymic = ?, email = ? WHERE id = ?");
    $stmt->execute([$name, $surname, $patronymic, $email, $current_user_id]);

    $_SESSION['message'] = "Данные успешно обновлены!";
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <h2>Личный кабинет</h2>
            <a href="../../index.php" class="btn btn-secondary">Назад</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <p>Привет, <strong>
                        <?= htmlspecialchars($user['name']) . ' ' . htmlspecialchars($user['surname']) ?>
                    </strong>!</p>
                <p>Ваш email: <strong>
                        <?= htmlspecialchars($user['email']) ?>
                    </strong></p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
                    Изменить данные
                </button>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header">
                <h3>История заказов</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Название товара</th>
                                <th>Количество</th>
                                <th>Цена</th>
                                <th>Дата заказа</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars($order['name']) ?>
                                    </td>
                                    <td>
                                        <?= $order['quantity'] ?>
                                    </td>
                                    <td>
                                        <?= $order['total_price'] ?> руб.
                                    </td>
                                    <td>
                                        <?= $order['order_date'] ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Редактирование профиля</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editProfileForm" method="post">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?= htmlspecialchars($user['name']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="surname">Фамилия</label>
                                <input type="text" class="form-control" id="surname" name="surname"
                                    value="<?= htmlspecialchars($user['surname']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="patronymic">Отчество</label>
                                <input type="text" class="form-control" id="patronymic" name="patronymic"
                                    value="<?= htmlspecialchars($user['patronymic']) ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="<?= htmlspecialchars($user['email']) ?>" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type="submit" name="update_profile" class="btn btn-primary">Сохранить
                                    изменения</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>