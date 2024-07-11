<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promo extends Model
{
    protected $table = 'promo';


    protected $fillable = [
        'tanggal_mulai_promo',
        'tanggal_akhir_promo',
        'code_promo',
        'type_promo',
        'info_promo',
        'harga_promo',
        'user_id',
    ];

}
