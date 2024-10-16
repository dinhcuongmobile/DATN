<?php

namespace App\Http\Controllers\Client\LienHe;

use App\Http\Controllers\Controller;
use App\Http\Requests\LienHe\StoreLienHeRequest;
use App\Models\LienHe;
use Illuminate\Http\Request;

class LienHeController extends Controller
{
    public function lienHe()
    {
        return view('client.lienHe.lienHe');
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
    }
}
