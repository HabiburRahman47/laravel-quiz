@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Choice</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Question</td>
                                    <td><a href="{{route('web.admin.questions.show',$questionChoice->questions->id)}}">{{$questionChoice->questions->name}}</a></td>
                                </tr>
                                <tr>
                                    <td>Choice</td>
                                    <td><a href="{{route('web.admin.choices.show',$questionChoice->choices->id)}}">{{$questionChoice->choices->name}}</a></td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $questionChoice->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $questionChoice->updated_at }}</td>
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
