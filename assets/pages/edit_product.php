<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../../assets/pages/login.php');
    exit;
}

include '../../assets/pages/db_connect.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$product = null;
$imageUpdated = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imagePath = $product['image'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../assets/img/index/catalog/product_1';
        $fileName = time() . "_" . basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $imagePath = '../../assets/img/index/catalog/product_1' . $fileName;
            $imageUpdated = true;
        } else {
            echo "<p>Произошла ошибка при загрузке файла.</p>";
        }
    }

    $query = "UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdsi", $name, $description, $price, $imagePath, $product_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0 || $imageUpdated) {
        echo "<p>Товар обновлен.</p>";
    } else {
        echo "<p>Ошибка при обновлении товара.</p>";
    }
    $stmt->close();
} else {

    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        header('Location: ../../assets/pages/manage_products.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Редактирование товара | CopyStar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Редактирование товара</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../assets/pages/manage_products.php">&larr; Назад в управление
                        товарами</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>Редактировать товар</h1>
        <form action="edit_product.php?id=<?php echo $product_id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productName">Название товара</label>
                <input type="text" class="form-control" id="productName" name="name"
                    value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Описание товара</label>
                <textarea class="form-control" id="productDescription" name="description"
                    required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="productPrice">Цена</label>
                <input type="number" class="form-control" id="productPrice" name="price"
                    value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="productImage">Изображение товара</label>
                <input type="file" class="form-control-file" id="productImage" name="image">
                <?php if (!empty($product['image'])): ?>
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Текущее изображение"
                        style="max-width: 200px; max-height: 200px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Обновить товар</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.9.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>