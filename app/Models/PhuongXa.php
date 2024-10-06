<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhuongXa extends Model
{
    use HasFactory;

    protected $table = 'vn_phuong_xas';

    protected $fillable = [
        'ma_phuong_xa',
        'ten_phuong_xa',
        'type',
        'ma_quan_huyen',
    ];

    public function quanHuyen() {
        return $this->belongsTo(QuanHuyen::class);
    }
}
