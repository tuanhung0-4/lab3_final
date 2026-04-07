# COURSE MANAGEMENT SYSTEM (CMS) - HƯỚNG DẪN CÀI ĐẶT & CHẠY DỰ ÁN

## 1. Yêu cầu hệ thống
- Môi trường: XAMPP (Windows).
- PHP >= 8.1
- MySQL (MariaDB).

---

## 2. Các bước cài đặt dự án

### Bước 1: Chuẩn bị file `.env`
- Tạo file `.env` (copy từ `.env.example`).
- Cấu hình database trong file `.env` (XAMPP mặc định):
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=course_management
    DB_USERNAME=root
    DB_PASSWORD=
    ```

### Bước 2: Chuẩn bị Database
- Mở **phpMyAdmin** tại địa chỉ `http://localhost/phpmyadmin/`.
- Tạo một database mới tên là `course_management`.

### Bước 3: Chạy các lệnh cài đặt trên Terminal (Powershell)
Mở terminal tại thư mục dự án và chạy các lệnh sau:

```bash
# 1. Cài đặt các thư viện (Vendor)
composer install

# 2. Tạo khóa ứng dụng
php artisan key:generate

# 3. Tạo các bảng và nạp dữ liệu mẫu (Sample Data)
php artisan migrate:fresh --seed

# 4. Tạo đường dẫn liên kết cho ảnh (Storage)
php artisan storage:link
```

---

## 3. Chạy ứng dụng
- Chạy lệnh sau để khởi động server:
    ```bash
    php artisan serve
    ```
- Truy cập vào địa chỉ: [http://localhost:8000](http://localhost:8000)

---

## 4. Các tài liệu đi kèm
Bạn có thể tham khảo thêm các tài liệu hướng dẫn chi tiết khác trong cùng thư mục:
- **[PROJECT_DOCS.md](PROJECT_DOCS.md)**: Mô tả bài toán, Sơ đồ ERD và Phác thảo giao diện.
- **[TECHNICAL_EXPLANATION.md](TECHNICAL_EXPLANATION.md)**: Giải thích chi tiết mã nguồn (Relationship, Validation, Optimization).

---

## 5. Tài khoản & Dữ liệu mẫu (Sample Data)
Sau khi chạy lệnh `db:seed`, hệ thống sẽ có sẵn:
- 5 Khóa học tiêu biểu với các trạng thái khác nhau.
- 25 Bài học tương ứng.
- 5 Học viên đăng ký vào các khóa học này.
- Thống kê doanh thu và báo cáo sẵn sàng trên Dashboard.
