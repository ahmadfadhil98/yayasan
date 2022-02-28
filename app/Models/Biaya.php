<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;
    protected $table = "biayas";
    protected $fillable = [
        'id_biaya',
        'id_reg',
        'keterangan',
        'qty',
        'harga',
        'total'
    ];
}
