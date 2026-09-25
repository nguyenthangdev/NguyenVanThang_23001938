<?php

require_once __DIR__ . '/Movie.php';
require_once __DIR__ . '/functions.php';

$movies = [
    new Movie(1, 'Avengers', 100000, 100),
    new Movie(2, 'Avatar', 120000, 80),
    new Movie(3, 'Batman', 90000, 120),
];

$avengers = findMovieById($movies, 1);
$avatar = findMovieById($movies, 2);
$messages = [];

$messages[] = $avengers->bookTicket(30);
$messages[] = $avatar->bookTicket(25);
$messages[] = $avengers->cancelTicket(5);

$bestSellingMovie = getBestSellingMovie($movies);
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài 2 - Quản lý vé xem phim</title>
</head>

<body>
    <h1>Bài 2 - Quản lý vé xem phim</h1>

    <h2>Kết quả đặt và hủy vé</h2>
    <ul>
        <?php foreach ($messages as $message): ?>
            <li><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Danh sách phim</h2>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Mã phim</th>
            <th>Tên phim</th>
            <th>Giá vé</th>
            <th>Tổng số ghế</th>
            <th>Ghế còn lại</th>
            <th>Vé đã bán</th>
            <th>Doanh thu</th>
        </tr>
        <?php foreach ($movies as $movie) $movie->displayInfo(); ?>
    </table>

    <p><strong>Tổng doanh thu:</strong> <?= number_format(getTotalRevenue($movies), 0, ',', '.') ?> đ</p>
    <p>
        <strong>Phim bán nhiều vé nhất:</strong>
        <?= htmlspecialchars($bestSellingMovie->getTitle(), ENT_QUOTES, 'UTF-8') ?>
        (<?= $bestSellingMovie->getSoldSeats() ?> vé)
    </p>

    <h2>Kiểm tra trường hợp không hợp lệ</h2>
    <ul>
        <li>Đặt 0 vé: <?= htmlspecialchars($avengers->bookTicket(0), ENT_QUOTES, 'UTF-8') ?></li>
        <li>Đặt quá số ghế còn lại: <?= htmlspecialchars($avengers->bookTicket(1000), ENT_QUOTES, 'UTF-8') ?></li>
        <li>Hủy 0 vé: <?= htmlspecialchars($avengers->cancelTicket(0), ENT_QUOTES, 'UTF-8') ?></li>
        <li>Hủy quá số vé đã bán: <?= htmlspecialchars($avengers->cancelTicket(1000), ENT_QUOTES, 'UTF-8') ?></li>
        <li>Tìm phim không tồn tại: <?= findMovieById($movies, 999) === null ? 'Không tìm thấy phim.' : 'Đã tìm thấy phim.' ?></li>
        <li>Tổng doanh thu danh sách rỗng: <?= number_format(getTotalRevenue([]), 0, ',', '.') ?> đ</li>
        <li>Phim bán chạy nhất trong danh sách rỗng: <?= getBestSellingMovie([]) === null ? 'Không có phim.' : 'Đã tìm thấy phim.' ?></li>
    </ul>
</body>

</html>