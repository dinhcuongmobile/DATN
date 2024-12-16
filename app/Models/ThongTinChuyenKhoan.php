<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongTinChuyenKhoan extends Model
{
    use HasFactory;

    protected $table = 'thong_tin_chuyen_khoans';

    protected $fillable = [
        'ma_don_hang',
        'so_tien',
        'mo_ta_don_hang',
        'ma_giao_dich_vnpay',
        'ma_ngan_hang',
        'ma_giao_dich_ngan_hang',
        'ma_phan_hoi',
        'trang_thai_giao_dich',
        'thoi_gian_thanh_toan',
        'chu_ky_vnpay',
    ];

    public $timestamps = false;

    protected $dates = ['thoi_gian_thanh_toan'];
}
