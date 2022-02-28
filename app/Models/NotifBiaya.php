<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifBiaya extends Model
{
    use HasFactory;

    protected $table = "notif_biayas";
    protected $fillable = [
        'id_biaya',
        'id_user',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    
}
