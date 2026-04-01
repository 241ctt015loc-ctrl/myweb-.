<?php

namespace App\Http\Controllers;

use App\Models\Truyen; // Sử dụng Model Truyen tiếng Việt
use Illuminate\Http\Request;

class TruyenController extends Controller 
{
    // 1. Trang chủ: Lấy danh sách truyện đổ ra web
    public function index() {
        // Lấy toàn bộ truyện từ Database thông qua Model Truyen
        $stories = Truyen::all(); 

        // Gửi biến $stories ra file welcome.blade.php
        return view('welcome', compact('stories'));
    }

    // 2. Tìm kiếm truyện
    public function timKiem(Request $request) {
        $tuKhoa = $request->tukhoa;
        $ketQua = Truyen::where('TenTruyen', 'like', "%$tuKhoa%")->get();
        return $ketQua;
    }

    // 3. Thêm truyện mới (Có bắt lỗi & Lưu ảnh)
    public function themMoi(Request $request) {
        $request->validate([
            'TenTruyen' => 'required',
            'GiaBan' => 'required|numeric|min:0',
            'AnhBia' => 'image|max:2048'
        ]);

        $tenAnh = null;
        if ($request->hasFile('AnhBia')) {
            $file = $request->file('AnhBia');
            $tenAnh = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $tenAnh);
        }

        // Sau này khi Nhóm 1 làm xong Database, bạn bỏ dấu // ở dưới để lưu thật nhé:
        /*
        Truyen::create([
            'TenTruyen' => $request->TenTruyen,
            'GiaBan' => $request->GiaBan,
            'HinhAnh' => $tenAnh,
            'MaTheLoai' => 1, // Mặc định
            'SoLuongTon' => 10
        ]);
        */

        return "Đã kiểm tra và lưu ảnh: " . $tenAnh;
    }
}