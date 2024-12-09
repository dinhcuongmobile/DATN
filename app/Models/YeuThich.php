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
        'user_id',
        'san_pham_id'
    ];
    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class,'san_pham_id');
    }
}
