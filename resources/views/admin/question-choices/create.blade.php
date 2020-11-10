@extends('core.dashboard.layout.main')

@section('content')
    {{--<head>--}}
    {{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />--}}
    {{--</head>--}}

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a Choice With Question</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.question-choices.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="question_id">Question</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="question_id" name="question_id">
                                            <option value="">Select Question</option>
                                            @foreach($questions as $question)
                                                <option value="{{$question->id}}" {{(collect(old('question_id'))->contains($question->id)) ? 'selected':''}}>{{$question->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="choice_id">Choice</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="choice_id" name="choice_id">

                                            <option value="">Select Choice</option>
                                            @foreach($choices as $choice)
                                                <option value="{{$choice->id}}" {{(collect(old('choice_id'))->contains($choice->id)) ? 'selected':''}}>{{$choice->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Link</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="link"
                                               value="{{old('link')}}"
                                               placeholder="Text">
                                    </div>
                                </div> --}}
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="image-input">Image</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="image" type="file" name="image"
                                               value="{{old('image')}}"
                                               placeholder="Text">
                                    </div>
                                </div> --}}
                                {{-- <hr>
                                @include('core.dashboard.layout.partials.seo.create-form-fields') --}}
                                <hr>
                                <div class="form-actions">
                                    <a href="{{route('web.admin.question-choices.index')}}" class="btn btn-secondary" type="button">Cancel</a>
                                    <button class="btn btn-primary float-right" type="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>--}}

    {{--<script type="text/javascript">--}}

    {{--    $("#type_id").select2({--}}
    {{--        //allowClear: true--}}
    {{--    });--}}
    {{--</script>--}}
@endsection

@section('javascript')

@endsection

