@extends('core.dashboard.layout.main')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <!-- /.row-->
            <h4 class="mb-4">Choice</h4>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <tr>
                                    <td>Card Number</td>
                                    <td>{{ $card->card_number }}</td>
                                </tr>
                                @if(($card->cardable_type) == 'App\Models\V1\Student\Student')
                                    <tr>
                                        <td>Cardable Type</td>
                                        <td><span  class="badge badge-success">{{"Student"}}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Cardable Id</td>
                                        <td><a href="{{ route('web.admin.students.show',[$card->cardable->id]) }}">{{$card->cardable->prefix}}{{$card->cardable->roll_number}}</a></td>
                                    </tr>
                                    @endif
                                {{--  @elseif(($card->cardable_type) == 'App\Models\V1\Topic\Topic')
                                    <tr>
                                        <td>Eventable Type</td>
                                        <td><span  class="badge badge-info">{{"Topic"}}</span></td>
                                    </tr>
                                    <tr>
                                        <td>Cardable Id</td>
                                        <td><a href="{{route('web.admin.topics.show',$card->topics->id)}}">{{$card->students->prefix}}</td>
                                    </tr>
                                @endif  --}}
                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $card->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $card->updated_at }}</td>
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


