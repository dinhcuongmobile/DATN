<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BienThe extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bien_thes';

    protected $fillable = [
        'san_pham_id',
        'hinh_anh',
        'kich_co',
        'ten_mau',
        'ma_mau',
        'so_luong',
    ];


    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id')->withTrashed();
    }

    public function gioHangs()
    {
        return $this->hasMany(GioHang::class, 'bien_the_id');
    }

    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHang::class, 'bien_the_id');
    }

}
