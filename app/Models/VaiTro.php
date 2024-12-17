<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    use HasFactory;

    protected $table = 'vai_tros';

    protected $fillable = [
        'vai_tro',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'vai_tro_id');
    }
}
