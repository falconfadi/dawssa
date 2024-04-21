<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoxItem extends Model
{
    use HasFactory;

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_box_items', 'box_item_id', 'service_id')
            ->withPivot('from_date', 'to_date');
    }
}
