<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController; // Phải có dòng này để nhận AuthController bạn đã tạo
use App\Models\Story; // Phải có dòng này để lấy dữ liệu truyện
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. TRANG CHỦ: Lấy dữ liệu truyện và đặt tên route là 'home'
Route::get('/', function () {
    $stories = Story::all(); // Lấy tất cả truyện từ database
    return view('welcome', compact('stories'));
})->name('home');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// 2. CÁC ROUTE PHỤ TRỢ: Để file welcome.blade.php không bị lỗi "Route not defined"
Route::get('/search', function() { 
    return "Trang tìm kiếm đang xây dựng"; 
})->name('search');

Route::get('/cart', function() { 
    return "Trang giỏ hàng đang xây dựng"; 
})->name('cart.index');

Route::get('/story/{id}', function($id) { 
    return "Chi tiết truyện số: " . $id; 
})->name('story.show');


// 3. LOGIC ĐĂNG NHẬP (CỦA BẠN TỰ VIẾT)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// 4. CÁC ROUTE CỦA LARAVEL BREEZE (GIỮ LẠI NẾU MUỐN DÙNG TRANG DASHBOARD)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php'; // Tạm thời đóng dòng này lại để không bị xung đột với AuthController bạn tự viết