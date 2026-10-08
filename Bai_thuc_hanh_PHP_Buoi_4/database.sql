CREATE DATABASE IF NOT EXISTS shopping_cart
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE shopping_cart;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS products;

CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL
);

INSERT INTO products (name, price, quantity) VALUES
    ('Laptop', 15000000, 5),
    ('Chuột không dây', 350000, 20),
    ('Bàn phím cơ', 700000, 12),
    ('Tai nghe', 1200000, 8),
    ('USB 64GB', 120000, 30);
