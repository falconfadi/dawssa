@extends('layouts/admin')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">

                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none" id="errormsgdiv">
                        <div class="alert-body">

                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                        </div>


                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{url('admin/orders/store')}}" enctype="multipart/form-data" onsubmit="return checkValidations()">
                            @csrf


                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="first_name">اسم مالك العداد</label>
                                            <input type="text" class="form-control" id="first_name" placeholder=" " name="first_name" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="father_name">اسم الأب</label>
                                            <input type="text" class="form-control" id="father_name" placeholder=" " name="father_name" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="last_name">الكنية</label>
                                            <input type="text" class="form-control" id="last_name" placeholder=" "  name="last_name" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="applicant_last_name">رقم العداد</label>
                                            <input type="text" class="form-control" id="water_meter_number" placeholder=" " name="water_meter_number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="national_id">ابحث بحسب الرقم الوطني</label>
                                            <input class="typeahead form-control" id="search" name="search" type="text">
    {{--                                        <select id="predictions" ></select>--}}
                                            <input class="typeahead form-control" id="token" name="token" type="hidden" value="{{ csrf_token() }}">
                                            <input type="hidden" id="client_id" name="client_id" >
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="padding-top: 35px" >
                                        <div class="form-group" style="display: none" id="add_link">
                                            <a href="{{url('admin/clients/create')}}"  target="__blank">إضافة مشترك جديد</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="same_as_applicant">صاحب العداد هو نفسه مالك العداد </label><br>
                                            <input type="checkbox" id="same_as_applicant" name="same_as_applicant" onclick="handleCheckbox(this)" checked>
                                        </div>
                                    </div>
                                    <div id="applicant_info" style="display:none">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="applicant_first_name">اسم المتقدم</label>
                                                <input type="text" class="form-control" id="applicant_first_name" placeholder=" " name="applicant_first_name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="applicant_father_name">اسم الأب</label>
                                                <input type="text" class="form-control" id="applicant_father_name" placeholder=" " name="applicant_father_name">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="applicant_last_name">الكنية</label>
                                                <input type="text" class="form-control" id="applicant_last_name" placeholder=" " name="applicant_last_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="applicant_national_id">الرقم الوطني</label>
                                                <input type="text" class="form-control" id="applicant_national_id" placeholder=" " name="applicant_national_id">
                                            </div>
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
    @push('ajax')
        <script type="application/javascript">
            $(document).ready(function() {

                $('input[name="search"]').keyup(function() {

                    if($("#search").val().length>=11){
                        console.log($(this).length);
                        var nationalId = $(this).val();
                        var token = $("#token").val();
                        $.ajax({
                            url: '{{url("admin/orders/autocomplete")}}',
                            type: 'get',
                            data: { _token: token, national_id: nationalId },
                            success: function(response) {
                                var dropdown = $('#predictions');
                                dropdown.empty();

                                if (response.length > 0) {
                                    $.each(response, function(key, value) {
                                        // dropdown.append($('<option></option>').attr('value', value.id).text(value.first_name + ' ' + value.last_name));
                                        $("#add_link").hide();
                                        $("#first_name").val(value.first_name);
                                        $("#father_name").val(value.father_name);
                                        $("#last_name").val(value.last_name);
                                        $("#client_id").val(value.id);
// Get the last water meter number
                                        var waterMeters = value.water_meters;
                                        if (waterMeters.length > 0) {
                                            var lastWaterMeter = waterMeters[waterMeters.length - 1];
                                            $("#water_meter_number").val(lastWaterMeter.number);

                                        } else {
                                            $("#water_meter_number").val('');
                                        }
                                    });

                                } else {
                                    $("#add_link").show();
                                    $("#first_name").val('');
                                    $("#father_name").val('');
                                    $("#last_name").val('');
                                    //dropdown.append($('<option disabled selected>No predictions found</option>'));
                                }
                            }
                        });
                    }
                });
            });
        </script>
    @endpush


@endsection
@push('form_validation')
    <script type="text/javascript">
        function checkValidations()
        {
            //alert(document.getElementById('starttime').value);
            var x = true;
             first_name = document.getElementById('first_name').value;
            // start_time = document.getElementById('start_time').value;
            //
            // errormsgdiv = document.getElementById('errormsgdiv');
            // errormsgdiv.innerHTML = "";

            if( first_name== '' /*|| title_en == '*/)
            {
                errormsgdiv.style.display = "block";
                errormsgdiv.innerHTML='<div class="alert-body"> حقل الاسم مطلوب </div>';
                x = false;
            }
            // givenDate = new Date(end_time).setHours(0,0,0,0);
            // var todaysDate = new Date().setHours(0, 0, 0, 0);
            //
            // if (givenDate < todaysDate) {
            //     errormsgdiv.style.display = "block";
            //     errormsgdiv.innerHTML='<div class="alert-body">تاريخ النهاية يجب أن يكون في المستقبل  </div>';
            //     x = false;
            //
            // }
            return x;
        }
        function handleCheckbox(checkbox) {
            var applicantInfo = document.getElementById("applicant_info");
            if (checkbox.checked) {
                applicantInfo.style.display = "none";
            } else {
                applicantInfo.style.display = "block";
            }
        }
    </script>
@endpush
