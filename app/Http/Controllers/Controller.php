<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    protected $isAdmin;
    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            //get the role of user is he is super admin or not
            $xx = (Auth::guard('admin')->user())?Auth::guard('admin')->user()->hasRole('Super-Admin'):false;
            $this->isAdmin = $xx;
            View::share('isAdmin', $xx);

            //get permissions for user and share them for blade files
            if(Auth::guard('admin')->check()) {
                $permissionsNames = array();
                $permissions = Auth::guard('admin')->user()->getAllPermissions();
                foreach ($permissions as $p) {
                    $permissionsNames[] = $p->name;
                }
                View::share('permissionsNames', $permissionsNames);
            }

            return $next($request);
        });
    }
    use AuthorizesRequests, ValidatesRequests;
}
