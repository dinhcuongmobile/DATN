<?php

namespace App\Http\Controllers\Admin\TaiKhoan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TaiKhoan\StoreTaiKhoanRequest;
use App\Http\Requests\TaiKhoan\UpdateTaiKhoanRequest;
use App\Models\PhuongXa;
use App\Models\QuanHuyen;
use App\Models\TinhThanhPho;
use App\Models\VaiTro;

class TaiKhoanAdminController extends Controller
{
    protected $views;

    public function __construct() {
        $this->views = [];
    }

    //SHOW
    public function showTaiKhoanQTV(Request $request){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSTKQTV'] = User::where('ho_va_ten', 'LIKE', "%$keyword%")
                                            ->orWhere('email', 'LIKE', "%$keyword%")
                                            ->orWhere('so_dien_thoai', 'LIKE', "%$keyword%")
                                            ->orderBy('id', 'desc')
                                            ->paginate(10);
        } else {
            $this->views['DSTKQTV'] = User::with('vaiTro')
            ->where('vai_tro_id',1)
            ->where('trang_thai',0)
            ->orderBy('id', 'desc')
            ->paginate(10);
        }
        return view('admin.taiKhoan.DSTKQTV', $this->views);
    }

    public function showTaiKhoanNV(Request $request){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSTKNV'] = User::where('ho_va_ten', 'LIKE', "%$keyword%")
                                            ->orWhere('email', 'LIKE', "%$keyword%")
                                            ->orWhere('so_dien_thoai', 'LIKE', "%$keyword%")
                                            ->orderBy('id', 'desc')
                                            ->paginate(10);
        } else {
            $this->views['DSTKNV'] = User::with('vaiTro')
                                    ->where('vai_tro_id',2)
                                    ->where('trang_thai',0)
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);
        }
        return view('admin.taiKhoan.DSTKNV', $this->views);
    }

    public function showTaiKhoanTV(Request $request){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSTKTV'] = User::where('ho_va_ten', 'LIKE', "%$keyword%")
                                            ->orWhere('email', 'LIKE', "%$keyword%")
                                            ->orWhere('so_dien_thoai', 'LIKE', "%$keyword%")
                                            ->orderBy('id', 'desc')
                                            ->paginate(10);
        } else {
            $this->views['DSTKTV'] = User::with('vaiTro')
                                    ->where('vai_tro_id',3)
                                    ->where('trang_thai',0)
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);
        }
        return view('admin.taiKhoan.DSTKTV', $this->views);
    }

    public function showTaiKhoanTKK(Request $request){
        $keyword = $request->input('kyw');
        if ($keyword) {
            $this->views['DSTKK'] = User::where('ho_va_ten', 'LIKE', "%$keyword%")
                                            ->orWhere('email', 'LIKE', "%$keyword%")
                                            ->orWhere('so_dien_thoai', 'LIKE', "%$keyword%")
                                            ->orderBy('id', 'desc')
                                            ->paginate(10);
        } else {
            $this->views['DSTKK'] = User::with('vaiTro')
                                    ->where('trang_thai',1)
                                    ->orderBy('id', 'desc')
                                    ->paginate(10);
        }
        return view('admin.taiKhoan.DSTKK', $this->views);
    }

    //add
    public function viewAdd(){
        $this->views['vai_tro']= VaiTro::orderBy('id', 'desc')->get();
        $this->views['tinh_thanh_pho']=TinhThanhPho::orderBy('ma_tinh_thanh_pho','ASC')->get();
        return view('admin.taiKhoan.add',$this->views);
    }

    public function add(StoreTaiKhoanRequest $request){
        $tinh_thanh_pho=TinhThanhPho::where('ma_tinh_thanh_pho','=',$request->tinh_thanh_pho)->first();
        $quan_huyen=QuanHuyen::where('ma_quan_huyen','=',$request->quan_huyen)->first();
        $phuong_xa=PhuongXa::where('ma_phuong_xa','=',$request->phuong_xa)->first();
        $dia_chi = trim(implode(', ', array_filter([
            $request->dia_chi_chi_tiet,
            $phuong_xa->ten_phuong_xa,
            $quan_huyen->ten_quan_huyen,
            $tinh_thanh_pho->ten_tinh_thanh_pho
        ])));
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
        $tai_khoan=User::findOrFail($id);
        $this->views['tai_khoan'] = $tai_khoan;
        $this->views['vai_tro']= VaiTro::orderBy('id', 'desc')->get();
        $this->views['tinh_thanh_pho']= TinhThanhPho::orderBy('ma_tinh_thanh_pho','ASC')->get();

        if($tai_khoan->dia_chi){
            $dia_chi_full = explode(', ', $tai_khoan->dia_chi);
            if(count($dia_chi_full)==4){
                $dia_chi_chi_tiet=$dia_chi_full[0];
                $phuong_xa_one=$dia_chi_full[1];
                $quan_huyen_one=$dia_chi_full[2];
                $tinh_thanh_pho_one=$dia_chi_full[3];
            }else{
                $dia_chi_chi_tiet="";
                $phuong_xa_one=$dia_chi_full[0];
                $quan_huyen_one=$dia_chi_full[1];
                $tinh_thanh_pho_one=$dia_chi_full[2];
            }

            $load_one_tinh_thanh_pho=TinhThanhPho::Where('ten_tinh_thanh_pho','LIKE',"%$tinh_thanh_pho_one%")->first();
            $quan_huyens= QuanHuyen::where('ma_tinh_thanh_pho',$load_one_tinh_thanh_pho->ma_tinh_thanh_pho)->orderBy('ma_quan_huyen','ASC')->get();
            $load_one_quan_huyen= QuanHuyen::where('ten_quan_huyen','LIKE',"%$quan_huyen_one%")
                                            ->where('ma_tinh_thanh_pho',$load_one_tinh_thanh_pho->ma_tinh_thanh_pho)->first();
            $phuong_xas= PhuongXa::where('ma_quan_huyen',$load_one_quan_huyen->ma_quan_huyen)->get();
            $this->views['dia_chi_chi_tiet'] = $dia_chi_chi_tiet;
            $this->views['phuong_xa_one'] = $phuong_xa_one;
            $this->views['quan_huyen_one'] = $quan_huyen_one;
            $this->views['tinh_thanh_pho_one'] = $tinh_thanh_pho_one;
            $this->views['quan_huyen']=$quan_huyens;
            $this->views['phuong_xa']=$phuong_xas;
        }
        return view('admin.taiKhoan.update', $this->views);
    }

    public function update(UpdateTaiKhoanRequest $request, int $id){
        $user= User::find($id);
        $tinh_thanh_pho=TinhThanhPho::where('ma_tinh_thanh_pho',$request->tinh_thanh_pho)->first();
        $quan_huyen=QuanHuyen::where('ma_quan_huyen',$request->quan_huyen)->first();
        $phuong_xa=PhuongXa::where('ma_phuong_xa',$request->phuong_xa)->first();
        $dia_chi = trim(implode(', ', array_filter([
            $request->dia_chi_chi_tiet,
            $phuong_xa->ten_phuong_xa,
            $quan_huyen->ten_quan_huyen,
            $tinh_thanh_pho->ten_tinh_thanh_pho
        ])));
        $dataUpdate = [
            'ho_va_ten' => $request->ho_va_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $dia_chi,
            'vai_tro_id' => $request->vai_tro_id,
            'updated_at' => now()
        ];
        if ($user) {
            $user->update($dataUpdate);
            if($request->vai_tro_id==1){
                return redirect()->route('tai-khoan.danh-sach-QTV')->with('success', 'Bạn đã sửa tài khoản thành công !');
            }elseif($request->vai_tro_id==2){
                return redirect()->route('tai-khoan.danh-sach-NV')->with('success', 'Bạn đã sửa tài khoản thành công !');
            }else{
                return redirect()->route('tai-khoan.danh-sach-TV')->with('success', 'Bạn đã sửa tài khoản thành công !');
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
