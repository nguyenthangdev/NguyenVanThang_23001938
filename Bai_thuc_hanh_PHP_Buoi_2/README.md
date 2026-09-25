# Bài thực hành PHP – Buổi 2

Bài thực hành sử dụng PHP thuần và gồm 2 bài chạy độc lập.

## Cấu trúc thư mục

```text
Bai_thuc_hanh_PHP_Buoi_2/
├── Bai1/
│   ├── index.php
│   ├── CartItem.php
│   └── ShoppingCart.php
├── Bai2/
│   ├── index.php
│   ├── Movie.php
│   └── functions.php
└── Bài thực hành buổi 2.docx
```

## Nội dung

- `Bai1`: xây dựng giỏ hàng, thêm/xóa sản phẩm, tính và hiển thị tổng tiền.
- `Bai2`: quản lý phim, đặt/hủy vé, tính doanh thu và tìm phim bán nhiều vé nhất.

Hai bài đều có kiểm tra và hiển thị thông báo cho các trường hợp dữ liệu không hợp lệ theo đề.

## Cách chạy

chạy Bài 1:

```bash
php -S localhost:8000 -t Bai_thuc_hanh_PHP_Buoi_2/Bai1
```

Hoặc chạy Bài 2:

```bash
php -S localhost:8000 -t Bai_thuc_hanh_PHP_Buoi_2/Bai2
```

Sau đó truy cập <http://localhost:8000> trên trình duyệt. Có thể thay `8000` bằng một cổng khác đang trống.
