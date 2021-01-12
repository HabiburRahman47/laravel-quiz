@extends('core.dashboard.layout.main')

@section('content')

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header"><strong>Edit</strong>Quiz Session Answer</div>
                    @if(session()->has('success'))
                        <div class="row">
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                                <strong>{{session()->get('success')}}</strong>
                                <strong><a href="{{route('web.admin.quiz-session-answers.show', session('rID'))}}">Click</a> here to show</strong>
                            </div>
                        </div>
                    @endif
                    <div class="card-body">
                        <form class="form-horizontal" action="{{route('web.admin.quiz-session-answers.update.all',$quizSessionAns->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('errors.form-error', ['errors'=>$errors])
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="text-input">Quiz Session</label>
                                    <div class="col-md-9">
                                    <select class="form-control" id="session_id" name="session_id">
                                        <option value="">Select Quiz Session</option>
                                        @foreach($quizSessions as $quizSession)
                                            <option value="{{$quizSession->id}}"  {{$quizSession->id == $quizSessionAns->session_id ? 'selected' : ''}}>{{$quizSession->quiz_name}}</option>
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
                                            <option value="{{$question->id}}"  {{$question->id == $quizSessionAns->question_id ? 'selected' : ''}}>{{$question->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="selected_choice_id">Selected Choice</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="selected_choice_id" name="selected_choice_id">
                                        <option value="">Select Choice</option>
                                        @foreach($choices as $choice)
                                            <option value="{{$choice->id}}"  {{$choice->id == $quizSessionAns->selected_choice_id ? 'selected' : ''}}>{{$choice->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-actions">
                                <a class="btn btn-secondary" type="button" href="{{route('web.admin.quiz-session-answers.index')}}">Cancel</a>
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


