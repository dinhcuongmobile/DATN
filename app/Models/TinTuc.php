<?php

namespace App\Models;

use App\Models\User;
use App\Models\DanhMucTinTuc;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TinTuc extends Model
{
    use HasFactory;

    protected $table = 'tin_tucs';
    protected $fillable = [
        'danh_muc_id',
        'hinh_anh',
        'tieu_de',
        'noi_dung',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function danhMucTinTuc()
    {
        return $this->belongsTo(DanhMucTinTuc::class, 'danh_muc_id');
    }

    public function loadAllTinTuc()
    {
        $query = DB::table('tin_tucs')
            ->join('danh_muc_tin_tucs', 'tin_tucs.danh_muc_id', '=', 'danh_muc_tin_tucs.id')
            ->select('tin_tucs.*', 'danh_muc_tin_tucs.ten_danh_muc as tenDanhMuc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return $query;
    }
    public function searchTinTuc($keyword)
    {
        $query = DB::table('tin_tucs')
            ->where('tieu_de', 'LIKE', "%$keyword%")
            ->orWhere('noi_dung', 'LIKE', "%$keyword%")
            ->orWhere('created_at', 'LIKE', "%$keyword%")
            ->orderBy('id', 'desc')
            ->paginate(10);
        return $query;
    }
    public function loadTinTucGanDay()
    {
        $query = DB::table('tin_tucs')
            ->limit(2)
            ->orderBy('id', 'desc')
            ->get();

        return $query;
    }

    public function loadOneTinTuc($id)
    {
        $query = DB::table('tin_tucs')->find($id);
        return $query;
    }

    public function addTinTuc($data)
    {
        DB::table('tin_tucs')->insert($data);
    }

    public function updateTinTuc($data, $id)
    {
        DB::table('tin_tucs')->where('id', $id)->update($data);
    }

    public function deleteTinTuc($id)
    {
        DB::table('tin_tucs')->delete($id);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
