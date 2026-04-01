<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Truyen; // Bắt buộc phải có dòng này để gọi Model

class HomeController extends Controller
{
    public function index() {
        // Lấy 5 truyện đầu tiên làm Truyện Hot
        $hotComics = Truyen::limit(5)->get();
        
        // Lấy 4 truyện mới nhất (sắp xếp theo MaTruyen giảm dần)
        $newComics = Truyen::orderBy('MaTruyen', 'desc')->limit(4)->get();
        
        // Lấy ngẫu nhiên 5 truyện làm Top Bán Chạy
        $bestSellers = Truyen::inRandomOrder()->limit(5)->get();

        // Gửi dữ liệu sang View
        return view('welcome', compact('hotComics', 'newComics', 'bestSellers'));
    }
}