<?php

require_once __DIR__ . '/../common/dbConnect.php';

function getAllProducts()
{
    $connection = getDatabaseConnection();
    $statement = $connection->query(
        'SELECT id, name, price, quantity FROM products ORDER BY id ASC'
    );

    return $statement->fetchAll();
}

function getProductById($id)
{
    $connection = getDatabaseConnection();
    $statement = $connection->prepare(
        'SELECT id, name, price, quantity FROM products WHERE id = :id'
    );
    $statement->execute(['id' => $id]);
    $product = $statement->fetch();

    return $product === false ? null : $product;
}

function addProduct($name, $price, $quantity)
{
    $connection = getDatabaseConnection();
    $statement = $connection->prepare(
        'INSERT INTO products (name, price, quantity)
         VALUES (:name, :price, :quantity)'
    );

    return $statement->execute([
        'name' => trim($name),
        'price' => $price,
        'quantity' => $quantity,
    ]);
}

function updateProduct($id, $name, $price, $quantity)
{
    $connection = getDatabaseConnection();
    $statement = $connection->prepare(
        'UPDATE products
         SET name = :name, price = :price, quantity = :quantity
         WHERE id = :id'
    );

    return $statement->execute([
        'id' => $id,
        'name' => trim($name),
        'price' => $price,
        'quantity' => $quantity,
    ]);
}

function deleteProduct($id)
{
    $connection = getDatabaseConnection();
    $statement = $connection->prepare('DELETE FROM products WHERE id = :id');
    $statement->execute(['id' => $id]);

    return $statement->rowCount() > 0;
}
