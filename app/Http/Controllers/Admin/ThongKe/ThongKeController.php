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
        $dauThangNay = Carbon::now()->startOfMonth()->toDateString();
        $hienTai = Carbon::now()->toDateString();

        $donHang = DonHang::selectRaw('DATE(ngay_tao) as ngay_tao, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
            ->whereBetween('ngay_tao', [$dauThangNay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_tao')->orderBy('ngay_tao', 'ASC')->get();

        $tongDoanhThu = $donHang->sum('tong_thanh_toan');

        $soDonHang = DonHang::whereBetween('ngay_tao', [$dauThangNay, $hienTai])->where('trang_thai', 3)->count();

        foreach ($donHang as $key => $val) {
            $chart_data[] = array(
                'ngay_tao' => $val->ngay_tao,
                'tong_don_hang' => $val->tong_don_hang,
                'tong_thanh_toan' => $val->tong_thanh_toan
            );
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

        $donHang = DonHang::selectRaw('DATE(ngay_tao) as ngay_tao, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
            ->whereBetween('ngay_tao', [$fromDate, $toDate])->where('trang_thai', 3)->groupBy('ngay_tao')->orderBy('ngay_tao', 'ASC')->get();

        $tongDoanhThu = $donHang->sum('tong_thanh_toan');

        $soDonHang = DonHang::whereBetween('ngay_tao', [$fromDate, $toDate])->where('trang_thai', 3)->count();

        foreach ($donHang as $key => $val) {
            $chart_data[] = array(
                'ngay_tao' => $val->ngay_tao,
                'tong_don_hang' => $val->tong_don_hang,
                'tong_thanh_toan' => $val->tong_thanh_toan
            );
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

        $sub7Ngay = Carbon::now()->subDays(7)->toDateString();
        $sub365Ngay = Carbon::now()->subDays(365)->toDateString();

        $hienTai = Carbon::now()->toDateString();

        if ($data['dashboardValue'] == '7ngay') {
            $donHang = DonHang::selectRaw('DATE(ngay_tao) as ngay_tao, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_tao', [$sub7Ngay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_tao')->orderBy('ngay_tao', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_tao', [$sub7Ngay, $hienTai])->where('trang_thai', 3)->count();
        } elseif ($data['dashboardValue'] == 'thangTruoc') {
            $donHang = DonHang::selectRaw('DATE(ngay_tao) as ngay_tao, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_tao', [$dauThangTruoc, $cuoiThangTruoc])->where('trang_thai', 3)->groupBy('ngay_tao')->orderBy('ngay_tao', 'ASC')->get();

            $soDonHang = DonHang::whereBetween('ngay_tao', [$dauThangTruoc, $cuoiThangTruoc])->where('trang_thai', 3)->count();
        } elseif ($data['dashboardValue'] == 'thangNay') {
            $donHang = DonHang::selectRaw('DATE(ngay_tao) as ngay_tao, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_tao', [$dauThangNay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_tao')->orderBy('ngay_tao', 'ASC')->get();
                
            $soDonHang = DonHang::whereBetween('ngay_tao', [$dauThangNay, $hienTai])->where('trang_thai', 3)->count();
        } else {
            $donHang = DonHang::selectRaw('DATE(ngay_tao) as ngay_tao, SUM(tong_thanh_toan) as tong_thanh_toan, COUNT(*) as tong_don_hang')
                ->whereBetween('ngay_tao', [$sub365Ngay, $hienTai])->where('trang_thai', 3)->groupBy('ngay_tao')->orderBy('ngay_tao', 'ASC')->get();
                
            $soDonHang = DonHang::whereBetween('ngay_tao', [$sub365Ngay, $hienTai])->where('trang_thai', 3)->count();
        }

        $tongDoanhThu = $donHang->sum('tong_thanh_toan');

        foreach ($donHang as $key => $val) {
            $chart_data[] = array(
                'ngay_tao' => $val->ngay_tao,
                'tong_don_hang' => $val->tong_don_hang,
                'tong_thanh_toan' => $val->tong_thanh_toan
            );
        }

        $response = [
            'chart_data' => $chart_data,
            'tong_doanh_thu' => $tongDoanhThu,
            'so_don_hang' => $soDonHang
        ];

        echo $data = json_encode($response);
    }
}
