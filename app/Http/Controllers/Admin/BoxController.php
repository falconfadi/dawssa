<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BoxController extends Controller
{
    public function index()
    {
        $title ='الصناديق';

        $boxes = Box::all();
        return view('admin.box.box.index',compact('title','boxes'));
    }
    public function create()
    {
        $title ='إضافة صندوق';
        //$local =  session()->get('locale');

        return view('admin.box.box.create',compact('title'));
    }

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
    }

}
