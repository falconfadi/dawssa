<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceEntryController extends Controller
{
    public function index($id)
    {
        $title ='مرفقات الخدمة';
        //$local =  session()->get('locale');
        $service = Service::find($id);
        $servicesEntries = $service->entries;
        return view('admin.services.entries.index',compact('title','servicesEntries','service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title ='إضافة مرفق';

        return view('admin.services.entries.create',compact('title'));
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
