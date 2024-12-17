<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnhDanhGia extends Model
{
    use HasFactory;

    protected $table = 'anh_danh_gias';

    protected $fillable = [
        'danh_gia_id',
        'hinh_anh',
    ];


    public function danhGia()
    {
        return $this->belongsTo(DanhGia::class, 'danh_gia_id');
    }
}
