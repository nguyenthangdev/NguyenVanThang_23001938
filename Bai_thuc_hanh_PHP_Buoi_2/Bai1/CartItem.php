<?php

class CartItem
{
    private $name;
    private $price;
    private $quantity;

    public function __construct($name, $price, $quantity)
    {
        $name = trim((string) $name);

        if ($name === '') {
            throw new InvalidArgumentException('Tên sản phẩm không được để trống.');
        }

        if (!is_numeric($price) || $price <= 0) {
            throw new InvalidArgumentException('Đơn giá sản phẩm phải lớn hơn 0.');
        }

        if (filter_var($quantity, FILTER_VALIDATE_INT) === false || $quantity <= 0) {
            throw new InvalidArgumentException('Số lượng sản phẩm phải là số nguyên lớn hơn 0.');
        }

        $this->name = $name;
        $this->price = (float) $price;
        $this->quantity = (int) $quantity;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getTotal()
    {
        return $this->price * $this->quantity;
    }
}
