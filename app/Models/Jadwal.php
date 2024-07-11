<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    protected $table = 'jadwal';


    protected $fillable = [
        'hari_jadwal',
        'buka_jadwal',
        'tutup_jadwal',
        'user_id',
    ];

}
