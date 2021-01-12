@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Course Section Teacher</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Course Section</td>
                                    @foreach($courseSections as $courseSection)
                                        @if($courseSectionTeacher->course_section_id==$courseSection->id)
                                            <td>{{ $courseSection->course->name}}({{ $courseSection->section->name}})</td>
                                        @endif
                                    @endforeach
                                    
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $courseSectionTeacher->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $courseSectionTeacher->updated_at }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
        </div>
    </div>
@endsection


