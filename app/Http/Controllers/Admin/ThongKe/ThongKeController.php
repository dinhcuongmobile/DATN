<?php

namespace App\Http\Controllers\Admin\ThongKe;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $donHang = DonHang::selectRaw('DATE(ngay_cap_nhat) as ngay_cap_nhat, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
            ->whereBetween('ngay_cap_nhat', [$sub30Ngay, $hienTai])
            ->where('trang_thai', 3)
            ->groupBy('ngay_cap_nhat')
            ->orderBy('ngay_cap_nhat', 'ASC')
            ->get();

        $tongDoanhThu = $donHang->sum('tong_thanh_toan');

        $soDonHang = DonHang::whereBetween('ngay_cap_nhat', [$sub30Ngay, $hienTai])->where('trang_thai', 3)->count();

        $groupedData = [];
        foreach ($donHang as $val) {
            $ngay = Carbon::parse($val->ngay_cap_nhat)->toDateString();

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
                'ngay_cap_nhat' => $ngay,
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

        $donHang = DonHang::selectRaw('DATE(ngay_cap_nhat) as ngay_cap_nhat, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
            ->whereBetween('ngay_cap_nhat', [$fromDate, $toDate])->where('trang_thai', 3)->groupBy('ngay_cap_nhat')->orderBy('ngay_cap_nhat', 'ASC')->get();

        $tongDoanhThu = $donHang->sum('tong_thanh_toan');

        $soDonHang = DonHang::whereBetween('ngay_cap_nhat', [$fromDate, $toDate])->where('trang_thai', 3)->count();

        $groupedData = [];
        foreach ($donHang as $val) {
            $ngay = Carbon::parse($val->ngay_cap_nhat)->toDateString();

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
                'ngay_cap_nhat' => $ngay,
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
            $donHang = DonHang::selectRaw('DATE(ngay_cap_nhat) as ngay_cap_nhat, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_cap_nhat', [$sub30Ngay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_cap_nhat')->orderBy('ngay_cap_nhat', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_cap_nhat', [$sub30Ngay, $hienTai])->where('trang_thai', 3)->count();
        } elseif ($data['dashboardValue'] == '7ngay') {
            $donHang = DonHang::selectRaw('DATE(ngay_cap_nhat) as ngay_cap_nhat, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_cap_nhat', [$sub7Ngay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_cap_nhat')->orderBy('ngay_cap_nhat', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_cap_nhat', [$sub7Ngay, $hienTai])->where('trang_thai', 3)->count();
        } elseif ($data['dashboardValue'] == 'thangTruoc') {
            $donHang = DonHang::selectRaw('DATE(ngay_cap_nhat) as ngay_cap_nhat, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_cap_nhat', [$dauThangTruoc, $cuoiThangTruoc])->where('trang_thai', 3)->groupBy('ngay_cap_nhat')->orderBy('ngay_cap_nhat', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_cap_nhat', [$dauThangTruoc, $cuoiThangTruoc])->where('trang_thai', 3)->count();
        } elseif ($data['dashboardValue'] == 'thangNay') {
            $donHang = DonHang::selectRaw('DATE(ngay_cap_nhat) as ngay_cap_nhat, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_cap_nhat', [$dauThangNay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_cap_nhat')->orderBy('ngay_cap_nhat', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_cap_nhat', [$dauThangNay, $hienTai])->where('trang_thai', 3)->count();
        } else {
            $donHang = DonHang::selectRaw('DATE(ngay_cap_nhat) as ngay_cap_nhat, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_cap_nhat', [$sub365Ngay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_cap_nhat')->orderBy('ngay_cap_nhat', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_cap_nhat', [$sub365Ngay, $hienTai])->where('trang_thai', 3)->count();
        }

        $tongDoanhThu = $donHang->sum('tong_thanh_toan');

        $groupedData = [];
        foreach ($donHang as $val) {
            $ngay = Carbon::parse($val->ngay_cap_nhat)->toDateString();

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
                'ngay_cap_nhat' => $ngay,
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
}
