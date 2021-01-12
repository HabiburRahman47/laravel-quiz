@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a Quiz With Question</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.quiz-questions.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="quiz_id">Quiz</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="quiz_id" name="quiz_id">

                                            <option value="">Select Quiz</option>
                                            @foreach($quizzes as $quiz)
                                                <option value="{{$quiz->id}}" {{(collect(old('quiz_id'))->contains($quiz->id)) ? 'selected':''}}>{{$quiz->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
                                {{-- @include('core.dashboard.layout.partials.seo.create-form-fields') --}}
                                <hr>
                                <div class="form-actions">
                                    <a href="{{route('web.admin.quiz-questions.index')}}" class="btn btn-secondary" type="button">Cancel</a>
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

