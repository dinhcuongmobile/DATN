<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;

    protected $table = 'danh_gias';

    protected $fillable = [
        'san_pham_id',
        'user_id',
        'noi_dung',
        'so_sao',
    ];

    public $timestamp = false;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function anhDanhGias()
    {
        return $this->hasMany(AnhDanhGia::class, 'danh_gia_id');
    }
}
