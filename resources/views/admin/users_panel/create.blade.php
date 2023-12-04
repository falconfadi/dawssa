@extends('layouts/admin')
@section('content')
        <link rel="stylesheet" href="{{ url('admin/plugins/select2/css/select2.min.css') }}">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff;
        /* border-color: #006fe6; */
        color: #fff;
        padding: 0 10px;
        margin-top: .31rem;
    }
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
                        <form method="post" action="{{url('admin/users_panel/store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">الاسم</label>
                                            <input type="text" class="form-control" id="name" placeholder=" " name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">الهاتف</label>
                                            <input type="text" class="form-control" id="phone" placeholder=" " name="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">البريد الإلكتروني</label>
                                            <input type="email" class="form-control" id="email" placeholder=" "  name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password"> كلمة المرور</label>
                                            <input type="password" class="form-control" id="password"  placeholder=" " name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">تأكيد كلمة المرور </label>
                                            <input type="password" class="form-control" id="password_confirmation" placeholder=" " name="password_confirmation">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="roles">الأدوار</label>
                                            <select class="js-example-basic-multiple form-control" name="roles[]" multiple="multiple" id="roles">
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
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




@endsection
@push('select2')
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
@endpush
