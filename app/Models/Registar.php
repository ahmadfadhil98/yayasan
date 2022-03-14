<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registar extends Model
{
    use HasFactory;
    protected $table = "registars";
    protected $fillable = [
        'id_reg',
        'nama_pu',
        'no_daftar',
        'nama_jenis_daftar',
        'nama_jenis_usaha',
        'status_reg',
        'notif'
    ];
}
