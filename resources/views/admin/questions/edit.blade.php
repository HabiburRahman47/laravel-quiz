@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Edit</strong> Question</div>
                        @if(session()->has('success'))
                            <div class="row">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                                    <strong>{{session()->get('success')}}</strong>
                                    <strong><a href="{{route('web.admin.questions.show', session('rID'))}}">Click</a> here to show</strong>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.questions.update.all',$question->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="name" value="{{old('name',$question->name)}}"
                                               placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Config</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="config" value="{{old('config',$question->config)}}"
                                               placeholder="Text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Question Type</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="question_type" value="{{old('question_type',$question->question_type)}}"
                                               placeholder="Text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="select1">Suggested</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="select1" name="suggested" value="{{old('suggested')}}">
                                            <option value="">Select Suggested</option>
                                            <option value="1" {{ $question->suggested == 1 ? 'selected':'' }} >Yes</option>
                                            <option value="0" {{ $question->suggested == 0 ? 'selected':'' }} >No</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button" href="{{route('web.admin.questions.index')}}">Cancel</a>
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


