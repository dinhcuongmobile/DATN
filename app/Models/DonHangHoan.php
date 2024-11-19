<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHangHoan extends Model
{
    use HasFactory;

    protected $table = 'don_hang_hoans';

    protected $fillable = [
        'don_hang_id',
        'ly_do',
        'trang_thai',
        'ngay_tao',
        'ngay_cap_nhat'
    ];

    public $timestamps = false;

    protected $dates = ['ngay_tao', 'ngay_cap_nhat'];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }
}
