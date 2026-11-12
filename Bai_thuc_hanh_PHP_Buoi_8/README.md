# Bài thực hành PHP + Vue.js – Buổi 8

Ứng dụng quản lý sản phẩm gồm hai phần tách biệt:

- **Back-end** (`back-end/`): API REST viết bằng PHP + MySQL, chạy bằng Docker.
- **Front-end** (`front-end/`): giao diện Vue 3 + Vite, gọi API để xem, thêm, sửa, xóa sản phẩm.

## Cách chạy

Yêu cầu: Docker có Docker Compose, Node.js 20 trở lên.

**1. Chạy back-end** (mở terminal tại `back-end/`):

```bash
docker compose up -d --build
```

**2. Chạy front-end** (mở terminal khác tại `front-end/`):

```bash
npm install
npm run dev
```

Mở địa chỉ Vite in ra (mặc định <http://localhost:5173>).

## Địa chỉ truy cập

| Thành phần | Địa chỉ                                    |
| ---------- | ------------------------------------------ |
| Giao diện  | <http://localhost:5173>                    |
| API        | <http://localhost:8000/api/products.php>   |
| phpMyAdmin | <http://localhost:8080>                    |

## Cách hai phần kết nối với nhau

Front-end gọi `/api/products.php`, và Vite dev server chuyển các yêu cầu `/api` sang back-end ở cổng 8000 (cấu hình trong `front-end/vite.config.js`). Nhờ vậy trình duyệt coi như gọi cùng origin, không bị chặn CORS.

## Cấu trúc

```
Bai_thuc_hanh_PHP_Buoi_8/
├── back-end/
│   ├── api/products.php      # điểm vào API (GET, POST, PUT, DELETE)
│   ├── src/                  # config, database, http, controllers, validators, repositories
│   ├── database.sql          # tạo bảng products và 3 dòng dữ liệu mẫu
│   ├── Dockerfile
│   └── compose.yaml          # PHP, MySQL, phpMyAdmin
└── front-end/
    ├── src/
    │   ├── api/              # gọi API
    │   ├── views/            # màn hình quản lý sản phẩm
    │   ├── components/       # bảng, biểu mẫu, popup xác nhận, thông báo
    │   ├── services/         # store thông báo
    │   ├── utils/            # hàm định dạng
    │   └── styles/           # CSS toàn cục
    └── vite.config.js
```

Chi tiết từng phần xem trong [back-end/README.md](back-end/README.md) và [front-end/README.md](front-end/README.md).

## Dừng ứng dụng

- Front-end: nhấn `Ctrl + C` trong terminal đang chạy `npm run dev`.
- Back-end: chạy `docker compose down` trong `back-end/` (thêm `-v` để xóa luôn dữ liệu MySQL và tạo lại từ `database.sql` ở lần chạy sau).
