<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'san_phams';

    protected $fillable = [
        'danh_muc_id',
        'hinh_anh',
        'ten_san_pham',
        'gia_san_pham',
        'khuyen_mai',
        'mo_ta',
        'luot_xem',
        'da_ban',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_id');
    }

    public function bienThes()
    {
        return $this->hasMany(BienThe::class, 'san_pham_id');
    }

    public function khuyenMais()
    {
        return $this->hasMany(KhuyenMai::class, 'san_pham_id');
    }

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'san_pham_id');
    }

    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHang::class, 'san_pham_id');
    }

    public function gioHangs()
    {
        return $this->hasMany(GioHang::class, 'san_pham_id');
    }

}

