<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


}
