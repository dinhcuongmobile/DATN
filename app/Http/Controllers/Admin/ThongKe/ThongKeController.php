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
        $hienTai = Carbon::now()->toDateString();

        $donHang = DonHang::whereBetween('ngay_tao', [$sub30Ngay, $hienTai])->where('thanh_toan', 0)->orderBy('ngay_tao', 'ASC')->get();
        // Sửa thanh_toan về  1 khi hoàn thành

        foreach ($donHang as $key => $val) {
            $chart_data[] = array(
                'ngay_tao' => $val->ngay_tao,
                'tong_thanh_toan' => $val->tong_thanh_toan
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function thongKeDoanhSo(Request $request)
    {
        $data = $request->all();

        $fromDate = $data['fromDate'];
        $toDate = $data['toDate'];

        $donHang = DonHang::whereBetween('ngay_tao', [$fromDate, $toDate])->where('thanh_toan', 0)->orderBy('ngay_tao', 'ASC')->get();

        foreach ($donHang as $key => $val) {
            $chart_data[] = array(
                'ngay_tao' => $val->ngay_tao,
                'tong_thanh_toan' => $val->tong_thanh_toan
            );
        }

        echo $data = json_encode($chart_data);
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
            $donHang = DonHang::whereBetween('ngay_tao', [$sub7Ngay, $hienTai])->where('thanh_toan', 0)->orderBy('ngay_tao', 'ASC')->get();
        } elseif ($data['dashboardValue'] == 'thangTruoc') {
            $donHang = DonHang::whereBetween('ngay_tao', [$dauThangTruoc, $cuoiThangTruoc])->where('thanh_toan', 0)->orderBy('ngay_tao', 'ASC')->get();
        } elseif ($data['dashboardValue'] == 'thangNay') {
            $donHang = DonHang::whereBetween('ngay_tao', [$dauThangNay, $hienTai])->where('thanh_toan', 0)->orderBy('ngay_tao', 'ASC')->get();
        } else {
            $donHang = DonHang::whereBetween('ngay_tao', [$sub365Ngay, $hienTai])->where('thanh_toan', 0)->orderBy('ngay_tao', 'ASC')->get();
        }
        
        foreach ($donHang as $key => $val) {
            $chart_data[] = array(
                'ngay_tao' => $val->ngay_tao,
                'tong_thanh_toan' => $val->tong_thanh_toan
            );
        }

        echo $data = json_encode($chart_data);
    }
}
