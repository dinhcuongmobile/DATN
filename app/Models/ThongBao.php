<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    use HasFactory;

    protected $table = 'thong_baos';

    protected $fillable = [
        'user_id',
        'hinh_anh',
        'tieu_de',
        'noi_dung',
        'trang_thai',
        'nguoi_nhan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
