<?php

// Điểm vào của API: /api/products.php (GET?page=&limit=, POST, PUT?id=, DELETE?id=)
require_once __DIR__ . '/../src/bootstrap.php';

$method = $_SERVER['REQUEST_METHOD'];

try {
    $controller = new ProductController(new ProductRepository(connectDatabase()), new ImageStorage());

    // id lấy từ URL, chỉ nhận số nguyên dương
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]) ?: null;

    // Đọc body JSON (chỉ cần cho POST, PUT)
    $input = [];
    if ($method === 'POST' || $method === 'PUT') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!is_array($input)) {
            Response::error('Dữ liệu gửi lên phải là JSON hợp lệ.', 400);
        }
    }

    match ($method) {
        'GET'    => $controller->index($_GET),
        'POST'   => $controller->store($input),
        'PUT'    => $controller->update($id, $input),
        'DELETE' => $controller->destroy($id),
        default  => Response::error('Phương thức không được hỗ trợ.', 405),
    };
} catch (PDOException $e) {
    error_log($e->getMessage());
    Response::error('Lỗi cơ sở dữ liệu, vui lòng thử lại sau.', 500);
}
