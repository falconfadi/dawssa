<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $title ='الخدمات';
        //$local =  session()->get('locale');
        $services = Service::with('boxItems')->get();
        return view('admin.services.index',compact('title','services'));
    }

    public function create()
    {
        $title ='إضافة خدمة';
        //$local =  session()->get('locale');
        $cServices = Service::all();
        return view('admin.services.create',compact('title'));
    }
}
