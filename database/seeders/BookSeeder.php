<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $readStatuses = ['readed', 'reading', 'not_read'];
        $countries = ['Việt Nam', 'Mỹ', 'Anh', 'Nhật Bản', 'Hàn Quốc', 'Trung Quốc', 'Pháp', 'Đức', 'Nga', 'Canada'];
        $publishers = [
            'NXB Văn học', 'NXB Kim Đồng', 'NXB Trẻ', 'NXB Tổng hợp TP.HCM', 'NXB Giáo dục',
            'NXB Thế giới', 'NXB Hội nhà văn', 'NXB Lao động', 'NXB Thanh niên', 'NXB Phụ nữ'
        ];

        $books = [
            ['name' => 'Đắc Nhân Tâm', 'author_name' => 'Dale Carnegie', 'publisher' => 'NXB Tổng hợp TP.HCM', 'total_pages' => 320, 'cover_price' => 85000],
            ['name' => 'Nhà Giả Kim', 'author_name' => 'Paulo Coelho', 'publisher' => 'NXB Văn học', 'total_pages' => 208, 'cover_price' => 65000],
            ['name' => 'Tuổi Trẻ Đáng Giá Bao Nhiêu', 'author_name' => 'Rosie Nguyễn', 'publisher' => 'NXB Hội nhà văn', 'total_pages' => 280, 'cover_price' => 89000],
            ['name' => 'Cách Nghĩ Để Thành Công', 'author_name' => 'Napoleon Hill', 'publisher' => 'NXB Lao động', 'total_pages' => 400, 'cover_price' => 120000],
            ['name' => 'Đọc Vị Bất Kỳ Ai', 'author_name' => 'David J. Lieberman', 'publisher' => 'NXB Lao động', 'total_pages' => 256, 'cover_price' => 75000],
            ['name' => 'Nghĩ Giàu Làm Giàu', 'author_name' => 'Napoleon Hill', 'publisher' => 'NXB Lao động', 'total_pages' => 380, 'cover_price' => 110000],
            ['name' => '7 Thói Quen Hiệu Quả', 'author_name' => 'Stephen R. Covey', 'publisher' => 'NXB Tổng hợp TP.HCM', 'total_pages' => 420, 'cover_price' => 150000],
            ['name' => 'Người Giàu Nhất Thành Babylon', 'author_name' => 'George S. Clason', 'publisher' => 'NXB Lao động', 'total_pages' => 200, 'cover_price' => 68000],
            ['name' => 'Đời Thay Đổi Khi Chúng Ta Thay Đổi', 'author_name' => 'Andrew Matthews', 'publisher' => 'NXB Trẻ', 'total_pages' => 240, 'cover_price' => 72000],
            ['name' => 'Hạt Giống Tâm Hồn', 'author_name' => 'Jack Canfield', 'publisher' => 'NXB Tổng hợp TP.HCM', 'total_pages' => 300, 'cover_price' => 95000],
            ['name' => 'Tôi Thấy Hoa Vàng Trên Cỏ Xanh', 'author_name' => 'Nguyễn Nhật Ánh', 'publisher' => 'NXB Trẻ', 'total_pages' => 380, 'cover_price' => 125000],
            ['name' => 'Mắt Biếc', 'author_name' => 'Nguyễn Nhật Ánh', 'publisher' => 'NXB Trẻ', 'total_pages' => 320, 'cover_price' => 98000],
            ['name' => 'Cô Gái Đến Từ Hôm Qua', 'author_name' => 'Nguyễn Nhật Ánh', 'publisher' => 'NXB Trẻ', 'total_pages' => 280, 'cover_price' => 85000],
            ['name' => 'Cho Tôi Xin Một Vé Đi Tuổi Thơ', 'author_name' => 'Nguyễn Nhật Ánh', 'publisher' => 'NXB Trẻ', 'total_pages' => 260, 'cover_price' => 78000],
            ['name' => 'Ngày Xưa Có Một Chuyện Tình', 'author_name' => 'Nguyễn Nhật Ánh', 'publisher' => 'NXB Trẻ', 'total_pages' => 340, 'cover_price' => 105000],
            ['name' => 'Số Đỏ', 'author_name' => 'Vũ Trọng Phụng', 'publisher' => 'NXB Văn học', 'total_pages' => 280, 'cover_price' => 75000],
            ['name' => 'Chí Phèo', 'author_name' => 'Nam Cao', 'publisher' => 'NXB Văn học', 'total_pages' => 200, 'cover_price' => 65000],
            ['name' => 'Truyện Kiều', 'author_name' => 'Nguyễn Du', 'publisher' => 'NXB Văn học', 'total_pages' => 320, 'cover_price' => 85000],
            ['name' => 'Tắt Đèn', 'author_name' => 'Ngô Tất Tố', 'publisher' => 'NXB Văn học', 'total_pages' => 240, 'cover_price' => 68000],
            ['name' => 'Bỉ Vỏ', 'author_name' => 'Nguyên Hồng', 'publisher' => 'NXB Văn học', 'total_pages' => 260, 'cover_price' => 72000],
            ['name' => 'Harry Potter và Hòn Đá Phù Thủy', 'author_name' => 'J.K. Rowling', 'publisher' => 'NXB Trẻ', 'total_pages' => 320, 'cover_price' => 120000],
            ['name' => 'Harry Potter và Phòng Chứa Bí Mật', 'author_name' => 'J.K. Rowling', 'publisher' => 'NXB Trẻ', 'total_pages' => 340, 'cover_price' => 125000],
            ['name' => 'Chúa Tể Những Chiếc Nhẫn', 'author_name' => 'J.R.R. Tolkien', 'publisher' => 'NXB Văn học', 'total_pages' => 480, 'cover_price' => 180000],
            ['name' => 'Đấu Trường Sinh Tử', 'author_name' => 'Suzanne Collins', 'publisher' => 'NXB Trẻ', 'total_pages' => 380, 'cover_price' => 135000],
            ['name' => 'Chạng Vạng', 'author_name' => 'Stephenie Meyer', 'publisher' => 'NXB Trẻ', 'total_pages' => 420, 'cover_price' => 145000],
            ['name' => 'Đi Tìm Alaska', 'author_name' => 'John Green', 'publisher' => 'NXB Trẻ', 'total_pages' => 280, 'cover_price' => 95000],
            ['name' => 'Lá Thư Không Gửi', 'author_name' => 'John Green', 'publisher' => 'NXB Trẻ', 'total_pages' => 320, 'cover_price' => 105000],
            ['name' => 'Những Kẻ Mộng Mơ', 'author_name' => 'John Green', 'publisher' => 'NXB Trẻ', 'total_pages' => 300, 'cover_price' => 98000],
            ['name' => 'Bắt Trẻ Đồng Xanh', 'author_name' => 'J.D. Salinger', 'publisher' => 'NXB Văn học', 'total_pages' => 240, 'cover_price' => 75000],
            ['name' => 'Giết Con Chim Nhại', 'author_name' => 'Harper Lee', 'publisher' => 'NXB Văn học', 'total_pages' => 360, 'cover_price' => 110000],
            ['name' => 'Ông Già Và Biển Cả', 'author_name' => 'Ernest Hemingway', 'publisher' => 'NXB Văn học', 'total_pages' => 180, 'cover_price' => 65000],
            ['name' => '1984', 'author_name' => 'George Orwell', 'publisher' => 'NXB Văn học', 'total_pages' => 320, 'cover_price' => 95000],
            ['name' => 'Trại Súc Vật', 'author_name' => 'George Orwell', 'publisher' => 'NXB Văn học', 'total_pages' => 160, 'cover_price' => 58000],
            ['name' => 'Bắt Đầu Với Tại Sao', 'author_name' => 'Simon Sinek', 'publisher' => 'NXB Lao động', 'total_pages' => 280, 'cover_price' => 120000],
            ['name' => 'Nghệ Thuật Tinh Tế Của Việc Đếch Quan Tâm', 'author_name' => 'Mark Manson', 'publisher' => 'NXB Lao động', 'total_pages' => 240, 'cover_price' => 98000],
            ['name' => 'Sức Mạnh Của Thói Quen', 'author_name' => 'Charles Duhigg', 'publisher' => 'NXB Lao động', 'total_pages' => 320, 'cover_price' => 125000],
            ['name' => 'Nghĩ Nhanh Và Chậm', 'author_name' => 'Daniel Kahneman', 'publisher' => 'NXB Lao động', 'total_pages' => 480, 'cover_price' => 180000],
            ['name' => 'Điểm Bùng Phát', 'author_name' => 'Malcolm Gladwell', 'publisher' => 'NXB Lao động', 'total_pages' => 300, 'cover_price' => 115000],
            ['name' => 'Những Kẻ Xuất Chúng', 'author_name' => 'Malcolm Gladwell', 'publisher' => 'NXB Lao động', 'total_pages' => 340, 'cover_price' => 130000],
            ['name' => 'Sapiens', 'author_name' => 'Yuval Noah Harari', 'publisher' => 'NXB Lao động', 'total_pages' => 420, 'cover_price' => 160000],
            ['name' => 'Homo Deus', 'author_name' => 'Yuval Noah Harari', 'publisher' => 'NXB Lao động', 'total_pages' => 380, 'cover_price' => 145000],
            ['name' => '21 Bài Học Cho Thế Kỷ 21', 'author_name' => 'Yuval Noah Harari', 'publisher' => 'NXB Lao động', 'total_pages' => 320, 'cover_price' => 125000],
            ['name' => 'Lịch Sử Vạn Vật', 'author_name' => 'Bill Bryson', 'publisher' => 'NXB Lao động', 'total_pages' => 480, 'cover_price' => 180000],
            ['name' => 'Vũ Trụ Trong Lòng Bàn Tay', 'author_name' => 'Neil deGrasse Tyson', 'publisher' => 'NXB Lao động', 'total_pages' => 360, 'cover_price' => 135000],
            ['name' => 'Lược Sử Thời Gian', 'author_name' => 'Stephen Hawking', 'publisher' => 'NXB Lao động', 'total_pages' => 280, 'cover_price' => 110000],
            ['name' => 'Định Luật Vạn Vật Hấp Dẫn', 'author_name' => 'Stephen Hawking', 'publisher' => 'NXB Lao động', 'total_pages' => 320, 'cover_price' => 125000],
            ['name' => 'Bí Mật Của May Mắn', 'author_name' => 'Alex Rovira', 'publisher' => 'NXB Trẻ', 'total_pages' => 160, 'cover_price' => 65000],
            ['name' => 'Hạnh Phúc Tại Tâm', 'author_name' => 'Matthieu Ricard', 'publisher' => 'NXB Trẻ', 'total_pages' => 280, 'cover_price' => 95000],
            ['name' => 'Nghệ Thuật Sống', 'author_name' => 'Thích Nhất Hạnh', 'publisher' => 'NXB Trẻ', 'total_pages' => 240, 'cover_price' => 78000],
            ['name' => 'Đường Xưa Mây Trắng', 'author_name' => 'Thích Nhất Hạnh', 'publisher' => 'NXB Trẻ', 'total_pages' => 360, 'cover_price' => 115000],
            ['name' => 'Bông Hồng Cài Áo', 'author_name' => 'Thích Nhất Hạnh', 'publisher' => 'NXB Trẻ', 'total_pages' => 200, 'cover_price' => 68000],
            ['name' => 'Truyện Cổ Andersen', 'author_name' => 'Hans Christian Andersen', 'publisher' => 'NXB Kim Đồng', 'total_pages' => 280, 'cover_price' => 85000],
            ['name' => 'Truyện Cổ Grimm', 'author_name' => 'Anh em Grimm', 'publisher' => 'NXB Kim Đồng', 'total_pages' => 320, 'cover_price' => 95000],
            ['name' => 'Dế Mèn Phiêu Lưu Ký', 'author_name' => 'Tô Hoài', 'publisher' => 'NXB Kim Đồng', 'total_pages' => 180, 'cover_price' => 65000],
            ['name' => 'Vừa Nhắm Mắt Vừa Mở Cửa Sổ', 'author_name' => 'Nguyễn Ngọc Thuần', 'publisher' => 'NXB Trẻ', 'total_pages' => 160, 'cover_price' => 58000],
        ];

        for ($i = 0; $i < 50; $i++) {
            $bookData = $books[$i] ?? [
                'name' => 'Sách ' . ($i + 1),
                'author_name' => 'Tác giả ' . ($i + 1),
                'publisher' => $publishers[array_rand($publishers)],
                'total_pages' => rand(150, 500),
                'cover_price' => rand(50000, 200000)
            ];

            Book::create([
                'name' => $bookData['name'],
                'author_name' => $bookData['author_name'],
                'user_id' => 2,
                'category_id' => $categories->random()->id,
                'read_status' => $readStatuses[array_rand($readStatuses)],
                'publisher' => $bookData['publisher'],
                'total_pages' => $bookData['total_pages'],
                'cover_price' => $bookData['cover_price'],
                'country' => $countries[array_rand($countries)],
            ]);
        }
    }
} 