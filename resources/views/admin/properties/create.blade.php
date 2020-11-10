@extends('core.dashboard.layout.main')

@section('content')
{{--<head>--}}
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />--}}
{{--</head>--}}

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Property</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.properties.store')}}" method="post">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="name"
                                               value="{{old('name')}}"
                                               placeholder="Text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="email-input">Private Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="private_name" value="{{old('private_name')}}"
                                               placeholder="Text"><span class="help-block">This is a  text</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="textarea-input">Description</label>
                                    <div class="col-md-9">
                                            <textarea class="form-control" id="textarea-input" name="description"
                                                      rows="9" placeholder="Content..">{{old('description')}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="property_type_id">Property Type</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="property_type_id" name="property_type_id">
                                            <option value="">Select Property Type</option>
                                            @foreach($propertyTypes as $propertyType)
                                                <option value="{{$propertyType->id}}" {{(collect(old('property_type_id'))->contains($propertyType->id)) ? 'selected':''}}>{{$propertyType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="parent_id">Parent Branch</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="parent_id" name="parent_id">
                                            <option value="">Select Parent Branch(if has any)</option>
                                            @foreach($properties as $property)
                                                <option value="{{$property->id}}" {{(collect(old('parent_id'))->contains($property->id)) ? 'selected':''}}>{{$property->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="select1">Visibility</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="select1" name="visibility">
                                            <option value="">Select Visibility</option>
                                            @foreach(config('enums.property.visibility.name') as $id => $name)
                                                <option value="{{$name}}"
                                                        @if($name == old('visibility')) selected @endif>{{ ucfirst($name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a href="{{route('web.admin.properties.index')}}" class="btn btn-secondary" type="button">Cancel</a>
                                    <button class="btn btn-primary float-right" type="submit">Save</button>
                                </div>
                            </form>
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
