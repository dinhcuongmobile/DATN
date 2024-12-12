<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonHang extends Model
{
    use HasFactory;

    protected $table = 'don_hangs';

    protected $fillable = [
        'ma_don_hang',
        'user_id',
        'nguoi_ban',
        'dia_chi_id',
        'giam_gia_van_chuyen',
        'giam_gia_don_hang',
        'namad_xu',
        'tong_thanh_toan',
        'phuong_thuc_thanh_toan',
        'trang_thai',
        'thanh_toan',
        'ghi_chu',
        'ngay_tao',
        'ngay_cap_nhat',
        'ngay_ban'
    ];

    public $timestamps = false;

    protected $dates = ['ngay_tao', 'ngay_cap_nhat', 'ngay_ban'];
    public function scopeMoiNhat($query)
    {
        return $query->orderBy('id', 'desc');
    }
    //END
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nguoiBan()
    {
        return $this->belongsTo(User::class, 'nguoi_ban');
    }

    public function diaChi()
    {
        return $this->belongsTo(DiaChi::class, 'dia_chi_id');
    }

    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHang::class, 'don_hang_id');
    }

    public function danhGia()
    {
        return $this->hasMany(DanhGia::class, 'don_hang_id');
    }

}
