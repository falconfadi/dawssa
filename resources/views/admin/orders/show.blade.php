@extends('layouts/admin')
@section('content')
    <style>
        .width100{
            width:130px
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="card-header">
            <h3 class="card-title"><?php echo ($title); ?></h3>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">معلومات المشترك</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>الاسم:</label>
                                <span>{{ $client->first_name ?? '' }} {{ $client->father_name ?? '' }} {{ $client->last_name ?? '' }}</span>
                            </div>
                            <div class="form-group">
                                <label>الرقم الوطني:</label>
                                <span>{{ $client->national_id ?? '' }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

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
            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline time label -->
                        <div class="time-label">
                            <span class="bg-red">{{$updatedAt}}</span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                <h3 class="timeline-header">رقم وصل الصندوق</h3>

                                <div class="timeline-body">
                                    <form action="{{ url('admin/order/receit_number_store') }}" method="post">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="exampleInputEmail1" name="number" required value="{{ $receitNumber ?? '' }}">
                                                <input type="hidden" name="order_id" value="{{ $id }}">
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
                        <!-- END timeline item -->
                        <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                <h3 class="timeline-header">دراسة دائرة الوصل</h3>

                                <div class="timeline-body">
                                    <form action="{{ url('admin/order/daeert_alwasl_store') }}" method="post">
                                    @csrf
                                        <div class="card-body">
                                            <div class="form-group">

                                                <textarea type="email" class="form-control" name="daeertAlwasl" id="exampleInputEmail1" >

                                                    {{$daeertAlwaslText ?? ''}}
                                                </textarea>
                                                <input type="hidden" name="order_id" value="{{ $id }}">

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
                        <div>
                            <i class="fa fa-camera bg-purple"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                                <h3 class="timeline-header">المرفقات </h3>
                                <div class="timeline-body">
                                    @foreach($ordersEntries as $orderEntry)
                                        <img src="{{url('storage/'.$orderEntry->value)}}" alt="..." class="width100">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- timeline item -->
{{--                        <div>--}}
{{--                            <i class="fas fa-user bg-green"></i>--}}
{{--                            <div class="timeline-item">--}}
{{--                                <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>--}}
{{--                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- END timeline item -->--}}
{{--                        <!-- timeline item -->--}}
{{--                        <div>--}}
{{--                            <i class="fas fa-comments bg-yellow"></i>--}}
{{--                            <div class="timeline-item">--}}
{{--                                <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>--}}
{{--                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>--}}
{{--                                <div class="timeline-body">--}}
{{--                                    Take me to your leader!--}}
{{--                                    Switzerland is small and neutral!--}}
{{--                                    We are more like Germany, ambitious and misunderstood!--}}
{{--                                </div>--}}
{{--                                <div class="timeline-footer">--}}
{{--                                    <a class="btn btn-warning btn-sm">View comment</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- END timeline item -->--}}
{{--                        <!-- timeline time label -->--}}
{{--                        <div class="time-label">--}}
{{--                            <span class="bg-green">3 Jan. 2014</span>--}}
{{--                        </div>--}}
{{--                        <!-- /.timeline-label -->--}}




{{--                        <div>--}}
{{--                            <i class="fas fa-clock bg-gray"></i>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.timeline -->
    </section>
    <!-- /.content -->
    @push('ajax')
        <script type="application/javascript">
            $(document).ready(function() {
                $('input[name="search"]').keyup(function() {
                    if($("#search").val().length>=11){
                        //console.log($(this).length);
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
    </script>
@endpush
