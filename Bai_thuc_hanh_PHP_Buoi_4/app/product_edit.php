<?php

require_once __DIR__ . '/model/product.php';
require_once __DIR__ . '/common/productValidation.php';

$pageTitle = 'Sửa sản phẩm';
$errors = [];
$product = null;
$idSource = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET;
$id = isset($idSource['id']) ? filter_var($idSource['id'], FILTER_VALIDATE_INT) : false;
$name = '';
$price = '';
$quantity = '';

if ($id === false || $id <= 0) {
    $errors[] = 'ID sản phẩm không hợp lệ.';
} else {
    try {
        $product = getProductById($id);
        if ($product === null) {
            $errors[] = 'Không tìm thấy sản phẩm.';
        }
    } catch (Throwable $exception) {
        $errors[] = $exception->getMessage();
    }
}

if ($product !== null) {
    $name = $product['name'];
    $price = $product['price'];
    $quantity = $product['quantity'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product !== null) {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : '';
    $errors = validateProductInput($name, $price, $quantity);

    if (count($errors) === 0) {
        try {
            updateProduct($id, $name, $price, $quantity);
            header('Location: product_list.php?message=' . urlencode('Cập nhật sản phẩm thành công.'));
            exit;
        } catch (Throwable $exception) {
            $errors[] = $exception->getMessage();
        }
    }
}

require __DIR__ . '/view/header.php';
?>
    <h2>Sửa sản phẩm</h2>

    <?php if (count($errors) > 0): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= escapeHtml($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($product !== null): ?>
        <form method="post" action="product_edit.php">
            <input type="hidden" name="id" value="<?= escapeHtml($id) ?>">
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
            <button type="submit">Cập nhật</button>
            <a href="product_list.php">Hủy</a>
        </form>
    <?php else: ?>
        <p><a href="product_list.php">Quay lại danh sách sản phẩm</a></p>
    <?php endif; ?>

<?php require __DIR__ . '/view/footer.php'; ?>
