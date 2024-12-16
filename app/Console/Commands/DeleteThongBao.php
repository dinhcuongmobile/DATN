<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\ThongBao;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Bus;
use App\Jobs\DeleteThongBaoJob;

class DeleteThongBao extends Command
{
    protected $signature = 'thongBao:delete-status';
    protected $description = 'Xóa các thông báo đã quá cũ.';

    public function handle()
    {
        $ngayQuyDinh = Carbon::now()->subDays(7);

        $thongBaos = ThongBao::where('trang_thai', 1)
            ->where('created_at', '<=', $ngayQuyDinh)
            ->get();

        // Đẩy từng job vào queue
        foreach ($thongBaos as $thongBao) {
            Bus::dispatch(new DeleteThongBaoJob($thongBao));
        }

        $this->info('Lệnh xóa thông báo đã được đưa vào hàng đợi.');
    }
}
