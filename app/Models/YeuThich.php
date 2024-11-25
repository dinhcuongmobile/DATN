<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuThich extends Model
{
    use HasFactory;
    protected $table = 'yeu_thichs';

    protected $fillable =
    [
        'nguoi_dung_id',
        'san_pham_id'
    ];

    public function NguoiDung()
    {
        return $this->belongsTo(User::class,'nguoi_dung_id','id');
    }

    public function SanPham()
    {
        return $this->belongsTo(SanPham::class);
    }
}
