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
        $this->views['tin_tucs'] = TinTuc::with('danhMucTinTuc','user')->orderBy('id','desc')->paginate(9);
        $this->views['danh_muc_tin_tucs']= DanhMucTinTuc::all();
        $this->views['bai_viet_hang_dau'] = TinTuc::with('danhMucTinTuc','user')->orderBy('luot_xem','desc')->take(5)->get();

        $this->views['count_tin_tuc_danh_muc'] = TinTuc::selectRaw('danh_muc_id, COUNT(*) as count')
                                                        ->groupBy('danh_muc_id')
                                                        ->pluck('count', 'danh_muc_id');

        return view('client.tinTuc.tinTuc', $this->views);
    }

    public function chiTietTinTuc(int $id)
    {
        $tin_tuc = TinTuc::with('danhMucTinTuc','user')->where('id',$id)->first();

        $luot_xem = $tin_tuc->luot_xem+1;
        $tin_tuc->update(['luot_xem'=>$luot_xem]);

        $this->views['tin_tuc'] = $tin_tuc;

        $this->views['danh_muc_tin_tucs']= DanhMucTinTuc::all();
        $this->views['bai_viet_hang_dau'] = TinTuc::with('danhMucTinTuc','user')->orderBy('luot_xem','desc')->take(5)->get();

        $this->views['count_tin_tuc_danh_muc'] = TinTuc::selectRaw('danh_muc_id, COUNT(*) as count')
                                                        ->groupBy('danh_muc_id')
                                                        ->pluck('count', 'danh_muc_id');
        return view('client.tinTuc.chiTietTinTuc', $this->views);
    }

    public function tinTucDanhMuc(int $id)
    {
        $this->views['tin_tucs'] = TinTuc::with('danhMucTinTuc','user')->where('danh_muc_id',$id)->orderBy('id','desc')->paginate(9);
        $this->views['danh_muc_tin_tucs']= DanhMucTinTuc::all();
        $this->views['danh_muc']= DanhMucTinTuc::where('id',$id)->first();
        $this->views['bai_viet_hang_dau'] = TinTuc::with('danhMucTinTuc','user')->where('danh_muc_id',$id)->orderBy('luot_xem','desc')->take(5)->get();

        $this->views['count_tin_tuc_danh_muc'] = TinTuc::selectRaw('danh_muc_id, COUNT(*) as count')
                                                        ->groupBy('danh_muc_id')
                                                        ->pluck('count', 'danh_muc_id');

        return view('client.tinTuc.tinTucDanhMuc', $this->views);
    }
}
