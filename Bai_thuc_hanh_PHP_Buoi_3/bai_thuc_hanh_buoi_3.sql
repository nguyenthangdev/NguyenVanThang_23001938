-- BÀI 1 - QUẢN LÝ GIỎ HÀNG

CREATE DATABASE IF NOT EXISTS shopping_cart
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE shopping_cart;

DROP TABLE IF EXISTS cart_items;

-- 1. Tạo bảng cart_items.
CREATE TABLE cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL
);

-- 2.1. Thêm ít nhất 5 sản phẩm vào bảng.
INSERT INTO cart_items (name, price, quantity) VALUES
    ('Laptop', 15000000, 1),
    ('Chuột không dây', 350000, 8),
    ('Bàn phím cơ', 700000, 4),
    ('Tai nghe', 1200000, 6),
    ('USB 64GB', 120000, 10),
    ('Sổ tay', 50000, 20);

-- 2.2. Hiển thị toàn bộ sản phẩm.
SELECT *
FROM cart_items;

-- 2.3. Hiển thị sản phẩm có giá lớn hơn 100000.
SELECT *
FROM cart_items
WHERE price > 100000;

-- 2.4. Hiển thị sản phẩm có số lượng lớn hơn 5.
SELECT *
FROM cart_items
WHERE quantity > 5;

-- 2.5. Sắp xếp sản phẩm theo giá giảm dần.
SELECT *
FROM cart_items
ORDER BY price DESC;

-- 2.6. Cập nhật giá của sản phẩm Laptop.
UPDATE cart_items
SET price = 14500000
WHERE name = 'Laptop';

-- Kiểm tra kết quả cập nhật giá.
SELECT *
FROM cart_items
WHERE name = 'Laptop';

-- 2.7. Cập nhật số lượng của sản phẩm Bàn phím cơ.
UPDATE cart_items
SET quantity = 5
WHERE name = 'Bàn phím cơ';

-- Kiểm tra kết quả cập nhật số lượng.
SELECT *
FROM cart_items
WHERE name = 'Bàn phím cơ';

-- 2.8. Xóa sản phẩm Sổ tay.
DELETE FROM cart_items
WHERE name = 'Sổ tay';

-- Kiểm tra danh sách sau khi xóa.
SELECT *
FROM cart_items;

-- 2.9. Hiển thị tên, giá, số lượng và thành tiền của từng sản phẩm.
SELECT
    name AS ten_san_pham,
    price AS gia,
    quantity AS so_luong,
    price * quantity AS thanh_tien
FROM cart_items;

-- 2.10. Tính tổng tiền của toàn bộ giỏ hàng.
SELECT SUM(price * quantity) AS tong_tien_gio_hang
FROM cart_items;


-- BÀI 2 - QUẢN LÝ VÉ XEM PHIM

CREATE DATABASE IF NOT EXISTS movie_management
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE movie_management;

DROP TABLE IF EXISTS movies;

-- 1. Tạo bảng movies.
CREATE TABLE movies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    total_seats INT NOT NULL,
    available_seats INT NOT NULL
);

-- 2.1. Thêm ít nhất 5 bộ phim.
INSERT INTO movies (title, price, total_seats, available_seats) VALUES
    ('Avengers', 100000, 100, 75),
    ('Avatar', 120000, 80, 55),
    ('Batman', 90000, 120, 100),
    ('Interstellar', 110000, 90, 40),
    ('Titanic', 95000, 100, 80),
    ('Inception', 105000, 70, 60);

-- 2.2. Hiển thị toàn bộ danh sách phim.
SELECT *
FROM movies;

-- 2.3. Hiển thị phim có giá vé lớn hơn 100000.
SELECT *
FROM movies
WHERE price > 100000;

-- 2.4. Hiển thị phim còn nhiều hơn 50 ghế.
SELECT *
FROM movies
WHERE available_seats > 50;

-- 2.5. Sắp xếp phim theo giá vé giảm dần.
SELECT *
FROM movies
ORDER BY price DESC;

-- 2.6. Cập nhật số ghế còn lại của phim Avengers.
UPDATE movies
SET available_seats = 70
WHERE title = 'Avengers';

-- Kiểm tra kết quả cập nhật số ghế.
SELECT *
FROM movies
WHERE title = 'Avengers';

-- 2.7. Xóa phim Titanic.
DELETE FROM movies
WHERE title = 'Titanic';

-- Kiểm tra danh sách sau khi xóa.
SELECT *
FROM movies;

-- 2.8. Hiển thị số vé đã bán của từng phim.
SELECT
    id,
    title,
    total_seats,
    available_seats,
    total_seats - available_seats AS sold_seats
FROM movies;

-- 2.9. Tính doanh thu của từng phim.
SELECT
    id,
    title,
    total_seats - available_seats AS sold_seats,
    price,
    (total_seats - available_seats) * price AS revenue
FROM movies;

-- 2.10. Tính tổng doanh thu của tất cả các phim.
SELECT
    SUM((total_seats - available_seats) * price) AS total_revenue
FROM movies;

-- 2.11. Tìm số vé bán ra nhiều nhất bằng MAX.
SELECT MAX(total_seats - available_seats) AS max_sold_seats
FROM movies;

-- Hiển thị đầy đủ thông tin phim bán nhiều vé nhất.
-- Nếu nhiều phim cùng bán nhiều vé nhất, câu lệnh trả về tất cả phim đó.
SELECT
    id,
    title,
    price,
    total_seats,
    available_seats,
    total_seats - available_seats AS sold_seats
FROM movies
WHERE total_seats - available_seats = (
    SELECT MAX(total_seats - available_seats)
    FROM movies
);
