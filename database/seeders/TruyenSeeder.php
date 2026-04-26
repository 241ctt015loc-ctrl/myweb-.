<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TruyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Truyen::create([
        'MaTheLoai' => 1, // Nhớ đảm bảo ID thể loại này đã tồn tại
        'TenTruyen' => 'Đảo Hải Tặc (One Piece)',
        'GiaBan' => 25000,
        'SoLuongTon' => 50,
        'HinhAnh' => 'one-piece.jpg'
    ]);

    \App\Models\Truyen::create([
        'TenTruyen' => 'Naruto',
        'GiaBan' => 22000,
        'SoLuongTon' => 30,
        'HinhAnh' => 'naruto.jpg'
    ]);
}
}
