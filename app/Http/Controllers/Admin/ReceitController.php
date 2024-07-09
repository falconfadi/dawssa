<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Receit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use TCPDF;

class ReceitController  extends Controller
{
    public function store(Request $request)
    {
        $newReceit = new Receit();
        $newReceit ->order_id = $request->input('order_id');
        $newReceit ->type = $request->input('type');
        // Get the last receit
       $lastReceit = Receit::orderBy('serial_num', 'desc')->first();

        // Determine the serial_num
        $newReceit ->serial_num  = $lastReceit ? $lastReceit->serial_num + 1 : 100000000;


        if ($newReceit->save()) {
            Session::flash('alert-success', 'تمت إضافة الايصال بنجاح');
          //  $order = Order::find($receit ->order_id);

            $addedReceit = Receit::orderBy('serial_num', 'desc')->first();
        //    PrintReceit($addedReceit);
            $receitNew = Receit::with(['order.client'])->findOrFail($addedReceit->id);


            return $this->PrintReceit($addedReceit->id);
        } else {

            Session::flash('message', 'لم تتم إضافة الايصال ');
            return redirect('admin/orders');
        }
    }
    public function PrintReceit2( $id)
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

        $receit = Receit::with([
            'order.service.boxItems'
        ])->findOrFail($id);

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
            ['accountNumber' => '', 'totalAccountNumber' => '001', 'accountNames' => 'Expense 1', 'description' => 'Description 1', 'amount' => '100', 'number' => '1'],
            ['accountNumber' => '', 'totalAccountNumber' => '002', 'accountNames' => 'Expense 2', 'description' => 'Description 2', 'amount' => '200', 'number' => '2'],
            ['accountNumber' => '', 'totalAccountNumber' => '003', 'accountNames' => 'Expense 3', 'description' => 'Description 3', 'amount' => '300', 'number' => '3'],
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
    public function PrintReceit($id)
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

        $receit = Receit::with([
            'order.service.boxItems'
        ])->findOrFail($id);

        $data = [
            'title' => 'إيصال جديد',
            'receiptNumber' => $receit->serial_num,
            'customerName' => $receit->order->applicant_first_name . ' ' . $receit->order->applicant_father_name . ' ' . $receit->order->applicant_last_name,
            'phoneNumber' => $receit->order->mobile,
            'propertyType' => $receit->order->is_regular ? 'نظامي' : 'غير نظامي',
            'date' => date('d F Y', strtotime($receit->created_at)),
            'totalAmount' => $receit->order->service->boxItems->sum('price'),
        ];

        $expenses = [];
        foreach ($receit->order->service->boxItems as $boxItem) {
            $expenses[] = [
                'accountNumber' => '', // Assuming this is not available in the given data
                'totalAccountNumber' => $boxItem->id,
                'accountNames' => $boxItem->name,
                'description' => $boxItem->note,
                'amount' => $boxItem->price,
                'number' => $boxItem->pivot->service_id,
            ];
        }

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

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('documento.pdf', 'D');
    }

}
