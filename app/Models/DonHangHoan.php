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
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }
}
