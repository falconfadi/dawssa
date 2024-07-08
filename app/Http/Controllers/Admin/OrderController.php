<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Faq;
use App\Models\Order;
use App\Models\orderDossier;
use App\Models\OrderEntry;
use App\Models\Service;
use App\Models\WaterMeter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Dompdf\Dompdf;
use Dompdf\Options;
use TCPDF;
use TCPDF_FONTS;
use Carbon\Carbon;



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
        if (strlen($search) > 0) {
            $data = Client::with('waterMeters')
                ->where('national_id', 'LIKE', "%{$search}%")
                ->get();
        }
        return response()->json($data);
    }

    public function index()
    {
        $title ='الطلبات';
        //$local =  session()->get('locale');
        $orders = Order::with('waterMeter')->get();
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
        if ($request->has('same_as_applicant')) {
            // Checkbox is enabled, take client data
            $order->applicant_first_name = $request->input('first_name');
            $order->applicant_last_name = $request->input('last_name');
            $order->applicant_father_name = $request->input('father_name');
            $order->applicant_national_id = $request->input('national_id');
        } else {
            // Checkbox is not enabled, take applicant data
            $order->applicant_first_name = $request->input('applicant_first_name');
            $order->applicant_last_name = $request->input('applicant_last_name');
            $order->applicant_father_name = $request->input('applicant_father_name');
            $order->applicant_national_id = $request->input('applicant_national_id');
        }

        $order->mobile = $request->input('phone');
        $order->client_id = $request->input('client_id');//$client->id;
        if ($request->has('water_meter_number')) {
            $waterMeterNumber = $request->input('water_meter_number');
            //var_dump($waterMeterNumber);exit();
            // Check if water meter with the provided number exists
            $waterMeter = WaterMeter::where('number', $waterMeterNumber)->first();

            // If water meter doesn't exist, create a new one
            if (!$waterMeter) {
                $waterMeter = new WaterMeter();
                $waterMeter->number = $waterMeterNumber;
                $client = Client::find($request->input('client_id'));
                $waterMeter->client()->associate($client);
                $waterMeter->save();
            }

            // Assign the water meter ID to the order
            $order->water_meter_id = $waterMeter->id;
        }
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
            'propertyType' => 'نظامي', 'date' => date('d F Y'), // Current date in Arabic format (e.g., 30 يونيو 2024)
            'totalAmount' => '600', // Replace with actual total amount
        ];
        // Dummy expenses array
        $expenses = [
            ['accountNumber' => '001', 'totalAccountNumber' => '001', 'accountNames' => 'Expense 1', 'description' => 'Description 1', 'amount' => '100', 'number' => '1'],
            ['accountNumber' => '002', 'totalAccountNumber' => '002', 'accountNames' => 'Expense 2', 'description' => 'Description 2', 'amount' => '200', 'number' => '2'],
            ['accountNumber' => '003', 'totalAccountNumber' => '003', 'accountNames' => 'Expense 3', 'description' => 'Description 3', 'amount' => '300', 'number' => '3'],
        ];
        $pdf->SetFont('aealarabiya', '', 12, '', true);

        $file = 'file.html';
        $html = file_get_contents($file);
        $html = str_replace('{title}', $data['title'], $html);
        $html = str_replace('{receiptNumber}', $data['receiptNumber'], $html);
        $html = str_replace('{customerName}', $data['customerName'], $html);
        $html = str_replace('{phoneNumber}', $data['phoneNumber'], $html);
        $html = str_replace('{propertyType}', $data['propertyType'], $html);
        $html = str_replace('{date}', $data['date'], $html);
        $html = str_replace('{totalAmount}', $data['totalAmount'], $html);
        $expenseHtml = '';
        foreach ($expenses as $expense) {
            $expenseHtml .= '<tr>';
            $expenseHtml .= '<td style="text-align: center; border: 1px solid #000000;">' . $expense['accountNumber'] . '</td>';
            $expenseHtml .= '<td style="text-align: center; border: 1px solid #000000;">' . $expense['totalAccountNumber'] . '</td>';
            $expenseHtml .= '<td style="text-align: center; border: 1px solid #000000;">' . $expense['accountNames'] . '</td>';
            $expenseHtml .= '<td style="text-align: center; border: 1px solid #000000;">' . $expense['description'] . '</td>';
            $expenseHtml .= '<td style="text-align: center; border: 1px solid #000000;">' . $expense['amount'] . '</td>';
            $expenseHtml .= '<td style="text-align: center; border: 1px solid #000000;">' . $expense['number'] . '</td>';
            $expenseHtml .= '</tr>';
        }
        $html = str_replace('<tr></tr>', $expenseHtml, $html);

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

       $orderDossiers =orderDossier ::where('order_id',$id)->get();
        $receitNumber = ($orderDossiers->first())?$orderDossiers->first()->receit_number:'';
        $daeertAlwaslText = ($orderDossiers->first())?$orderDossiers->first()->daeert_alwasl_text:'';


        $updatedAt =   Carbon::now();//Carbon::parse($orderDossiers->first()->updated_at)->toDateString();
        $client = $order->client;
        // echo $orderDossiers;

        return view('admin.orders.show',compact('id','title','entries','ordersEntries','receitNumber','daeertAlwaslText','updatedAt','client'));

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

        // Find an existing record with the given order_id
        $orderDossier = OrderDossier::where('order_id', $request->order_id)->first();

        // If the record exists, update the receit_number
        if ($orderDossier) {
            $orderDossier->receit_number = $request->number;
            $orderDossier->save();
            $message = "تم تحديث رقم وصل الصندوق";
        } else {
            // If the record doesn't exist, create a new one
            $orderDossier = new OrderDossier();
            $orderDossier->order_id = $request->order_id;
            $orderDossier->receit_number = $request->number;
            $orderDossier->save();
            $message = "تم إضافة رقم وصل الصندوق";
        }

        // Use the updated message in the flash message
        Session::flash('alert-success', $message);

        return redirect('admin/orders-profile/' . $request->order_id);


    }

    public function daeertAlwaslStore(Request $request){

        // Find an existing record with the given order_id
        $orderDossier = OrderDossier::where('order_id', $request->order_id)->first();

        // If the record exists, update the receit_number
        if ($orderDossier) {
            $orderDossier->daeert_alwasl_text = $request->daeertAlwasl;
            $orderDossier->save();
            $message = "تم تحديث دراسة دائرة الوصل";
        } else {
            // If the record doesn't exist, create a new one
            $orderDossier = new OrderDossier();
            $orderDossier->order_id = $request->order_id;
            $orderDossier->daeert_alwasl_text = $request->daeertAlwasl;
            $orderDossier->save();
            $message = "تم إضافة دراسة دائرة وصل";
        }

        // Use the updated message in the flash message
        Session::flash('alert-success', $message);

        return redirect('admin/orders-profile/' . $request->order_id);


    }

}
