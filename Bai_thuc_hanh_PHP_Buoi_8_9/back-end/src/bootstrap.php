<?php

// Nạp các lớp dùng chung và đặt header CORS cho mọi endpoint trong api/
require_once __DIR__ . '/http/Response.php';
require_once __DIR__ . '/database/Database.php';
require_once __DIR__ . '/validators/ProductValidator.php';
require_once __DIR__ . '/validators/ImageValidator.php';
require_once __DIR__ . '/repositories/ProductRepository.php';
require_once __DIR__ . '/services/ImageStorage.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/UploadController.php';

// CORS cho front-end chạy ở cổng khác (Vite dev server)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

function connectDatabase(): PDO
{
    return Database::connect(require __DIR__ . '/config/config.php');
}
