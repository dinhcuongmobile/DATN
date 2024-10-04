<?php

namespace App\Http\Controllers\Client\TinTuc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TinTucController extends Controller
{
    public function tinTuc() {
        return view('client.tinTuc.tinTuc');
    }

    public function chiTietTinTuc() {
        return view('client.tinTuc.chiTietTinTuc');
    }

    public function tinTucDanhMuc() {
        return view('client.tinTuc.tinTucDanhMuc');
    }
}
