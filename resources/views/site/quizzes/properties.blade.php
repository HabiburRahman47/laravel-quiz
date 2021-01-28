@extends('site\quizzes\main')
@section('content')
<div class="container mt-2">
  <h2 class="text-center">List of Properties</h2><br>
  <hr>
  <div class="row">
    @foreach($properties as $key => $property)
              <div class="col-md-3 col-sm-6">
                  <div class="card card-block text-center p-3">
                     <img src="https://via.placeholder.com/400" alt="Photo of sunset">
                      <h5 class="card-title mt-3 mb-3">
                      <a href="{{ route('web.site.property.show',$property->slug) }}"> 
                         {{ $property->name }}
                         </a>
                     
            
                        </h5>
                  </div>
              </div>
              @endforeach
  </div>
    
</div>
@endsection
