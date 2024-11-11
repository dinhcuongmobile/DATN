<?php

namespace App\Http\Controllers\Admin\PhiShip;

use App\Models\PhiShip;
use App\Models\TinhThanhPho;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\QuanHuyen;

class PhiShipAdminController extends Controller
{
    protected $views;

    public function __construct() {
        $this->views = [];
    }

    //show
    public function showDanhSach(Request $request){
        $query = PhiShip::with('tinhThanhPho', 'quanHuyen');
        $keyword = $request->input('kyw');

        if ($keyword) {
            $query->where('phi_ship',$keyword)
                    ->orWhereHas('tinhThanhPho', function($loc) use ($keyword) {
                        $loc->where('ten_tinh_thanh_pho', 'LIKE', "%$keyword%");
                    })
                  ->orWhereHas('quanHuyen', function($loc) use ($keyword) {
                      $loc->where('ten_quan_huyen', 'LIKE', "%$keyword%");
                  });
        }

        $this->views['phi_ships'] = $query->orderBy('ma_tinh_thanh_pho', 'ASC')->paginate(10)->appends(['kyw' => $keyword]);
        return view('admin.phiShip.danhSachPhiShip',$this->views);
    }

    //add
    public function viewAdd(Request $request){
        $this->views['tinh_thanh_pho']= TinhThanhPho::all();
        return view('admin.phiShip.add',$this->views);
    }

    public function add(Request $request){
        $request->validate(
            [
                'ma_tinh_thanh_pho' => 'required',
                'ma_quan_huyen' => [
                    'required',
                    Rule::unique('phi_ships')->where(function ($query) use ($request) {
                        return $query->where('ma_tinh_thanh_pho', $request->ma_tinh_thanh_pho);
                    })
                ],
                'phi_ship' => 'required|numeric|min:1000', // Giới hạn tối thiểu phí ship là 1000
            ],
            [
                'ma_tinh_thanh_pho.required' => 'Vui lòng chọn tỉnh thành phố!',
                'ma_quan_huyen.required' => 'Vui lòng chọn quận huyện!',
                'ma_quan_huyen.unique' => 'Phí ship cho vị trí giao hàng này đã được thêm trước đó!',
                'phi_ship.required' => 'Vui lòng nhập phí giao hàng!',
                'phi_ship.numeric' => 'Phí giao hàng chỉ được chứa số!',
                'phi_ship.min' => 'Phí giao hàng phải tối thiểu là 1.000 đồng!',
            ]
        );

        $dataInsert = [
            'ma_tinh_thanh_pho' => $request->ma_tinh_thanh_pho,
            'ma_quan_huyen' => $request->ma_quan_huyen,
            'phi_ship' => $request->phi_ship
        ];

        $result = PhiShip::create($dataInsert);
        if ($result) {
            return redirect()->route('phi-ship.danh-sach')->with('success', 'Bạn đã thêm thành công!');
        } else {
            return redirect()->route('phi-ship.danh-sach')->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại!');
        }
    }

    //update
    public function viewUpdate(int $id){
        $this->views['phi_ships'] = PhiShip::find($id);
        $this->views['tinh_thanh_pho']= TinhThanhPho::all();
        $this->views['quan_huyen'] = QuanHuyen::where('ma_tinh_thanh_pho',$this->views['phi_ships']->ma_tinh_thanh_pho)
                                                ->orderBy('ma_quan_huyen', 'ASC')->get();
        return view('admin.phiShip.update',$this->views);
    }

    public function update(Request $request, int $id){
        $phi_ships=PhiShip::find($id);

        $request->validate(
            [
                'ma_tinh_thanh_pho' => 'required',
                'ma_quan_huyen' => [
                    'required',
                    Rule::unique('phi_ships')->ignore($id)->where(function ($query) use ($request) {
                        return $query->where('ma_tinh_thanh_pho', $request->ma_tinh_thanh_pho);
                    })
                ],
                'phi_ship' => 'required|numeric|min:1000', // Giới hạn tối thiểu phí ship là 1000
            ],
            [
                'ma_tinh_thanh_pho.required' => 'Vui lòng chọn tỉnh thành phố!',
                'ma_quan_huyen.required' => 'Vui lòng chọn quận huyện!',
                'ma_quan_huyen.unique' => 'Phí ship cho vị trí giao hàng này đã được thêm trước đó!',
                'phi_ship.required' => 'Vui lòng nhập phí giao hàng!',
                'phi_ship.numeric' => 'Phí giao hàng chỉ được chứa số!',
                'phi_ship.min' => 'Phí giao hàng phải tối thiểu là 1.000 đồng!',
            ]
        );

        $dataUpdate = [
            'ma_tinh_thanh_pho' => $request->ma_tinh_thanh_pho,
            'ma_quan_huyen' => $request->ma_quan_huyen,
            'phi_ship' => $request->phi_ship
        ];

        $result = $phi_ships->update($dataUpdate);
        if ($result) {
            return redirect()->route('phi-ship.danh-sach')->with('success', 'Bạn đã thêm thành công!');
        } else {
            return redirect()->route('phi-ship.danh-sach')->with('error', 'Đã xảy ra lỗi. Vui lòng thao tác lại!');
        }
        return view('admin.phiShip.update',$this->views);
    }

    //delete
    public function delete(int $id){
        $phi_ships=PhiShip::findOrFail($id);
        $phi_ships->delete();
        return redirect()->route('phi-ship.danh-sach')->with('success', 'Bạn đã xóa thành công !');
    }

    public function xoaNhieuPhiShip(Request $request){
        if($request->select){
            foreach($request->select as $id){
                $phi_ships=PhiShip::findOrFail($id);
                $phi_ships->delete();
            }
            return redirect()->route('phi-ship.danh-sach')->with('success', 'Bạn đã xóa thành công !');
        }else{
            return redirect()->route('phi-ship.danh-sach')->with('error', 'Vui lòng chọn mục muốn xóa !');
        }
    }

}
