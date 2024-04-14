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
                        <form method="post" action="{{url('admin/box_items/store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الاسم</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=" " name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">السعر</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=" " name="price">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>اسم المؤسسة</label>
                                            <select class="form-control select2" style="width: 100%;" name="organization_id">
                                                <?php foreach ($organizations as $organization){ ?>
                                                <option value="{{$organization->id}}" > <?=$organization->name?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                </div> <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">ملاحظة</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=" " name="note">
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
