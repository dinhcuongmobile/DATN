<?php

namespace App\Http\Controllers\Admin\TaiKhoan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TaiKhoan\StoreTaiKhoanRequest;
use App\Http\Requests\TaiKhoan\UpdateTaiKhoanRequest;
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
        return view('admin.taiKhoan.add',$this->views);
    }

    public function add(StoreTaiKhoanRequest $request){
        $dataInsert = [
            'ho_va_ten' => $request->ho_va_ten,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
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
        $this->views['tai_khoan'] = User::findOrFail($id);
        $this->views['vai_tro']= VaiTro::orderBy('id', 'desc')->get();
        return view('admin.taiKhoan.update', $this->views);
    }

    public function update(UpdateTaiKhoanRequest $request, int $id){
        $user= User::find($id);
        $dataUpdate = [
            'ho_va_ten' => $request->ho_va_ten,
            'so_dien_thoai' => $request->so_dien_thoai,
            'dia_chi' => $request->dia_chi,
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
