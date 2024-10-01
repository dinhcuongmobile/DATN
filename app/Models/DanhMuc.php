<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhMuc extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'danh_mucs';

    protected $fillable = [
        'id',
        'hinh_anh',
        'ten_danh_muc',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function sanPhams()
    {
        return $this->hasMany(SanPham::class, 'danh_muc_id');
    }
    public static function search($query)
    {
        return self::when($query, function($queryBuilder) use ($query) {
            return $queryBuilder->where('ten_danh_muc', 'LIKE', "%{$query}%");
        })->get();
    }
}
