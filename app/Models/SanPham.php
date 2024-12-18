<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SanPham extends Model
{
    use HasFactory, SoftDeletes ,Searchable;

    protected $table = 'san_phams';

    protected $fillable = [
        'danh_muc_id',
        'hinh_anh',
        'ten_san_pham',
        'gia_san_pham',
        'khuyen_mai',
        'mo_ta',
        'luot_xem',
        'da_ban',
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_id');
    }

    public function bienThes()
    {
        return $this->hasMany(BienThe::class, 'san_pham_id')->withTrashed();
    }

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'san_pham_id');
    }

    public function chiTietDonHangs()
    {
        return $this->hasMany(ChiTietDonHang::class, 'san_pham_id');
    }

    public function gioHangs()
    {
        return $this->hasMany(GioHang::class, 'san_pham_id');
    }

    public function yeuThich()
    {
        return $this->hasMany(YeuThich::class, 'san_pham_id');
    }

    public function searchableAs()
    {
        return 'san_phams_index';
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Bạn có thể tùy chỉnh dữ liệu để được lập chỉ mục
        return [
            'ten_san_pham' => $this->ten_san_pham,
            'gia_san_pham' => $this->gia_san_pham,
            'mo_ta' => $this->mo_ta,
            // thêm các trường khác nếu cần
        ];
    }

}

