<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $title ='الخدمات';
        //$local =  session()->get('locale');
        $services = Service::all();
        return view('admin.services.index',compact('title','services'));
    }
}
