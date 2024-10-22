<?php

namespace App\Http\Controllers\Admin\LienHe;

use App\Http\Controllers\Controller;
use App\Models\LienHe;
use Illuminate\Http\Request;

class LienHeController extends Controller
{
    protected $LienHe;
    protected $view;
    public function __construct()
    {
        $this->LienHe = new LienHe();
        $this->view = [];
    }

    public function dSLienHe(Request $request)
    {
        $keyword = $request->input('kyw');
        $dsLienHe = LienHe::query();
        if ($keyword) {
            $search = $this->view['dSLienHe'] = LienHe::where('ho_va_ten', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%')
                ->orWhere('tieu_de', 'like', '%' . $keyword . '%')
                ->paginate(5);
        }
        else{
            $this->view['dSLienHe'] = $dsLienHe->paginate(5);
        }
        return view('admin.lienhe.dSLienHe',$this->view);
    }
}
