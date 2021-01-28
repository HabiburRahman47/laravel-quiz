@extends('site\quizzes\main')
@section('content')
<div class="container p-3">
     <div class="row">
        <div class="col-sm-5">
            <h3>Previous Quiz Result</h3>
            <table class="table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Quiz Name</th>
                    <th>Total Question</th>
                    <th>Total Right Answer</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    @foreach ($quizSessions as $key=>$item)
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->quiz_name }}</td>
                        @if($item->status==true)
                          <td>{{ $item->result->total_question }}</td>
                          <td>{{ $item->result->total_right_ans }}</td>
                          <td><span class="badge badge-success">Complete</span></td>
                          <td><a href="{{ route('web.site.quiz.result',$item->id) }}" class="btn btn-primary">View Result</a></td>
                        @else
                         @php
                          $total_question=0;
                          $total_right_ans=0;                             
                         @endphp
                          <td>{{ $total_question }}</td>
                          <td>{{ $total_right_ans }}</td>
                          <td><span class="badge badge-danger">Incomplete</span></td>
                          <td><a href="{{ route('web.site.incomplete.quiz.show',$item->id) }}" class="btn btn-warning">Start Again</a></td>
                        @endif
                        
                        <td></td>
                        </tr>                       
                    @endforeach
                  
                </tbody>
             </table>
        </div>
        <div class="col-sm-2">
          
        </div>
    </div>
</div>
@endsection