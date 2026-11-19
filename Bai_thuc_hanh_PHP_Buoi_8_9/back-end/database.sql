SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS product_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE product_db;

CREATE TABLE IF NOT EXISTS products (
    id    INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(100) NOT NULL,
    price INT          NOT NULL,
    stock INT          NOT NULL,
    image VARCHAR(255) NULL,
    CONSTRAINT chk_products_price CHECK (price > 0),
    CONSTRAINT chk_products_stock CHECK (stock >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO products (name, price, stock) VALUES
    ('Bút bi', 5000, 20),
    ('Vở ô ly', 12000, 15),
    ('Thước kẻ', 8000, 0),
    ('Bút chì', 3000, 40),
    ('Tẩy', 2000, 35),
    ('Gọt bút chì', 6000, 12),
    ('Bút dạ quang', 10000, 18),
    ('Hộp bút', 45000, 7),
    ('Giấy note', 15000, 25),
    ('Kéo', 20000, 9),
    ('Băng dính', 7000, 30),
    ('Compa', 25000, 0);
