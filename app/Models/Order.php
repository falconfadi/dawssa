<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

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


}
