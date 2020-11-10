@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Edit</strong> Your Quiz With Question</div>
                        @if(session()->has('success'))
                            <div class="row">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                                    <strong>{{session()->get('success')}}</strong>
                                    <strong><a href="{{route('web.admin.quiz-questions.show', session('rID'))}}">Click</a> here</strong>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.quiz-questions.update.all',$quizQuestion->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="quiz_id">Quiz</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="quiz_id" name="quiz_id">
                                            <option value="">Select Quiz</option>
                                            @foreach($quizzes as $quiz)
                                                <option value="{{$quiz->id}}"  {{old('quiz_id',$quiz->id) == $quizQuestion->quiz_id ? 'selected' : ''}}>{{$quiz->name}}</option>
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
                                                <option value="{{$question->id}}"  {{old('question_id',$question->id) == $quizQuestion->question_id ? 'selected' : ''}}>{{$question->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                {{-- <hr>
                                @include('core.dashboard.layout.partials.seo.edit-form-fields') --}}
                                <hr>
                                <div class="form-actions">
                                    <a href="{{route('web.admin.quiz-questions.index')}}" class="btn btn-secondary" type="button">Cancel</a>
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

