<?php
session_start();

function checkUserLoggedIn()
{
    return isset($_SESSION['name']);
}

$userLoggedIn = checkUserLoggedIn();

?>
<?php
include './assets/pages/db_connect.php';

$query = "SELECT * FROM products";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная | CopyStar</title>
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <header>
        <div class="logo-section">
            <img src="/assets/img/index/header/1.svg" alt="Логотип Copy Star">
            <h1>| CopyStar - Бесподобно копируя будущее!</h1>
        </div>
        <nav class="menu">
            <a href="#about-us">О нас</a>
            <a href="#catalog-section">Каталог</a>
            <a href="#contact-section">Где нас найти</a>
            <?php if ($userLoggedIn): ?>
                <span>Привет,
                    <?php echo htmlspecialchars($_SESSION['name']); ?>
                </span>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <a href="./assets/pages/admin.php"><i class="fas fa-cog"></i></a>
                <?php else: ?>
                    <a href="./assets/pages/my_profile.php"><i class="fas fa-user"></i></a>
                <?php endif; ?>
                <a href="./assets/pages/cart.php"><i class="fas fa-shopping-cart"></i></a>
                <a href="./assets/pages/logout.php"><i class="fas fa-sign-out-alt"></i></a>
            <?php else: ?>
                <button class="auth-btn"><a href="./assets/pages/login.php">Войти</a></button>
                <button class="auth-btn"><a href="./assets/pages/register.php">Регистрация</a></button>
            <?php endif; ?>
        </nav>
    </header>
    <section class="about-us" id="about-us">
        <h2 class="about_o">О нас</h2>
        <div class="about-content">
            <div class="about-description">
                <p>Компания Copy Star - ваш надежный партнер в мире текстов и контента. Наша миссия - помогать вашему
                    бизнесу выделяться и достигать успеха благодаря качественным копирайтингу и контент-решениям.</p>
            </div>
            <div class="about-slider">
                <script src="/assets/js/index.js"></script>
                <p class="call_0">Наши новинки:</p>
                <div class="about-slide" id="aboutSlide1">
                    <img src="assets//img/index/slider/1.jpg" alt="Фото_1">
                </div>
                <div class="about-slide" id="aboutSlide2">
                    <img src="assets//img/index/slider/2.jpg" alt="Фото_2">
                </div>
                <div class="call_1">
                    <button class="slider-btn slider-prev">❮</button>
                    <button class="slider-btn slider-next">❯</button>
                </div>
            </div>
        </div>
    </section>
    <section class="catalog-section" id="catalog-section">
        <h2 class="catalog-title">Каталог товаров:</h2>
        <div class="products-wrapper">
            <div class="products-container">
                <?php while ($product = $result->fetch_assoc()): ?>
                    <div class="product">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>"
                            alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3>
                            <?php echo htmlspecialchars($product['name']); ?>
                        </h3>
                        <p>
                            <?php echo htmlspecialchars($product['description']); ?>
                        </p>
                        <p>Цена:
                            <?php echo htmlspecialchars($product['price']); ?> руб.
                        </p>
                        <form action="../../assets/pages/add_to_cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="number" name="quantity" value="1" min="1">
                            <button type="submit">Добавить в корзину</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <section class="contact-section" id="contact-section">
        <div class="contact-map" id="map">
            <img class="contact-map" src="./assets/img/index/map/1.jpg" alt="Карта">
        </div>
        <div class="contact-info">
            <h2>Где нас найти</h2>
            <p><strong>Адрес:</strong> Г. Новомосковск, мкр. Сокольники, ул. Шахтреская, д.11</p>
            <p><strong>Телефон:</strong> +7 (993) 538-08-20</p>
            <p><strong>Email:</strong> D.I.M.1.A.S@yandex.ru</p>
            <p><strong>Часы работы:</strong> Пн-Пт: 9:00 - 18:00, Сб-Вс: выходной</p>
        </div>
    </section>
    <footer class="footer-section">
        <div class="footer-logo-section">
            <img src="/assets/img/index/header/1.svg" alt="Логотип Copy Star">
            <h1>| CopyStar</h1>
        </div>
        <nav class="footer-menu">
            <a href="#about-us">О нас</a>
            <a href="#catalog-section">Каталог</a>
            <a href="#contact-section">Где нас найти</a>
        </nav>
    </footer>
</body>

</html>