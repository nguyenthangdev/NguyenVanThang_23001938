# Front-end - Vue 3 + Vite

```
npm install
npm run dev
```

Cần chạy back-end trước (cổng 8000); Vite chuyển các yêu cầu `/api` và `/uploads` (ảnh) sang đó (xem `vite.config.js`).

- `api/` - gọi API (`productApi.js`)
- `views/` - màn hình `ProductsView` (giữ state, gọi API)
- `components/product/` - bảng (có ảnh thu nhỏ), biểu mẫu (có chọn và xem trước ảnh), phân trang; `components/common/` - popup xác nhận, thông báo
- `services/` - store thông báo; `utils/` - định dạng tiền, kiểm tra ảnh (loại, dung lượng); `styles/` - CSS toàn cục
