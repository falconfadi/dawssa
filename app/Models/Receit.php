<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receit extends Model
{
    use HasFactory;


    public function Order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function Box()
    {
        return $this->belongsTo(Box::class, 'box_id');
    }
}
