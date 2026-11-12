<?php

// Điểm vào của API: /api/products.php (GET, POST, PUT?id=, DELETE?id=)
require_once __DIR__ . '/../src/http/Response.php';
require_once __DIR__ . '/../src/database/Database.php';
require_once __DIR__ . '/../src/validators/ProductValidator.php';
require_once __DIR__ . '/../src/repositories/ProductRepository.php';
require_once __DIR__ . '/../src/controllers/ProductController.php';

// CORS cho front-end chạy ở cổng khác (Vite dev server)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    http_response_code(204);
    exit;
}

try {
    $controller = new ProductController(
        new ProductRepository(Database::connect(require __DIR__ . '/../src/config/config.php'))
    );

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
        'GET'    => $controller->index(),
        'POST'   => $controller->store($input),
        'PUT'    => $controller->update($id, $input),
        'DELETE' => $controller->destroy($id),
        default  => Response::error('Phương thức không được hỗ trợ.', 405),
    };
} catch (PDOException $e) {
    error_log($e->getMessage());
    Response::error('Lỗi cơ sở dữ liệu, vui lòng thử lại sau.', 500);
}
