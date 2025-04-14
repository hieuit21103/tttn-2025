# Hướng Dẫn Cài Đặt Dự Án Laravel TTTN-2025

## Yêu Cầu Chuẩn Bị
- PHP 8.1 trở lên
- Composer
- MySQL hoặc cơ sở dữ liệu tương thích khác
- Node.js và npm

## Tải Mã Nguồn

```bash
# Clone kho lưu trữ
git clone https://github.com/hieuit21103/tttn-2025.git

# Di chuyển vào thư mục dự án
cd tttn-2025
```

## Các Bước Cài Đặt

1. Cài Đặt Thư Viện PHP
```bash
composer install
```

2. Tạo File Môi Trường `.env`
```bash
cp .env.example .env
```

3. Tạo Khóa Ứng Dụng
```bash
php artisan key:generate
```

4. Cấu Hình CSDL và Mail
- Mở file `.env`
- Thiết lập thông tin kết nối CSDL:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tên_database
DB_USERNAME=tên_đăng_nhập_database
DB_PASSWORD=mật_khẩu_database
```
- Thiết lập thông tin mail:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=harunaai235@gmail.com
MAIL_PASSWORD=yacgvsjgohgbtlmv
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="harunaai235@gmail.com"
MAIL_FROM_NAME="BAN QUẢN LÝ KÝ TÚC XÁ"
```

5. Chạy Migration CSDL
```bash
php artisan migrate
```

6. Tạo Tài Khoản Admin Mặc Định
```bash
php artisan db:seed
```

Tông tin đăng nhập:
- Tên đăng nhập: **admin**
- Mật khẩu: **password**

**Lưu ý:** Hãy đổi mật khẩu ngay sau khi đăng nhập.

7. Cài Đặt Gói Frontend
```bash
npm install
npm run dev
```

8. Khởi Chạy Server Phát Triển
```bash
php artisan serve
```

## Cấu Hình Bổ Sung
- Kiểm tra và điều chỉnh file `.env` nếu cần
- Sau khi thay đổi cấu hình, chạy lệnh:
```bash
php artisan config:clear
```

## Tạo Thêm Người Dùng
Sử dụng lệnh:
```bash
php artisan create:user --email="user@example.com" --role="admin|user"
```

Vai trò:
- **admin**: Toàn quyền truy cập
- **user**: Quyền xem (read-only)

## Khắc Phục Sự Cố
- Kiểm tra đầy đủ các extension PHP
- Kiểm tra quyền truy cập file
- Xác minh kết nối CSDL

## Đóng Góp
Vui lòng đọc hướng dẫn đóng góp trước khi tham gia.

## Bản Quyền
Xem file LICENSE trong kho lưu trữ dự án để biết chi tiết về bản quyền.

