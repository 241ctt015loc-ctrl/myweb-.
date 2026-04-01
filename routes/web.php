<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruyenController;
use App\Http\Controllers\GioHangController;

// 1. Trang chủ
Route::get('/', [TruyenController::class, 'index'])->name('home');

// 2. Thêm vào giỏ hàng
Route::get('/mua-hang/{id}', [GioHangController::class, 'themVaoGio'])->name('cart.add');

// 3. Xem trang giỏ hàng
Route::get('/gio-hang', [GioHangController::class, 'index'])->name('cart.index');

// 4. Reset giỏ hàng
Route::get('/reset-gio-hang', function() {
    session()->forget('gio_hang');
    return "Đã dọn dẹp sạch sẽ! Giờ hãy quay lại trang chủ và bấm Thêm vào giỏ hàng lại nhé.";
}); // <--- Phải đóng ngoặc ở đây để kết thúc hàm reset

// 5. Đường dẫn mở trang thanh toán (PHẢI NẰM NGOÀI)
Route::get('/thanh-toan', [GioHangController::class, 'thanhToan'])->name('cart.checkout');

// 6. Đường dẫn xử lý khi bấm nút "Đặt hàng"
Route::post('/xu-ly-thanh-toan', [GioHangController::class, 'xuLyThanhToan'])->name('cart.process');
