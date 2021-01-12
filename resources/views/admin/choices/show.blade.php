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
                                    <td>Name</td>
                                    <td>{{ $choice->name }}</td>
                                </tr>
                                <tr>
                                    <td>Image</td>
                                    <td>
                                        <a href="{{ asset("uploads/straps/$choice->id/image/$choice->image")}}">
                                            <img
                                                src="{{ asset("uploads/straps/$choice->id/image/$choice->image")}}"
                                                style="height:100px;">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $choice->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $choice->updated_at }}</td>
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


