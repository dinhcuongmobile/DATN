<?php

namespace App\Http\Controllers\Client\Coin;

use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoinController extends Controller
{
    protected $views;

    public function __construct()
    {
        $this->views = [];
    }

    public function addDailyCoin(Request $request)
    {
        $user = Auth::user();
        $ngayNhan = Carbon::now()->toDateString();

        // Lấy lịch sử nhận xu gần nhất của người dùng
        $check = Coin::where('user_id', $user->id)
            ->latest('ngay_nhan')->first();

            if ($check && $check->ngay_nhan == $ngayNhan) {
                
                return response()->json([
                    'message' => 'Bạn đã nhận xu hôm nay rồi!',
                    'userId' => $user->id,
                    'alreadyReceived' => true 
                ], 200);
            }

        // Chuỗi nhận xu là 7 ngày
        if ($check && $check->ngay_nhan == Carbon::yesterday()->toDateString()) {
            // Nếu ngày nhận cuối cùng là ngày hôm qua, tăng chuỗi ngày liên tiếp
            $soNgay = $check->so_ngay + 1;
        } else {
            // Nếu không phải là ngày hôm qua, reset chuỗi về 1
            $soNgay = 1;
        }

        // Hết 7 ngày reset
        if ($soNgay > 7) {
            $soNgay = 1;
        }

        
        $coins = rand(100, 300);

        // Ngày 7 nhận 300 xu các ngày còn lại nhận 100 xu
        $coins = ($soNgay == 7) ? 300 : 100;

        // Nếu đã nhận xu rồi sẽ cộng dồn xu
        $updateCoin = $check ? $check->coin + $coins : $coins;

        if ($check) {
            
            $check->update([
                'coin' => $updateCoin,
                'ngay_nhan' => $ngayNhan,
                'so_ngay' => $soNgay
            ]);
        } else {
            // Nếu chưa nhận xu lần nào thì tạo cái mới
            Coin::create([
                'user_id' => $user->id,
                'coin' => $coins,
                'ngay_nhan' => $ngayNhan,
                'so_ngay' => $soNgay
            ]);
        }

        return response()->json(['message' => 'Nhận xu thành công!', 'coin' => $coins, 'so_ngay' => $soNgay], 200);
    }

    public function getUserCoin()
    {
        $user = Auth::user();
        $tongCoin = Coin::where('user_id', $user->id)->sum('coin');

        return response()->json(['tong_xu' => $tongCoin], 200);
    }
}
