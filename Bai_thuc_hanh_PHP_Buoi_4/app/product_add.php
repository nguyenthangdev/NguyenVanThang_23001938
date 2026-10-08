<?php

require_once __DIR__ . '/model/product.php';
require_once __DIR__ . '/common/productValidation.php';

$pageTitle = 'Thêm sản phẩm';
$name = '';
$price = '';
$quantity = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : '';
    $errors = validateProductInput($name, $price, $quantity);

    if (count($errors) === 0) {
        try {
            addProduct($name, $price, $quantity);
            header('Location: product_list.php?message=' . urlencode('Thêm sản phẩm thành công.'));
            exit;
        } catch (Throwable $exception) {
            $errors[] = $exception->getMessage();
        }
    }
}

require __DIR__ . '/view/header.php';
?>
    <h2>Thêm sản phẩm</h2>

    <?php if (count($errors) > 0): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= escapeHtml($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="product_add.php">
        <p>
            <label for="name">Tên sản phẩm:</label><br>
            <input id="name" name="name" type="text" maxlength="100" required value="<?= escapeHtml($name) ?>">
        </p>
        <p>
            <label for="price">Giá:</label><br>
            <input id="price" name="price" type="number" min="0.01" step="0.01" required value="<?= escapeHtml($price) ?>">
        </p>
        <p>
            <label for="quantity">Số lượng:</label><br>
            <input id="quantity" name="quantity" type="number" min="0" step="1" required value="<?= escapeHtml($quantity) ?>">
        </p>
        <button type="submit">Thêm sản phẩm</button>
        <a href="product_list.php">Hủy</a>
    </form>

<?php require __DIR__ . '/view/footer.php'; ?>
