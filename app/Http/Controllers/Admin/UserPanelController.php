<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserPanelController extends Controller
{
    public function index()
    {
        $title = "مستخدمي لوحة التحكم";
        $users = Admin::with('roles')->get();

        return view('admin.users_panel.index',compact('title','users'));
    }

    public function create_users_panel(){
        $title = "إضافة مستخدم";
        $perms = Permission::where('guard_name','admin')->get();
        $roles = Role::all();
        return view('admin.users_panel.create',compact('title','perms','roles'));
    }

    public function store(Request $request){
        $messages = [
            'email.unique' =>  'الرجاء التأكد من عدم تسجيل بريد الكتروني مسجل مسبقاً',
            'name.string' => 'الاسم يجب أن يكون سلسلة محارف '
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:admins',
        ],$messages);

        if ($validator->fails())
        {
           // var_dump($validator->errors()->getMessageBag());exit();
           // Session::flash('alert-danger',$validator->errors());
            return  redirect()->back()->withErrors(['الرجاء التأكد من عدم تسجيل بريد الكتروني مسجل مسبقا']);//redirect('admin/users_panel/create');
        }
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $user = Admin::create(array(
            /*'name' => $request->name,*/
            'email' => $request->email,
            'phone' => $request->phone,
            'password'=>Hash::make($request->password),
            'gender' => 1
        ));

       // $role_id = $request->role;
       // $role = Role::find($role_id);
        foreach($request->roles as $role){
            $role = Role::find($role);
            $user->assignRole($role);
        }


        Session::flash('alert-success','تم إضافة مستخدم جديد مع دوره');
        return redirect('admin/users_panel');
    }

    public function edit_users_panel($id){
        $title ='تعديل مستخدم لوحة التحكم';
        $user  = Admin::find($id);
        //$role  = $user->getRoleNames();
        // var_dump($role);exit();
        //if($role)
        //$rolee = Admin::role($role[0])->get();
        $userRolesIds = array();
        foreach($user->roles as $userRole){
            $userRolesIds[] = $userRole->id;
        }
        //$roleId = $user->roles->first()->id;
        $perms = Permission::where('guard_name','admin')->get();
        $roles = Role::all();
        return view('admin.users_panel.edit',compact('title','perms','roles','user','userRolesIds'));
    }

    public function update_users_panel(Request $request){
        $user = Admin::find($request->id);
        $messages = [
            'email.unique' =>  'الرجاء التأكد من عدم تسجيل بريد الكتروني مسجل مسبقاً',
            'name.string' => 'الاسم يجب أن يكون سلسلة محارف '
        ];
            $validator = Validator::make($request->all(), [
                'phone' =>'required',
                'name' => 'required|string',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('admins')->ignore($user->id)]

            ],$messages);
        //الرجاء التأكد من عدم تسجيل بريد الكتروني مسجل مسبقا
        if ($validator->fails())
        {
            return redirect('admin/users_panel/edit/'.$user->id)->withErrors($validator);
        }
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        //$password = ($request->password))
        $user ->update(array(

            'email' => $request->email,
            'phone' => $request->phone,
            /*'password'=>$password,*/
            'gender' => 1
        ));

        $user->roles()->detach();
        foreach($request->roles as $role){
            $role = Role::find($role);
            $user->assignRole($role);
        }
        /*
        $role_id = $request->role;
        $role = Role::find($role_id);
        $user->assignRole($role);
*/
        Session::flash('alert-success','تم تعديل مستخدم جديد مع دوره');
        return redirect('admin/users_panel');
    }

    public function destroy_users_panel($id)
    {

        $user = Admin::find($id);
        $user->roles()->detach();
        $res = $user->delete();
        //return back()->with('success','User deleted successfully');
        return redirect('admin/users_panel');
    }
}
