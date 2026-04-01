<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GioHangController;

// 1. TRANG CHỦ (Hiển thị danh sách truyện)
Route::get('/', [GioHangController::class, 'index'])->name('home');

// 2. TÌM KIẾM TRUYỆN
Route::get('/search', [GioHangController::class, 'search'])->name('search');

// 3. XEM CHI TIẾT TRUYỆN (Trang chọn tập/chap)
Route::get('/truyen/{id}', [GioHangController::class, 'show'])->name('story.show');

// 4. GIỎ HÀNG
// Xem giỏ hàng
Route::get('/gio-hang', [GioHangController::class, 'xemGioHang'])->name('cart.index');
// Thêm vào giỏ hàng (Mua hàng)
// Thêm vào giỏ hàng (Mua hàng)
Route::post('/mua-hang/{id}', [GioHangController::class, 'themVaoGio'])->name('cart.add');
Route::get('/reset-gio-hang', function() {
    session()->forget('gio_hang');
    return redirect()->route('home')->with('swal_success', 'Đã dọn dẹp giỏ hàng!');
});

// 5. THANH TOÁN
// Trang điền thông tin thanh toán
Route::get('/thanh-toan', [GioHangController::class, 'thanhToan'])->name('cart.checkout');
// Xử lý lưu đơn hàng
Route::post('/xu-ly-thanh-toan', [GioHangController::class, 'xuLyThanhToan'])->name('cart.process');
// 6. LỌC THEO THỂ LOẠI
Route::get('/the-loai/{slug}', [GioHangController::class, 'theLoai'])->name('category.show');
// Xóa 1 truyện khỏi giỏ
Route::get('/xoa-khoi-gio/{id}', [GioHangController::class, 'xoaKhoiGio'])->name('cart.remove');
