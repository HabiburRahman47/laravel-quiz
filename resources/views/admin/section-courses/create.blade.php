@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a Section With Course</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.section-courses.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="section_id">Section</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="section_id" name="section_id">
                                            <option value="">Select Section</option>
                                            @foreach($sections as $section)
                                                <option value="{{$section->id}}" {{(collect(old('section_id'))->contains($section->id)) ? 'selected':''}}>{{$section->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="course_id">Course</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="course_id" name="course_id">

                                            <option value="">Select Course</option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}" {{(collect(old('course_id'))->contains($course->id)) ? 'selected':''}}>{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- @include('core.dashboard.layout.partials.seo.create-form-fields') --}}
                                <hr>
                                <div class="form-actions">
                                    <a href="{{route('web.admin.section-courses.index')}}" class="btn btn-secondary" type="button">Cancel</a>
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





