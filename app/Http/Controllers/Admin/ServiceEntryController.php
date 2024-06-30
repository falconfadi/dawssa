<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\Organization;
use App\Models\Service;
use App\Models\ServiceEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ServiceEntryController extends Controller
{
    public function index($id)
    {
        $title ='مرفقات الخدمة';
        App::setLocale('ar');
        $service = Service::find($id);
        $servicesEntries = $service->entries;
        return view('admin.services.entries.index',compact('title','servicesEntries','service'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($serviceId)
    {
        $title ='إضافة مرفق';
        $service = Service::find($serviceId);
        $entries = Entry::all();
        return view('admin.services.entries.create',compact('title','service','entries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$organization->name = $request->input('name');
        $service = Service::find($request->service_id);
        $serviceEntry = $service->entries()->where('entry_id', $request->entry_id)->first();
        //var_dump($r->id);exit();
        if($serviceEntry){
            Session::flash('alert-danger', 'المرفق موجود مسبقاً');
            return redirect()->back();
        }
        $service->entries()->attach($request->entry_id);


        Session::flash('alert-success', 'تمت إضافة مرفق للخدمة');
        return redirect('admin/service_entries/'.$request->service_id);
//            Session::flash('message', 'لم تتم إضافة المؤسسة ');
//            return redirect('admin/organizations');

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
    public function destroy($serviceEntryId)
    {
        //var_dump($serviceEntryId);exit();
        $res = ServiceEntry::find($serviceEntryId)->delete();

        return back()->with('alert-success','Faq deleted successfully');

    }
}
