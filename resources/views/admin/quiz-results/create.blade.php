@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Quiz</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.quiz-results.store')}}"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Quiz Name</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="session_id" name="session_id">
                                            <option value="">Select Department</option>
                                            @foreach($quizSessions as $quizSession)
                                                <option value="{{$quizSession->id}}" {{(collect(old('session_id'))->contains($quizSession->id)) ? 'selected':''}}>{{$quizSession->quiz_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Total Question</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="total_question"
                                               value="{{old('total_question')}}"
                                               placeholder="Total Question">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Total Right Ans</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="total_right_ans"
                                               value="{{old('total_right_ans')}}"
                                               placeholder="Total Right Ans">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.quiz-results.index')}}">Cancel</a>
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


