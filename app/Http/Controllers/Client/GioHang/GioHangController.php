<?php

namespace App\Http\Controllers\Client\GioHang;

use App\Models\Coin;
use App\Models\User;
use App\Models\DiaChi;
use App\Models\KichCo;
use App\Models\MauSac;
use App\Models\BienThe;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\PhiShip;
use App\Models\SanPham;
use App\Mail\SendHoaDon;
use App\Models\KhuyenMai;
use Illuminate\Support\Str;
use App\Models\TinhThanhPho;
use Illuminate\Http\Request;
use App\Models\ChiTietDonHang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class GioHangController extends Controller
{
    protected $views;

    public function __construct(){
        $this->views = [];
    }

    public function gioHang(){
        $this->views['gio_hangs'] = [];
        $this->views['kich_cos'] = KichCo::all();
        $this->views['mau_sacs'] = MauSac::all();
        $this->views['san_pham_moi_nhat']= SanPham::with('bienThes','danhGias')->orderBy('id','desc')->take(8)->get();

        if (Auth::check()) {
            $gioHangs = GioHang::with('user', 'sanPham', 'bienThe')
                                ->where('user_id', Auth::user()->id)
                                ->whereHas('bienThe', function($query) {
                                    $query->where('so_luong', '>', 0);
                                })
                                ->orderBy('id', 'desc')
                                ->get();

            foreach ($gioHangs as $item) {
                $item->sanPham->load('danhMuc', 'bienThes', 'danhGias');
            }

            $this->views['gio_hangs'] = $gioHangs;
        }
        return view('client.gioHang.gioHang', $this->views);
    }

    public function themGioHang(Request $request){
        if (!Auth::check()) {
            return response()->json(['login' => false]);
        } else {
            $user_id = Auth::user()->id;
            $gia_khuyen_mai = $request->input('gia_khuyen_mai');
            $san_pham_id = $request->input('san_pham_id');
            $so_luong = $request->input('so_luong');
            $kich_co = $request->input('kich_co');
            $ma_mau = $request->input('ma_mau');
            $bien_the = BienThe::where('san_pham_id', $san_pham_id)->where('kich_co', $kich_co)->where('ma_mau', $ma_mau)->first();
            $gio_hang = GioHang::where('user_id', $user_id)->where('san_pham_id', $san_pham_id)->where('bien_the_id', $bien_the->id)->first();
            if (!$gio_hang) {
                $data = [
                    'user_id' => $user_id,
                    'san_pham_id' => $san_pham_id,
                    'bien_the_id' => $bien_the->id,
                    'so_luong' => $so_luong,
                    'thanh_tien' => $gia_khuyen_mai * $so_luong,
                    'created_at' => now(),
                ];
                $result = GioHang::create($data);
            } else {
                $data = [
                    'so_luong' => $gio_hang->so_luong + $so_luong,
                    'thanh_tien' => $gia_khuyen_mai * ($gio_hang->so_luong + $so_luong),
                ];
                $result = $gio_hang->update($data);
            }
            $gio_hangs = GioHang::with('user', 'sanPham', 'bienThe')
                    ->where('user_id', Auth::id())
                    ->orderBy('id', 'desc')
                    ->get();
            $san_pham= SanPham::find($san_pham_id);
            $count_gio_hang = $gio_hangs->count();
            if($result){
                return response()->json(['login' => true, 'count_gio_hang' => $count_gio_hang, 'san_pham' => $san_pham]);
            }
        }
    }

    public function muaNgay(Request $request) {
        if (!Auth::check()) {
            return response()->json(['login' => false]);
        }

        $san_pham_id = $request->input('san_pham_id');
        $so_luong = $request->input('so_luong');
        $kich_co = $request->input('kich_co');
        $ma_mau = $request->input('ma_mau');

        $san_pham = SanPham::find($san_pham_id);
        $bien_the = BienThe::where('san_pham_id', $san_pham_id)
                            ->where('kich_co', $kich_co)
                            ->where('ma_mau', $ma_mau)
                            ->first();

        // Tính thành tiền
        $gia_khuyen_mai = $san_pham->gia_san_pham - ($san_pham->gia_san_pham * $san_pham->khuyen_mai / 100);

        // Dữ liệu sản phẩm để lưu vào session
        $data = [
            'san_pham_id' => $san_pham->id,
            'so_luong' => $so_luong,
            'kich_co' => $kich_co,
            'ma_mau' => $ma_mau,
            'gia_khuyen_mai' => $gia_khuyen_mai
        ];

        // Lấy giỏ hàng hiện tại từ session và thêm sản phẩm mới
        $gio_hangs = session()->get('gio_hangs', []);
        $gio_hangs[] = $data;

        // Lưu lại giỏ hàng vào session
        session()->put('gio_hangs', $gio_hangs);

        return response()->json(['login' => true]);
    }


    public function xoaTatCa(Request $request){
        $gio_hang_id =  $request->input('gio_hang_id');
        foreach ($gio_hang_id as $item) {
            GioHang::where('id',$item)->delete();
        }

        $gio_hang = GioHang::with('user', 'sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->whereHas('bienThe', function($query) {
                                $query->where('so_luong', '>', 0);
                            })
                            ->orderBy('id', 'desc')
                            ->get();

        return response()->json(['success' => true, 'gio_hang'=>$gio_hang]);
    }

    public function xoaSanPhamGiohang(Request $request){
        $gio_hang_id =  $request->input('gio_hang_id');
        GioHang::where('id',$gio_hang_id)->delete();

        $gio_hang = GioHang::with('user', 'sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->whereHas('bienThe', function($query) {
                                $query->where('so_luong', '>', 0);
                            })
                            ->orderBy('id', 'desc')
                            ->get();

        return response()->json(['success' => true, 'gio_hang'=>$gio_hang]);
    }

    public function soLuongMua(Request $request){
        $gio_hang = GioHang::with('user', 'sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->find($request->input('gio_hang_id'));

        $so_luong = $request->input('so_luong');
        $thanh_tien = $request->input('thanh_tien');
        $data = [
            'so_luong' => $so_luong,
            'thanh_tien' => $thanh_tien
        ];
        $gio_hang->update($data);

        $gio_hangs = GioHang::with('user', 'sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->whereHas('bienThe', function($query) {
                                $query->where('so_luong', '>', 0);
                            })
                            ->orderBy('id', 'desc')
                            ->get();
        return response()->json(['gio_hangs'=>$gio_hangs]);
    }

    public function checkBienTheSize(Request $request){
        $gio_hang = GioHang::with('bienThe')->find($request->input('gio_hang_id'));
        $disabledColors = [];

        if ($gio_hang) {
            $bienTheProducts = GioHang::with('bienThe')
                ->where('san_pham_id', $gio_hang->san_pham_id)
                ->where('id', '!=', $gio_hang->id)
                ->get();

            foreach ($bienTheProducts as $item) {
                if ($item->bienThe && $item->bienThe->kich_co == $request->input('kich_co')) {
                    $disabledColors[] = $item->bienThe->ma_mau;
                }
            }
        }

        return response()->json(['disabledColors' => array_unique($disabledColors)]);
    }

    public function checkBienTheColor(Request $request){
        $gio_hang = GioHang::with('bienThe')->find($request->input('gio_hang_id'));
        $disabledSizes = [];

        if ($gio_hang) {
            $bienTheProducts = GioHang::with('bienThe')
                ->where('san_pham_id', $gio_hang->san_pham_id)
                ->where('id', '!=', $gio_hang->id)
                ->get();

            foreach ($bienTheProducts as $item) {
                if ($item->bienThe && $item->bienThe->ma_mau == $request->input('ma_mau')) {
                    $disabledSizes[] = $item->bienThe->kich_co;
                }
            }
        }

        return response()->json(['disabledSizes' => array_unique($disabledSizes)]);
    }


    public function thayDoiBienThe(Request $request){
        $gio_hang= GioHang::with('user', 'sanPham', 'bienThe')->find($request->input('gio_hang_id'));

        $bien_the = BienThe::where('san_pham_id',$gio_hang->san_pham_id)
                            ->where('kich_co',$request->input('kich_co'))
                            ->where('ma_mau',$request->input('ma_mau'))->first();

        if ($bien_the) {
            $gio_hang->update(['bien_the_id'=>$bien_the->id]);
        }

        return response()->json(['gio_hang'=>$gio_hang,'bien_the'=>$bien_the]);
    }

    public function chiTietThanhToan(){
        if (empty(session()->get('gio_hangs', []))) {
            return redirect()->route('gio-hang.gio-hang');
        }

        // Lấy thông tin địa chỉ
        $this->views['tinh_thanh_pho'] = TinhThanhPho::orderBy('ma_tinh_thanh_pho', 'ASC')->get();
        $this->views['dia_chis'] = DiaChi::with('user', 'tinhThanhPho', 'quanHuyen', 'phuongXa')
                                        ->where('user_id', Auth::user()->id)
                                        ->orderBy('trang_thai', 'ASC')
                                        ->get();

        // Lấy dữ liệu giỏ hàng từ session và truy vấn sản phẩm
        $gio_hangs = session()->get('gio_hangs', []);
        $san_phams = [];
        foreach ($gio_hangs as $item) {
            $san_pham = SanPham::find($item['san_pham_id']);
            $bien_the = BienThe::where('san_pham_id', $item['san_pham_id'])
                                ->where('kich_co', $item['kich_co'])
                                ->where('ma_mau', $item['ma_mau'])
                                ->first();
            if ($san_pham && $bien_the) {
                $san_phams[] = [
                    'san_pham' => $san_pham,
                    'bien_the' => $bien_the,
                    'so_luong' => $item['so_luong'],
                    'gia_khuyen_mai' => $item['gia_khuyen_mai'],
                ];
            }
        }
        $this->views['gio_hangs'] = $san_phams;
        $this->views['count_gio_hang'] = count($this->views['gio_hangs']);

        // Popup giảm giá
        $this->views['ma_giam_gia_van_chuyen'] = KhuyenMai::where('trang_thai', 2)->orderBy('id', 'desc')->get();
        $this->views['ma_giam_gia_don_hang'] = KhuyenMai::where('trang_thai', 1)->orderBy('id', 'desc')->get();

        // Tính phí ship
        $dia_chi_checked = DiaChi::where('user_id', Auth::user()->id)->orderBy('trang_thai', 'ASC')->first();
        $this->views['phi_ship_goc'] = [];
        if ($dia_chi_checked) {
            $this->views['phi_ship_goc'] = PhiShip::with('tinhThanhPho', 'quanHuyen')
                                                ->where('ma_quan_huyen', $dia_chi_checked->ma_quan_huyen)
                                                ->first();
        }
        $this->views['tongCoin'] = Coin::where('user_id', Auth::user()->id)->sum('coin');

        return view('client.gioHang.chiTietThanhToan', $this->views);
    }


    public function xoaSessionGioHang(){
            session()->forget('gio_hangs');
    }


    public function tiepTucDatHang(Request $request){
        $gio_hang_ids = $request->input('select', []);

        if (empty($gio_hang_ids)) {
            return response()->json(['success' => false]);
        }

        // Lấy thông tin chi tiết của các sản phẩm được chọn từ cơ sở dữ liệu
        $gio_hang = GioHang::with('sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->whereIn('id', $gio_hang_ids)
                            ->get();

        // Chuẩn bị dữ liệu giỏ hàng cần lưu vào session
        $gio_hangs = [];
        foreach ($gio_hang as $item) {
            $gio_hangs[] = [
                'san_pham_id' => $item->sanPham->id,
                'so_luong' => $item->so_luong,
                'kich_co' => $item->bienThe->kich_co,
                'ma_mau' => $item->bienThe->ma_mau,
                'gia_khuyen_mai' => $item->sanPham->gia_san_pham - ($item->sanPham->gia_san_pham * $item->sanPham->khuyen_mai / 100),
            ];
        }

        // Lưu dữ liệu vào session
        session()->put('gio_hangs', $gio_hangs);

        // Trả về đường dẫn để chuyển hướng
        return response()->json(['success' => true, 'redirect' => route('gio-hang.chi-tiet-thanh-toan')]);
    }


    public function tinhPhiShipDiaChi(Request $request){
        $ma_quan_huyen = $request->input('ma_quan_huyen');

        $phi_ships = PhiShip::with('tinhThanhPho','quanHuyen')
                        ->where('ma_quan_huyen',$ma_quan_huyen)->first();

        return response()->json(['phi_ships'=>$phi_ships]);
    }

    public function chonMaGiamGia(Request $request){
        $giamGiaVanChuyen = KhuyenMai::find($request->input('maVanChuyenId'));
        $giamGiaDonHang = KhuyenMai::find($request->input('maDonHangId'));
        $gioHangCu = session()->get('gio_hangs', []);
        return response()->json([
            'success'=>true,
            'giamGiaVanChuyen' => $giamGiaVanChuyen,
            'giamGiaDonHang' => $giamGiaDonHang,
            'gioHangCu' => $gioHangCu
        ]);
    }

    public function datHang(Request $request){
        DB::beginTransaction();
        try {
            $gio_hangs = session()->get('gio_hangs', []);
            $phi_ships = $request->input('phiShip');
            $giamGiaVanChuyen = $request->input('giamTienVanChuyen');
            $giamGiaDonHang = $request->input('giamTienDonHang');
            $soCoin = $request->input('soCoin');
            $check=false;

            // Kiểm tra phương thức thanh toán
            if ($request->input('phuong_thuc_thanh_toan') == 0) { // COD
                $phuong_thuc_thanh_toan = 0;
                $trang_thai = 0;
                $thanh_toan = 0;
            } else { // Chuyển khoản
                $phuong_thuc_thanh_toan = 1;
                $trang_thai = 1;
                $thanh_toan = 1;
            }

            // Tạo đơn hàng mới
            $dataInsertDonHang = [
                'ma_don_hang' => 'DH' . strtoupper(Str::random(8)),
                'user_id' => Auth::user()->id,
                'dia_chi_id' => $request->input('dia_chi_id'),
                'giam_gia_van_chuyen' => $giamGiaVanChuyen,
                'giam_gia_don_hang' => $giamGiaDonHang,
                'namad_xu' => $soCoin,
                'tong_thanh_toan' => $request->input('tong_thanh_toan'),
                'phuong_thuc_thanh_toan' => $phuong_thuc_thanh_toan,
                'trang_thai' => $trang_thai,
                'thanh_toan' => $thanh_toan,
                'ghi_chu' => $request->input('ghi_chu'),
                'ngay_tao' => now(),
            ];

            $result = DonHang::create($dataInsertDonHang);

            if ($result) {
                $donHang = DonHang::with('diaChi')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

                foreach ($gio_hangs as $item) {
                    $san_pham = SanPham::find($item['san_pham_id']);
                    $bien_the = BienThe::where('san_pham_id', $item['san_pham_id'])
                                        ->where('kich_co', $item['kich_co'])
                                        ->where('ma_mau', $item['ma_mau'])
                                        ->first();
                    $coin = Coin::where('user_id', Auth::user()->id)->first();

                    // Tạo chi tiết đơn hàng
                    $dataInsertChiTiet = [
                        'don_hang_id' => $donHang->id,
                        'san_pham_id' => $item['san_pham_id'],
                        'bien_the_id' => $bien_the->id,
                        'so_luong' => $item['so_luong'],
                        'don_gia' => $item['gia_khuyen_mai'],
                        'thanh_tien' => $item['gia_khuyen_mai'] * $item['so_luong'],
                        'created_at' => now(),
                    ];
                    ChiTietDonHang::create($dataInsertChiTiet);

                    // Cập nhật số lượng tồn kho cho biến thể
                    $bien_the->decrement('so_luong', $item['so_luong']);

                    // Xóa sản phẩm trong giỏ hàng của người dùng
                    GioHang::where('user_id', Auth::user()->id)
                        ->where('san_pham_id', $item['san_pham_id'])
                        ->where('bien_the_id', $bien_the->id)
                        ->delete();
                }
                // Kiểm tra xem có bản ghi Coin và số coin sử dụng có hợp lệ hay không
                if ($coin && $soCoin > 0) {
                    $coin->decrement('coin', $soCoin);
                }

                // Gửi email xác nhận đơn hàng
                $dia_chi = DiaChi::with('tinhThanhPho', 'quanHuyen', 'phuongXa')
                                ->where('user_id', Auth::user()->id)
                                ->where('trang_thai', 1)
                                ->first();

                $don_hang = DonHang::with('user', 'diaChi')->find($donHang->id);
                $chi_tiet_don_hangs = ChiTietDonHang::with('sanPham', 'bienThe')->where('don_hang_id', $donHang->id)->get();
                $user = User::find(Auth::user()->id);

                Mail::to(Auth::user()->email)->queue(new SendHoaDon($user,$dia_chi, $don_hang, $chi_tiet_don_hangs, $phi_ships, $giamGiaVanChuyen, $giamGiaDonHang,$soCoin));

                $check=true;
            }
            if($check){
                DB::commit();
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}
