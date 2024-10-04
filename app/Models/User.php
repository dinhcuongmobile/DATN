<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'ho_va_ten',
        'email',
        'password',
        'so_dien_thoai',
        'dia_chi',
        'vai_tro_id',
        'email_verified_at',
        'email_verification_token',
        'password_reset_token',
        'trang_thai',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'email_verification_token',
        'password_reset_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'trang_thai' => 'integer',
    ];

    public function vaiTro()
    {
        return $this->belongsTo(VaiTro::class, 'vai_tro_id');
    }

    public function timKiemTaiKhoan($key)
    {
        $tiemKiem = User::where('ho_va_ten', 'LIKE', "%$key%")
            ->orWhere('email', 'LIKE', "%$key%")
            ->orWhere('so_dien_thoai', 'LIKE', "%$key%")
            ->orDerByDesc('id')
            ->get();

        return $tiemKiem;
    }

    public function danhSachTaiKhoan()
    {
        $taiKhoan = User::query()->get();

        return $taiKhoan;
    }

    public function themTaiKhoan($params)
    {
        $taiKhoan = User::query()->create($params);

        return $taiKhoan;
    }

    public function suaTaiKhoan($params, $id)
    {
        $taiKhoan = User::query()->findOrFail($id);

        $taiKhoan->update($params);

        return $taiKhoan;
    }
}
