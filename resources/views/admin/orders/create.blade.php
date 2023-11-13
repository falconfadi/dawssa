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
                        <form method="post" action="{{url('admin/orders/store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الاسم</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=" " name="first_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">اسم الأب</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=" " name="father_name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الكنية</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=" "  name="last_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">رقم الهاتف</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder=" " name="phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="national_id">الرقم الوطني</label>
                                            <input type="text" class="form-control" id="national_id" placeholder=" " name="national_id">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>نظامي\مخالفات</label>
                                            <select class="form-control " style="width: 100%;" name="is_regular">
                                                <option value="0" >نظامي</option>
                                                <option value="1" >مخالفات</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>نوع الخدمة</label>
                                            <select class="form-control select2" style="width: 100%;" name="service_id">
                                                <?php foreach ($cServices as $service){ ?>
                                                <option value="{{$service->id}}" > <?=$service->name?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

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
                                <button type="submit" class="btn btn-primary">إدخال</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
