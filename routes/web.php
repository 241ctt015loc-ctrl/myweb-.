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
// Dùng cái này để dọn dẹp đống dữ liệu cũ bị sai
Route::get('/reset-gio-hang', function() {
    session()->forget('gio_hang');
    return "Đã dọn dẹp sạch sẽ! Giờ hãy quay lại trang chủ và bấm Thêm vào giỏ hàng lại nhé.";
});