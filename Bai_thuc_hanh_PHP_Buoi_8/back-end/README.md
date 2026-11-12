# Back-end - API sản phẩm (PHP + MySQL)

```
docker compose up -d --build
```

Lệnh này khởi động PHP, MySQL và phpMyAdmin chạy nền (`-d`); `--build` build lại image PHP từ `Dockerfile` vì image `php` gốc chưa có extension `pdo_mysql` để kết nối MySQL.

API chạy ở `http://localhost:8000/api/products.php`, phpMyAdmin ở `http://localhost:8080` (tự đăng nhập bằng `product_user`).

| Phương thức | Đường dẫn             | Chức năng          |
| ----------- | --------------------- | ------------------ |
| GET         | api/products.php      | Danh sách sản phẩm |
| POST        | api/products.php      | Thêm sản phẩm      |
| PUT         | api/products.php?id=1 | Cập nhật theo id   |
| DELETE      | api/products.php?id=1 | Xóa theo id        |

Body JSON cho POST/PUT: `{"name": "Bút bi", "price": 5000, "stock": 20}`.
Phản hồi: `{"success": true|false, "message": "...", "data": ...}`.

Cấu trúc:

- `api/` - điểm vào HTTP (định tuyến theo phương thức)
- `src/` - logic, chia theo chức năng:
  - `config/` - cấu hình kết nối (`config.php`)
  - `database/` - tạo kết nối PDO (`Database.php`)
  - `http/` - định dạng phản hồi JSON (`Response.php`)
  - `controllers/` - xử lý từng thao tác (`ProductController.php`)
  - `validators/` - kiểm tra dữ liệu đầu vào (`ProductValidator.php`)
  - `repositories/` - truy vấn MySQL bằng PDO (`ProductRepository.php`)
- `database.sql` - tạo bảng và 3 dòng dữ liệu mẫu (tự chạy khi khởi tạo container MySQL)

## Lưu ý về biến môi trường

Các biến môi trường quan trọng (mật khẩu, thông tin kết nối database...) lẽ ra phải đưa ra file `.env` và không commit lên git. Vì đây là bài tập cá nhân nên các giá trị được viết thẳng trong `compose.yaml` (và giá trị mặc định trong `src/config.php`) cho đơn giản.
