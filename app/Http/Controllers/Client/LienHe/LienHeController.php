<?php

namespace App\Http\Controllers\Client\LienHe;

use App\Models\User;
use App\Models\LienHe;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LienHe\StoreLienHeRequest;

class LienHeController extends Controller
{

    protected $views;
    public function __construct()
    {
        $this->views = [];
    }
    public function lienHe()
    {

        return view('client.lienHe.lienHe', $this->views);
    }

    public function guiLienHe(Request $request)
    {
        LienHe::query()->create([
            'ho_va_ten' => $request->ho_va_ten,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'tieu_de' => $request->tieu_de,
            'noi_dung' => $request->noi_dung,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        ThongBao::create([
            'tieu_de' => "Khách hàng ". $request->ho_va_ten ." gửi liên hệ",
            'noi_dung' => $request->noi_dung,
            'nguoi_nhan' => true,
        ]);
    }
}
