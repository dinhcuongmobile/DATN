<?php

namespace App\Http\Controllers\Admin\LienHe;

use App\Http\Controllers\Controller;
use App\Models\LienHe;
use Illuminate\Http\Request;

class LienHeAdminController extends Controller
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
    public function viewCapNhatTrangThai($id)
{
    $lienHe = LienHe::findOrFail($id);
    return view('admin.lienhe.capNhatTrangThai', compact('lienHe'));
}

public function capNhatTrangThai(Request $request, $id)
{
    $lienHe = LienHe::findOrFail($id);
    
    // Kiểm tra trạng thái hiện tại
    if ($lienHe->trang_thai == 0) { // Nếu trạng thái là chưa phản hồi
        $lienHe->trang_thai = 1; // Đặt trạng thái là đã phản hồi
        $lienHe->save();

        return redirect()->route('lienhe.dsLienHe')->with('success', 'Cập nhật trạng thái thành công!');
    }

    return redirect()->route('lienhe.dsLienHe')->with('error', 'Liên hệ đã được phản hồi trước đó!');
}
    public function dsLienHeDaPhanHoi()
    {
    $dSLienHe = LienHe::where('trang_thai', 0)->paginate(10); // Lọc chỉ liên hệ đã phản hồi
    return view('admin.lienhe.dsLienHeDaPhanHoi', compact('dSLienHe'));
    }

    public function dsLienHeChuaPhanHoi()
    {
    $dSLienHe = LienHe::where('trang_thai', '!=', 0)->paginate(10); // Lọc chỉ liên hệ chưa phản hồi
    return view('admin.lienhe.dsLienHeChuaPhanHoi', compact('dSLienHe'));
    }
}
