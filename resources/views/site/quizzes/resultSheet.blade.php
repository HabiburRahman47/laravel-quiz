{{-- @extends('site\quizzes\main')
@section('css-style')
<style>
  .rightAns {
     color:#0f0;
  }
  .wrongAns {
     color:#f00;
  }
</style>
@endsection
@section('content') --}}
<div class=" container justify-content-center">
      <div class="row">
        <div class="col 6">
          <h1>Your Exam Result</h1>
          <hr>
          <h2>Total Question:{{ $quizResult->total_question }}</h2>
          <h2>Right Ans:{{ $quizResult->total_right_ans }}</h2>
          <a href="{{ route('web.site.quiz.history') }}" class="btn btn-success">Previous Quiz</a>
        </div>
        <div class="col 6">
          <a href="{{ route('web.site.quiz.result.sheet',$quizResult->session_id) }}" class="btn btn-info">Generate Result Sheet</a>
        </div>
      </div>
</div>
<div class="container p-3">
     <div class="row">        
        <div class="col-sm-7">
          @foreach($questions as $key =>  $question)
              @php
              $q = 1+$key
              @endphp
              <div class="form-group">                
                  <label class="form-check-label" for="question">Question {{1+$key}}:</label>
                  <h4>{{$question->name}}</h4>
                  @foreach($question->choices as $key =>  $choice)
                    <label class="
                        @if ($question->config==$question->canditade_selected_ans && $choice->id==$question->config)
                        rightAns
                        @elseif($question->config==$choice->id)
                        rightAns
                        @elseif ($choice->id==$question->canditade_selected_ans && $question->config!=$question->canditade_selected_ans)
                        wrongAns
                        @endif">
                      <input id="choice" type="radio" name="choice[{{$question->id}}]" 
                        {{ ($choice->id==$question->canditade_selected_ans)? "checked" : "" }} >
                        {{$choice->name}}
                    </label>
                     <br>
                 @endforeach
                 <p class="text-light bg-secondary p-2">Explation:{{ $question->explanation }}</p>
              </div>
          @endforeach

    </div>
</div>
{{-- @endsection --}}
