<?php
require_once __DIR__ . '/../common/helpers.php';
$pageTitle = isset($pageTitle) ? $pageTitle : 'Quản lý sản phẩm';
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= escapeHtml($pageTitle) ?></title>
</head>
<body>
    <header>
        <h1>Quản lý sản phẩm giỏ hàng</h1>
        <nav>
            <a href="product_list.php">Danh sách sản phẩm</a> |
            <a href="product_add.php">Thêm sản phẩm</a>
        </nav>
        <hr>
    </header>
    <main>
