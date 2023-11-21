<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function entries()
    {
        return $this->belongsToMany(Entry::class,'service_entries','service_id','entry_id' );
    }
}
