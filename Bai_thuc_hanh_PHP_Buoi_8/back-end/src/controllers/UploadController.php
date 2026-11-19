<?php

class UploadController
{
    public function __construct(private ProductRepository $products, private ImageStorage $images)
    {
    }

    // Nhận multipart/form-data gồm id (mã sản phẩm) và image (file ảnh)
    public function store(array $post, array $files): never
    {
        $id = filter_var($post['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($id === false) {
            Response::error('Thiếu hoặc sai mã sản phẩm.', 400);
        }
        $product = $this->products->find($id)
            ?? Response::error("Không tìm thấy sản phẩm có id = $id.", 404);

        [$extension, $error] = ImageValidator::validate($files['image'] ?? null);
        if ($error) {
            Response::error($error, 422);
        }

        $path = $this->images->store($files['image']['tmp_name'], $extension);
        try {
            $this->products->updateImage($id, $path);
        } catch (PDOException $e) {
            $this->images->delete($path); // không để lại file mồ côi
            throw $e;
        }
        // Chỉ xóa ảnh cũ khi ảnh mới đã lưu và cập nhật thành công
        $this->images->delete($product['image']);

        Response::success('Tải ảnh lên thành công.', $this->products->find($id));
    }
}
