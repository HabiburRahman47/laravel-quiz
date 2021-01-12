@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Edit</strong> Your Section</div>
                        @if(session()->has('success'))
                            <div class="row">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                                    <strong>{{session()->get('success')}}</strong>
                                    <strong><a href="{{route('web.admin.sections.show', session('rID'))}}">Click</a> here to show</strong>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.sections.update.all',$section->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="name" value="{{old('name',$section->name)}}"
                                               placeholder="Text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="department_id">Department</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="department_id" name="department_id">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}"  {{$department->id == $section->department_id ? 'selected' : ''}}>{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button" href="{{route('web.admin.sections.index')}}">Cancel</a>
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


