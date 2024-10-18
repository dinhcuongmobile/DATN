<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMucTinTuc extends Model
{
    use HasFactory;

    protected $table = 'danh_muc_tin_tucs';

    protected $fillable = [
        'ten_danh_muc',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function tinTucs()
    {
        return $this->hasMany(TinTuc::class, 'danh_muc_id');
    }
}

