<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title ='أسماء المؤسسات المرتبطة';
        //$local =  session()->get('locale');
        $organizations = Organization::all();
        return view('admin.box.organizations.index',compact('title','organizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ='إضافة مؤسسة';

         return view('admin.box.organizations.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $organization = new Organization();
        $organization->name = $request->input('name');


        if ($organization->save()) {
            Session::flash('alert-success', 'تمت إضافة المؤسسة بنجاح');
            return redirect('admin/organizations');
        } else {

            Session::flash('message', 'لم تتم إضافة المؤسسة ');
            return redirect('admin/organizations');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Oranization $oranization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'تعديل المؤسسة';
        $organization = Organization::find($id);
        return view('admin.box.organizations.edit',compact('title','organization'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Oranization $oranization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oranization $oranization)
    {
        //
    }
}
