<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    public function index()
    {
        $title ='المشتركين';
        //$local =  session()->get('locale');
        $clients = Client::all();
        return view('admin.clients.index',compact('title','clients'));
    }
    public function create()
    {
        $title ='إضافة مشترك';
        //$local =  session()->get('locale');
        return view('admin.clients.create',compact('title'));
    }

    public function store(Request $request)
    {

        $client = new Client();

        if ($client->save()) {
            Session::flash('alert-success',__('message.new_faqs_added'));
            return redirect('admin/faqs');
        } else {

            Session::flash('message',__('message.not_added'));
            return redirect('admin/faqs');
        }
    }
}
