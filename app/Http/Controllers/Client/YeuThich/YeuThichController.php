<?php

namespace App\Http\Controllers\Client\YeuThich;

use App\Models\YeuThich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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

    public function yeuThich(){
        $this->views['yeu_thichs'] = [];

        if (Auth::check()) {
            $yeu_thichs = YeuThich::with('user', 'sanPham')->where('user_id', Auth::user()->id)
                                ->orderBy('id', 'desc')
                                ->get();

            $this->views['yeu_thichs'] = $yeu_thichs;
        }

        return view('client.yeuThich.yeuThich',$this->views);
    }

    public function themYeuThich(Request $request) {
        if (!Auth::check()) {
            return response()->json(['success' => false]);
        }

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $san_pham_id = $request->input('sanPhamId');

            $yeu_thich = YeuThich::where('user_id', $user->id)
            ->where('san_pham_id', $san_pham_id)
            ->first();

            if ($yeu_thich) {
                $yeu_thich->delete();
                $count_yeu_thich = YeuThich::where('user_id', $user->id)->get()->count();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'exist' => true,
                    'count_yeu_thich' => $count_yeu_thich,
                    'message' => 'Đã loại sản phẩm khỏi danh sách yêu thích.!!'
                ]);
            }

            $result = YeuThich::create([
                'user_id' => $user->id,
                'san_pham_id' => $san_pham_id,
                'created_at' => now(),
            ]);

            if($result){
                DB::commit();
                $count_yeu_thich = YeuThich::where('user_id', $user->id)->get()->count();
                return response()->json([
                    'success' => true,
                    'exist' => false,
                    'count_yeu_thich' => $count_yeu_thich,
                    'message' => 'Thành công! Sản phẩm đã được thêm vào danh sách yêu thích.!!'
                ]);
            }

            DB::rollBack();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function xoaYeuThich(Request $request) {
        DB::beginTransaction();
        try {
            $yeu_thich_id = $request->input('yeuThichId');

            $yeu_thich = YeuThich::find($yeu_thich_id);

            if ($yeu_thich) {
                $yeu_thich->delete();
                $count_yeu_thich = YeuThich::where('user_id', Auth::id())->get()->count();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'count_yeu_thich' => $count_yeu_thich,
                    'message' => 'Đã loại sản phẩm khỏi danh sách yêu thích.!!'
                ]);
            }

            if(!$yeu_thich){
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm trong danh sách yêu thích.!!'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

}
