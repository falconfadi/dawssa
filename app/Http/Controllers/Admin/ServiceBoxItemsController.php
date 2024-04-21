<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\ServiceBoxItem;
use App\Models\Service;
use App\Models\BoxItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServiceBoxItemsController extends Controller
{
    public function index( $serviceId)
    {
        $title ='بنود الدفع الخاصة بالخدمة';

        $serviceBoxItems = ServiceBoxItem::where('Service_id', $serviceId)
            ->with('boxItem') // Load the associated BoxItem
            ->get();

        // Returning the serviceBoxItems with associated BoxItem names
    ///  dd($serviceBoxItems->boxItems);

return view('admin.box.service_box_items.index',compact('title','serviceBoxItems','serviceId'));
    }
    public function create($serviceId )
    {
        $service = Service::findOrFail($serviceId);

        // Retrieve all BoxItems and check if each one is related to the service
        $boxItems = BoxItem::all()->map(function ($boxItem) use ($service) {
            $isRelated = $service->boxItems->contains('id', $boxItem->id);
            $boxItem->setAttribute('is_related_to_service', $isRelated);
            return $boxItem;
        });

        return response()->json($boxItems);

    }
/*
    public function store(Request $request)
    {


        $box = new Box();
        $box->name = $request->input('name');


        if ($box->save()) {
            Session::flash('alert-success','تمت إضافة المشترك بنجاح');
            return redirect('admin/boxes');
        } else {

            Session::flash('message','لم تتم إضافة المشترك ');
            return redirect('admin/boxes');
        }
    }*/

}
