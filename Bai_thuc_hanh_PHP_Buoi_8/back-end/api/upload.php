<?php

// Điểm vào upload ảnh: POST /api/upload.php (multipart/form-data: id, image)
require_once __DIR__ . '/../src/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error('Phương thức không được hỗ trợ.', 405);
}

// Body lớn hơn post_max_size thì PHP bỏ trống cả $_POST và $_FILES
if (empty($_POST) && empty($_FILES) && (int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > 0) {
    Response::error('Ảnh vượt quá dung lượng tối đa 2 MB.', 413);
}

try {
    $controller = new UploadController(new ProductRepository(connectDatabase()), new ImageStorage());
    $controller->store($_POST, $_FILES);
} catch (PDOException $e) {
    error_log($e->getMessage());
    Response::error('Lỗi cơ sở dữ liệu, vui lòng thử lại sau.', 500);
} catch (RuntimeException $e) {
    error_log($e->getMessage());
    Response::error('Không lưu được ảnh, vui lòng thử lại.', 500);
}
