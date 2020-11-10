@extends('core.dashboard.layout.main')
@push('css')
    @include('core.dashboard.layout.partials.datatables.css')
@endpush

@section('content')

    <div class="container-fluid index">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Property</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @include('admin.properties.partials.toolbar')
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
            var dataTable = LaravelDataTables['property-table'];
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

            /* Delete property */
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





{{--///////////////////////////////////////////////////////////--}}
{{--@extends('core.dashboard.layout.main')--}}

{{--@section('content')--}}

{{--    <div class="container-fluid">--}}
{{--        <div class="fade-in">--}}
{{--            <!-- /.row-->--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header card-title"><h4 class="mb-0">Properties</h4></div>--}}
{{--                        </div>--}}

{{--                        <div class="card-body">--}}
{{--                            <div class="col-12 text-right">--}}
{{--                                <a href="{{ route('web.admin.properties.create') }}" class="btn btn-primary m-2 float-right" id="new-user"--}}
{{--                                >Create Property</a>--}}
{{--                            </div>--}}
{{--                            <div class="col-12 text-right">--}}
{{--                                <a href="{{route('web.admin.properties.index',['trashed' => true])}}" class="btn btn-primary float-right"--}}
{{--                                   type="button">View Trashed</a>--}}
{{--                                <a href="{{route('web.admin.properties.index')}}" class="btn btn-warning float-right"--}}
{{--                                   type="button">Without Trashed</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}

{{--                            <div class="offset-md-4 col-md-4">--}}
{{--                                <form>--}}
{{--                                    <div class="row input-daterange">--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <input type="text" name="from_date" id="from_date" class="form-control searchable"--}}
{{--                                                   placeholder="From Date" readonly/>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <input type="text" name="to_date" id="to_date" class="form-control searchable"--}}
{{--                                                   placeholder="To Date" readonly/>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-4">--}}
{{--                                            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <select name="visibility" id="visibility" class="form-control searchable" required>--}}
{{--                                            <option value="">Select Visibility</option>--}}
{{--                                            <option value="public">Public</option>--}}
{{--                                            <option value="private">Private</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <select name="property_type_id" id="property_type_id" class="form-control searchable" required>--}}
{{--                                            <option value="">Select Property Type</option>--}}
{{--                                            @foreach($propertyTypes as $propertyType)--}}

{{--                                                <option value="{{ $propertyType->id }}"  @if( request('property_type_id')== $propertyType->id) selected @endif >{{ $propertyType->name }}</option>--}}

{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </form>--}}

{{--                            </div>--}}

{{--                        </div>--}}
{{--                            <hr>--}}
{{--                            {!! $dataTable->table() !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- /.col-->--}}
{{--            </div>--}}
{{--            <!-- /.row-->--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}

{{--@section('javascript')--}}
{{--    @include('core.dashboard.layout.partials.datatables.js')--}}
{{--    {!! $dataTable->scripts() !!}--}}

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('.input-daterange').datepicker({--}}
{{--                todayBtn: 'linked',--}}
{{--                format: 'yyyy-mm-dd',--}}
{{--                autoclose: true--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $(function () {--}}
{{--            $(".searchable").on('change', function () {--}}
{{--                console.log('here....');--}}
{{--                LaravelDataTables['property-table'].draw();--}}
{{--            })--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script type="text/javascript">--}}

{{--        /* Delete ptoperty type */--}}
{{--        $('body').on('click', '.delete-record', function () {--}}
{{--            var record_id = $(this).data("id");--}}
{{--            var delete_record_url = $(this).data("url");--}}

{{--            console.log($(this));--}}
{{--            var token = $("meta[name='csrf-token']").attr("content");--}}
{{--            var confirmed = confirm("Are You sure want to delete !");--}}
{{--            if (confirmed === true) {--}}
{{--                console.log("confirmed " + confirmed);--}}

{{--                $.ajax({--}}
{{--                    type: "DELETE",--}}
{{--                    url: delete_record_url,--}}
{{--                    data: {--}}
{{--                        "id": record_id,--}}
{{--                        "_token": token,--}}
{{--                    },--}}
{{--                    success: function (data) {--}}

{{--                        //Swal.fire('Successfully deleted')--}}

{{--                        LaravelDataTables['property-table'].draw();--}}
{{--                    },--}}
{{--                    error: function (data) {--}}
{{--                        console.log('Error:', data);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}

{{--        });--}}

{{--    </script>--}}
{{--    <script type="text/javascript">--}}

{{--        /* trash property type */--}}
{{--        $('body').on('click', '.trash-record', function () {--}}
{{--            var record_id = $(this).data("id");--}}
{{--            var trash_record_url = $(this).data("url");--}}

{{--            console.log($(this));--}}
{{--            var token = $("meta[name='csrf-token']").attr("content");--}}
{{--            var confirmed = confirm("Are You sure want to trash !");--}}
{{--            if (confirmed === true) {--}}
{{--                console.log("confirmed " + confirmed);--}}

{{--                $.ajax({--}}
{{--                    type: "PATCH",--}}
{{--                    url: trash_record_url,--}}
{{--                    data: {--}}
{{--                        "id": record_id,--}}
{{--                        "_token": token,--}}
{{--                    },--}}
{{--                    success: function (data) {--}}

{{--                        //Swal.fire('Successfully deleted')--}}

{{--                        LaravelDataTables['property-table'].draw();--}}
{{--                    },--}}
{{--                    error: function (data) {--}}
{{--                        console.log('Error:', data);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}

{{--        });--}}

{{--    </script>--}}

{{--    <script type="text/javascript">--}}

{{--        /* trash property type */--}}
{{--        $('body').on('click', '.restore-record', function () {--}}
{{--            var record_id = $(this).data("id");--}}
{{--            var restore_record_url = $(this).data("url");--}}

{{--            console.log($(this));--}}
{{--            var token = $("meta[name='csrf-token']").attr("content");--}}
{{--            var confirmed = confirm("Are You sure want to restore !");--}}
{{--            if (confirmed === true) {--}}
{{--                console.log("confirmed " + confirmed);--}}

{{--                $.ajax({--}}
{{--                    type: "PATCH",--}}
{{--                    url: restore_record_url,--}}
{{--                    data: {--}}
{{--                        "id": record_id,--}}
{{--                        "_token": token,--}}
{{--                    },--}}
{{--                    success: function (data) {--}}

{{--                        //Swal.fire('Successfully deleted')--}}

{{--                        LaravelDataTables['property-table'].draw();--}}
{{--                    },--}}
{{--                    error: function (data) {--}}
{{--                        console.log('Error:', data);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}

{{--        });--}}

{{--    </script>--}}


{{--@endsection--}}
