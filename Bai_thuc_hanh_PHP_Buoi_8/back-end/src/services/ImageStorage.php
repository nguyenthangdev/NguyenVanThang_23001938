<?php

// Lưu và xóa file ảnh trong thư mục uploads/ (được web server phục vụ trực tiếp)
class ImageStorage
{
    private const DIR = 'uploads';

    private string $root;

    public function __construct()
    {
        $this->root = dirname(__DIR__, 2);
    }

    // Lưu file tạm với tên duy nhất, trả về đường dẫn tương đối để ghi vào cột image
    public function store(string $tmpPath, string $extension): string
    {
        $relative = self::DIR . '/' . bin2hex(random_bytes(16)) . '.' . $extension;
        if (!move_uploaded_file($tmpPath, $this->root . '/' . $relative)) {
            throw new RuntimeException('Không lưu được file ảnh.');
        }
        return $relative;
    }

    public function delete(?string $relative): void
    {
        // basename() để chắc chắn chỉ xóa file nằm trong uploads/
        if ($relative) {
            @unlink($this->root . '/' . self::DIR . '/' . basename($relative));
        }
    }
}
