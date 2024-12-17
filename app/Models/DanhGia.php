<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhGia extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'danh_gias';

    protected $fillable = [
        'don_hang_id',
        'san_pham_id',
        'user_id',
        'noi_dung',
        'so_sao',
    ];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }

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

    public function traLoiDanhGia()
    {
        return $this->hasMany(TraLoiDanhGia::class, 'danh_gia_id');
    }
}
