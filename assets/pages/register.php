<?php
include "../../assets/pages/db_connect.php";

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $surname = $conn->real_escape_string($_POST['surname']);
    $patronymic = $conn->real_escape_string($_POST['patronymic']);
    $login = $conn->real_escape_string($_POST['login']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkSql = "SELECT * FROM users WHERE login='$login' OR email='$email'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        $message = "Такой логин или email уже существует!";
    } else {
        $sql = "INSERT INTO users (name, surname, patronymic, login, email, password) 
                VALUES ('$name', '$surname', '$patronymic', '$login', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            $message = "Успешно зарегистрировано!";
            header("Location: ../../assets/pages/login.php");
        } else {
            $message = "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация | CopyStar</title>
    <link rel="stylesheet" href="../../assets/css/register.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="login-container">
        <div class="logo-section">
            <a href="../../index.php">
                <img src="/assets/img/index/header/1.svg" alt="Логотип Copy Star">
            </a>
            <h1>| Регистрация</h1>
        </div>
        <form class="login-form" action="" method="POST" id="registration-form">
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" id="name" name="name" required pattern="[А-Яа-яЁё\s\-]+">
            </div>
            <div class="form-group">
                <label for="surname">Фамилия:</label>
                <input type="text" id="surname" name="surname" required pattern="[А-Яа-яЁё\s\-]+">
            </div>
            <div class="form-group">
                <label for="patronymic">Отчество:</label>
                <input type="text" id="patronymic" name="patronymic" pattern="[А-Яа-яЁё\s\-]+">
            </div>
            <div class="form-group">
                <label for="login">Логин:</label>
                <input type="text" id="login" name="login" required pattern="[a-zA-Z0-9\-]+">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required minlength="6">
            </div>
            <div class="form-group">
                <input class="ruik" type="checkbox" id="rules" name="rules" required>
                <label for="rules">Я согласен с пользовательским соглашением</label>
            </div>
            <script src="../../assets/js/register.js"></script>
            <div class="form-actions">
                <button type="submit" class="auth-btn">Зарегистрироваться</button>
            </div>
        </form>
        <div id="message-section">
            <?php echo $message; ?>
        </div>
    </div>

    <div id="rulesModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Пользовательское соглашение:</h2>
            <p>1. Для совершения покупок необходимо зарегистрировать аккаунт в магазине.</p>
            <p>2. При регистрации предоставьте достоверную информацию о себе.</p>
            <p>3. Нельзя использовать данные других лиц.</p>
            <p>4. Интернет-магазин <b>НЕ</b> несет ответственность за финансовые гарантии. </p>
            <p>5. Интернет-магазин <b>НЕ</b> несет ответственность за предоставление товаров.</p>
        </div>
    </div>

    <script src="../../assets/js/register.js"></script>
</body>

</html>