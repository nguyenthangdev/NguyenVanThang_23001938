# Back-end - API sản phẩm (PHP + MySQL)

```
docker compose up -d --build
```

Lệnh này khởi động PHP, MySQL và phpMyAdmin chạy nền (`-d`); `--build` build lại image PHP từ `Dockerfile` vì image `php` gốc chưa có extension `pdo_mysql` để kết nối MySQL (Dockerfile cũng nâng giới hạn upload của PHP để API tự kiểm tra ảnh 2 MB).

> Nếu đã chạy bản cũ (Buổi 8, chưa có cột `image`), cần tạo lại database: `docker compose down -v` rồi chạy lại lệnh trên. Lệnh này xóa dữ liệu cũ và nạp lại `database.sql`.

API chạy ở `http://localhost:8000/api/products.php`, phpMyAdmin ở `http://localhost:8080` (tự đăng nhập bằng `product_user`).

| Phương thức | Đường dẫn                          | Chức năng                                  |
| ----------- | ---------------------------------- | ------------------------------------------ |
| GET         | api/products.php?page=1&limit=5    | Danh sách sản phẩm theo trang              |
| POST        | api/products.php                   | Thêm sản phẩm (JSON), trả về mã sản phẩm   |
| PUT         | api/products.php?id=1              | Cập nhật theo id (JSON)                    |
| DELETE      | api/products.php?id=1              | Xóa theo id (xóa luôn file ảnh)            |
| POST        | api/upload.php                     | Upload ảnh (multipart/form-data: id, image) |

Body JSON cho POST/PUT: `{"name": "Bút bi", "price": 5000, "stock": 20}`.
Phản hồi: `{"success": true|false, "message": "...", "data": ...}`.

**Phân trang:** thiếu tham số thì dùng `page=1`, `limit=5`; `page` phải là số nguyên dương, `limit` từ 1 đến 50, sai thì trả lỗi 400. Sắp xếp theo id giảm dần. Phản hồi có thêm `pagination: {page, limit, total, total_pages}`; `total_pages` tối thiểu là 1, `page` vượt trang cuối thì trả trang cuối.

**Upload ảnh:** chỉ nhận JPG/JPEG/PNG tối đa 2 MB. Loại ảnh được đọc từ nội dung file (`finfo` + `getimagesize`), không tin vào tên file. Ảnh được lưu vào `uploads/` với tên ngẫu nhiên, đường dẫn (vd `uploads/abc.png`) ghi vào cột `image`, xem được tại `http://localhost:8000/uploads/abc.png`. Ảnh cũ chỉ bị xóa sau khi ảnh mới đã lưu thành công.

Cấu trúc:

- `api/` - điểm vào HTTP (định tuyến theo phương thức)
- `src/` - logic, chia theo chức năng:
  - `config/` - cấu hình kết nối (`config.php`)
  - `database/` - tạo kết nối PDO (`Database.php`)
  - `http/` - định dạng phản hồi JSON (`Response.php`)
  - `controllers/` - xử lý từng thao tác (`ProductController.php`, `UploadController.php`)
  - `validators/` - kiểm tra dữ liệu đầu vào (`ProductValidator.php`, `ImageValidator.php`)
  - `repositories/` - truy vấn MySQL bằng PDO (`ProductRepository.php`)
  - `services/` - lưu, xóa file ảnh (`ImageStorage.php`)
  - `bootstrap.php` - nạp các lớp và đặt header CORS, dùng chung cho mọi file trong `api/`
- `uploads/` - nơi lưu ảnh sản phẩm (không commit ảnh lên git)
- `database.sql` - tạo bảng và 12 dòng dữ liệu mẫu (tự chạy khi khởi tạo container MySQL)

## Lưu ý về biến môi trường

Các biến môi trường quan trọng (mật khẩu, thông tin kết nối database...) lẽ ra phải đưa ra file `.env` và không commit lên git. Vì đây là bài tập cá nhân nên các giá trị được viết thẳng trong `compose.yaml` (và giá trị mặc định trong `src/config.php`) cho đơn giản.
