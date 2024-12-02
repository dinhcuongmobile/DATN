<?php

namespace App\Http\Controllers\Admin\DanhGia;

use App\Http\Controllers\Controller;
use App\Models\DanhGia;
use App\Models\TraLoiDanhGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhGiaController extends Controller
{
    protected $views;

    public function __construct()
    {
        $this->views = [];
    }

    public function showDanhGia(Request $request)
    {
        $danhGias = DanhGia::with('user');

        $keyword = $request->input('kyw');
        if ($keyword) {
            $danhGias->whereHas('user', function ($loc) use ($keyword) {
                $loc->where('ho_va_ten', 'LIKE', "%$keyword%");
            });
        }

        $this->views['danhGias'] = $danhGias->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);

        return view('admin.danhGia.DSDanhGia', $this->views);
    }

    public function chiTietDanhGia(int $id)
    {
        $this->views['danhGia'] = DanhGia::query()->findOrFail($id);

        return view('admin.danhGia.chiTietDanhGia', $this->views);
    }

    public function guiPhanHoi(Request $request)
    {
        $request->validate(
            [
                'noi_dung' => 'required|string|max:255'
            ],
            [
                'noi_dung.required' => 'Vui lòng nhận câu trả lời !'
            ]
        );

        TraLoiDanhGia::create([
            'danh_gia_id' => $request->danh_gia_id,
            'user_id' => Auth::id(),
            'noi_dung' => $request->noi_dung,
        ]);

        $danhGia = DanhGia::find($request->danh_gia_id);
        $danhGia->trang_thai = 1; // 1 là đã phản hồi
        $danhGia->save();

        return redirect()->back()->with('success', 'Phản hồi đã được gửi.');
    }
}
