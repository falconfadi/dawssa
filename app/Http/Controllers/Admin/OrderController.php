<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $title ='الطلبات';
        //$local =  session()->get('locale');
        $orders = Order::all();
        return view('admin.orders.index',compact('title','orders'));
    }

    public function create()
    {
        $title ='إضافة طلب';
        //$local =  session()->get('locale');
        $cServices = Service::all();
        return view('admin.orders.create',compact('title','cServices'));
    }

    public function store(Request $request)
    {
        $serviceId = $request->input('service_id');
        $service = Service::with('entries')->first();
        var_dump($service->entries); exit();
        $order = new Order();

        if ($order->save()) {
            Session::flash('alert-success',__('message.new_faqs_added'));
            return redirect('admin/faqs');
        } else {

            Session::flash('message',__('message.not_added'));
            return redirect('admin/faqs');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $title = __('label.edit_faq');
        $faq = Faq::find($id);
        //var_dump($cars);
        return view('admin.faqs.edit',compact('faq','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateoffersRequest  $request
     * @param  \App\Models\offers  $offers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $faq = Faq::find($request->id);

        $faq->arabic_question = $request->input('arabic_question');
        $faq->arabic_answer = $request->input('arabic_answer');
        $faq->english_question = $request->input('english_question');
        $faq->english_answer = $request->input('english_answer');

        if ($faq->update()) {
            //$request->session()->flash('alert-success', __('Setting has been Edited'));
            Session::flash('alert-success',__('message.faq_edited'));
            return redirect('admin/faqs/');
        } else {
            Session::flash('alert-success',__('message.not_edited'));
            return redirect('admin/faqs/');
        }
    }
}
