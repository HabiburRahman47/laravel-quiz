@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Section-Course</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Section</td>
                                    <td><a href="{{route('web.admin.sections.show',$sectionCourse->section->id)}}">{{$sectionCourse->section->name}}</a></td>
                                </tr>
                                <tr>
                                    <td>Choice</td>
                                    <td><a href="{{route('web.admin.courses.show',$sectionCourse->course->id)}}">{{$sectionCourse->course->name}}</a></td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $sectionCourse->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $sectionCourse->updated_at }}</td>
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
