<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    // Báo cho Laravel biết tên bảng chính xác trong database
    protected $table = 'Truyen'; 
    
    // Báo cho Laravel biết khóa chính là MaTruyen (chứ không phải id)
    protected $primaryKey = 'MaTruyen'; 
    
    // Tắt timestamps vì bảng của bạn không có cột created_at và updated_at
    public $timestamps = false; 
}