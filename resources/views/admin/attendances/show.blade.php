@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Attendance</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Info</td>
                                    <td>{{ $attendance->info }}</td>
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>{{ $attendance->notes }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $attendance->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $attendance->updated_at }}</td>
                                </tr>

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


