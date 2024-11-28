<?php

namespace App\Http\Controllers\Client\GioiThieu;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GioiThieuController extends Controller
{
  protected $views;
  public function __construct()
  {
    $this->views = [];
  }
  public function gioiThieu()
  {
    // Tổng yêu thích
    if (Auth::check()) {
      $user_id = Auth::id();
      $user = User::find($user_id);
      $tongYeuThich = $user->yeuThich()->count();
      //
      $this->views['tong_yeu_thich'] = $tongYeuThich;
    }
    //
    return view('client.gioiThieu.gioiThieu', $this->views);
  }
}
