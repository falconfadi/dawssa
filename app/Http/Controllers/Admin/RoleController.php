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

class RoleController extends Controller
{
    protected $typesSize = 12;
    public $types = array();
    public function __construct()
    {
        parent::__construct();
       $this->types =  array('1'=>__('label.add'),
            '2'=>__('page.Edit'),
            '3'=>__('page.Delete'),
            '4'=>__('page.View'),
            '5'=>__('label.print'),
            '6'=>__('page.Freeze'),
            '7'=>__('label.change_password'),
            '8'=>__('label.final_delete'),
            '9'=>__('label.add_note'),
            '10'=>__('page.Verify'),
           '11'=>__('label.send'),
           '12'=>__('label.renew_balance'),'13'=>__('page.Search'),'14'=>__('label.delete_token'));
//        App::setLocale('ar');
//        session()->put('locale', 'ar');
    }
    public function index()
    {
        $title = "الأدوار";
        $roles = Role::all();
        //var_dump($roles);exit();
       // echo $this->id."==";
        return view('admin.roles.index',compact('title','roles'));
    }

    public function create(){
        $title = "إضافة دور";
        $perms = Permission::where('guard_name','admin')->get();
        //$groups = Permission::where('guard_name','admin')->where('main_group',1)->get();
        $permissionsTable = array();
        $types = $this->types;

//        foreach($perms as $permission)
//        {
//            for($i=1;$i<=$this->typesSize;$i++){
//                if($permission->type==$i ){
//                    $permissionsTable[$permission->group_id][$i] = $permission;
//                }
//            }
//        }

        //return view('admin.roles.create',compact('title','perms','groups', 'permissionsTable','types'));
        return view('admin.roles.create',compact('title', 'permissionsTable','perms'));
    }
    public function store(Request $request){
        //var_dump($request->all());

        $role = Role::create(['guard_name' => 'admin', 'name' => $request->name ,'name_ar' => $request->name_ar]);
        $permissions = $request->permissions;
        for($i=0;$i<count($permissions);$i++){
            //assign $permissions to role by name
            $role->givePermissionTo($permissions[$i]);
        }
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Session::flash('alert-success','تم إضافة دور جديد مع الصلاحيات');
        return redirect('admin/roles');
    }
    public function edit($id)
    {
        //1 add ,2 edit ,3 delete, 4 view, 5 print, 6 freeze, 7 change password , 8 final delete , 9 add note, 10 verify, 11 send (notification , sms), 12 renew balance
        $title = "تعديل الدور";
        $role = Role::where('guard_name','admin')->where('id',$id)->first();
        $perms = Permission::where('guard_name','admin')->get();

        $rolePermissionsIds = $role->permissions->pluck('id')->toArray();
        //var_dump($rolePermissionsIds);exit();
//        $groups = Permission::where('guard_name','admin')->where('main_group',1)->get();
//        $permissionsTable = array();
//        $types = $this->types;
//        foreach($perms as $permission)
//        {
//            for($i=1;$i<=count($types);$i++){
//                if($permission->type==$i ){
//                    $permissionsTable[$permission->group_id][$i] = $permission;
//                }
//            }
//        }
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        return view('admin.roles.edit',compact('title','role','perms','rolePermissionsIds'/*,'groups','permissionsTable','types'*/));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car_model  $car_model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //var_dump($request->id);exit();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $role = Role::findById($request->id);
        $role->name = $request->name;
        $role->save();
        $permissions = $request->permissions;
        $role->permissions()->detach();
        for($i=0;$i<count($permissions);$i++){
            //assign $permissions to role by name
           $role->givePermissionTo($permissions[$i]);
        }
        //return redirect('admin/roles');
        Session::flash('alert-success',__('message.Role_Edited'));
        return redirect('admin/roles');

    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if($role )
        {
            $role->delete();
        }
        return back()->with('success','Role deleted successfully');
    }




    public  function test(){
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create a manager role for users authenticating with the admin guard:
//        $role = Role::create(['guard_name' => 'admin', 'name' => 'manager']);
//        // Define a `publish articles` permission for the admin users belonging to the admin guard
//        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'users']);

//        // create roles and assign existing permissions
//        $role1 = Role::create(['name' => 'writer']);
//        $role1->givePermissionTo('edit articles');
//        $role1->givePermissionTo('delete articles');
//
//        $role2 = Role::create(['name' => 'admin']);
//        $role2->givePermissionTo('publish articles');
//        $role2->givePermissionTo('unpublish articles');

//        $role3 = Role::create(['guard_name' => 'admin', 'name' => 'Super-Admin']);
//        // gets all permissions via Gate::before rule; see AuthServiceProvider
//        $user = Admin::find(2);
//        $user->assignRole($role3);


//
   //   $permission = Permission::create(['guard_name' => 'admin', 'name' => 'edit_border','name_ar' => 'تعديل منطقة متاحة']);
////        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'verify_driver','name_ar' => 'تأكيد كابتن']);
////        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'freeze_user','name_ar' => 'تجميد عميل']);
////        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'change_password_user','name_ar' => 'تغيير كلمة السر عميل']);
   //    $permission = Permission::create(['guard_name' => 'admin', 'name' => 'delete_complaint','name_ar' => 'حذف شكوى']);
////        $permission = Permission::create(['guard_name' => 'admin', 'name' => 'ultimate_delete_user','name_ar' => 'حذف نهائي عميل']);
        //$permission = Permission::create(['guard_name' => 'admin', 'name' => 'add_border','name_ar' => 'إضافة منطقة متاحة']);
      //  $permission = Permission::create(['guard_name' => 'admin', 'name' => 'print_complaint','name_ar' => 'طباعة شكوى']);
     //     $permission = Permission::create(['guard_name' => 'admin', 'name' => 'view_slider','name_ar' => 'عرض سلايدر']);
            $permission = Permission::create(['guard_name' => 'admin', 'name' => 'edit_who_we_are','name_ar' => 'تعديل من نحن ']);


        // create demo users
//        $user = \App\Models\Admin::factory()->create([
//            'name' => 'manager_user',
//            'email' => 'test@example.com',
//        ]);
//        $user->assignRole($role3);
//
//        $user = \App\Models\User::factory()->create([
//            'name' => 'Example Admin User',
//            'email' => 'admin@example.com',
//        ]);
//        $user->assignRole($role2);
//
//        $user = \App\Models\User::factory()->create([
//            'name' => 'Example Super-Admin User',
//            'email' => 'superadmin@example.com',
//        ]);
//        $user->assignRole($role3);
        //$user = Admin::find(11);
        //$user->assignRole(["company-admin"]);
    }
}
