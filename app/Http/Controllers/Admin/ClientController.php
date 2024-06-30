<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

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

        //$client = new Client();
      /*  $client = Client::create([ 'first_name' => $request->first_name ,'last_name' => $request->last_name,
            'father_name' => $request->father_name ,'national_id' => $request->national_id]);
*/
        $messages = [
            'national_id.unique' =>  'الرجاء التأكد من عدم تسجيل رقم وطني مسجل مسبقاً',
            'first_name.string' => 'الاسم يجب أن يكون سلسلة محارف ',
            'last_name.string' => 'الكنية يجب أن تكون سلسلة محارف ',
            'father_name.string' => 'اسم الأب يجب أن يكون سلسلة محارف ',
            'phone.required' => 'رقم الهاتف مطلوب ',
            'first_name.required' => 'الاسم مطلوب ',
            'last_name.required' => 'الكنية مطلوبة ',
            'father_name.required' => 'اسم الأب مطلوب ',
            'national_id.required' => 'الرقم الوطني مطلوب',
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'father_name' => 'required|string',
            'phone' => 'required',

            'national_id' => [
                'required',
                Rule::unique('clients')->ignore($request->id)]

        ],$messages);
        if ($validator->fails())
        {
           return redirect('admin/clients/create')->withErrors($validator);
        }
        $client = new Client();
        $client->first_name = $request->input('first_name');
        $client->last_name = $request->input('last_name');
        $client->father_name = $request->input('father_name');
       // $client->father_name = $request->input('father_name');
        $client->national_id = $request->input('national_id');

        if ($client->save()) {
            Session::flash('alert-success','تمت إضافة المشترك بنجاح');
            return redirect('admin/clients');
        } else {

            Session::flash('message','لم تتم إضافة المشترك ');
            return redirect('admin/clients');
        }
    }

    public function edit($id)
    {
        $title ='تعديل مشترك';
        $client = Client::find($id);
        return view('admin.clients.edit',compact('title','client'));
    }

    public function update(Request $request){
        $client = Client::find($request->client_id);
        if($client){
            $client ->update(array(

                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'father_name' => $request->father_name,
                'phone'       => $request->phone ?? '',
                'national_id' => $request->national_id,
                'gender' => 1
            ));
            Session::flash('alert-success','تم تعديل مشترك جديد');
            return redirect('admin/clients');

        }


    }
}
