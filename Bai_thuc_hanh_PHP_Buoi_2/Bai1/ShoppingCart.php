<?php

require_once __DIR__ . '/CartItem.php';

class ShoppingCart
{
    private $items = [];

    public function addItem($item)
    {
        if (!($item instanceof CartItem)) {
            return 'Không thể thêm: dữ liệu không phải là một CartItem.';
        }

        if ($item->getPrice() <= 0) {
            return 'Không thể thêm: đơn giá sản phẩm phải lớn hơn 0.';
        }

        if ($item->getQuantity() <= 0) {
            return 'Không thể thêm: số lượng sản phẩm phải lớn hơn 0.';
        }

        $this->items[] = $item;
        return 'Đã thêm sản phẩm "' . $item->getName() . '".';
    }

    public function removeItem($name)
    {
        $name = trim((string) $name);

        foreach ($this->items as $index => $item) {
            if (strtolower($item->getName()) === strtolower($name)) {
                array_splice($this->items, $index, 1);
                return 'Đã xóa sản phẩm "' . $item->getName() . '".';
            }
        }

        return 'Không tìm thấy sản phẩm "' . $name . '" trong giỏ hàng.';
    }

    public function calculateTotal()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }

        return $total;
    }

    public function displayCart()
    {
        if (count($this->items) === 0) {
            echo '<p>Giỏ hàng chưa có sản phẩm.</p>';
            echo '<p><strong>Tổng tiền:</strong> 0 đ</p>';
            return;
        }

        echo '<table border="1" cellpadding="6" cellspacing="0">';
        echo '<tr><th>Tên sản phẩm</th><th>Đơn giá</th><th>Số lượng</th><th>Thành tiền</th></tr>';

        foreach ($this->items as $item) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($item->getName(), ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . number_format($item->getPrice(), 0, ',', '.') . ' đ</td>';
            echo '<td>' . $item->getQuantity() . '</td>';
            echo '<td>' . number_format($item->getTotal(), 0, ',', '.') . ' đ</td>';
            echo '</tr>';
        }

        echo '</table>';
        echo '<p><strong>Tổng tiền:</strong> '
            . number_format($this->calculateTotal(), 0, ',', '.') . ' đ</p>';
    }
}
