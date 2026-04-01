<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truyen; 

class GioHangController extends Controller
{
    // 1. Hàm hiển thị trang giỏ hàng
    public function index()
    {
        return view('giohang.index');
    }

    // 2. Hàm xử lý khi nhấn nút "Thêm vào giỏ"
    public function themVaoGio(Request $request, $id)
    {
        // Tìm xem cuốn truyện đó có tồn tại không
        $truyen = Truyen::find($id);

        if (!$truyen) {
            return redirect()->back()->with('error', 'Truyện không tồn tại!');
        }

        // Lấy giỏ hàng từ Session (nếu chưa có thì là mảng rỗng)
        $gioHang = session()->get('gio_hang', []);

        // Nếu truyện đã có trong giỏ, tăng số lượng lên 1
        if(isset($gioHang[$id])) {
            $gioHang[$id]['so_luong']++;
        } else {
            // Thêm mới với đúng tên cột trong Database (Chữ Hoa)
            $gioHang[$id] = [
                "ten_truyen" => $truyen->TenTruyen, 
                "so_luong" => 1,
                "gia_ban" => (float)$truyen->GiaBan, 
                "hinh_anh" => $truyen->HinhAnh
            ];
        }

        // Lưu lại vào bộ nhớ Session
        session()->put('gio_hang', $gioHang);

        // Gửi thông báo ngắn gọn để tránh lỗi văng dấu nháy làm hỏng Script
        return redirect()->back()->with('swal_success', 'Đã thêm truyện vào giỏ hàng thành công!');
    }
}