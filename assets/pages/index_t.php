<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ваш Сайт</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/index.css">
</head>

<body>
    <!-- Шапка сайта -->
    <header class="bg-dark text-white py-2 px-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Логотип и название сайта -->
                    <div class="d-flex align-items-center">
                        <img src="/assets/img/index/header/1.svg" alt="Логотип" class="logo">
                        <div class="ml-3">
                            <h1 class="h3 mb-0">CopyStar</h1>
                            <p class="mb-0">Бесподобно копируя будущее!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Навигационное меню -->
                    <nav class="d-flex justify-content-end">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#about-us">О нас</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#catalog-section">Каталог</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#contact-section">Где нас найти</a>
                            </li>
                            <!-- Дополнительные элементы меню -->
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </header>

    <!-- Основное содержимое страницы -->
    <main>
        <div class="container mt-4">
            <!-- Раздел "О нас" -->
            <!-- Раздел "О нас" -->
            <section id="about-us" class="my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="h1 font-weight-bold">О нас</h2>
                            <p class="lead">
                                Компания CopyStar - ваш надежный партнер в мире текстов и контента. Наша миссия -
                                помогать вашему бизнесу выделяться и достигать успеха благодаря качественным
                                копирайтингу и контент-решениям.
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <!-- Слайдер с изображениями -->
                            <div id="aboutUsCarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#aboutUsCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#aboutUsCarousel" data-slide-to="1"></li>
                                    <li data-target="#aboutUsCarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="/assets/img/catalog/product/1.jpg" class="d-block w-100"
                                            alt="Изображение 1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="path_to_your_second_image.jpg" class="d-block w-100"
                                            alt="Изображение 2">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="path_to_your_third_image.jpg" class="d-block w-100"
                                            alt="Изображение 3">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#aboutUsCarousel" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Предыдущий</span>
                                </a>
                                <a class="carousel-control-next" href="#aboutUsCarousel" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Следующий</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Продуктовая карточка -->
            
            <div class="card mb-4 shadow-sm">
                <img src="path_to_product_image.jpg" class="card-img-top" alt="Название продукта">
                <div class="card-body">
                    <h5 class="card-title">Название продукта</h5>
                    <p class="card-text">Краткое описание продукта...</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Посмотреть</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Редактировать</button>
                        </div>
                        <small class="text-muted">9 минут назад</small>
                    </div>
                </div>
            </div>

            <!-- Контактная информация -->
            <!-- Контактная информация -->
<section id="contact-section" class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="h1 font-weight-bold">Где нас найти</h2>
                <p class="lead">Наш адрес и контакты ниже. Пожалуйста, свяжитесь с нами, если у вас есть вопросы.</p>
                <div class="contact-info">
                    <p><strong>Адрес:</strong> Г. Новомосковск, мкр. Сокольники, ул. Шахтреская, д.11</p>
                    <p><strong>Телефон:</strong> +7 (993) 538-08-20</p>
                    <p><strong>Email:</strong> D.I.M.1.A.S@yandex.ru</p>
                    <p><strong>Часы работы:</strong> Пн-Пт: 9:00 - 18:00, Сб-Вс: выходной</p>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Форма обратной связи -->
                <form>
                    <div class="form-group">
                        <label for="contactName">Имя</label>
                        <input type="text" class="form-control" id="contactName" placeholder="Введите ваше имя">
                    </div>
                    <div class="form-group">
                        <label for="contactEmail">Email</label>
                        <input type="email" class="form-control" id="contactEmail" placeholder="Введите ваш email">
                    </div>
                    <div class="form-group">
                        <label for="contactMessage">Сообщение</label>
                        <textarea class="form-control" id="contactMessage" rows="3" placeholder="Введите ваше сообщение"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>
</section>

        </div>
    </main>

    <!-- Подвал сайта -->
    <footer class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Логотип и название сайта в подвале -->
                </div>
                <div class="col-md-6">
                    <!-- Навигационное меню в подвале -->
                </div>
            </div>
        </div>
    </footer>

    <!-- Подключение Bootstrap JS и зависимостей -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>