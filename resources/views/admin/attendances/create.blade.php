@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Attendance</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.attendances.store')}}"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Info</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="info"
                                               value="{{old('info')}}"
                                               placeholder="Info">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Notes</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="text" name="notes"
                                               value="{{old('notes')}}"
                                               placeholder="Notes">
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="course_section_id">Course Section</label>
                                    <div class="col-md-9">
                                        <select class="form-control" id="course_section_id" name="course_section_id">
                                            <option value="">Select Property</option>
                                            @foreach($courseSections as $courseSction)
                                                <option value="{{$courseSction->id}}"  {{(collect(old('course_section_id'))->contains($courseSction->id)) ? 'selected':''}}>{{$courseSction->course->name}}({{$courseSction->section->name}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.attendances.index')}}">Cancel</a>
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


