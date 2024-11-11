<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'coin',
        'ngay_nhan',
        'so_ngay'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
