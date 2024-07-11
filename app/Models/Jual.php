<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jual extends Model
{
    protected $table = 'jual';


    protected $fillable = [
        'tanggal_jual',
        'code_jual',
        'type_jual',
        'harga_jual',
        'stock_jual',
        'jumlah_jual',
        'user_id',
    ];

}
