@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Category</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.categories.store')}}"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text"  id="name" name="name"
                                               value="{{old('name')}}"
                                               placeholder="Name">
                                    </div>
                                    {{-- <label>Name:</label>

                                    <input type="text" id="name" name="name" value="" class="form-control" placeholder="Enter Name"> --}}
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="category_id">Parent</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="parent_id" name="parent_id">
                                            <option value="0">Select Parent</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{(collect(old('category_id'))->contains($category->id)) ? 'selected':''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                            {{-- <label>Category:</label>
                                <select id="parent_id" name="parent_id" class="form-control">
                                    <option value="0">Select</option>
                                    @foreach($categories as $rows)
                                            <option value="{{ $rows->id }}">{{ $rows->name }}</option>
                                    @endforeach
                                </select> --}}
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.categories.index')}}">Cancel</a>
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


