<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    use HasFactory;

    protected $table = 'ma_khuyen_mais';

    protected $fillable = [
        'san_pham_id',
        'ma_giam_gia',
        'so_tien_giam',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'gia_tri_toi_thieu',
        'trang_thai'
    ];
}
