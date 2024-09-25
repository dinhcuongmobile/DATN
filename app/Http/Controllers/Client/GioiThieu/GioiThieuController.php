<?php

namespace App\Http\Controllers\Client\GioiThieu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GioiThieuController extends Controller
{
    public function __construct(){

    }
    public function gioiThieu(){
        return view('client.gioiThieu.gioiThieu');
    }
}
