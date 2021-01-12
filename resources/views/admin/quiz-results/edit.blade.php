@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Edit</strong> Quiz Result</div>
                        @if(session()->has('success'))
                            <div class="row">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                                    <strong>{{session()->get('success')}}</strong>
                                    <strong><a href="{{route('web.admin.quiz-results.show', session('rID'))}}">Click</a> here to show</strong>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.quiz-results.update.all',$quizResult->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                 <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="session_id">Session Quiz</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="session_id" name="session_id">
                                            <option value="">Select Category</option>
                                            @foreach($quizSessions as $quizSession)
                                                <option value="{{$quizSession->id}}"  {{$quizSession->id == $quizResult->session_id ? 'selected' : ''}}>{{$quizSession->quiz_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Total Question</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="number" name="total_question" value="{{old('total_question',$quizResult->total_question)}}"
                                               placeholder="Text">
                                    </div>
                                </div>
                               <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Total Right Ans</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="total_right_ans" value="{{old('total_right_ans',$quizResult->total_right_ans)}}"
                                               placeholder="Name">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button" href="{{route('web.admin.quiz-results.index')}}">Cancel</a>
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


