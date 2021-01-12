@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Quiz</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.quiz-session-answers.store')}}"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Quiz Session</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="session_id"
                                               value="{{old('quiz_name')}}"
                                               placeholder="Session Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Question</label>
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
                                    <label class="col-md-3 col-form-label" for="text-input">Selection of Choice</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="selected_choice_id" name="selected_choice_id">
                                            <option value="">Select choice</option>
                                            @foreach($choices as $choice)
                                                <option value="{{$choice->id}}" {{(collect(old('selected_choice_id'))->contains($choice->id)) ? 'selected':''}}>{{$choice->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.quiz-session-answers.index')}}">Cancel</a>
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


