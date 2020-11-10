@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Property Type</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.property-types.store')}}"
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
                                    <label class="col-md-3 col-form-label" for="textarea-input">Description</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="textarea-input" name="description"
                                                  rows="9" placeholder="Content..">{{old('description')}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="suggested">Suggested</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="suggested" name="suggested">
                                            <option value="-1">Please select</option>
                                            <option value="1" @if(old('suggested')=== 1){{'selected'}} @endif>Yes</option>
                                            <option value="0" @if(old('suggested')=== 0){{'selected'}} @endif>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">User Interface</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="user_interface"
                                               value="{{old('user_interface')}}"
                                               placeholder="Text">
                                    </div>
                                </div>

                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.property-types.index')}}">Cancel</a>
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
