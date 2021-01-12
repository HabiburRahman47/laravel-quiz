@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Quiz</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.quiz-sessions.store')}}"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Quiz Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="quiz_name"
                                               value="{{old('quiz_name')}}"
                                               placeholder="Quiz Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Quiz</label>
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
                                    <label class="col-md-3 col-form-label" for="status">status</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="status" name="status">
                                            <option value="-1">Please select</option>
                                            <option value="1" @if(old('status')=== 1){{'selected'}} @endif>Complete</option>
                                            <option value="0" @if(old('status')=== 0){{'selected'}} @endif>Incomplete</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.quiz-sessions.index')}}">Cancel</a>
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


