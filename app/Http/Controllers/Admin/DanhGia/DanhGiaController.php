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

    public function showDanhGiaChuaPhanHoi(Request $request)
    {
        $danhGias = DanhGia::with('user')->where('trang_thai', 0); // 0 là chưa phản hồi

        $keyword = $request->input('kyw');
        if ($keyword) {
            $danhGias->whereHas('user', function ($loc) use ($keyword) {
                $loc->where('ho_va_ten', 'LIKE', "%$keyword%");
            });
        }

        $this->views['danhGias'] = $danhGias->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);

        return view('admin.danhGia.DSChuaPhanHoi', $this->views);
    }

    public function showDanhGiaDaPhanHoi(Request $request)
    {
        $danhGias = DanhGia::with('user')->where('trang_thai', 1); // 1 là đã phản hồi

        $keyword = $request->input('kyw');
        if ($keyword) {
            $danhGias->whereHas('user', function ($loc) use ($keyword) {
                $loc->where('ho_va_ten', 'LIKE', "%$keyword%");
            });
        }

        $this->views['danhGias'] = $danhGias->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);

        return view('admin.danhGia.DSDaPhanHoi', $this->views);
    }

    public function showDanhGiaDaAn(Request $request)
    {
        $danhGias = DanhGia::with('user')->onlyTrashed();

        $keyword = $request->input('kyw');
        if ($keyword) {
            $danhGias->whereHas('user', function ($loc) use ($keyword) {
                $loc->where('ho_va_ten', 'LIKE', "%$keyword%");
            });
        }

        $this->views['danhGias'] = $danhGias->orderBy('id', 'desc')->paginate(10)->appends(['kyw' => $keyword]);

        return view('admin.danhGia.DSBiAn', $this->views);
    }

    public function chiTietDanhGia(Request $request, int $id)
    {
        $danhGia = DanhGia::withTrashed()->findOrFail($id);
        $traLoiDanhGia = TraLoiDanhGia::where('danh_gia_id', $danhGia->id)->first();

        $this->views['danhGia'] = $danhGia;
        $this->views['traLoiDanhGia'] = $traLoiDanhGia;

        return view('admin.danhGia.chiTietDanhGia', $this->views);
    }

    public function guiPhanHoi(Request $request)
    {
        $request->validate(
            [
                'noi_dung' => 'required|string|max:255'
            ],
            [
                'noi_dung.required' => 'Vui lòng nhập câu trả lời !'
            ]
        );

        TraLoiDanhGia::create([
            'danh_gia_id' => $request->danh_gia_id,
            'user_id' => Auth::guard('admin')->user()->id,
            'noi_dung' => $request->noi_dung,
        ]);

        $danhGia = DanhGia::find($request->danh_gia_id);
        $danhGia->trang_thai = 1; // 1 là đã phản hồi
        $danhGia->save();

        return redirect()->back()->with('success', 'Phản hồi đã được gửi.');
    }

    public function anDanhGia(int $id)
    {
        $danhGia = DanhGia::query()->findOrFail($id);
        $danhGia->delete();

        return redirect()->back()->with('success', 'Ẩn đánh giá thành công');
    }

    public function anNhieuDanhGia(Request $request)
    {
        if ($request->select) {
            foreach ($request->select as $id) {
                $danhGia = DanhGia::query()->findOrFail($id);
                $danhGia->delete();
            }

            return redirect()->back()->with('success', 'Ẩn đánh giá thành công');
        } else {
            return redirect()->back()->with('error', 'Vui lòng chọn mục muốn ẩn');
        }
    }

    public function khoiPhucDanhGia(int $id)
    {
        $danhGia = DanhGia::onlyTrashed()->findOrFail($id);

        if ($danhGia) {
            $danhGia->restore();
        } else {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thử lại');
        }

        return redirect()->route('danh-gia.danh-sach')->with('success', 'Khôi phục đánh giá thành công');
    }

    public function khoiPhucNhieuDanhGia(Request $request)
    {
        if ($request->select) {
            foreach ($request->select as $id) {
                $danhGia = DanhGia::onlyTrashed()->findOrFail($id);
                $danhGia->restore();
            }

            return redirect()->route('danh-gia.danh-sach')->with('success', 'Khôi phục đánh giá thành công');
        } else {
            return redirect()->back()->with('error', 'Vui lòng chọn mục muốn khôi phục');
        }
    }
}
