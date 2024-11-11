<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendHoaDon extends Mailable
{
    use Queueable, SerializesModels;

    public $dia_chi;
    public $don_hang;
    public $chi_tiet_don_hangs;
    public $phi_ships;
    public $giamGiaVanChuyen;
    public $giamGiaDonHang;

    public function __construct($dia_chi, $don_hang, $chi_tiet_don_hangs, $phi_ships, $giamGiaVanChuyen, $giamGiaDonHang)
    {
        $this->dia_chi = $dia_chi;
        $this->don_hang = $don_hang;
        $this->chi_tiet_don_hangs = $chi_tiet_don_hangs;
        $this->phi_ships = $phi_ships;
        $this->giamGiaVanChuyen = $giamGiaVanChuyen;
        $this->giamGiaDonHang = $giamGiaDonHang;
    }

    public function build()
    {
        return $this->view('emails.sendHoaDon')
                    ->subject('Hóa đơn đặt hàng');
    }
}

