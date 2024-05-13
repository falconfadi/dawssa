<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function waterMeters()
    {
    //    return $this->belongsToMany(WaterMeter::class,'water_meters','id','user_id' );
        return $this->hasMany(WaterMeter::class,'user_id');

    }
}
