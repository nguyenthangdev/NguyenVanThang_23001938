<?php

class Movie
{
    private $id;
    private $title;
    private $price;
    private $totalSeats;
    private $availableSeats;

    public function __construct($id, $title, $price, $totalSeats)
    {
        if (filter_var($id, FILTER_VALIDATE_INT) === false || $id <= 0) {
            throw new InvalidArgumentException('Mã phim phải là số nguyên lớn hơn 0.');
        }

        if (trim((string) $title) === '') {
            throw new InvalidArgumentException('Tên phim không được để trống.');
        }

        if (!is_numeric($price) || $price <= 0) {
            throw new InvalidArgumentException('Giá vé phải lớn hơn 0.');
        }

        if (filter_var($totalSeats, FILTER_VALIDATE_INT) === false || $totalSeats <= 0) {
            throw new InvalidArgumentException('Tổng số ghế phải là số nguyên lớn hơn 0.');
        }

        $this->id = (int) $id;
        $this->title = trim((string) $title);
        $this->price = (float) $price;
        $this->totalSeats = (int) $totalSeats;
        $this->availableSeats = (int) $totalSeats;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function bookTicket($quantity)
    {
        if (filter_var($quantity, FILTER_VALIDATE_INT) === false || $quantity <= 0) {
            return 'Số vé đặt phải là số nguyên lớn hơn 0.';
        }

        if ($quantity > $this->availableSeats) {
            return 'Không đủ ghế trống. Phim chỉ còn ' . $this->availableSeats . ' ghế.';
        }

        $this->availableSeats -= $quantity;
        return 'Đặt thành công ' . $quantity . ' vé phim "' . $this->title . '".';
    }

    public function cancelTicket($quantity)
    {
        if (filter_var($quantity, FILTER_VALIDATE_INT) === false || $quantity <= 0) {
            return 'Số vé hủy phải là số nguyên lớn hơn 0.';
        }

        if ($quantity > $this->getSoldSeats()) {
            return 'Không thể hủy ' . $quantity . ' vé vì phim mới bán '
                . $this->getSoldSeats() . ' vé.';
        }

        $this->availableSeats += $quantity;
        return 'Đã hủy ' . $quantity . ' vé phim "' . $this->title . '".';
    }

    public function getSoldSeats()
    {
        return $this->totalSeats - $this->availableSeats;
    }

    public function getRevenue()
    {
        return $this->getSoldSeats() * $this->price;
    }

    public function displayInfo()
    {
        echo '<tr>';
        echo '<td>' . $this->id . '</td>';
        echo '<td>' . htmlspecialchars($this->title, ENT_QUOTES, 'UTF-8') . '</td>';
        echo '<td>' . number_format($this->price, 0, ',', '.') . ' đ</td>';
        echo '<td>' . $this->totalSeats . '</td>';
        echo '<td>' . $this->availableSeats . '</td>';
        echo '<td>' . $this->getSoldSeats() . '</td>';
        echo '<td>' . number_format($this->getRevenue(), 0, ',', '.') . ' đ</td>';
        echo '</tr>';
    }
}
