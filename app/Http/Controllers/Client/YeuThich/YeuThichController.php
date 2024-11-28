<?php

namespace App\Http\Controllers\Client\YeuThich;

use App\Http\Controllers\Controller;
use App\Models\YeuThich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YeuThichController extends Controller
{
    protected $yeu_thich;
    protected $views;


    public function __construct()
    {
        $this->yeu_thich = new YeuThich();
        $this->views = [];
    }


    public function themYeuThich(Request $request)
    {
        // Kiểm tra đăng nhập
        if (!Auth::check()) {
            return response()->json(['success' => false]);
        }
        $user = Auth::user();
        // Thông tin sản phẩm
        $san_pham_id = $request->input('sanPhamId');

        // Kiểm tra tồn tại sản phẩm trong bảng yêu thích theo user chưa
        $soYeuThich = YeuThich::where('user_id', $user->id)->where('san_pham_id', $san_pham_id)->first();

        if ($soYeuThich) {
            return response()->json(['success' => false]);
        }

        // Thêm mới sản phẩm vào yêu thích

        $data = ['user_id' => $user->id, 'san_pham_id' => $san_pham_id];
        $request = YeuThich::create($data);

        if ($request) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success', false]);
        }
    }
}
