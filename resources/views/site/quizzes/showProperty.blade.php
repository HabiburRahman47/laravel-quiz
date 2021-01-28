@extends('site\quizzes\main')
@section('content')
<div class="container p-3">
     <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <a class="text-center" href="#">
              <img class="img-responsive" src="https://via.placeholder.com/250X300">
            </a>
        </div>
        <div class="col-sm-5">
            <h1 class="display-4">{{ $property->name }}</h1>
            <h3>Private Name:{{ $property->private_name }}</h3>
            <h3>Description:{{ $property->description }}</h3>
            <h3>Property Type:{{ $property->propertyType->name }}</h3>
            <button type="button" class="btn btn-outline-info rounded-pill d-none d-xl-block d-lg-block d-xl-none">
              <a href="{{ route('web.site.category.index') }}">
                Quiz
              </a>
              
            </button>

        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
@endsection