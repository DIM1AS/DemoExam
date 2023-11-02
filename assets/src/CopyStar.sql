-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 02 2023 г., 20:45
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `CopyStar`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `total_price`, `order_date`) VALUES
(1, 1, 18, 6, NULL, '2023-11-02 17:40:20'),
(2, 1, 30, 500, NULL, '2023-11-02 17:40:20'),
(3, 1, 27, 5000, NULL, '2023-11-02 17:40:20');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(17, 'PrintMax Pro 2023', 'Высокоскоростной офисный принтер с поддержкой Wi-Fi и NFC', '1200.00', 'assets/img/index/catalog/product/1.jpg'),
(18, 'ColorJet 5X', 'Многофункциональный цветной принтер для дома и офиса', '850.50', 'assets/img/index/catalog/product/1.jpg'),
(19, 'EcoPrint LTX', 'Экономичный принтер с системой непрерывной подачи чернил', '699.99', 'assets/img/index/catalog/product/1.jpg'),
(20, 'LaserPro 4D', 'Профессиональный лазерный принтер для бизнес-потребностей', '1300.00', 'assets/img/index/catalog/product/4.jpg'),
(21, 'CompactPrint C1', 'Компактный настольный принтер, идеальный для малого офиса', '300.00', 'assets/img/index/catalog/product/2.jpg'),
(22, 'PhotoMaster HD', 'Фотопринтер высокого разрешения для профессиональной печати', '1200.00', 'assets/img/index/catalog/product/6.jpg'),
(23, 'OfficeJet Elite', 'Многофункциональное устройство: принтер, сканер, копир', '950.00', 'assets/img/index/catalog/product/7.jpg'),
(24, 'PrintStation ProX', 'Промышленный принтер для крупноформатной печати', '2500.00', 'assets/img/index/catalog/product/8.jpg'),
(25, 'Wireless Wonder W2', 'Беспроводной принтер с поддержкой облачной печати', '400.00', 'assets/img/index/catalog/product/9.jpg'),
(26, 'SpeedPrint S300', 'Сверхбыстрый принтер для больших объемов печати', '1100.00', 'assets/img/index/catalog/product/10.jpg'),
(27, 'EcoFriendly E10', 'Экологичный принтер с минимальным энергопотреблением', '650.00', 'assets/img/index/catalog/product/11.jpg'),
(28, 'PrintPro All-in-One', 'Универсальное решение для печати, сканирования и копирования', '800.00', 'assets/img/index/catalog/product/12.jpg'),
(29, 'StudioJet Art', 'Принтер для печати на холстах и тяжелых бумагах', '1500.00', 'assets/img/index/catalog/product/13.jpg'),
(30, 'MobileMini M1', 'Портативный принтер для печати с мобильных устройств', '220.00', 'assets/img/index/catalog/product/14.jpg'),
(31, 'UltraPrint UHD', 'Принтер ультравысокого разрешения для дизайнерских нужд', '1800.00', 'assets/img/index/catalog/product/15.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patronymic` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `patronymic`, `login`, `email`, `password`, `is_admin`) VALUES
(1, 'Дмитрий', 'Костяшев', 'Олегович', 'DIM1AS', 'dima.kostiasev@mail.ru', '$2y$10$Mj.5Zfkhz6pjiFoGkaZJEuc4gOv/W6LRVY5HneA2JUtH42JBdiNe6', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
