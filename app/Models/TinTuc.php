<?php

namespace App\Models;

use App\Models\User;
use App\Models\DanhMucTinTuc;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TinTuc extends Model
{
    use HasFactory;

    protected $table = 'tin_tucs';
    protected $fillable = [
        'danh_muc_id',
        'nguoi_dang',
        'hinh_anh',
        'tieu_de',
        'noi_dung',
        'luot_xem',
        'ngay_dang',
        'ngay_cap_nhat'
    ];
    public $timestamps = false;

    protected $dates = ['ngay_dang', 'ngay_cap_nhat'];

    public function danhMucTinTuc()
    {
        return $this->belongsTo(DanhMucTinTuc::class, 'danh_muc_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'nguoi_dang');
    }
}
