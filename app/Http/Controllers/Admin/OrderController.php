<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Faq;
use App\Models\Order;
use App\Models\orderDossier;
use App\Models\OrderEntry;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;
use Dompdf\Options;
use TCPDF;
use TCPDF_FONTS;


class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function autocomplete(Request $request)
    {
        $search = $request->get('national_id');
        $data = array();
        if (strlen($search)>0){
            $data = Client::where('national_id', 'LIKE',   "%{$search}%")->get();

        }
        return response()->json($data);
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

        $order = new Order();
        $order->is_regular = $request->input('is_regular');
        $order->service_id = $request->input('service_id');
        $order->mobile = $request->input('phone');
        $order->client_id = $request->input('client_id');//$client->id;
        if ($order->save()) {
            Session::flash('alert-success',__('message.new_faqs_added'));
            return redirect('admin/order-details/'.$order->id);
        } else {
            Session::flash('message',__('message.not_added'));
            return redirect('admin/order-details/'.$order->id);
        }
    }

    public function OrderDetails($id){
        $title = 'تفاصيل الطلب';
        $order = Order::find($id);
   //     $service = Service::with('entries')->find($order->service_id);
        $service = Service::with(['entries' => function ($query) use ($order) {
            $query->where('is_regular', $order->is_regular);
        }])->find($order->service_id);
        //var_dump($service->entries);exit();
        $formContent = '';
        $entriesContr = new EntryController();
        foreach($service->entries as $entry){

            $entryStr = $entriesContr->entries[$entry->id];
            $formContent .= $entriesContr->$entryStr();
       //     echo $entry->id."-";exit();
        }
        return view('admin.orders.order_details',compact('formContent','title','id'));
       // echo $id;
    }

    public function OrderDetailsStore(Request $request){
        $orderId = $request->id;
      //  echo $id;echo "<br>";
        $entryValues = $request->except('_method', '_token','id');
        foreach ($entryValues as $key=>$entryValue){
            $orderEntry = new OrderEntry();
            $orderEntry->order_id = $orderId;
            $orderEntry->entry_id = substr($key, 1); //$orderId;

            $file = $request->file($key);
            $file_name = 'entries/' . md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension();
            if ($file->move('storage/entries/', $file_name)) {
                $orderEntry->value = $file_name;
            }
            $orderEntry->save();
        }
        Session::flash('alert-success',"تم إضافة طلب جديد");
        return redirect('admin/orders/');

    }

    public function PrintOrder()
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Document Title');
        $pdf->SetSubject('Document Subject');
        $pdf->SetKeywords('Keywords');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

// Set the Arial font for Arabic text
        $data = [
            'title' => 'إيصال جديد',
            'receiptNumber' => '123456',
            'customerName' => 'محمد محمد',
            'phoneNumber' => '123-456-7890',
            'propertyType' => 'نظامي',
        ];
        $pdf->SetFont('aealarabiya', '', 12, '', true);

        $file = 'file.html';
        $html = file_get_contents($file);
        $html = str_replace('{title}', $data['title'], $html);
        $html = str_replace('{receiptNumber}', $data['receiptNumber'], $html);
        $html = str_replace('{customerName}', $data['customerName'], $html);
        $html = str_replace('{phoneNumber}', $data['phoneNumber'], $html);
        $html = str_replace('{propertyType}', $data['propertyType'], $html);

        $pdf->writeHTML($html, true, false, true, false, '',);

        $pdf->Output('documento.pdf', 'D');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $title = 'بروفايل الطلب';
        $order = Order::find($id);
        $ordersEntries = OrderEntry::where('order_id',$id)->get();
        //echo "<pre>";
       $entries = $order->entries;
        //echo "</pre>";
        //var_dump($cars);
        return view('admin.orders.show',compact('id','title','entries','ordersEntries'));

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

    public function receitNumberStore(Request $request){

        $orderDossier = new orderDossier();
        $orderDossier->order_id =  $request->order_id;
        $orderDossier->receit_number = $request->number;
        $orderDossier->save();

        Session::flash('alert-success',"تم إضافة رقم وصل الصندوق");
        return redirect('admin/orders-profile/'.$request->order_id);

    }

}
