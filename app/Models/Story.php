<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    // 1. Khai báo tên bảng (vì Laravel thường tự hiểu tên bảng là 'stories' số nhiều)
    protected $table = 'stories';

    // 2. Khai báo các cột có thể nhập liệu (Mass Assignment)
    protected $fillable = [
        'TenTruyen', 
        'HinhAnh', 
        'GiaBan', 
        'MoTa',
        'category_id'
    ];

    // 3. Nếu bảng của bạn không dùng 2 cột created_at và updated_at thì để false
    // public $timestamps = false;
}