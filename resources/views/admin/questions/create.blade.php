@extends('core.dashboard.layout.main')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Quiz</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.questions.store')}}"
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
                                    <label class="col-md-3 col-form-label" for="text-input">config</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="config"
                                               value="{{old('config')}}"
                                               placeholder="Config">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Question Type</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="question_type"
                                               value="{{old('question_type')}}"
                                               placeholder="Question Type">
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
                                    <label class="col-md-3 col-form-label" for="text-input">Tags</label>
                                    <div class="col-md-9">
                                        <select name="tags[]" id="tags" class="form-control js-example-tags" multiple>
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id }}" {{ (collect(old('tags'))->contains($tag->id)) ? 'selected':'' }}>{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.questions.index')}}">Cancel</a>
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

@push('javascript')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
           $(".js-example-tags").select2({
                placeholder:'Select tags',
                tags: true,
                tokenSeparators: [',', ' ']
                });
        });
    </script>
@endpush

