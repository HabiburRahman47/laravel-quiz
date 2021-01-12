@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Quiz</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $quiz->name }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $quiz->description }}</td>
                                </tr>
                                 <tr>
                                    <td>Strap Image</td>
                                    <td>
                                        <a href="#">
                                            <img
                                                src="{{ asset("uploads/straps/$quiz->id/image/$quiz->image")}}"
                                                style="height:100px;">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Config</td>
                                    <td>{{ $quiz->config }}</td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>{{ $quiz->category->name }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $quiz->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $quiz->updated_at }}</td>
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


