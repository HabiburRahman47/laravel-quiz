@extends('core.dashboard.layout.main')
@push('css')
    @include('core.dashboard.layout.partials.datatables.css')
@endpush

@section('content')

    <div class="container-fluid index">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Department</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('admin.departments.partials.toolbar')
                            <div class="row mt-4 dt-container">
                                <div class="col-12">
                                    {!! $dataTable->table() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
        </div>
    </div>

@endsection

@push('javascript')
    @include('core.dashboard.layout.partials.datatables.js')
    {!! $dataTable->scripts() !!}

    <script>

        $(function () {
            var dataTable = LaravelDataTables['department-table'];
            $(".filterable").on('change', function () {
                dataTable.draw();
            });

            $(".dt-triggerable").on('click', function () {
                setTimeout(function (){
                    dataTable.draw();
                },2000);
            });

            // dataTable.buttons().container().appendTo($('#dt-custom-buttons-pane'));

            $("#searchbox").on("keyup search input paste cut", function () {
                dataTable.search(this.value).draw();
            });

            /* Delete property type */
            $('body').on('click', '.delete-record, .trash-record, .restore-record', function () {

                var record_id = $(this).data("id");
                var action_url = $(this).data("url");

                if ($(this).hasClass('delete-record')) {
                    var confirmed = confirm("Are You sure want to delete !");
                    if (confirmed === true) {
                        performAjaxRequest("DELETE", action_url, record_id, function (data) {
                            Swal.fire('Successfully deleted');
                            dataTable.draw();
                        }, function (error) {
                            console.log('Error:', error);
                        });
                    }
                }
                else if ($(this).hasClass('trash-record')) {

                    performAjaxRequest("PATCH", action_url, record_id, function (data) {
                        showSwalMsg('Successfully Trashed','error');
                        dataTable.draw();
                    }, function (error) {
                        console.log('Error:', error);
                    });

                } else if ($(this).hasClass('restore-record')) {
                    performAjaxRequest("PATCH", action_url, record_id, function (data) {
                        showSwalMsg('Successfully Restored','success');
                        dataTable.draw();
                    }, function (error) {
                        console.log('Error:', error);
                    });
                }

            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });
    </script>
@endpush


