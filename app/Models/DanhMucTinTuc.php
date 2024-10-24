<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DanhMucTinTuc extends Model
{
    use HasFactory,SoftDeletes;

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

