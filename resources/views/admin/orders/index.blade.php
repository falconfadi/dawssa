@extends('layouts/admin')
@section('content')
    @if(Session::has('alert-success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="alert-body">
                {!! session('alert-success') !!}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b><?=$title?></b></h3>
                <div class="col-lg-4  float-left">
                    <div class="btn-group w-100">
                        <a class="btn btn-success col fileinput-button" href="{{url('admin/orders/create')}}">
                            <i class="fas fa-plus"></i>
                            <span>إضافة طلب </span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>المشترك</th>
                        <th>المتقدم</th> <!-- Added new column for the applicant -->
                        <th>التاريخ</th>
                        <th>نظامي\مخالفات</th>
                        <th>تحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($orders as $order){ ?>
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->client->first_name}} {{$order->client->father_name}} {{$order->client->last_name}}</td> <!-- Display complete client name -->
                        <td>{{$order->applicant_first_name}} {{$order->applicant_father_name}} {{$order->applicant_last_name}}</td> <!-- Display complete applicant name -->
                        <td>{{$order['created_at']}}</td>
                        <td>{{($order['is_regular']==0)?'نظامي':'مخالفات'}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default"></button>
                                <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a type="button" class="btn-sm" href="#">تعديل</a>
                                    <div class="dropdown-divider"></div>
                                    <a type="button" class="btn-sm" href="#">حذف</a>
                                    <div class="dropdown-divider"></div>
                                    <a type="button" class="btn-sm" href="#">تأكيد</a>
                                    <div class="dropdown-divider"></div>
                                    <a type="button" class="btn-sm" href="{{url('admin/orders-profile/'.$order->id)}}">بروفايل</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php $i++; }?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
