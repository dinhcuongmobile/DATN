<?php

namespace App\Models;

use App\Models\TinTuc;
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

    public function tinTucs()
    {
        return $this->hasMany(TinTuc::class, 'danh_muc_id');
    }
}

