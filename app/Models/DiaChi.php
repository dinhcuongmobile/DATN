<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaChi extends Model
{
    use HasFactory;

    protected $table = 'dia_chis';

    protected $fillable = [
        'user_id',
        'ho_va_ten_nhan',
        'so_dien_thoai_nhan',
        'ma_tinh_thanh_pho',
        'ma_quan_huyen',
        'ma_phuong_xa',
        'dia_chi_chi_tiet',
        'trang_thai'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function phuongXa()
    {
        return $this->belongsTo(PhuongXa::class, 'ma_phuong_xa');
    }

    public function quanHuyen()
    {
        return $this->belongsTo(QuanHuyen::class, 'ma_quan_huyen');
    }

    public function tinhThanhPho()
    {
        return $this->belongsTo(TinhThanhPho::class, 'ma_tinh_thanh_pho');
    }

    public function donHangs()
    {
        return $this->hasMany(DonHang::class, 'dia_chi_id');
    }
}
