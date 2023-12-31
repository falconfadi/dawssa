<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{

    use HasFactory;use HasRoles;
    protected $guard = "admin";

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
