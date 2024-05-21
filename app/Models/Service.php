<?php

namespace App\Models;

use App\Http\Controllers\Admin\ServiceBoxItemsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function entries()
    {
        return $this->belongsToMany(Entry::class,'service_entries','service_id','entry_id' );
    }

    public function boxItems()
    {
        return $this->belongsToMany(BoxItem::class, 'service_box_items', 'service_id', 'box_item_id')
            ->withPivot('from_date', 'to_date');;

    }
}
