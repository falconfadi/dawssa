<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\BoxItem;
use App\Models\Organization;
use Illuminate\Http\Request;

class BoxItemController extends Controller
{
    public function index()
    {
        $title ='بنود الدفع';

        $boxitems = BoxItem::all();
        return view('admin.box.box_items.index',compact('title','boxitems'));
    }
    public function create()
    {
        $title ='إضافة بند دفع';
        $organizations = Organization::all();
        return view('admin.box.box_items.create',compact('title','organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $boxItem = new BoxItem();
        $boxItem->name = $request->input('name');
        $boxItem->price = $request->input('price');
        $boxItem->organization_id = $request->input('organization_id');
        $boxItem->note = $request->input('note');


        if ($boxItem->save()) {
            Session::flash('alert-success', 'تمت إضافة بند الدفع بنجاح');
            return redirect('admin/box_items');
        } else {

            Session::flash('message', 'لم تتم إضافة بند الدفع ');
            return redirect('admin/box_items');
        }
    }

}
