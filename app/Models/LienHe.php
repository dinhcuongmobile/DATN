<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LienHe extends Model
{
    use HasFactory;

    protected $table = 'lien_hes';

    protected $fillable = [
        'ho_va_ten',
        'email',
        'so_dien_thoai',
        'noi_dung',
        'trang_thai',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
