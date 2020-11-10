@extends('core.dashboard.layout.main')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header"><strong>Create</strong> a new Card</div>
                        <div class="card-body">
                            <form class="form-horizontal" action="{{route('web.admin.cards.store')}}"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @include('errors.form-error', ['errors'=>$errors])
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="text-input">Card Number</label>
                                    <div class="col-md-9">
                                        <input class="form-control" id="text-input" type="number" name="card_number"
                                               value="{{old('card_number')}}"
                                               placeholder="card number">
                                    </div>
                                </div>
                                 <input type="hidden" name="cardable_type" value="{{ request("cardable_type")}}">
                                 <input type="hidden" name="cardable_id" value="{{ request("cardable_id")}}">
                                <hr>
                                <div class="form-actions">
                                    <a class="btn btn-secondary" type="button"
                                       href="{{route('web.admin.cards.index')}}">Cancel</a>
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


