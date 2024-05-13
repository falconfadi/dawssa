<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterMeter extends Model
{
    public function client()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }
    public function waterMeters()
    {
        return $this->belongsToMany(Order::class,'orders','id','water_meter_id' );
    }
}

