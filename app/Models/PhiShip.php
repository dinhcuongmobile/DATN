<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhiShip extends Model
{
    use HasFactory;

    protected $table = 'phi_ships';

    protected $fillable = [
        'ma_tinh_thanh_pho',
        'ma_quan_huyen',
        'phi_ship'
    ];

    public function quanHuyen()
    {
        return $this->belongsTo(QuanHuyen::class, 'ma_quan_huyen');
    }

    public function tinhThanhPho()
    {
        return $this->belongsTo(TinhThanhPho::class, 'ma_tinh_thanh_pho');
    }
}
