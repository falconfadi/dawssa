<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    const TYPE = [
        'REGULAR' => 0,
        'NOT_REGULAR' => 1,
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function entries()
    {
        return $this->belongsToMany(Entry::class,'order_entries','order_id','entry_id' );
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function waterMeter()
    {
        return $this->belongsTo(WaterMeter::class, 'water_meter_id');
    }
    public function receits()
    {
        return $this->hasMany(Receit::class,'order_id');
    }

}
