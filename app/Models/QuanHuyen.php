<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanHuyen extends Model
{
    use HasFactory;

    protected $table = 'vn_quan_huyens';

    protected $fillable = [
        'ma_quan_huyen',
        'ten_quan_huyen',
        'type',
        'ma_tinh_thanh_pho',
    ];

    public function phuongXa() {
        return $this->hasMany(PhuongXa::class);
    }

    public function tinhThanhPho() {
        return $this->belongsTo(TinhThanhPho::class);
    }
}
