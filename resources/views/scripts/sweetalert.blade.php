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
