@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Category</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Session Quiz</td>
                                    <td>{{ $quizResult->quizSession->quiz_name }}</td>
                                </tr>
                                <tr>
                                    <td>Total Question</td>
                                    <td>{{ $quizResult->total_question }}</td>
                                </tr>
                                <tr>
                                    <td>Total Right Ans</td>
                                    <td>{{ $quizResult->total_right_ans }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $quizResult->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $quizResult->updated_at }}</td>
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


