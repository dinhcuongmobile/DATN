<?php

namespace App\Http\Controllers\Client\LienHe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LienHeController extends Controller
{
    public function lienHe() {
        return view('client.lienHe.lienHe');
    }
}
