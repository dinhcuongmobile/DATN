<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DeleteThongBaoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $thongBao;

    public function __construct($thongBao)
    {
        $this->thongBao = $thongBao;
    }

    public function handle()
    {
        // Xóa ảnh nếu có
        if ($this->thongBao->hinh_anh) {
            Storage::disk('public')->delete($this->thongBao->hinh_anh);
        }

        // Xóa thông báo
        $this->thongBao->delete();
    }
}
