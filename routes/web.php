<?php

use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

// Khi vào trang chủ, nó sẽ gọi hàm index của StoryController
Route::get('/', [StoryController::class, 'index']);
