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
                        <a class="btn btn-success col fileinput-button" href="{{url('admin/services/create')}}">
                            <i class="fas fa-plus"></i>
                            <span>إضافة خدمة </span>
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
                        <th>الاسم  </th>
                        <th>تحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=0; @endphp
                    @foreach ($services as $service)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$service->name}}</td>

                        <td>

                            <a class="dropdown-item" href="#"><span class="badge bg-warning">تعديل</span></a>
                            <a class="dropdown-item" href="#"><span class="badge bg-primary">تأكيد</span></a>

                        </td>
                    </tr>
                    @php  $i++; @endphp
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
