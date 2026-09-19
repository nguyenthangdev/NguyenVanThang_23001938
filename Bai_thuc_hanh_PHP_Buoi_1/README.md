# Bài thực hành PHP cơ bản – Buổi 1

Bài thực hành gồm 4 bài, mỗi bài được đặt trong một thư mục riêng.

## Cấu trúc thư mục

```text
Bai_thuc_hanh_PHP_Buoi_1/
├── Bai1/
│   └── index.php       # Biến, mảng và vòng lặp
├── Bai2/
│   └── index.php       # Tách hàm xử lý sinh viên
├── Bai3/
│   ├── index.php       # Tìm kiếm và thống kê sinh viên
│   └── functions.php   # Các hàm xử lý danh sách
└── Bai4/
    ├── index.php       # Lập trình hướng đối tượng
    └── Student.php     # Class Student
```

## Cách chạy

Mở terminal tại thư mục dự án và chạy một trong các lệnh sau:

```bash
php -S localhost:8000 -t Bai_thuc_hanh_PHP_Buoi_1/Bai1
```

Sau đó mở <http://localhost:8000> để xem Bài 1.

Để chạy bài khác, thay `Bai1` bằng `Bai2`, `Bai3` hoặc `Bai4`:

```bash
php -S localhost:8000 -t Bai_thuc_hanh_PHP_Buoi_1/Bai2
php -S localhost:8000 -t Bai_thuc_hanh_PHP_Buoi_1/Bai3
php -S localhost:8000 -t Bai_thuc_hanh_PHP_Buoi_1/Bai4
```

Có thể sử dụng cổng khác bằng cách thay `8000`, ví dụ `8080`.
