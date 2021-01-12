@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Quiz Session</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Quiz Name</td>
                                    <td>{{ $quizSession->quiz_name }}</td>
                                </tr>
                                <tr>
                                    <td>Question</td>
                                    <td>{{ $quizSession->quiz->name }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @if ($quizSession->status)
                                            <span class="badge badge-success">Complete</span>
                                        @else
                                            <span class="badge badge-warning">Incomplete</span>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $quizSession->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $quizSession->updated_at }}</td>
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


