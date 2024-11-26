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
        if(!Auth::check()){
            return response()->json(['success' => false]);
        }else{
            $san_pham_id = $request->input('sanPhamId');
        return response()->json(['success' => true,'id'=>$san_pham_id]);
        }
        // $user = Auth::user();

        // // Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
        // $existing = YeuThich::where('nguoi_dung_id', $user->id)
        //     ->where('san_pham_id', $san_pham_id)
        //     ->first();

        // if ($existing) {
        //     // Nếu sản phẩm đã có trong danh sách yêu thích, chỉ trả về mã trạng thái error
        //     return response()->json(['status' => 'error']);
        // }

        // $data = [
        //     'user_id' => $user->id,
        //     'san_pham_id' => $san_pham_id
        // ];

        // // Thực hiện insert vào bảng YeuThich
        // $res = YeuThich::insert($data);

        // if ($res) {
        //     // Nếu insert thành công, trả về mã trạng thái success
        //     return response()->json(['status' => 'success']);
        // }

        // // Nếu insert không thành công, trả về mã trạng thái error
        // return response()->json(['status' => 'error']);
    }

}
