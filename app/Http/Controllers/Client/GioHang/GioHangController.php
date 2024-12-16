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
use App\Models\ThongBao;
use App\Models\ThongTinChuyenKhoan;
use App\Models\YeuThich;
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
            $checkGioHang = GioHang::with('user', 'sanPham', 'bienThe')->where('user_id', Auth::user()->id)->get();

            foreach ($checkGioHang as $item) {
                $checkSL = BienThe::find($item->bien_the_id);
                if($checkSL->so_luong==0){
                    GioHang::with('user', 'sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->where('san_pham_id',$checkSL->san_pham_id)
                            ->where('bien_the_id',$checkSL->id)
                            ->delete();
                }
                $item->sanPham->load('danhMuc', 'bienThes', 'danhGias');

            }
            $gioHangs = GioHang::with('user', 'sanPham', 'bienThe')
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();
            $this->views['gio_hangs'] = $gioHangs;
        }

        //
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
            $sp_yeu_thichs = YeuThich::with('user','sanPham')->where('san_pham_id','!=',$san_pham_id)->orderBy('id','desc')->take(6)->get();
            if($result){
                return response()->json([
                    'login' => true,
                    'count_gio_hang' => $count_gio_hang,
                    'san_pham' => $san_pham,
                    'spYeuThich' => $sp_yeu_thichs
                ]);
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

        return response()->json([
            'login' => true,
        ]);
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
                ->where('id', '!=', $gio_hang->id)
                ->where('user_id', Auth::id())
                ->where('san_pham_id', $gio_hang->san_pham_id)
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
                            ->where('id', '!=', $gio_hang->id)
                            ->where('user_id', Auth::id())
                            ->where('san_pham_id', $gio_hang->san_pham_id)
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

        if ($bien_the && $bien_the->so_luong>0) {
            $gio_hang->update(['bien_the_id'=>$bien_the->id]);
            return response()->json([
                'success' => true,
                'gio_hang'=>$gio_hang,
                'bien_the'=>$bien_the
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message'=> 'Sản phẩm với biến thể bạn chọn không đủ số lượng trong kho !',
            ]);
        }
    }


    public function tiepTucDatHang(Request $request){
        $gio_hang_ids = $request->input('select', []);

        if (empty($gio_hang_ids)) {
            return response()->json(['success' => false]);
        }

        $gio_hang = GioHang::with('sanPham', 'bienThe')
                            ->where('user_id', Auth::user()->id)
                            ->whereIn('id', $gio_hang_ids)
                            ->get();

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

        session()->put('gio_hangs', $gio_hangs);

        return response()->json(['success' => true, 'redirect' => route('gio-hang.chi-tiet-thanh-toan')]);
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
        //
        return view('client.gioHang.chiTietThanhToan', $this->views);
    }


    public function xoaSessionGioHang(){
        session()->forget('gio_hangs');
    }

    public function xoaSessionDatHangChuyenKhoan(){
        session()->forget('dat_hang_chuyen_khoan');
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

    public function datHangCod(Request $request){
        DB::beginTransaction();
        try {
            $gio_hangs = session()->get('gio_hangs', []);
            $phi_ships = $request->input('phiShip');
            $giamGiaVanChuyen = $request->input('giamTienVanChuyen');
            $giamGiaDonHang = $request->input('giamTienDonHang');
            $soCoin = $request->input('soCoin');
            $check=false;

            foreach ($gio_hangs as $item) {
                $checkSoLuongSp = BienThe::where('san_pham_id', $item['san_pham_id'])
                                        ->where('kich_co', $item['kich_co'])
                                        ->where('ma_mau', $item['ma_mau'])
                                        ->lockForUpdate()
                                        ->first();

                if (!$checkSoLuongSp || ($checkSoLuongSp->so_luong - $checkSoLuongSp->so_luong_tam_giu) < $item['so_luong']) {
                    return response()->json([
                        'success' => false,
                        'message' => "một trong số sản phẩm bạn mua không đủ số lượng trong kho !"
                    ]);
                }
            }
            // Tạo đơn hàng mới
            do {
                $maDonHang = 'DH' . strtoupper(Str::random(8));
            } while (DB::table('don_hangs')->where('ma_don_hang', $maDonHang)->exists());

            $dataInsertDonHang = [
                'ma_don_hang' => $maDonHang,
                'user_id' => Auth::user()->id,
                'dia_chi_id' => $request->input('dia_chi_id'),
                'giam_gia_van_chuyen' => $giamGiaVanChuyen,
                'giam_gia_don_hang' => $giamGiaDonHang,
                'namad_xu' => $soCoin,
                'tong_thanh_toan' => $request->input('tong_thanh_toan'),
                'phuong_thuc_thanh_toan' => 0,
                'trang_thai' => 0,
                'thanh_toan' => 0,
                'ghi_chu' => $request->input('ghi_chu'),
                'ngay_tao' => now(),
                'ngay_cap_nhat' => now()
            ];

            $result = DonHang::create($dataInsertDonHang);

            if ($result) {
                ThongBao::create([
                    'user_id' => Auth::id(),
                    'tieu_de' => "Đặt hàng thành công",
                    'noi_dung' => 'Bạn đã đặt hàng thành công! Chờ xác nhận của người bán.',
                ]);

                foreach ($gio_hangs as $item) {
                    $bien_the = BienThe::where('san_pham_id', $item['san_pham_id'])
                                        ->where('kich_co', $item['kich_co'])
                                        ->where('ma_mau', $item['ma_mau'])
                                        ->first();

                    // Tạo chi tiết đơn hàng
                    $dataInsertChiTiet = [
                        'don_hang_id' => $result->id,
                        'san_pham_id' => $item['san_pham_id'],
                        'bien_the_id' => $bien_the->id,
                        'so_luong' => $item['so_luong'],
                        'don_gia' => $item['gia_khuyen_mai'],
                        'thanh_tien' => $item['gia_khuyen_mai'] * $item['so_luong'],
                        'created_at' => now(),
                    ];
                    ChiTietDonHang::create($dataInsertChiTiet);

                    // Tăng số lượng tạm giữ
                    $bien_the->increment('so_luong_tam_giu', $item['so_luong']);

                    // Xóa sản phẩm trong giỏ hàng của người dùng
                    GioHang::where('user_id', Auth::user()->id)
                        ->where('san_pham_id', $item['san_pham_id'])
                        ->where('bien_the_id', $bien_the->id)
                        ->delete();
                }

                $coin = Coin::where('user_id', Auth::user()->id)->first();
                // Kiểm tra xem có bản ghi Coin và số coin sử dụng có hợp lệ hay không
                if ($coin && $soCoin > 0) {
                    $coin->decrement('coin', $soCoin);
                }

                // Gửi email xác nhận đơn hàng
                $dia_chi = DiaChi::with('tinhThanhPho', 'quanHuyen', 'phuongXa')
                                ->where('user_id', Auth::user()->id)
                                ->where('trang_thai', 1)
                                ->first();

                $don_hang = DonHang::with('user', 'diaChi')->find($result->id);
                $chi_tiet_don_hangs = ChiTietDonHang::with('sanPham', 'bienThe')->where('don_hang_id', $result->id)->get();
                $user = User::find(Auth::user()->id);

                Mail::to(Auth::user()->email)->queue(new SendHoaDon($user,$dia_chi, $don_hang, $chi_tiet_don_hangs, $phi_ships, $giamGiaVanChuyen, $giamGiaDonHang,$soCoin));

                ThongBao::create([
                    'tieu_de' => "Đơn hàng mới",
                    'noi_dung' => "Đơn hàng ". $result->ma_don_hang . " đã được tạo mới.",
                    'nguoi_nhan' => true
                ]);

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

    public function datHangChuyenKhoan(Request $request){
        // Lấy dữ liệu giỏ hàng hiện tại
        if (empty(session()->get('gio_hangs', []))) {
            return response()->json([
                'success' => false,
            ]);
        }

        $gio_hangs = session()->get('gio_hangs', []);

        // Thêm các thông tin mới
        $gio_hangs['thong_tin_them'] = [
            'dia_chi_id' => $request->input('dia_chi_id'),
            'tong_thanh_toan' => $request->input('tong_thanh_toan'),
            'ghi_chu' => $request->input('ghi_chu'),
            'phi_ships' => $request->input('phiShip'),
            'giam_gia_van_chuyen' => $request->input('giamTienVanChuyen'),
            'giam_gia_don_hang' => $request->input('giamTienDonHang'),
            'so_coin' => $request->input('soCoin'),
        ];

        session()->put('dat_hang_chuyen_khoan', $gio_hangs);


        return response()->json([
            'success' => true,
        ]);
    }

    public function createPayment(Request $request){
        if (empty(session()->get('dat_hang_chuyen_khoan', []))) {
            return redirect()->route('gio-hang.gio-hang');
        }
        $dat_hang_chuyen_khoan = session()->get('dat_hang_chuyen_khoan', []);

        // Ngân hàng	NCB
        // Số thẻ	9704198526191432198
        // Tên chủ thẻ	NGUYEN VAN A
        // Ngày phát hành	07/15
        // Mật khẩu OTP	123456
        $vnp_TmnCode = config('vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_Url = config('vnpay.vnp_Url');
        $vnp_Returnurl = config('vnpay.vnp_ReturnUrl');

        // Cấu hình định dạng đầu vào
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        do {
            $maDonHang = 'DH' . strtoupper(Str::random(8));
        } while (DB::table('don_hangs')->where('ma_don_hang', $maDonHang)->exists());

        $vnp_TxnRef = $maDonHang;
        $vnp_Amount = $dat_hang_chuyen_khoan['thong_tin_them']['tong_thanh_toan'] ?? '';
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $request->ip();

        $inputData = [
           "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            'vnp_BankCode' => $vnp_BankCode,
            "vnp_Amount" => $vnp_Amount* 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toán cho đơn hàng: " . $vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$expire
        ];

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect()->away($vnp_Url);

    }

    public function hoanTatChuyenKhoanDonHang(){
        if (empty(session()->get('dat_hang_chuyen_khoan', []))) {
            return redirect()->route('gio-hang.gio-hang');
        }

        $datHangChuyenKhoan = session()->get('dat_hang_chuyen_khoan', []);

        if(isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode']==0){
            DB::beginTransaction();
            try {
                $ma_don_hang = $_GET['vnp_TxnRef'];
                $dia_chi_id = $datHangChuyenKhoan['thong_tin_them']['dia_chi_id'];
                $phi_ships = $datHangChuyenKhoan['thong_tin_them']['phi_ships'];
                $giamGiaVanChuyen = $datHangChuyenKhoan['thong_tin_them']['giam_gia_van_chuyen'];
                $giamGiaDonHang = $datHangChuyenKhoan['thong_tin_them']['giam_gia_don_hang'];
                $soCoin = $datHangChuyenKhoan['thong_tin_them']['so_coin'];
                $tong_thanh_toan = $datHangChuyenKhoan['thong_tin_them']['tong_thanh_toan'];
                $ghi_chu = $datHangChuyenKhoan['thong_tin_them']['ghi_chu'];
                $check=false;

                //tạo mới thông tin chuyển khoản

                $dataInsertThongTinChuyenKhoan = [
                    'ma_don_hang' => $_GET['vnp_TxnRef'], // Mã đơn hàng
                    'so_tien' => $_GET['vnp_Amount'], // Số tiền thanh toán (VNPay trả về số tiền đã nhân với 100)
                    'mo_ta_don_hang' => $_GET['vnp_OrderInfo'], // Mô tả đơn hàng
                    'ma_giao_dich_vnpay' => $_GET['vnp_TransactionNo'], // Mã giao dịch VNPay
                    'ma_ngan_hang' => $_GET['vnp_BankCode'], // Mã ngân hàng thanh toán
                    'ma_giao_dich_ngan_hang' => $_GET['vnp_BankTranNo'], // Mã giao dịch ngân hàng
                    'ma_phan_hoi' => $_GET['vnp_ResponseCode'], // Mã phản hồi từ VNPay (00 là thành công)
                    'trang_thai_giao_dich' => $_GET['vnp_TransactionStatus'], // Trạng thái giao dịch
                    'thoi_gian_thanh_toan' => $_GET['vnp_PayDate'], // Thời gian thanh toán
                    'chu_ky_vnpay' => $_GET['vnp_SecureHash'], // Chuỗi mã hóa kiểm tra tính toàn vẹn
                ];

                ThongTinChuyenKhoan::create($dataInsertThongTinChuyenKhoan);

                // Tạo đơn hàng mới
                $dataInsertDonHang = [
                    'ma_don_hang' => $ma_don_hang,
                    'user_id' => Auth::id(),
                    'dia_chi_id' => $dia_chi_id,
                    'giam_gia_van_chuyen' => $giamGiaVanChuyen,
                    'giam_gia_don_hang' => $giamGiaDonHang,
                    'namad_xu' => $soCoin ,
                    'tong_thanh_toan' => $tong_thanh_toan,
                    'phuong_thuc_thanh_toan' => 1,
                    'trang_thai' => 1,
                    'thanh_toan' => 1,
                    'ghi_chu' => $ghi_chu,
                    'ngay_tao' => now(),
                    'ngay_cap_nhat' => now()
                ];

                $result = DonHang::create($dataInsertDonHang);

                if ($result) {
                    ThongBao::create([
                        'user_id' => Auth::id(),
                        'tieu_de' => "Đặt hàng thành công",
                        'noi_dung' => 'Bạn đã đặt hàng thành công! Đang chuẩn bị hàng.',
                    ]);

                    foreach ($datHangChuyenKhoan as $key => $item) {
                        if($key !== 'thong_tin_them' && is_array($item)){
                            $bien_the = BienThe::where('san_pham_id', $item['san_pham_id'])
                                            ->where('kich_co', $item['kich_co'])
                                            ->where('ma_mau', $item['ma_mau'])
                                            ->first();

                            // Tạo chi tiết đơn hàng
                            $dataInsertChiTiet = [
                                'don_hang_id' => $result->id,
                                'san_pham_id' => $item['san_pham_id'],
                                'bien_the_id' => $bien_the->id,
                                'so_luong' => $item['so_luong'],
                                'don_gia' => $item['gia_khuyen_mai'],
                                'thanh_tien' => $item['gia_khuyen_mai'] * $item['so_luong'],
                                'created_at' => now(),
                            ];
                            ChiTietDonHang::create($dataInsertChiTiet);

                            // Tăng số lượng tạm giữ
                            $bien_the->increment('so_luong_tam_giu', $item['so_luong']);

                            // Xóa sản phẩm trong giỏ hàng của người dùng
                            GioHang::where('user_id', Auth::user()->id)
                                ->where('san_pham_id', $item['san_pham_id'])
                                ->where('bien_the_id', $bien_the->id)
                                ->delete();
                        }

                    }

                    $coin = Coin::where('user_id', Auth::user()->id)->first();
                    // Kiểm tra xem có bản ghi Coin và số coin sử dụng có hợp lệ hay không
                    if ($coin && $datHangChuyenKhoan['thong_tin_them']['so_coin'] > 0) {
                        $coin->decrement('coin', $datHangChuyenKhoan['thong_tin_them']['so_coin']);
                    }

                    // Gửi email xác nhận đơn hàng
                    $dia_chi = DiaChi::with('tinhThanhPho', 'quanHuyen', 'phuongXa')
                                    ->where('user_id', Auth::user()->id)
                                    ->where('trang_thai', 1)
                                    ->first();

                    $don_hang = DonHang::with('user', 'diaChi')->find($result->id);
                    $chi_tiet_don_hangs = ChiTietDonHang::with('sanPham', 'bienThe')->where('don_hang_id', $result->id)->get();
                    $user = User::find(Auth::user()->id);

                    Mail::to(Auth::user()->email)->queue(new SendHoaDon($user,$dia_chi, $don_hang, $chi_tiet_don_hangs, $phi_ships, $giamGiaVanChuyen, $giamGiaDonHang,$soCoin));

                    ThongBao::create([
                        'tieu_de' => "Đơn hàng mới",
                        'noi_dung' => "Đơn hàng ". $result->ma_don_hang . " đã được tạo mới.",
                        'nguoi_nhan' => true
                    ]);

                    $check=true;
                }
                if($check){
                    DB::commit();
                }else{
                    DB::rollBack();
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
        }
        return view('client.vnpay.vnpay_return');
    }

}
