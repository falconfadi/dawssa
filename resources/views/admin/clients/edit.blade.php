@extends('layouts/admin')
@section('content')
    <style>
        .font-white{
            color:#fff !important;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        @if(Session::has('alert-danger'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <div class="alert-body">
                                    {{session('alert-danger')}}
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <div class="alert-body">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="text-danger font-white">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{url('admin/clients/update')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الاسم</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{$client->first_name}}" name="first_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">اسم الأب</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{$client->father_name}}" name="father_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الكنية</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"  value="{{$client->last_name}}"  name="last_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">رقم الهاتف</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{$client->phone}}" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="national_id">الرقم الوطني</label>
                                            <input type="text" class="form-control" id="national_id" value="{{$client->national_id}}" name="national_id">
                                        </div>
                                    </div>
                                        <input type="hidden" name="client_id" value="{{$client['id']}}" >
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="customFile">تحميل صورة الهوية</label>

                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">تعديل</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
