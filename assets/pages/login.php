<?php
session_start();
include '../../assets/pages/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if ($stmt === false) {
        die("Ошибка подготовки запроса: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name'];
            $_SESSION['is_admin'] = $row['is_admin'];

            header("Location: ../../index.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Неправильный пароль.";
        }
    } else {
        $_SESSION['login_error'] = "Пользователь с таким email не существует.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация | CopyStar</title>
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="login-container">
        <div class="logo-section">
            <a href="../../index.php">
                <img src="/assets/img/index/header/1.svg" alt="Логотип Copy Star">
            </a>
            <h1>| CopyStar</h1>
        </div>
        <form class="login-form" action="" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="auth-btn">Войти</button>
        </form>

        <div id="message-section">
            <?php echo isset($_SESSION['login_error']) ? $_SESSION['login_error'] : ''; ?>
        </div>
    </div>
</body>

</html>