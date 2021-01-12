@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Edit</strong> Quiz Session</div>
                        @if(session()->has('success'))
                            <div class="row">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                                    <strong>{{session()->get('success')}}</strong>
                                    <strong><a href="{{route('web.admin.quiz-sessions.show', session('rID'))}}">Click</a> here to show</strong>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.quiz-sessions.update.all',$quizSession->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Quiz Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="quiz_name" value="{{old('quiz_name',$quizSession->quiz_name)}}"
                                               placeholder="Text">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="quiz_id">Quiz</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="quiz_id" name="quiz_id">
                                            <option value="">Select Quiz</option>
                                            @foreach($quizzes as $quiz)
                                                <option value="{{$quiz->id}}"  {{$quiz->id == $quizSession->quiz_id ? 'selected' : ''}}>{{$quiz->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="select1">status</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="select1" name="status" value="{{old('status')}}">
                                        <option value="">Select status</option>
                                        <option value="1" {{ $quizSession->status == 1 ? 'selected':'' }} >Complete</option>
                                        <option value="0" {{ $quizSession->status == 0 ? 'selected':'' }} >Incomplete</option>
                                    </select>
                                </div>
                            </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button" href="{{route('web.admin.quiz-sessions.index')}}">Cancel</a>
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


