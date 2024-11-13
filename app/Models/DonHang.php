<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonHang extends Model
{
    use HasFactory;

    protected $table = 'don_hangs';

    protected $fillable = [
        'ma_don_hang',
        'user_id',
        'dia_chi_id',
        'giam_gia_van_chuyen',
        'giam_gia_don_hang',
        'tong_thanh_toan',
        'phuong_thuc_thanh_toan',
        'trang_thai',
        'thanh_toan',
        'ghi_chu',
        'ngay_dat_hang',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function diaChi()
    {
        return $this->belongsTo(DiaChi::class, 'dia_chi_id');
    }

    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHang::class, 'don_hang_id');
    }

    public function donHangHoan()
    {
        return $this->hasMany(DonHangHoan::class, 'don_hang_id');
    }
}
