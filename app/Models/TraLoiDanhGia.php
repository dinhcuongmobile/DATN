<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraLoiDanhGia extends Model
{
    use HasFactory;

    protected $table = 'tra_loi_danh_gias';

    protected $fillable = [
        'danh_gia_id',
        'user_id',
        'noi_dung'
    ];

    public function danhGia()
    {
        return $this->belongsTo(DanhGia::class, 'danh_gia_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
