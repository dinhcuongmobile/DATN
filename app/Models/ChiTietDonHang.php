<?php

namespace App\Models;

use App\Models\BienThe;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChiTietDonHang extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_don_hangs';

    protected $fillable = [
        'don_hang_id',
        'san_pham_id',
        'bien_the_id',
        'so_luong',
        'don_gia',
        'thanh_tien',
    ];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id')->withTrashed();
    }

    public function bienThe()
    {
        return $this->belongsTo(BienThe::class, 'bien_the_id')->withTrashed();
    }
}
