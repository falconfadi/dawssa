@extends('layouts/admin')
@push('select2-css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
@endpush
@section('content')
    <section class="content">
        <div class="container-fluid">
            @if(Session::has('alert-danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                        {!! session('alert-danger') !!}
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">

                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}} - {{$service->name}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{url('admin/service_entries/store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>نوع الخدمة</label>
                                            <select class="form-control select2" style="width: 100%;" name="entry_id">
                                                @foreach($entries as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="service_id" value="{{$service->id}}">


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
@endsection
@push('select2')
    <!-- Page specific script -->
    <script src="{{ asset('admin/plugins/select2/js/select2.min.js')}}"></script>

    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
@endpush
