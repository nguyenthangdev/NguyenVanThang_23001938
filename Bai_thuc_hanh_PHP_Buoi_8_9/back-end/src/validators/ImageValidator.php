<?php

class ImageValidator
{
    public const MAX_SIZE = 2 * 1024 * 1024; // 2 MB

    // Loại ảnh thực tế (đọc từ nội dung file) => phần mở rộng khi lưu
    public const ALLOWED_TYPES = [
        'image/jpeg' => 'jpg',
        'image/png'  => 'png',
    ];

    /**
     * Kiểm tra một phần tử của $_FILES.
     * Trả về [phần mở rộng, thông báo lỗi]; lỗi là null nếu hợp lệ.
     */
    public static function validate(?array $file): array
    {
        if ($file === null || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return [null, 'Vui lòng chọn ảnh để tải lên.'];
        }
        if (in_array($file['error'], [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true)) {
            return [null, 'Ảnh vượt quá dung lượng tối đa 2 MB.'];
        }
        if ($file['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])) {
            return [null, 'Tải ảnh lên không thành công, vui lòng thử lại.'];
        }
        if ($file['size'] > self::MAX_SIZE) {
            return [null, 'Ảnh vượt quá dung lượng tối đa 2 MB.'];
        }

        // Không tin vào tên file hay Content-Type do trình duyệt gửi, đọc loại thật từ nội dung
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        if (!isset(self::ALLOWED_TYPES[$mime]) || getimagesize($file['tmp_name']) === false) {
            return [null, 'Chỉ chấp nhận ảnh JPG, JPEG hoặc PNG.'];
        }

        return [self::ALLOWED_TYPES[$mime], null];
    }
}
