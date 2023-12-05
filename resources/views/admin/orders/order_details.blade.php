@extends('layouts/admin')
@section('content')
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
                        <form method="post" action="{{url('admin/order-details-store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    {!! $formContent !!}
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <input value="{{$id}}" type="hidden" name="id">
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
