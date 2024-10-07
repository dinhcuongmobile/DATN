<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use App\Models\PhuongXa;
use App\Models\QuanHuyen;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct() {

    }

    public function showQuanHuyen($matp) {
        $quanHuyen = QuanHuyen::where('ma_tinh_thanh_pho', $matp)->get();
        return response()->json($quanHuyen);
    }

    public function showPhuongXa($maqh) {
        $phuongXa = PhuongXa::where('ma_quan_huyen', $maqh)->get();
        return response()->json($phuongXa);
    }
}
