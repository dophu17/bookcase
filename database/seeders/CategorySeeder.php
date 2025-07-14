<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Tiểu thuyết',
            'Khoa học',
            'Lịch sử',
            'Thiếu nhi',
            'Tâm lý',
            'Kinh doanh',
            'Công nghệ thông tin',
            'Văn học',
            'Y học',
            'Nấu ăn',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
} 