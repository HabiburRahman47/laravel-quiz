@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Quiz Session Answer</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Quiz Session</td>
                                    <td>{{ $quizSessionAns->session_id }}</td>
                                </tr>
                                <tr>
                                    <td>Question</td>
                                    <td>{{ $quizSessionAns->question_id }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                <td>{{ $quizSessionAns->selected_choice_id }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $quizSessionAns->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $quizSessionAns->updated_at }}</td>
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


