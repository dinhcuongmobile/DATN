<?php

namespace App\Http\Controllers\Admin\ThongKe;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ThongKeController extends Controller
{
    protected $views;

    public function __construct()
    {
        $this->views = [];
    }

    public function load30Ngay()
    {
        $sub30Ngay = Carbon::now()->subDays(30)->toDateString();
        $hienTai = Carbon::now()->endOfDay()->toDateString();

        $donHang = DonHang::selectRaw('DATE(ngay_ban) as ngay_ban, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
            ->whereBetween('ngay_ban', [$sub30Ngay, $hienTai])
            ->where('trang_thai', 3)
            ->groupBy('ngay_ban')
            ->orderBy('ngay_ban', 'ASC')
            ->get();

        $tongDoanhThu = $donHang->sum('tong_thanh_toan');

        $soDonHang = DonHang::whereBetween('ngay_ban', [$sub30Ngay, $hienTai])->where('trang_thai', 3)->count();
        $groupedData = [];
        foreach ($donHang as $val) {
            $ngay = Carbon::parse($val->ngay_ban)->toDateString();

            if (!isset($groupedData[$ngay])) {
                $groupedData[$ngay] = [
                    'tong_don_hang' => 0,
                    'tong_thanh_toan' => 0
                ];
            }

            $groupedData[$ngay]['tong_don_hang'] += $val->tong_don_hang;
            $groupedData[$ngay]['tong_thanh_toan'] += $val->tong_thanh_toan;
        }

        $chart_data = [];
        foreach ($groupedData as $ngay => $data) {
            $chart_data[] = [
                'ngay_ban' => $ngay,
                'tong_don_hang' => $data['tong_don_hang'],
                'tong_thanh_toan' => $data['tong_thanh_toan']
            ];
        }

        $response = [
            'chart_data' => $chart_data,
            'tong_doanh_thu' => $tongDoanhThu,
            'so_don_hang' => $soDonHang
        ];

        echo $data = json_encode($response);
    }

    public function thongKeDoanhSo(Request $request)
    {
        $data = $request->all();

        $fromDate = $data['fromDate'];
        $toDate = $data['toDate'];

        $donHang = DonHang::selectRaw('DATE(ngay_ban) as ngay_ban, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
            ->whereBetween('ngay_ban', [$fromDate, $toDate])->where('trang_thai', 3)->groupBy('ngay_ban')->orderBy('ngay_ban', 'ASC')->get();

        $tongDoanhThu = $donHang->sum('tong_thanh_toan');

        $soDonHang = DonHang::whereBetween('ngay_ban', [$fromDate, $toDate])->where('trang_thai', 3)->count();
        $groupedData = [];
        foreach ($donHang as $val) {
            $ngay = Carbon::parse($val->ngay_ban)->toDateString();

            if (!isset($groupedData[$ngay])) {
                $groupedData[$ngay] = [
                    'tong_don_hang' => 0,
                    'tong_thanh_toan' => 0
                ];
            }

            $groupedData[$ngay]['tong_don_hang'] += $val->tong_don_hang;
            $groupedData[$ngay]['tong_thanh_toan'] += $val->tong_thanh_toan;
        }

        $chart_data = [];
        foreach ($groupedData as $ngay => $data) {
            $chart_data[] = [
                'ngay_ban' => $ngay,
                'tong_don_hang' => $data['tong_don_hang'],
                'tong_thanh_toan' => $data['tong_thanh_toan']
            ];
        }

        $response = [
            'chart_data' => $chart_data,
            'tong_doanh_thu' => $tongDoanhThu,
            'so_don_hang' => $soDonHang
        ];

        echo $data = json_encode($response);
    }

    public function thongKeDoanhSoBy(Request $request)
    {
        $data = $request->all();

        // $homNay = Carbon::now()->format('d-m-Y H:i:s');
        $dauThangNay = Carbon::now()->startOfMonth()->toDateString();
        $dauThangTruoc = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $cuoiThangTruoc = Carbon::now()->subMonth()->endOfMonth()->toDateString();

        $sub30Ngay = Carbon::now()->subDays(30)->toDateString();
        $sub7Ngay = Carbon::now()->subDays(7)->toDateString();
        $sub365Ngay = Carbon::now()->subDays(365)->toDateString();

        $hienTai = Carbon::now()->toDateString();


        if ($data['dashboardValue'] == '30ngay') {
            $donHang = DonHang::selectRaw('DATE(ngay_ban) as ngay_ban, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_ban', [$sub30Ngay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_ban')->orderBy('ngay_ban', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_ban', [$sub30Ngay, $hienTai])->where('trang_thai', 3)->count();
        } elseif ($data['dashboardValue'] == '7ngay') {
            $donHang = DonHang::selectRaw('DATE(ngay_ban) as ngay_ban, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_ban', [$sub7Ngay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_ban')->orderBy('ngay_ban', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_ban', [$sub7Ngay, $hienTai])->where('trang_thai', 3)->count();
        } elseif ($data['dashboardValue'] == 'thangTruoc') {
            $donHang = DonHang::selectRaw('DATE(ngay_ban) as ngay_ban, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_ban', [$dauThangTruoc, $cuoiThangTruoc])->where('trang_thai', 3)->groupBy('ngay_ban')->orderBy('ngay_ban', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_ban', [$dauThangTruoc, $cuoiThangTruoc])->where('trang_thai', 3)->count();
        } elseif ($data['dashboardValue'] == 'thangNay') {
            $donHang = DonHang::selectRaw('DATE(ngay_ban) as ngay_ban, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_ban', [$dauThangNay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_ban')->orderBy('ngay_ban', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_ban', [$dauThangNay, $hienTai])->where('trang_thai', 3)->count();
        } else {
            $donHang = DonHang::selectRaw('DATE(ngay_ban) as ngay_ban, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_ban', [$sub365Ngay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_ban')->orderBy('ngay_ban', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_ban', [$sub365Ngay, $hienTai])->where('trang_thai', 3)->count();
        }

        $tongDoanhThu = $donHang->sum('tong_thanh_toan');
        $groupedData = [];
        foreach ($donHang as $val) {
            $ngay = Carbon::parse($val->ngay_ban)->toDateString();

            if (!isset($groupedData[$ngay])) {
                $groupedData[$ngay] = [
                    'tong_don_hang' => 0,
                    'tong_thanh_toan' => 0
                ];
            }

            $groupedData[$ngay]['tong_don_hang'] += $val->tong_don_hang;
            $groupedData[$ngay]['tong_thanh_toan'] += $val->tong_thanh_toan;
        }

        $chart_data = [];
        foreach ($groupedData as $ngay => $data) {
            $chart_data[] = [
                'ngay_ban' => $ngay,
                'tong_don_hang' => $data['tong_don_hang'],
                'tong_thanh_toan' => $data['tong_thanh_toan']
            ];
        }

        $response = [
            'chart_data' => $chart_data,
            'tong_doanh_thu' => $tongDoanhThu,
            'so_don_hang' => $soDonHang
        ];

        echo $data = json_encode($response);
    }

    public function doanhThuNhanVien(Request $request)
    {
        $filterMonth = $request->input('filter_month', 'thangNay'); // Mặc định là tháng này

        // Xác định thời gian lọc
        $startDate = $request->input('tu_ngay'); // Ngày bắt đầu
        $endDate = $request->input('den_ngay');   // Ngày kết thúc

        if (!$startDate && !$endDate) {
            if ($filterMonth === 'thangNay') {
                // Lọc theo tháng này
                $startDate = Carbon::now()->startOfMonth()->toDateString(); // Ngày đầu tiên của tháng này
                $endDate = Carbon::now()->endOfMonth()->toDateString();    // Ngày cuối cùng của tháng này
            } elseif ($filterMonth === 'thangTruoc') {
                // Lọc theo tháng trước
                $startDate = Carbon::now()->subMonth()->startOfMonth()->toDateString(); // Ngày đầu tiên của tháng trước
                $endDate = Carbon::now()->subMonth()->endOfMonth()->toDateString();    // Ngày cuối cùng của tháng trước
            } else {
                // Lọc theo tháng trước
                $startDate = Carbon::now()->subDays(365)->toDateString();
                $endDate = Carbon::now()->toDateString();
            }
        }

        $donHang = DonHang::with('nguoiBan')->select(
                'nguoi_ban',
                DB::raw('COUNT(*) as so_don_hang'),
                DB::raw('SUM(tong_thanh_toan) as tong_doanh_thu'),
                DB::raw('ngay_ban')
            )
            ->whereNotNull('nguoi_ban')
            ->where('trang_thai', 3) // Trạng thái đơn hàng hoàn thành
            ->when(Auth::guard('admin')->user()->vai_tro_id == 2, function ($query) {
                return $query->where('nguoi_ban', '=', Auth::guard('admin')->user()->id);
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('ngay_ban', [$startDate, $endDate]);
            })
            ->groupBy('ngay_ban', 'nguoi_ban');


        // Tính tổng số đơn hàng và doanh thu của từng nhân viên
        $tongDonHang = DonHang::whereNotNull('nguoi_ban')
            ->where('trang_thai', 3)
            ->when(Auth::guard('admin')->user()->vai_tro_id == 2, function ($query) {
                return $query->where('nguoi_ban', '=', Auth::guard('admin')->user()->id);
            })
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('ngay_ban', [$startDate, $endDate]);
            })
            ->select(
                'nguoi_ban',
                DB::raw('COUNT(*) as tong_so_don_hang'),
                DB::raw('SUM(tong_thanh_toan) as tong_doanh_thu')
            )
            ->groupBy('nguoi_ban')
            ->with('nguoiBan');

        // dd($donHang);
        $keyword = $request->input('kyw');
        if ($keyword) {
            $donHang = $donHang->whereHas('nguoiBan', function ($loc) use ($keyword) {
                $loc->where('ho_va_ten', 'LIKE', "%$keyword%")
                    ->orWhere('id', 'LIKE', "%$keyword%");
            })->orderBy('tong_doanh_thu', 'desc')->get();

            $tongDonHang = $tongDonHang->whereHas('nguoiBan', function ($loc) use ($keyword) {
                $loc->where('ho_va_ten', 'LIKE', "%$keyword%")
                    ->orWhere('id', 'LIKE', "%$keyword%");
            })->orderBy('tong_doanh_thu', 'desc')->get();
        }else{
            $donHang = $donHang->orderBy('tong_doanh_thu', 'desc')->get();

            $tongDonHang = $tongDonHang->orderBy('tong_doanh_thu', 'desc')->get();
        }

        $this->views['doanhThuNhanVien'] = $donHang;
        $this->views['tongDonHang'] = $tongDonHang;

        return view('admin.thongKeNhanVien.doanhThuNhanVien', $this->views);
    }
}
