@extends('layouts/admin')
@section('content')

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Advanced form elements</title>
        <link rel="stylesheet" href="{{ url('admin/plugins/select2/css/select2.min.css') }}">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        /* border-color: #006fe6; */
        color: #fff;
        padding: 0 10px;
        margin-top: .31rem;
    }
</style>
    </head>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{url('admin/clients/store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الاسم</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=" " name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الهاتف</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=" " name="number">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" id="email" placeholder=" "  name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> كلمة المرور</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder=" " name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="national_id">تاكيد كلمة المرور </label>
                                            <input type="password" class="form-control" id="password_confirmation" placeholder=" " name="password_confirmation">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="roles">الأدوار</label>

                                            <select class="js-example-basic-multiple form-control" name="roles" multiple="multiple" id="roles">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">إدخال</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    </div>
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('admin/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('admin/plugins/dropzone/min/dropzone.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/dist/js/demo.js')}}"></script>
    <!-- Page specific script -->
    <script src="{{ asset('admin/plugins/select2/js/select2.min.js')}}"></script>



    <script>

        jQuery(document).ready(function($) {
            $('.js-example-basic-multiple').select2();
        });
        // DropzoneJS Demo Code End
    </script>
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>


@endsection
