<?php

namespace App\Http\Controllers\Client\DonHang;

use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
    protected $views;

    public function __construct() {
        $this->views = [];
    }

    
}
