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
                                    <td>Name</td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <td>Parent</td>
                                    @if($category->parent_id==0)
                                        <td>{{ $category->name }}</td>
                                    @else
                                        @foreach($categories as $parent)
                                            @if( $category->parent_id === $parent->id )
                                                <td>{{ $parent->name }}</td>
                                            @endif
                                        @endforeach
                                    @endif
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $category->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $category->updated_at }}</td>
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


