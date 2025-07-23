# Bookcase - Hệ thống quản lý sách

Một ứng dụng web quản lý sách được xây dựng bằng Laravel với giao diện Bootstrap hiện đại.

## Tính năng

- 🎨 **Giao diện Bootstrap đẹp mắt**: Sử dụng Bootstrap 5 với thiết kế responsive
- 🌍 **Đa ngôn ngữ**: Hỗ trợ tiếng Nhật (ja) và tiếng Việt (vn)
- 🔐 **Hệ thống đăng nhập/đăng ký**: Xác thực người dùng an toàn
- 📚 **Quản lý sách**: Thêm, sửa, xóa và tìm kiếm sách
- 👥 **Quản lý người dùng**: Hồ sơ người dùng và phân quyền
- 📊 **Dashboard**: Thống kê và báo cáo trực quan
- 📱 **Responsive**: Tương thích với mọi thiết bị

## Cài đặt

1. **Clone repository (branch features/use_OpenAIGPT4o)**
   ```bash
   git clone -b features/use_OpenAIGPT4o https://github.com/dophu17/bookcase.git
   cd bookcase
   ```

2. **Cài đặt dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Cấu hình môi trường**
   ```bash
   cp .env.example .env
   ```
   - Chỉnh sửa file `.env` với thông tin database của bạn
   - Thêm key OpenAI: `OPENAI_API_KEY=your_openai_key` để sử dụng OpenAI
   - Tham khảo tại đây: https://platform.openai.com/api-keys

4. **Cấu hình ngôn ngữ**
   - Mặc định: `APP_LOCALE=ja` (tiếng Nhật)
   - Có thể thay đổi thành: `APP_LOCALE=vn` (tiếng Việt)

5. **Chạy migration và seed lại dữ liệu**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **(Tuỳ chọn) Đăng nhập hệ thống, đăng ký user mới, và chỉnh sửa ID của user = 2 để mapping data mẫu**
   - Sau khi đăng ký user mới, vào database và chỉnh sửa trường `id` của user thành `2` nếu muốn sử dụng dữ liệu mẫu mapping sẵn.

7. **Chạy ứng dụng**
   ```bash
   php artisan serve
   ```

## Cấu trúc giao diện

### Layout chính (`resources/views/layouts/app.blade.php`)
- Navigation bar với menu responsive
- Footer với thông tin liên hệ
- Hỗ trợ Bootstrap 5 và Bootstrap Icons
- Flash messages cho thông báo

### Trang chủ (`resources/views/home.blade.php`)
- Hero section với call-to-action
- Tính năng nổi bật
- Thống kê
- Responsive design

### Trang đăng nhập (`resources/views/auth/login.blade.php`)
- Form đăng nhập với validation
- Thiết kế card đẹp mắt
- Link đến trang đăng ký

### Trang đăng ký (`resources/views/auth/register.blade.php`)
- Form đăng ký với validation
- Thiết kế tương tự trang đăng nhập
- Link đến trang đăng nhập

### Dashboard (`resources/views/dashboard.blade.php`)
- Thống kê tổng quan
- Thao tác nhanh
- Hoạt động gần đây

## Routes

- `/` - Trang chủ
- `/login` - Trang đăng nhập
- `/register` - Trang đăng ký
- `/dashboard` - Dashboard (yêu cầu đăng nhập)
- `/logout` - Đăng xuất
- `/language/{locale}` - Chuyển đổi ngôn ngữ (ja/vn)

## Đa ngôn ngữ

Ứng dụng hỗ trợ 2 ngôn ngữ:
- **Tiếng Nhật (ja)**: Ngôn ngữ mặc định
- **Tiếng Việt (vn)**: Ngôn ngữ thứ hai

### Chuyển đổi ngôn ngữ
- Sử dụng dropdown menu trong navigation bar
- Hoặc truy cập trực tiếp: `/language/ja` hoặc `/language/vn`
- Ngôn ngữ được lưu trong session

### Thêm ngôn ngữ mới
1. Tạo file `lang/{locale}/app.php`
2. Thêm locale vào `config/app.php` trong mảng `available_locales`
3. Thêm các key translation tương ứng

## Công nghệ sử dụng

- **Backend**: Laravel 10
- **Frontend**: Bootstrap 5, Bootstrap Icons
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Auth

## Tùy chỉnh

### Thay đổi màu sắc
Chỉnh sửa CSS variables trong file `resources/views/layouts/app.blade.php`:

```css
:root {
    --primary-color: #3498db;
    --secondary-color: #2c3e50;
    --success-color: #27ae60;
    --warning-color: #f39c12;
    --danger-color: #e74c3c;
}
```

### Thêm trang mới
1. Tạo view trong `resources/views/`
2. Thêm route trong `routes/web.php`
3. Tạo controller nếu cần

## Đóng góp

1. Fork project
2. Tạo feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Tạo Pull Request

## License

Distributed under the MIT License. See `LICENSE` for more information.

## Liên hệ

- Email: info@bookcase.com
- Phone: +84 123 456 789
- Address: Hà Nội, Việt Nam
