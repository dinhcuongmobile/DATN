<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KichCo extends Model
{
    use HasFactory;

    protected $table = 'kich_cos';

    protected $fillable = [
        'kich_co',
    ];
}
