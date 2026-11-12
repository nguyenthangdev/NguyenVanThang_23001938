<?php

class ProductController
{
    public function __construct(private ProductRepository $products)
    {
    }

    public function index(): never
    {
        Response::success('Lấy danh sách sản phẩm thành công.', $this->products->all());
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
        $this->requireExisting($id);
        $this->products->delete($id);
        Response::success('Xóa sản phẩm thành công.');
    }

    // Báo lỗi nếu thiếu id hoặc sản phẩm không tồn tại
    private function requireExisting(?int $id): void
    {
        if ($id === null) {
            Response::error('Thiếu hoặc sai id sản phẩm trên URL.', 400);
        }
        if ($this->products->find($id) === null) {
            Response::error("Không tìm thấy sản phẩm có id = $id.", 404);
        }
    }
}
