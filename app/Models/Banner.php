<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;


    protected $table = 'banners';
    protected $fillable = [
        'title',
        'hinh_anh',
        'status',
        'start_date',
        'end_date'
    ];


}
