<?php

namespace App\Http\Controllers\Client\YeuThich;

use App\Http\Controllers\Controller;
use App\Models\YeuThich;
use Illuminate\Http\Request;

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
        $productId = $request->input('productId');
        $user = auth()->user();

        // Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
        $existing = YeuThich::where('nguoi_dung_id', $user->id)
            ->where('san_pham_id', $productId)
            ->first();

        if ($existing) {
            // Nếu sản phẩm đã có trong danh sách yêu thích, chỉ trả về mã trạng thái error
            return response()->json(['status' => 'error']);
        }

        $data = [
            'nguoi_dung_id' => $user->id,
            'san_pham_id' => $productId
        ];

        // Thực hiện insert vào bảng YeuThich
        $res = YeuThich::insert($data);

        if ($res) {
            // Nếu insert thành công, trả về mã trạng thái success
            return response()->json(['status' => 'success']);
        }

        // Nếu insert không thành công, trả về mã trạng thái error
        return response()->json(['status' => 'error']);
    }

}
