@extends('site\quizzes\main')
@section('content')
<div class="container">
  <div class="card-body">
    <hr>
    <form  method="post" class="form-group">
      @csrf
      @foreach($questions as $key =>  $question)
        @php
        $q = 1+$key
        @endphp
        <div class="form-group">
          {{-- <label class="form-check-label" for="question">Question {{1+$key}}:</label> --}}
          <h4>({{1+$key}}) {{$question->name}}</h4>
          <input type="hidden" name="questions[{{ $q }}]" value="{{ $question->id }}">
           @foreach($question->choices as $key =>  $choice)
              <label>
                  <input id="choice" type="radio" name="choice[{{$question->id}}]" 
                      value="{{old('choice',$choice->id)}}"  {{ ($choice->id==$question->canditade_selected_ans)? "checked" : "" }}>
                      {{$choice->name}}
              </label>
              <br>
          @endforeach
        </div>
        @endforeach
      <div class="form-group">
         <button formaction="{{ route('web.site.quizSubmit',$sessionId) }}" type="submit">Submit</button>
         <button formaction="{{ route('web.site.quiz.incomplete',$sessionId) }}" type="submit">Save</button>
      </div>
      
    </form>
  </div>
</div>
@endsection