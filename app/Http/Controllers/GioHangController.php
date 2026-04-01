<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Truyen; 

class GioHangController extends Controller
{
    /**
     * 1. Hàm hiển thị TRANG CHỦ (Trang danh sách truyện)
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $stories = Truyen::where('TenTruyen', 'LIKE', "%{$query}%")->get();
        } else {
            $stories = Truyen::all();
        }

        return view('welcome', compact('stories'));
    }

    /**
     * 2. Hàm xử lý khi nhấn nút "Thêm vào giỏ"
     */
    public function themVaoGio(Request $request, $id)
    {
        $truyen = Truyen::find($id);

        if (!$truyen) {
            return redirect('/')->with('error', 'Truyện không tồn tại!');
        }
        
        $soLuongMua = $request->input('so_luong', 1);
        $gioHang = session()->get('gio_hang', []);

        if(isset($gioHang[$id])) {
            $gioHang[$id]['so_luong'] += $soLuongMua;
        } else {
            $gioHang[$id] = [
                "ten_truyen" => $truyen->TenTruyen, 
                "so_luong"   => $soLuongMua,
                "gia_ban"    => $truyen->GiaBan,   
                "hinh_anh"   => $truyen->HinhAnh   
            ];
        }

        session()->put('gio_hang', $gioHang);

        return redirect()->action([GioHangController::class, 'xemGioHang'])
                         ->with('added_to_cart', 'Đã thêm vào giỏ hàng thành công!');
    }

    /**
     * 3. Hàm xử lý TÌM KIẾM (Cho route /search)
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $stories = Truyen::where('TenTruyen', 'LIKE', "%{$query}%")->get();

        return view('welcome', compact('stories'));
    }

    /**
     * 4. Hàm hiển thị trang GIỎ HÀNG
     */
    public function xemGioHang()
    {
        return view('giohang.index');
    }

    /**
     * TÍNH NĂNG MỚI: XÓA 1 TRUYỆN KHỎI GIỎ HÀNG
     */
    public function xoaKhoiGio($id)
    {
        $gioHang = session()->get('gio_hang', []);

        // Nếu tồn tại truyện này trong giỏ thì tiến hành xóa
        if(isset($gioHang[$id])) {
            unset($gioHang[$id]); // Xóa phần tử khỏi mảng
            session()->put('gio_hang', $gioHang); // Cập nhật lại session
        }

        // Quay lại trang giỏ hàng và báo thành công
        return redirect()->back()->with('removed_from_cart', 'Đã xóa truyện khỏi giỏ hàng!');
    }

    /**
     * 5. Hàm hiển thị trang Thanh toán (Checkout)
     */
    public function thanhToan()
    {
        $gioHang = session()->get('gio_hang', []);
        
        if(empty($gioHang)) {
            return redirect('/')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        return view('giohang.checkout', compact('gioHang'));
    }

    /**
     * 6. Xử lý đặt hàng thành công
     */
    public function xuLyThanhToan(Request $request)
    {
        $hoTen = $request->input('ho_ten');
        session()->forget('gio_hang'); 

        // Đổi thành order_success cho khớp với đoạn script SweetAlert ở trang welcome
        return redirect('/')->with('order_success', 'Cảm ơn ' . $hoTen . '! Đơn hàng đã được ghi nhận.');
    }

    /**
     * 7. Hiển thị chi tiết truyện
     */
    public function show($id)
    {
        $story = \App\Models\Truyen::findOrFail($id);
        return view('stories.show', compact('story'));
    }

    /**
     * 8. Lọc theo thể loại
     */
    public function theLoai($slug)
    {
        $category = \DB::table('categories')->where('name', $slug)->first();

        if ($category) {
            // Đã sửa Story thành Truyen ở đây để không bị lỗi
            $stories = \App\Models\Truyen::where('category_id', $category->id)->get();
        } else {
            $stories = collect(); 
        }

        return view('welcome', compact('stories', 'slug'));
    }
}