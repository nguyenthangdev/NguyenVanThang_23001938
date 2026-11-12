# Front-end - Vue 3 + Vite

```
npm install
npm run dev
```

Cần chạy back-end trước (cổng 8000); Vite chuyển các yêu cầu `/api` sang đó (xem `vite.config.js`).

- `api/` - gọi API (`productApi.js`)
- `views/` - màn hình `ProductsView` (giữ state, gọi API)
- `components/product/` - bảng và biểu mẫu; `components/common/` - popup xác nhận, thông báo
- `services/` - store thông báo; `utils/` - hàm định dạng; `styles/` - CSS toàn cục
