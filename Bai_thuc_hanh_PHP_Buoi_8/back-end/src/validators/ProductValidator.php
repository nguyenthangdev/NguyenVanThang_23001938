<?php

class ProductValidator
{
    // Giới hạn của kiểu INT trong MySQL
    private const INT_MAX = 2147483647;

    /**
     * Kiểm tra và chuẩn hóa dữ liệu sản phẩm.
     * Trả về [dữ liệu đã chuẩn hóa, thông báo lỗi]; lỗi là null nếu hợp lệ.
     */
    public static function validate(array $input): array
    {
        $name = $input['name'] ?? null;
        if (!is_string($name)) {
            return [null, 'Tên sản phẩm là bắt buộc.'];
        }
        $name = trim($name);
        $length = mb_strlen($name);
        if ($length < 1 || $length > 100) {
            return [null, 'Tên sản phẩm phải từ 1 đến 100 ký tự.'];
        }

        $price = self::toInt($input['price'] ?? null);
        if ($price === null || $price <= 0) {
            return [null, 'Đơn giá phải là số nguyên lớn hơn 0.'];
        }
        if ($price > self::INT_MAX) {
            return [null, 'Đơn giá quá lớn, vui lòng nhập giá trị nhỏ hơn.'];
        }

        $stock = self::toInt($input['stock'] ?? null);
        if ($stock === null || $stock < 0) {
            return [null, 'Số lượng tồn phải là số nguyên không âm.'];
        }
        if ($stock > self::INT_MAX) {
            return [null, 'Số lượng tồn quá lớn, vui lòng nhập giá trị nhỏ hơn.'];
        }

        return [['name' => $name, 'price' => $price, 'stock' => $stock], null];
    }

    // Chấp nhận số nguyên hoặc chuỗi số nguyên; từ chối số thực, bool, null, chuỗi rỗng
    private static function toInt(mixed $value): ?int
    {
        if (is_int($value)) {
            return $value;
        }
        if (is_string($value) && preg_match('/^-?\d{1,10}$/', trim($value))) {
            return (int) trim($value);
        }
        return null;
    }
}
