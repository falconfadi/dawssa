<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserPanelController extends Controller
{
    public function users_panel()
    {
        $title = "مستخدمي لوحة التحكم";
        $users = Admin::all();
        return view('admin.users_panel.index',compact('title','users'));
    }

    public function create_users_panel(){
        $title = "إضافة مستخدم";
        $perms = Permission::where('guard_name','admin')->get();
        $roles = Role::all();
        return view('admin.users_panel.create',compact('title','perms','roles'));
    }
}
