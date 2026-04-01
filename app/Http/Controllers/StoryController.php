<?php

namespace App\Http\Controllers;

use App\Models\Story; // Nhớ dòng này để dùng Model Story
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index()
    {
        // Lấy tất cả truyện từ DB
        $stories = Story::all(); 

        // Trả về giao diện kèm biến stories
        return view('welcome', compact('stories'));
    }
}