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
                        <form method="post" action="{{url('admin/roles/update')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group">

                                        <input hidden type="text" class="form-control" id="id" value="{{$role->id}} " name="id">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">الاسم</label>
                                            <input type="text" class="form-control" id="name" value="{{$role->name}} " name="name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_ar">الاسم (عربي)</label>
                                            <input type="text" class="form-control" id="name_ar" value="{{$role->name_ar}} " name="name_ar">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الصلاحيات</label>
                                        </div>
                                    </div>

                                    @for($i=0;$i<count($perms);$i++)
                                    <div class="col-md-4">
                                        <!-- checkbox -->
                                        <div class="form-group clearfix">
                                            <div class=" d-inline">
                                                <input type="checkbox" id="{{$perms[$i]->id}}" name="permissions[]" value="{{$perms[$i]->name}}"

                                                    {{ (in_array($perms[$i]->id,$rolePermissionsIds)) ? "checked" : "" }}
                                                >
                                                <label for="checkboxPrimary{{$i}}">
                                                   {{$perms[$i]->name_ar}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor


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
