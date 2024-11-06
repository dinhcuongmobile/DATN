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

    public function addDailyCoin()
    {
        $user = Auth::user();
        $ngayNhan = Carbon::now()->toDateString();

        // Lấy lịch sử nhận xu gần nhất của người dùng
        $check = Coin::where('user_id', $user->id)
            ->latest('ngay_nhan')->first();
        
        if ($check && $check->ngay_nhan == $ngayNhan) {
            // Người dùng đã nhận xu hôm nay
            return response()->json(['message' => 'Bạn đã nhận xu hôm nay rồi!'], 200);
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

        Coin::create([
            'user_id' => $user->id,
            'coin' => 100,
            'ngay_nhan' => $ngayNhan,
            'so_ngay' => $soNgay,
        ]);

        return response()->json(['message' => 'Nhận xu thành công!', 'coin' => 100, 'so_ngay' => $soNgay], 200);
    }

    public function getUserCoin()
    {
        $user = Auth::user();
        $tongCoin = Coin::where('user_id', $user->id)->sum('coin');

        return response()->json(['tong_xu', $tongCoin], 200);
    }
}
