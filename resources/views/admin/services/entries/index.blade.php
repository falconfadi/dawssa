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
                        <a class="btn btn-success col fileinput-button" href="{{ url('admin/service_entries/create', ['id' => $service->id]) }}">
                            <i class="fas fa-plus"></i>
                            <span>إضافة مرفق </span>
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
                        <th>اسم  المرفق</th>
                        <th>تحكم</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i=1; @endphp
                    @foreach($servicesEntries as $item)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default"></button>
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">

{{--                                        <a type="button" class="btn-sm" href="#">حذف</a>--}}

                                        <form action="{{ url('admin/service_entries/delete', ['id' => $item->id]) }}" method="DELETE">
                                        <a href="#"
                                           class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                           data-bs-toggle="tooltip" title=""
                                           data-bs-original-title="Delete" aria-label="Delete"><i
                                                class="ti ti-trash text-white "></i>حذف</a>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach

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
@include('scripts.sweetalert');
@push('sweetalert')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            /*sweet alert*/
            $(function() {
                $(document).on("click",".bs-pass-para",function(){
                    var form = $(this).closest("form");
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                        title:  "{{__('Are You Sure?')}}",
                        text: "", /*{{__('This action can not be undone. Do you want to continue?')}}*/
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '{{__('Yes')}}',
                        cancelButtonText: '{{__('No')}}',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });

            });
        });
    </script>

@endpush
