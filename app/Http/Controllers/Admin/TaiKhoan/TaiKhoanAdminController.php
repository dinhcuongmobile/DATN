<?php

namespace App\Http\Controllers\Admin\TaiKhoan;

use App\Models\User;
use App\Models\VaiTro;
use App\Models\PhuongXa;
use App\Models\QuanHuyen;
use App\Models\TinhThanhPho;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TaiKhoan\StoreTaiKhoanRequest;

class TaiKhoanAdminController extends Controller
{
    protected $views;

    public function __construct() {
        $this->views = [];
    }

    //SHOW
    public function showTaiKhoanQTV(Request $request){
        $query = User::with('vaiTro')
                     ->where('id', '!=', Auth::user()->id)
                     ->where('vai_tro_id', 1)
                     ->where('trang_thai', 0);

        $keyword = $request->input('kyw');
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('ho_va_ten', 'LIKE', "%$keyword%")
                  ->orWhere('email', 'LIKE', "%$keyword%")
                  ->orWhere('so_dien_thoai', 'LIKE', "%$keyword%");
            });
        }

        $this->views['DSTKQTV'] = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.taiKhoan.DSTKQTV', $this->views);
    }

    public function showTaiKhoanNV(Request $request){
        $query = User::with('vaiTro')
                     ->where('id', '!=', Auth::user()->id)
                     ->where('vai_tro_id', 2)
                     ->where('trang_thai', 0);

        $keyword = $request->input('kyw');
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('ho_va_ten', 'LIKE', "%$keyword%")
                  ->orWhere('email', 'LIKE', "%$keyword%")
                  ->orWhere('so_dien_thoai', 'LIKE', "%$keyword%");
            });
        }

        $this->views['DSTKNV'] = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.taiKhoan.DSTKNV', $this->views);
    }

    public function showTaiKhoanTV(Request $request){
        $query = User::with('vaiTro')
                     ->where('id', '!=', Auth::user()->id)
                     ->where('vai_tro_id', 3)
                     ->where('trang_thai', 0);

        $keyword = $request->input('kyw');
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('ho_va_ten', 'LIKE', "%$keyword%")
                  ->orWhere('email', 'LIKE', "%$keyword%")
                  ->orWhere('so_dien_thoai', 'LIKE', "%$keyword%");
            });
        }

        $this->views['DSTKTV'] = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.taiKhoan.DSTKTV', $this->views);
    }

    public function showTaiKhoanTKK(Request $request){
        $query = User::with('vaiTro')->where('trang_thai', 1);

        $keyword = $request->input('kyw');
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('ho_va_ten', 'LIKE', "%$keyword%")
                  ->orWhere('email', 'LIKE', "%$keyword%")
                  ->orWhere('so_dien_thoai', 'LIKE', "%$keyword%");
            });
        }

        $this->views['DSTKK'] = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.taiKhoan.DSTKK', $this->views);
    }

    //add
    public function viewAdd(){
        $this->views['vai_tro']= VaiTro::orderBy('id', 'desc')->get();
        $this->views['tinh_thanh_pho']=TinhThanhPho::orderBy('ma_tinh_thanh_pho','ASC')->get();
        return view('admin.taiKhoan.add',$this->views);
    }

    public function add(StoreTaiKhoanRequest $request){
        if($request->tinh_thanh_pho){
            $tinh_thanh_pho=TinhThanhPho::where('ma_tinh_thanh_pho','=',$request->tinh_thanh_pho)->first();
            $quan_huyen=QuanHuyen::where('ma_quan_huyen','=',$request->quan_huyen)->first();
            $phuong_xa=PhuongXa::where('ma_phuong_xa','=',$request->phuong_xa)->first();
            $dia_chi = trim(implode(', ', array_filter([
                $request->dia_chi_chi_tiet,
                $phuong_xa->ten_phuong_xa,
                $quan_huyen->ten_quan_huyen,
                $tinh_thanh_pho->ten_tinh_thanh_pho,
             ])));
        }else{
            $dia_chi=null;
        }
        $dataInsert = [
            'ho_va_ten' => $request->ho_va_ten,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $dia_chi,
            'vai_tro_id' => $request->vai_tro_id,
            'trang_thai' => 0,
            'created_at' => now()
        ];
        $result = User::create($dataInsert);
        if($result){
            if($request->vai_tro_id==1){
                return redirect()->route('tai-khoan.danh-sach-QTV')->with('success', 'Bạn đã thêm tài khoản thành công !');
            }elseif($request->vai_tro_id==2){
                return redirect()->route('tai-khoan.danh-sach-NV')->with('success', 'Bạn đã thêm tài khoản thành công !');
            }else{
                return redirect()->route('tai-khoan.danh-sach-TV')->with('success', 'Bạn đã thêm tài khoản thành công !');
            }
        } else {
            return redirect()->back()
                             ->with('error', 'Không thể thêm tài khoản. Vui lòng thử lại.');
        }
    }

    //update
    public function viewUpdate(int $id){
        $this->views['tai_khoan']=User::findOrFail($id);
        $this->views['vai_tro']= VaiTro::all();

        return view('admin.taiKhoan.update', $this->views);
    }

    public function update(Request $request, int $id){
        $user= User::find($id);
        if ($user) {
            $user->update(['vai_tro_id'=>$request->vai_tro_id]);
            if($request->vai_tro_id==1){
                return redirect()->route('tai-khoan.danh-sach-QTV')->with('success', 'Bạn đã cập nhật vai trò thành công !');
            }elseif($request->vai_tro_id==2){
                return redirect()->route('tai-khoan.danh-sach-NV')->with('success', 'Bạn đã cập nhật vai trò thành công !');
            }else{
                return redirect()->route('tai-khoan.danh-sach-TV')->with('success', 'Bạn đã cập nhật vai trò thành công !');
            }
        } else {
            return redirect()->back()
                             ->with('error', 'Không thể cập nhật tài khoản. Vui lòng thử lại.');
        }
    }

    public function khoaTaiKhoan(int $id){
        $user = User::find($id);
        if ($user) {
            $user->update(['trang_thai' => 1]);
            return redirect()->back()->with('success', 'Bạn đã khóa tài khoản thành công !');
        } else {
            return redirect()->back()->with('error', 'Không thể khóa tài khoản. Vui lòng thử lại.');
        }
    }

    public function moKhoaTaiKhoan(int $id){
        $user = User::find($id);
        if ($user) {
            $user->update(['trang_thai' => 0]);
            return redirect()->back()->with('success', 'Đã mở khóa tài khoản!');
        } else {
            return redirect()->back()->with('error', 'Không thể mở khóa tài khoản. Vui lòng thử lại.');
        }
    }

    public function selectKhoaTK(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $user = User::find($id);
                if ($user) {
                    $user->update(['trang_thai' => 1]);
                }
            }
            return redirect()->back()
                             ->with('success', 'Đã khóa các tài khoản đã chọn!');
        }else{
            return redirect()->back()
                             ->with('error', 'Vui lòng chọn mục muốn khóa!');
        }

    }
}
