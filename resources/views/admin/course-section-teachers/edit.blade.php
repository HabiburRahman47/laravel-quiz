@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Edit</strong> Your Course</div>
                        @if(session()->has('success'))
                            <div class="row">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> &times;</button>
                                    <strong>{{session()->get('success')}}</strong>
                                    <strong><a href="{{route('web.admin.course-section-teachers.show', session('rID'))}}">Click</a> here to show</strong>
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.course-section-teachers.update.all',$courseSectionTeacher->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    {{-- <label class="col-md-3 col-form-label" for="text-input">Course Section Teacher</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="course_section_id" value="{{old('course_section_id',$courseSectionTeacher->course_section_id)}}"
                                               placeholder="Text">
                                    </div> --}}
                                    <label class="col-md-3 col-form-label" for="course_section_id">Course Section</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="course_section_id" name="course_section_id">
                                            <option value="">Select Course Section</option>
                                            @foreach($courseSections as $courseSection)
                                                <option value="{{$courseSection->id}}"  {{$courseSection->id == $courseSectionTeacher->course_section_id ? 'selected' : ''}}>{{$courseSection->course->name}}({{ $courseSection->section->name }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button" href="{{route('web.admin.course-section-teachers.index')}}">Cancel</a>
                                    <button class="btn btn-primary float-right" type="submit">Update</button>
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


