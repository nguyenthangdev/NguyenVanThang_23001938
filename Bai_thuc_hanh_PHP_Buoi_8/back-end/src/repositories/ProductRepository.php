<?php

// Truy vấn bảng products, mọi câu lệnh có tham số đều dùng PDO prepared statement
class ProductRepository
{
    private const COLUMNS = 'id, name, price, stock, image';

    public function __construct(private PDO $pdo)
    {
    }

    public function count(): int
    {
        return (int) $this->pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
    }

    // Lấy một trang, sản phẩm mới nhất (id lớn nhất) lên đầu
    public function paginate(int $limit, int $offset): array
    {
        $stmt = $this->pdo->prepare('SELECT ' . self::COLUMNS . ' FROM products ORDER BY id DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT ' . self::COLUMNS . ' FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): array
    {
        $stmt = $this->pdo->prepare('INSERT INTO products (name, price, stock) VALUES (:name, :price, :stock)');
        $stmt->execute($data);
        return $this->find((int) $this->pdo->lastInsertId());
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->pdo->prepare('UPDATE products SET name = :name, price = :price, stock = :stock WHERE id = :id');
        $stmt->execute($data + ['id' => $id]);
    }

    public function updateImage(int $id, string $path): void
    {
        $stmt = $this->pdo->prepare('UPDATE products SET image = :image WHERE id = :id');
        $stmt->execute(['image' => $path, 'id' => $id]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
