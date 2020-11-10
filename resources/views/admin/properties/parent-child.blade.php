@extends('core.dashboard.layout.main')

@section('content')
    {{--<head>--}}
    {{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />--}}
    {{--</head>--}}

    <div class="container-fluid index">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Property</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!DOCTYPE html>
                            <html>
                            <head>
                                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
                                <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                                <link href="/css/treeview.css" rel="stylesheet">
                            </head>
                            <body>
                            <div class="container">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Manage Property TreeView</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3>Parent Child List</h3>
                                                <ul id="tree1">
                                                    @foreach($properties as $property)
                                                        <li>
                                                            {{ $property->name }}
                                                            @if(count($property->childs))
                                                                @include('manageChild',['childs' => $property->childs])
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
{{--                                                <h3>Add New Category</h3>--}}


{{--                                                {!! Form::open(['route'=>'add.category']) !!}--}}


{{--                                                @if ($message = Session::get('success'))--}}
{{--                                                    <div class="alert alert-success alert-block">--}}
{{--                                                        <button type="button" class="close" data-dismiss="alert">×</button>--}}
{{--                                                        <strong>{{ $message }}</strong>--}}
{{--                                                    </div>--}}
{{--                                                @endif--}}


{{--                                                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">--}}
{{--                                                    {!! Form::label('Title:') !!}--}}
{{--                                                    {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}--}}
{{--                                                    <span class="text-danger">{{ $errors->first('title') }}</span>--}}
{{--                                                </div>--}}


{{--                                                <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">--}}
{{--                                                    {!! Form::label('Category:') !!}--}}
{{--                                                    {!! Form::select('parent_id',$allCategories, old('parent_id'), ['class'=>'form-control', 'placeholder'=>'Select Category']) !!}--}}
{{--                                                    <span class="text-danger">{{ $errors->first('parent_id') }}</span>--}}
{{--                                                </div>--}}


{{--                                                <div class="form-group">--}}
{{--                                                    <button class="btn btn-success">Add New</button>--}}
{{--                                                </div>--}}


{{--                                                {!! Form::close() !!}--}}


                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                            <script src="/js/treeview.js"></script>
                            </body>
                            </html>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}

    {{--<script type="text/javascript">--}}

    {{--    $("#type_id").select2({--}}
    {{--        //allowClear: true--}}
    {{--    });--}}
    {{--</script>--}}
@endsection

@section('javascript')

@endsection



