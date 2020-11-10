@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Course Section Teacher</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.course-section-teachers.store')}}"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Course-Section-Teacher</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="course_section_id"
                                               value="{{old('course_section_id')}}"
                                               placeholder="Text">
                                    </div>
                                </div> --}}
                                 <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="course_section_id">Course Section Teacher</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="course_section_id" name="course_section_id">
                                            <option value="">Select Course Section Teacher</option>
                                            @foreach($courseSectionTeachers as $courseSectionTeacher)
                                                <option value="{{$courseSectionTeacher->id}}" {{(collect(old('course_section_id'))->contains($courseSectionTeacher->id)) ? 'selected':''}}>{{$courseSectionTeacher->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.course-section-teachers.index')}}">Cancel</a>
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


