@extends('layouts/admin')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Timelime example  -->
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <div class="timeline">
                        <!-- timeline time label -->
                        <div class="time-label">
                            <span class="bg-red">10 Feb. 2014</span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                <div class="timeline-body">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                    quora plaxo ideeli hulu weebly balihoo...
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary btn-sm">Read more</a>
                                    <a class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-user bg-green"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-comments bg-yellow"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                <div class="timeline-body">
                                    Take me to your leader!
                                    Switzerland is small and neutral!
                                    We are more like Germany, ambitious and misunderstood!
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-warning btn-sm">View comment</a>
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline time label -->
                        <div class="time-label">
                            <span class="bg-green">3 Jan. 2014</span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div>
                            <i class="fa fa-camera bg-purple"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                <div class="timeline-body">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <!-- timeline item -->
                        <div>
                            <i class="fas fa-video bg-maroon"></i>

                            <div class="timeline-item">
                                <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>

                                <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

                                <div class="timeline-body">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="timeline-footer">
                                    <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                                </div>
                            </div>
                        </div>
                        <!-- END timeline item -->
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
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
