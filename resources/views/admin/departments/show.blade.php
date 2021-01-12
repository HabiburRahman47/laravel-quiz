@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
             <div class="btn-group float-right" role="group" aria-label="Third group">
                <a href="{{ route('web.admin.departments.edit',$department->id) }}"
                   class="btn btn-primary" type="button"><span class="cil-plus"></span>edit</a>
            </div>
            <!-- /.row-->
            <h4 class="mb-4">Department</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $department->name }}</td>
                                </tr>
                                <tr>
                                    <td>Property</td>
                                    <td>{{ $department->property->name }}</td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $department->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $department->updated_at }}</td>
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
     @if(count($department->sections))
     <div class="container-fluid">
         <div class="btn-group float-right" role="group" aria-label="Third group">
            <a href="{{ route('web.admin.sections.index',['department_id'=>$department->id ]) }}"
                class="btn btn-secondary" type="button">manage</a>    
            </div>
        <div class="fade-in">
            <h4 class="mb-4">Section</h4>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <tr style="border-top: hidden">
                                <th>No</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Action</th>
                            </tr>
                            @foreach($department->sections as $key=>$section)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$section->name}}</td>
                                       <td>
                                    <ul>
                                    @foreach($section->courses as $key => $course)
                                           <li><a href="{{ route('web.admin.courses.show',$course->id) }}"> {{$course->name}}</a></li>  
                                    @endforeach
                                    </ul>
                                    </td>
                                    <td>
                                         <a href="{{ route('web.admin.sections.show',$section->id) }}"
                   class="btn btn-primary" type="button"><span ></span>view</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        </div>
        @endif
    </div>
@endsection


