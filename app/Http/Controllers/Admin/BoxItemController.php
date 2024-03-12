<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoxItem;
use Illuminate\Http\Request;

class BoxItemController extends Controller
{
    public function index()
    {
        $title ='بنود الدفع';

        $boxitems = BoxItem::all();
        return view('admin.box.box_items.index',compact('title','boxitems'));
    }
}
