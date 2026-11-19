<?php

// Cấu hình kết nối MySQL, đọc từ biến môi trường (xem compose.yaml)
return [
    'host'     => getenv('DB_HOST') ?: 'localhost',
    'name'     => getenv('DB_NAME') ?: 'product_db',
    'user'     => getenv('DB_USER') ?: 'product_user',
    'password' => getenv('DB_PASSWORD') ?: 'product_password',
];
