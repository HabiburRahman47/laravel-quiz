@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Edit</strong> Student</div>
                        @if(session()->has('success'))
                            <div class="row">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                                    <strong>{{session()->get('success')}}</strong>
                                    <strong><a href="{{route('web.admin.students.show', session('rID'))}}">Click</a> here to show</strong>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.students.update.all',$student->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Prefix</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="number" name="prefix" value="{{old('prefix',$student->prefix)}}"
                                               placeholder="Text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Roll Number</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="number" name="roll_number" value="{{old('roll_number',$student->roll_number)}}"
                                               placeholder="Text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="property_id">Property</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="property_id" name="property_id">
                                            <option value="">Select Property</option>
                                            @foreach($properties as $property)
                                                <option value="{{$property->id}}"  {{$property->id == $student->property_id ? 'selected' : ''}}>{{$property->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="section_id">Section</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="section_id" name="section_id">
                                            <option value="">Select Property</option>
                                            @foreach($sections as $section)
                                                <option value="{{$section->id}}"  {{$section->id == $student->section_id ? 'selected' : ''}}>{{$section->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button" href="{{route('web.admin.students.index')}}">Cancel</a>
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


