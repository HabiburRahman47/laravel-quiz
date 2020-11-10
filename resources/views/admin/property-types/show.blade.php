@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Property Type</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $propertyType->name }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $propertyType->description }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        Properties
                                    </td>

                                    <td>
                                        <a href="{{ route('web.admin.properties.index',['property_type_id'=>$propertyType->id ]) }}"
                                           class="btn btn-secondary" type="button">Show All Properties</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Suggested</td>
                                    <td>
                                        @if ($propertyType->suggested)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-warning">No</span>
                                    @endif
                                </tr>
                                <tr>
                                    <td>User Interface</td>
                                    <td>{{ $propertyType->user_interface }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $propertyType->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $propertyType->updated_at }}</td>
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
