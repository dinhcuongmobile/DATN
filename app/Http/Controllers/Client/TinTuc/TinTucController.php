<?php

namespace App\Http\Controllers\Client\TinTuc;

use App\Models\TinTuc;
use Illuminate\Http\Request;
use App\Models\DanhMucTinTuc;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TinTucController extends Controller
{
    protected $tin_tucs;
    protected $views;
    public function __construct()
    {
        $this->tin_tucs = new TinTuc();
        $this->views = [];
    }
    public function tinTuc()
    {
        $this->views['tin_tucs'] = $this->tin_tucs->loadAllTinTuc();
        $this->views['danh_muc_tin_tucs'] = DanhMucTinTuc::all();
        $this->views['count_danh_muc_tin_tuc'] = TinTuc::groupBy('danh_muc_id')
            ->selectRaw('danh_muc_id, COUNT(*) as count')
            ->pluck('count', 'danh_muc_id');
        $this->views['tin_tuc_gan_day'] = $this->tin_tucs->loadTinTucGanDay();
        //phân trang
        $perPage = 5;
        $tin_tucs = TinTuc::paginate($perPage);

        
        //

        return view('client.tinTuc.tinTuc', $this->views);
    }

    public function chiTietTinTuc(int $id)
    {
        $this->views['tin_tuc'] = $this->tin_tucs->loadOneTinTuc($id);
        $this->views['tin_tucs'] = $this->tin_tucs->loadAllTinTuc();
        $this->views['danh_muc_tin_tucs'] = DanhMucTinTuc::all();
        $this->views['tin_tuc_gan_day'] = $this->tin_tucs->loadTinTucGanDay();

        
        //
        return view('client.tinTuc.chiTietTinTuc', $this->views);
    }

    public function tinTucDanhMuc(int $danhMucId)
    {
        $this->views['tin_tucs'] = TinTuc::where('danh_muc_id', $danhMucId)->paginate(5);
        $this->views['danh_muc'] = DanhMucTinTuc::find($danhMucId);
        $this->views['danh_muc_tin_tucs'] = DanhMucTinTuc::all();
        $this->views['tin_tuc_gan_day'] = $this->tin_tucs->loadTinTucGanDay();

        
        //
        return view('client.tinTuc.tinTucDanhMuc', $this->views);
    }
}
