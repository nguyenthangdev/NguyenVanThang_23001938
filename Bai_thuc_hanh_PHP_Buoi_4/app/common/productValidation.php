<?php

function validateProductInput($name, $price, $quantity)
{
    $errors = [];

    if (trim((string) $name) === '') {
        $errors[] = 'Tên sản phẩm không được để trống.';
    }

    if (!is_numeric($price) || (float) $price <= 0) {
        $errors[] = 'Giá sản phẩm phải lớn hơn 0.';
    }

    $validatedQuantity = filter_var($quantity, FILTER_VALIDATE_INT);
    if ($validatedQuantity === false || $validatedQuantity < 0) {
        $errors[] = 'Số lượng phải là số nguyên lớn hơn hoặc bằng 0.';
    }

    return $errors;
}
