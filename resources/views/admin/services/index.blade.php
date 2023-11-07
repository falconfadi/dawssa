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
                            <span>إضافة مشترك </span>
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
                        <th>اسم المشترك </th>
                        <th>الكنية</th>
                        <th>اسم الأب</th>
                        <th>الرقم الوطني</th>
                        <th>تحكم</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; foreach ($services as $service){
                    ?>
                    <tr>
                        <td><?=$service['id']?></td>
                        <td><?=$service['first_name']?></td>
                        <td><?=$service['last_name']?></td>
                        <td><?=$service['father_name']?></td>

                        <td><?=$service['national_id']?></td>


                        <td>

                            <a class="dropdown-item" href="#"><span class="badge bg-warning">تعديل</span></a>
                            <a class="dropdown-item" href="#"><span class="badge bg-primary">تأكيد</span></a>

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
