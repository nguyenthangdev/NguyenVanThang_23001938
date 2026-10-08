<?php

require_once __DIR__ . '/model/product.php';

$pageTitle = 'Xóa sản phẩm';
$error = '';
$product = null;
$idSource = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $_GET;
$id = isset($idSource['id']) ? filter_var($idSource['id'], FILTER_VALIDATE_INT) : false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel'])) {
    header('Location: product_list.php');
    exit;
}

if ($id === false || $id <= 0) {
    $error = 'ID sản phẩm không hợp lệ.';
} else {
    try {
        $product = getProductById($id);
        if ($product === null) {
            $error = 'Sản phẩm không tồn tại hoặc đã bị xóa.';
        }
    } catch (Throwable $exception) {
        $error = $exception->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product !== null && isset($_POST['confirm'])) {
    try {
        if (deleteProduct($id)) {
            header('Location: product_list.php?message=' . urlencode('Xóa sản phẩm thành công.'));
            exit;
        }
        $error = 'Sản phẩm không tồn tại hoặc đã bị xóa.';
        $product = null;
    } catch (Throwable $exception) {
        $error = $exception->getMessage();
    }
}

require __DIR__ . '/view/header.php';
?>
    <h2>Xóa sản phẩm</h2>

    <?php if ($error !== ''): ?>
        <p><?= escapeHtml($error) ?></p>
        <p><a href="product_list.php">Quay lại danh sách sản phẩm</a></p>
    <?php elseif ($product !== null): ?>
        <p>
            Bạn có chắc muốn xóa sản phẩm
            <strong><?= escapeHtml($product['name']) ?></strong> không?
        </p>
        <form method="post" action="product_delete.php">
            <input type="hidden" name="id" value="<?= escapeHtml($id) ?>">
            <button type="submit" name="confirm" value="1">Xác nhận xóa</button>
            <button type="submit" name="cancel" value="1">Hủy</button>
        </form>
    <?php endif; ?>

<?php require __DIR__ . '/view/footer.php'; ?>
