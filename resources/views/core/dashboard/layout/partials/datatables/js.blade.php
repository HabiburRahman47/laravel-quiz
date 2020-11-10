{{--main scripts--}}
<script src="{{ asset('vendor/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('vendor/datatables/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js')}} "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

<script>
    function performAjaxRequest(type, action_url, record_id, success, error) {
        $.ajax({
            type: type,
            url: action_url,
            data: {
                "id": record_id,
                "_token": $("meta[name='csrf-token']").attr("content"),
            },
            success: success,
            error: error
        });
    }

    function showSwalMsg(msg,icon) {
        Swal.fire({
            toast: true,
            icon: icon,
            position: 'center',
            title: msg,
            showConfirmButton: false,
            timer: 1500
        });
    }
</script>