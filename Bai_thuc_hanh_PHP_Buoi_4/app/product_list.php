<?php

require_once __DIR__ . '/model/product.php';

$pageTitle = 'Danh sách sản phẩm';
$products = [];
$error = '';
$message = isset($_GET['message']) ? trim($_GET['message']) : '';

try {
    $products = getAllProducts();
} catch (Throwable $exception) {
    $error = $exception->getMessage();
}

require __DIR__ . '/view/header.php';
?>
    <h2>Danh sách sản phẩm</h2>

    <?php if ($message !== ''): ?>
        <p><strong><?= escapeHtml($message) ?></strong></p>
    <?php endif; ?>

    <?php if ($error !== ''): ?>
        <p><?= escapeHtml($error) ?></p>
    <?php elseif (count($products) === 0): ?>
        <p>Chưa có sản phẩm nào.</p>
    <?php else: ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= escapeHtml($product['id']) ?></td>
                        <td><?= escapeHtml($product['name']) ?></td>
                        <td><?= escapeHtml(formatPrice($product['price'])) ?></td>
                        <td><?= escapeHtml($product['quantity']) ?></td>
                        <td>
                            <a href="product_edit.php?id=<?= urlencode($product['id']) ?>">Sửa</a>
                            <a href="product_delete.php?id=<?= urlencode($product['id']) ?>">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

<?php require __DIR__ . '/view/footer.php'; ?>
