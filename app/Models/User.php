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
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'ho_va_ten',
        'email',
        'password',
        'so_dien_thoai',
        'dia_chi',
        'vai_tro_id',
        'remember_token',
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

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'user_id');
    }

    public function binhLuans()
    {
        return $this->hasMany(BinhLuan::class, 'user_id');
    }

    public function donHangs()
    {
        return $this->hasMany(DonHang::class, 'user_id');
    }

    public function gioHangs()
    {
        return $this->hasMany(GioHang::class, 'user_id');
    }
}
