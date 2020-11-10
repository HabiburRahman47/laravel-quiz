@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Property</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $property->name }}</td>
                                </tr>
                                <tr>
                                    <td>Private Name</td>
                                    <td>{{ $property->private_name }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $property->description }}</td>
                                </tr>
                                <tr>
                                    <td>Property Type</td>
                                    <td><a href="{{route('web.admin.property-types.show',$property->property_type_id)}}">{{$property->propertyType->name}}</a></td>
                                </tr>
                                <tr>
                                    <td>Parent Branch</td>
                                    <td><a href="{{route('web.admin.properties.show',$property->id)}}">{{$property->parent->name}}</a></td>
                                </tr>
                                <tr>
                                    <td>Visibility</td>
                                    <td>
                                        @if ($property->visibility == 'private')
                                            <span class="badge badge-success">Private</span>
                                        @else
                                            <span class="badge badge-info">Public</span>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $property->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $property->updated_at }}</td>
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

{{--//////////////--}}
{{--@extends('core.dashboard.layout.main')--}}

{{--@section('content')--}}
{{--<style>--}}
{{--#customers {--}}
{{--  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;--}}
{{--  border-collapse: collapse;--}}
{{--  width: 50%;--}}
{{--}--}}

{{--#customers td, #customers th {--}}
{{--  border: 1px solid #ddd;--}}
{{--  padding: 20px;--}}
{{--}--}}

{{--#customers tr:nth-child(even){background-color: #f2f2f2;}--}}

{{--#customers tr:hover {background-color: #ddd;}--}}

{{--/* #customers th {--}}
{{--  padding-top: 12px;--}}
{{--  padding-bottom: 12px;--}}
{{--  text-align: right;--}}
{{--  background-color: #4CAF50;--}}
{{--  color: white;--}}
{{--} */--}}
{{--</style>--}}
{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">--}}
{{--</head>--}}
{{--<body>--}}

{{--<table id="customers" align="center">--}}
{{--    <h1 align="center">Property Table</h1>--}}
{{--  <tr >--}}
{{--    <td>Name</td>--}}
{{--    <td >{{ $property->name }}</td>--}}
{{--  </tr>--}}
{{--  <tr>--}}
{{--    <td>Private Name</td>--}}
{{--    <td>{{ $property->private_name }}</td>--}}
{{--  </tr>--}}
{{--  <tr>--}}
{{--    <td>Description</td>--}}
{{--    <td>{{ $property->description }}</td>--}}
{{--  </tr>--}}
{{--  <tr>--}}
{{--    <td>Property Type</td>--}}
{{--  <td><a href="{{route('web.admin.property-types.show',$property->property_type_id)}}">{{$property->propertyType->name}}</a></td>--}}
{{--  </tr>--}}
{{--  <tr>--}}
{{--    <td><span>Visibility</span></td>--}}
{{--    <td><span  class="badge badge-primary" >{{ $property->visibility }}</span></td>--}}
{{--  </tr>--}}
{{--  <tr>--}}
{{--    <td>Created At</td>--}}
{{--    <td>{{ \Carbon\Carbon::parse($property->created_at)->toDayDateTimeString() }}</td>--}}
{{--  </tr>--}}
{{--  <tr>--}}
{{--    <td>Updated At</td>--}}
{{--    <td>{{ \Carbon\Carbon::parse($property->updated_at)->toDayDateTimeString() }}</td>--}}
{{--  </tr>--}}
{{--</table>--}}

{{--</body>--}}
{{--@endsection--}}

{{--@section('javascript')--}}

{{--@endsection--}}

