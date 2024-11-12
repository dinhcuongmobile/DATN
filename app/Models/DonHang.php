<?php

namespace App\Models;

use App\Models\User;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonHang extends Model
{
    use HasFactory;

    protected $table = 'don_hangs';

    protected $fillable = [
        'user_id',
        'ho_ten_nhan',
        'ngay_dat_hang',
        'dia_chi_nhan',
        'so_dien_thoai_nhan',
        'tong_thanh_toan',
        'phuong_thuc_thanh_toan',
        'trang_thai',
        'thanh_toan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHang::class, 'don_hang_id');
    }
}
