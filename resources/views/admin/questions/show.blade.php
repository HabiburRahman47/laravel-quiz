@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Question</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $question->name }}</td>
                                </tr>
                                <tr>
                                    <td>Config</td>
                                    <td>{{ $question->config }}</td>
                                </tr>
                                <tr>
                                    <td>Question Type</td>
                                    <td>{{ $question->question_type }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $question->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $question->updated_at }}</td>
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


