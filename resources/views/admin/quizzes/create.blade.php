@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Quiz</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.quizzes.store')}}"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="name"
                                               value="{{old('name')}}"
                                               placeholder="Name">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Description</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="description"
                                               value="{{old('description')}}"
                                               placeholder="Description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Config</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="config"
                                               value="{{old('config')}}"
                                               placeholder="Config">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="category_id">Property</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{(collect(old('category_id'))->contains($category->id)) ? 'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.quizzes.index')}}">Cancel</a>
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


