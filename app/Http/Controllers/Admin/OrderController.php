<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Faq;
use App\Models\Order;
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
        $client = new Client();
        $client->first_name = $request->input('first_name');
        $client->last_name = $request->input('last_name');
        $client->father_name = $request->input('father_name');
        $client->national_id = $request->input('national_id');
        $client->save();

        $order = new Order();
        $order->is_regular = $request->input('is_regular');
        $order->service_id = $request->input('service_id');
        $order->mobile = $request->input('phone');
        $order->client_id = $client->id;
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
        $service = Service::with('entries')->find($order->service_id);
        //var_dump($service->entries);exit();
        $formContent = '';
        $entriesCont = new EntryController();
        foreach($service->entries as $entry){

            $entry = $entriesCont->entries[$entry->id];
            $formContent .= $entriesCont->$entry();
       //     echo $entry->id."-";exit();
        }
        return view('admin.orders.order_details',compact('formContent','title'));
       // echo $id;
    }
    public function PrintOrder()
    {
/*
        $data = [
            'title' => 'إيصال جديد',
            'receiptNumber' => '123456',
            'customerName' => 'محمد محمد',
            'phoneNumber' => '123-456-7890',
            'propertyType' => 'نظامي',
        ];
        $options = new Options();
        $options->set('defaultFont', 'Arial'); // Set a font that supports Arabic characters
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);



        $html = view('admin.pdf.document', $data)->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4');
        $dompdf->render();
        return $dompdf->stream('document.pdf');

*/
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
        $pdf->writeHTML($html, true, false, true, false, '',);

        $pdf->Output('documento.pdf', 'I');
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
