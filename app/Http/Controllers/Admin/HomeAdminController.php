<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function __construct() {

    }

    public function homeAdmin(){
        return view('admin.homeAdmin');
    }
}
