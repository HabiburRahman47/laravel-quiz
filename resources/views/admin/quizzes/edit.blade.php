@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Edit</strong> Quiz</div>
                        @if(session()->has('success'))
                            <div class="row">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                                    <strong>{{session()->get('success')}}</strong>
                                    <strong><a href="{{route('web.admin.quizzes.show', session('rID'))}}">Click</a> here to show</strong>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.quizzes.update.all',$quiz->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="name" value="{{old('prefix',$quiz->name)}}"
                                               placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Description</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="description" value="{{old('description',$quiz->description)}}"
                                               placeholder="Text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="image-input">Image</label>
                                <div class="col-md-9">
                                    <input class="form-control" id="image-input" type="file" name="image"
                                           value="{{old('image',$quiz->image)}}"
                                           placeholder="Text">
                                </div>
                            </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Config</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="config" value="{{old('config',$quiz->config)}}"
                                               placeholder="Text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="category_id">Category</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"  {{$category->id == $quiz->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button" href="{{route('web.admin.quizzes.index')}}">Cancel</a>
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


