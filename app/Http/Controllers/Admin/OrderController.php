<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $title ='الطلبات';
        $local =  session()->get('locale');

        return view('admin.orders.index',compact('title'));
    }
}
