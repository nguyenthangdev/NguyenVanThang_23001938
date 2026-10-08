# Bài thực hành PHP + MySQL – Buổi 4

Ứng dụng quản lý sản phẩm của hệ thống giỏ hàng, gồm chức năng xem danh sách, thêm, sửa và xóa sản phẩm.

Dự án dùng Docker để PHP, MySQL và phpMyAdmin chạy đồng nhất trên Windows/Linux, không phụ thuộc vào XAMPP hoặc cấu hình sẵn trên từng máy.

## Chạy bằng Docker

Yêu cầu máy đã cài [Docker Desktop](https://www.docker.com/products/docker-desktop/) hoặc Docker Engine có Docker Compose.

Sau khi clone source code, mở terminal tại thư mục `Bai_thuc_hanh_PHP_Buoi_4` và chạy:

```bash
docker compose up -d --build
```

Docker sẽ tự động:

- Tạo môi trường PHP 8.2 và cài extension `pdo_mysql`.
- Khởi động PHP web server tại <http://localhost:8000>.
- Khởi động MySQL 8.4.
- Tạo database `shopping_cart`, bảng `products` và 5 sản phẩm mẫu.
- Khởi động phpMyAdmin tại <http://localhost:8080>.

Không cần cài PHP, MySQL hoặc import file SQL thủ công trên máy chạy bài.

### Dừng ứng dụng

```bash
docker compose down
```

### Tạo lại database từ đầu

Dữ liệu MySQL được giữ lại khi chỉ chạy `docker compose down`. Muốn xóa dữ liệu cũ và import lại `database.sql`, chạy:

```bash
docker compose down -v
docker compose up -d --build
```

Lệnh `docker compose down -v` sẽ xóa database đang lưu trong Docker của riêng bài này.

## Địa chỉ truy cập

| Thành phần                | Địa chỉ                 |
| ------------------------- | ----------------------- |
| Ứng dụng quản lý sản phẩm | <http://localhost:8000> |
| phpMyAdmin                | <http://localhost:8080> |

Thông tin đăng nhập phpMyAdmin:

```text
Server: database
Username: shopping_user
Password: shopping_password
```

## Cấu trúc

```text
Bai_thuc_hanh_PHP_Buoi_4/
├── app/
│   ├── common/
│   │   ├── dbConnect.php
│   │   ├── helpers.php
│   │   └── productValidation.php
│   ├── model/
│   │   └── product.php
│   ├── view/
│   │   ├── header.php
│   │   └── footer.php
│   ├── assets/
│   ├── index.php
│   ├── product_list.php
│   ├── product_add.php
│   ├── product_edit.php
│   └── product_delete.php
├── Dockerfile
├── compose.yaml
├── database.sql
└── Bai_thuc_hanh_4_quan_ly_gio_hang.docx
```

## Chạy không dùng Docker

Nếu máy đã có PHP với extension `pdo_mysql` và MySQL, có thể import `database.sql` rồi chạy:

```bash
php -S localhost:8000 -t app
```

Mặc định ứng dụng kết nối tới MySQL bằng `localhost`, database `shopping_cart`, tài khoản `root` và mật khẩu trống. Có thể đặt các biến môi trường `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASSWORD` nếu cấu hình MySQL khác mặc định.

## Lưu ý về biến môi trường

Đây là bài tập demo đơn giản nên thông tin kết nối database được khai báo trực tiếp trong `compose.yaml`, không cần tạo file `.env`. Với dự án thực tế, nên lưu mật khẩu và các thông tin nhạy cảm trong biến môi trường hoặc secret, không đưa chúng trực tiếp lên Git.
