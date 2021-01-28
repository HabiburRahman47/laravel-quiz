@extends('site\quizzes\main')
@section('content')
<div class="container p-3">
  <h2 class="text-center">List of Property Type</h2><br>
  <hr>
    <div class="row">
        
              @foreach($propertyTypes as $key => $propertyType)
              <div class="col-md-3 col-sm-6">
                  <div class="card card-block text-center p-3">
                     <img src="https://via.placeholder.com/400" alt="Photo of sunset">
                      <h5 class="card-title mt-3 mb-3">
                      <a href="{{ route('web.site.properties.index',$propertyType->slug) }}"> 
                         {{ $propertyType->name }}
                         </a>
                     
            
                        </h5>
                  </div>
              </div>
              @endforeach
                
         
    </div>
</div>
@endsection