<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Thêm dòng này để dùng Database

class DonHangController extends Controller {

    public function addGioHang(Request $request, $id) {
        // 1. Tìm thông tin truyện từ bảng truyens
        $truyen = DB::table('truyens')->where('id', $id)->first();

        if (!$truyen) {
            return "Truyện không tồn tại!";
        }

        // 2. Kiểm tra xem truyện này đã có trong giỏ hàng của máy này chưa
        $daCo = DB::table('gio_hang')
                    ->where('truyen_id', $id)
                    ->where('session_id', session()->getId())
                    ->first();

        if ($daCo) {
            // Nếu có rồi thì cộng thêm 1 vào số lượng
            DB::table('gio_hang')->where('id', $daCo->id)->increment('so_luong');
        } else {
            // Nếu chưa có thì thêm mới một dòng vào bảng gio_hang
            DB::table('gio_hang')->insert([
                'truyen_id'  => $truyen->id,
                'ten_truyen' => $truyen->TenTruyen,
                'gia_ban'    => $truyen->GiaBan,
                'so_luong'   => 1,
                'session_id' => session()->getId(), // Dùng để phân biệt giỏ hàng các máy khác nhau
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return "Đã thêm '" . $truyen->TenTruyen . "' vào giỏ hàng Database!";
    }

    public function tinhTongTien($gia, $soluong) {
        $phiShip = 20000;
        $tong = ($gia * $soluong) + $phiShip;
        return "Tổng tiền của bạn là: " . number_format($tong, 0, ',', '.') . " VNĐ (đã bao gồm 20k ship).";
    }
}