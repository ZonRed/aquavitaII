<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'Jadwal';


    protected $fillable = [
        'hari_jadwal',
        'buka_jadwal',
        'tutup_jadwal'
    ];

}
