@extends('site\quizzes\main')
@section('content')
<div class="container-fluid">
    <h2 class="text-center">List of Category</h2><br>
  <hr>
    <div class="row">
        
              @foreach($categories as $category)
              <div class="col-md-3 col-sm-6">
                  <div class="card card-block text-center p-3">
                     <img src="https://via.placeholder.com/400" alt="Photo of sunset">
                      <h5 class="card-title mt-3 mb-3">
                      <a href="{{ route('web.site.category.show',$category->slug) }}">
                         {{ $category->name }}
                      </a>
                        </h5>
                  </div>
              </div>
              @endforeach
                
         
    </div>
</div>
@endsection


