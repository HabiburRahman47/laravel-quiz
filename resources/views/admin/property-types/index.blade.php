@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-title"><h4 class="mb-0">Property Types</h4></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('web.admin.property-types.create') }}" class="btn btn-primary m-2">Create Property Type</a>
                                </div>
                            </div>
                            <hr>
                            {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
        </div>
    </div>

@endsection

@section('javascript')
    @include('core.dashboard.layout.partials.datatable.js')
    {!! $dataTable->scripts() !!}
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function () {--}}
            {{--/* Delete customer */--}}
            {{--$('body').on('click', '.delete-user', function () {--}}
                {{--var user_id = $(this).data("id");--}}
                {{--console.log($(this));--}}
                {{--var token = $("meta[name='csrf-token']").attr("content");--}}
                {{--var confirmed = confirm("Are You sure want to delete !");--}}
                {{--if (confirmed === true) {--}}
                    {{--console.log("confirmed " + confirmed);--}}

                    {{--$.ajax({--}}
                        {{--type: "DELETE",--}}
                        {{--url: "http://lsapp.test/web/property-types/" + user_id,--}}
                        {{--data: {--}}
                            {{--"id": user_id,--}}
                            {{--"_token": token,--}}
                        {{--},--}}
                        {{--success: function (data) {--}}

                            {{--//$('#msg').html('Customer entry deleted successfully');--}}
                            {{--//$("#customer_id_" + user_id).remove();--}}
                            {{--table.ajax.reload();--}}
                        {{--},--}}
                        {{--error: function (data) {--}}
                            {{--console.log('Error:', data);--}}
                        {{--}--}}
                    {{--});--}}
                {{--}--}}

            {{--});--}}

        {{--});--}}

    {{--</script>--}}
@endsection
