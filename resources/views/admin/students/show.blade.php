@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <div class="btn-group float-right" role="group" aria-label="Third group">
                 <a href="{{ route('web.admin.cards.create',['cardable_type'=>'student','cardable_id'=>$student->id]) }}"
                   class="btn btn-primary" type="button"><span class="cil-plus"></span>Add Card</a>
            </div>
            <h4 class="mb-4">Section</h4>
             
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Prefix</td>
                                    <td>{{ $student->prefix }}</td>
                                </tr>
                                <tr>
                                    <td>Roll Number</td>
                                    <td>{{ $student->roll_number }}</td>
                                </tr>
                                <tr>
                                    <td>Section</td>
                                    <td>
                                    <a href="{{ route('web.admin.sections.show',[$student->section->id]) }}">{{ $student->section->name }}</a></td>
                                </tr>
                                <tr>
                                    <td>Property</td>
                                    <td>
                                    <a href="{{ route('web.admin.properties.show',[$student->property->id]) }}">{{ $student->property->name }}</a></td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $student->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $student->updated_at }}</td>
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


