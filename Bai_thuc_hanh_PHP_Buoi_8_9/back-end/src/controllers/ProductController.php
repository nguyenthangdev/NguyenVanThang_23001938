<?php

class ProductController
{
    public const DEFAULT_LIMIT = 5;
    public const MAX_LIMIT = 50;

    public function __construct(private ProductRepository $products, private ImageStorage $images)
    {
    }

    public function index(array $query): never
    {
        $page = $this->positiveInt($query, 'page', 1);
        $limit = $this->positiveInt($query, 'limit', self::DEFAULT_LIMIT);
        if ($page === null) {
            Response::error('Tham số page phải là số nguyên dương.', 400);
        }
        if ($limit === null || $limit > self::MAX_LIMIT) {
            Response::error('Tham số limit phải là số nguyên từ 1 đến ' . self::MAX_LIMIT . '.', 400);
        }

        $total = $this->products->count();
        $totalPages = max(1, (int) ceil($total / $limit));
        $page = min($page, $totalPages); // page vượt trang cuối thì trả trang cuối

        Response::success(
            'Lấy danh sách sản phẩm thành công.',
            $this->products->paginate($limit, ($page - 1) * $limit),
            200,
            ['pagination' => [
                'page'        => $page,
                'limit'       => $limit,
                'total'       => $total,
                'total_pages' => $totalPages,
            ]]
        );
    }

    public function store(array $input): never
    {
        [$data, $error] = ProductValidator::validate($input);
        if ($error) {
            Response::error($error, 422);
        }
        $product = $this->products->create($data);
        Response::success('Thêm sản phẩm thành công.', $product, 201);
    }

    public function update(?int $id, array $input): never
    {
        $this->requireExisting($id);
        [$data, $error] = ProductValidator::validate($input);
        if ($error) {
            Response::error($error, 422);
        }
        $this->products->update($id, $data);
        Response::success('Cập nhật sản phẩm thành công.', $this->products->find($id));
    }

    public function destroy(?int $id): never
    {
        $product = $this->requireExisting($id);
        $this->products->delete($id);
        $this->images->delete($product['image']);
        Response::success('Xóa sản phẩm thành công.');
    }

    // Báo lỗi nếu thiếu id hoặc sản phẩm không tồn tại
    private function requireExisting(?int $id): array
    {
        if ($id === null) {
            Response::error('Thiếu hoặc sai id sản phẩm trên URL.', 400);
        }
        return $this->products->find($id)
            ?? Response::error("Không tìm thấy sản phẩm có id = $id.", 404);
    }

    // Thiếu tham số thì dùng giá trị mặc định; có nhưng sai thì trả null
    private function positiveInt(array $query, string $key, int $default): ?int
    {
        if (!array_key_exists($key, $query)) {
            return $default;
        }
        $value = filter_var($query[$key], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        return $value === false ? null : $value;
    }
}
