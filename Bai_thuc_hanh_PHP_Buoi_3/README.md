# Bài thực hành MySQL – Buổi 3

Bài thực hành chỉ sử dụng MySQL, không sử dụng PHP.

## File bài làm

- `bai_thuc_hanh_buoi_3.sql`: chứa toàn bộ câu lệnh SQL của cả 2 bài.
- `Bài thực hành buổi 3 - MYSQL.docx`: file đề bài.

File SQL tạo hai database:

- `shopping_cart`: chứa bảng `cart_items` của Bài 1.
- `movie_management`: chứa bảng `movies` của Bài 2.

## Cách chạy bằng phpMyAdmin

1. Khởi động Apache và MySQL.
2. Mở trình duyệt và truy cập <http://localhost/phpmyadmin>.
3. Tại trang chính của phpMyAdmin, chọn tab **Import**. Không cần tạo database hoặc chọn database trước khi import.
4. Nhấn **Choose File** và chọn file `bai_thuc_hanh_buoi_3.sql` trong thư mục này.
5. Giữ nguyên định dạng **SQL**, sau đó nhấn **Import** hoặc **Go** ở cuối trang.
6. Chờ phpMyAdmin thông báo import thành công rồi tải lại danh sách database ở bên trái.

Sau khi import, phpMyAdmin sẽ hiển thị:

- Database `shopping_cart` với bảng `cart_items`.
- Database `movie_management` với bảng `movies`.

Để xem dữ liệu, chọn database, chọn bảng tương ứng rồi mở tab **Browse**. Để tự chạy một câu truy vấn, chọn tab **SQL**, nhập câu lệnh và nhấn **Go**.

File SQL sử dụng `DROP TABLE IF EXISTS`, vì vậy có thể import lại mà không gặp lỗi bảng đã tồn tại. Tuy nhiên, mỗi lần import lại, dữ liệu hiện tại trong hai bảng sẽ bị xóa và tạo lại từ đầu.
