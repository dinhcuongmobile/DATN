<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\DonHang;
use App\Models\SanPham;
use App\Models\ChiTietDonHang;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class UpdateOrderStatus extends Command
{
    protected $signature = 'orders:update-status';
    protected $description = 'Cập nhật trạng thái đơn hàng sang "đã giao" sau thời gian quy định';

    public function handle()
    {
        // Thời gian tính từ khi đơn hàng ở trạng thái "đang giao" (ví dụ 3 ngày)
        $ngayQuyDinh = Carbon::now()->subDays(3);

        // Lấy các đơn hàng đang giao nhưng chưa được khách nhấn "đã nhận hàng"
        $donHangs = DonHang::where('trang_thai', 2)
            ->where('ngay_cap_nhat', '<=', $ngayQuyDinh) // Thời gian cập nhật quá 3 ngày
            ->get();

        // Cập nhật trạng thái sang "đã giao" (3)
        foreach ($donHangs as $donHang) {
            $donHang->update([
                'trang_thai' => 3,
                'thanh_toan' => 1,
                'ngay_cap_nhat' => now(),
                'nguoi_ban' => Auth::guard('admin')->user()->id,
                'ngay_ban' => Carbon::now()
            ]);

            $chi_tiet_don_hangs = ChiTietDonHang::with('sanPham')->where('don_hang_id',$donHang->id)->get();
            foreach ($chi_tiet_don_hangs as $item) {
                $san_pham = SanPham::find($item->san_pham_id);
                $san_pham->update(['da_ban'=> $san_pham->da_ban + $item->so_luong]);
            }
        }

        $this->info('Cập nhật trạng thái đơn hàng thành công.');
    }
}
