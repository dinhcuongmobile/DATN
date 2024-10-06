<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinhThanhPho extends Model
{
    use HasFactory;

    protected $table = 'vn_tinh_thanh_phos';

    protected $fillable = [
        'ma_tinh_thanh_pho',
        'ten_tinh_thanh_pho',
        'type',
    ];

    public function quanHuyen() {
        return $this->hasMany(QuanHuyen::class);
    }
}
