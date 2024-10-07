<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {

    }

    public function home(){
        return view('client.home');
    }

    public function error404()
    {
        return view('auth.404');
    }
}
