@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Course</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.courses.store')}}"
                                  method="post"
                                  enctype="multipart/form-data">
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
                                    <label class="col-md-3 col-form-label" for="property_id">Property</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="property_id" name="property_id">
                                            <option value="">Select Property</option>
                                            @foreach($properties as $properties)
                                                <option value="{{$properties->id}}" {{(collect(old('property_id'))->contains($properties->id)) ? 'selected':''}}>{{$properties->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.courses.index')}}">Cancel</a>
                                    <button class="btn btn-primary float-right" type="submit">Save</button>
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


