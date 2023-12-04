@extends('layouts/admin')
@section('content')


    <div class="col-12">
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><b><?=$title?></b></h3>
                <div class="col-lg-4  float-left">
                    <div class="btn-group w-100">
                        <a class="btn btn-success col fileinput-button" href="{{url('admin/roles/create')}}">
                            <i class="fas fa-plus"></i>
                            <span>إضافة دور </span>
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
                        <th>اسم  الدور</th>
                        <th>تحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=0; @endphp
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default"></button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a type="button" class="btn-sm" href="{{url('admin/roles/edit/'.$role->id)}}">تعديل</a>
                                        <div class="dropdown-divider"></div>
                                        <a type="button" class="btn-sm" href="#">حذف</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @php $i++; @endphp
                    </tbody>
                    <tfoot>
                    <tr>
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
