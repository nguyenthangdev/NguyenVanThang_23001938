<?php

require_once __DIR__ . '/ShoppingCart.php';

function createAndAddItem($cart, $name, $price, $quantity)
{
    try {
        $item = new CartItem($name, $price, $quantity);
        return $cart->addItem($item);
    } catch (InvalidArgumentException $exception) {
        return 'Không thể thêm "' . $name . '": ' . $exception->getMessage();
    }
}

$cart = new ShoppingCart();
$messages = [];

$messages[] = createAndAddItem($cart, 'Laptop', 15000000, 1);
$messages[] = createAndAddItem($cart, 'Chuột không dây', 350000, 2);
$messages[] = createAndAddItem($cart, 'Bàn phím', 700000, 1);
$messages[] = createAndAddItem($cart, 'Tai nghe', 1200000, 2);
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 1 - Giỏ hàng mua sắm</title>
</head>

<body>
    <h1>Bài 1 - Xây dựng giỏ hàng mua sắm</h1>

    <h2>Kết quả thêm sản phẩm</h2>
    <ul>
        <?php foreach ($messages as $message): ?>
            <li><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Giỏ hàng ban đầu</h2>
    <?php $cart->displayCart(); ?>

    <h2>Xóa sản phẩm</h2>
    <p><?= htmlspecialchars($cart->removeItem('Bàn phím'), ENT_QUOTES, 'UTF-8') ?></p>

    <h2>Giỏ hàng sau khi xóa</h2>
    <?php $cart->displayCart(); ?>

    <h2>Kiểm tra trường hợp không hợp lệ</h2>
    <ul>
        <li><?= htmlspecialchars(createAndAddItem($cart, 'Sản phẩm lỗi giá', 0, 1), ENT_QUOTES, 'UTF-8') ?></li>
        <li><?= htmlspecialchars(createAndAddItem($cart, 'Sản phẩm lỗi số lượng', 100000, 0), ENT_QUOTES, 'UTF-8') ?></li>
        <li><?= htmlspecialchars($cart->removeItem('Sản phẩm không tồn tại'), ENT_QUOTES, 'UTF-8') ?></li>
        <li>Giỏ hàng rỗng: <?php $emptyCart = new ShoppingCart(); ?><?= number_format($emptyCart->calculateTotal(), 0, ',', '.') ?> đ</li>
    </ul>
</body>

</html>