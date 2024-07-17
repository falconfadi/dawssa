@extends('layouts.admin')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{'البحث بحسب رقم العداد'}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{url('admin/meter/search')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">رقم العداد</label>
                                            <input type="text" class="form-control" id="number" placeholder=" " name="number">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">بحث</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><b>العدّادات</b></h3>

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

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>


    </section>

@endsection
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
                                // $.each(response, function(key, value) {
                                //     // dropdown.append($('<option></option>').attr('value', value.id).text(value.first_name + ' ' + value.last_name));
                                //     $("#add_link").hide();
                                //     $("#first_name").val(value.first_name);
                                //     $("#father_name").val(value.father_name);
                                //     $("#last_name").val(value.last_name);
                                //     $("#client_id").val(value.id);
                                //     // Get the last water meter number
                                //     var waterMeters = value.water_meters;
                                //     if (waterMeters.length > 0) {
                                //         var lastWaterMeter = waterMeters[waterMeters.length - 1];
                                //         $("#water_meter_number").val(lastWaterMeter.number);
                                //
                                //     } else {
                                //         $("#water_meter_number").val('');
                                //     }
                                // });
                        }
                    });
                }
            });
        });
    </script>
@endpush

