@extends('core.dashboard.layout.main')

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header"><strong>Edit</strong> Your Property</div>
                    @if(session()->has('success'))
                    <div class="row">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                            <strong>{{session()->get('success')}}</strong>
                            <strong><a href="{{route('web.admin.properties.show', session('rID'))}}">Click</a> here</strong>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('web.admin.properties.update.all',$property->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('errors.form-error', ['errors'=>$errors])
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="text-input">Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="text-input" type="text" name="name" value="{{old('name',$property->name) }}" placeholder="Text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="email-input">Private Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="text-input" type="text" name="private_name" value="{{ $property->private_name }}" name="private_name" placeholder="Text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="textarea-input">Description</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="textarea-input" name="description"
                                              rows="9" placeholder="Content..">{{old('description',$property->description)}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="property_type_id">Property Type</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="property_type_id" name="property_type_id">
                                        <option value="">Select Property Type</option>
                                        @foreach($propertyTypes as $propertyType)
                                            <option value="{{$propertyType->id}}"  {{$propertyType->id == $property->property_type_id ? 'selected' : ''}}>{{$propertyType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="parent_id">Parent Branch</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <option value="">Select Parent Branch(if has any)</option>
                                        @foreach($parentProperties as $parentProperty)
                                            <option value="{{$parentProperty->id}}"  {{$parentProperty->id == $property->parent_id ? 'selected' : ''}}>{{$parentProperty->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="select1">Suggested</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="select1" name="suggested">
                                        <option>Select Visibility</option>
                                        <option {{ $property->visibility == 'private' ? 'selected':'' }} >Private</option>
                                        <option {{ $property->visibility == 'public' ? 'selected':'' }} >Public</option>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-actions">
                                <a href="{{route('web.admin.properties.index')}}" class="btn btn-secondary" type="button">Cancel</a>
                                <button class="btn btn-primary float-right" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')

@endsection
