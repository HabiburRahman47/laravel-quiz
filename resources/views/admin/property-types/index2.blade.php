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
                            <table id="property-types"
                                   class="table  table-hover table-outline dt-responsive nowrap"
                                   style="width:100%">
                                <thead class="thead-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="5%">Id</th>
                                    <th width="10%">Name</th>
                                    <th width="20%">Description</th>
                                    <th width="5%">Suggested</th>
                                    <th width="5%">User_interface</th>
                                    <th width="50%">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
    @include('core.dashboard.layout.partials.datatables.js')
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#property-types').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('web.admin.property-types.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'suggested', name: 'suggested'},
                    {data: 'user_interface', name: 'user_interface'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


            /* Delete customer */
            $('body').on('click', '.delete-user', function () {
                var user_id = $(this).data("id");
                console.log($(this));
                var token = $("meta[name='csrf-token']").attr("content");
                var confirmed = confirm("Are You sure want to delete !");
                if (confirmed === true) {
                    console.log("confirmed " + confirmed);

                    $.ajax({
                        type: "DELETE",
                        url: "http://lsapp.test/web/property-types/" + user_id,
                        data: {
                            "id": user_id,
                            "_token": token,
                        },
                        success: function (data) {

                            //$('#msg').html('Customer entry deleted successfully');
                            //$("#customer_id_" + user_id).remove();
                            table.ajax.reload();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }

            });

        });

    </script>
@endsection
