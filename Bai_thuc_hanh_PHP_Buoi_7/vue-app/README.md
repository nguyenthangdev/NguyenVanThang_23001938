# Bài thực hành 7 - Vue 3 + Vite

```
npm install
npm run dev
```

Cấu trúc `src/`:

- `views/` - mỗi bài là một màn hình (Bai1View, Bai2View, Bai3View)
- `components/` - component tái sử dụng; `bai1/`, `bai3/` chứa component riêng của từng bài, `TheSanPham.js` dùng chung (đăng ký toàn cục trong `main.js`)
- `data/` - dữ liệu mẫu
- `constants/` - hằng số (giới hạn số lượng giỏ hàng)
- `utils/` - hàm tiện ích (định dạng tiền, kiểm tra dữ liệu)
- `styles/` - CSS toàn cục
