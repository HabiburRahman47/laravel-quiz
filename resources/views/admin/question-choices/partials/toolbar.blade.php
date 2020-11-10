<div class="row toolbar-container">
    <div class="col-md-4">
        <input id="searchbox" type="text" class="form-control" placeholder="Search here...">
    </div>
    <div class="col-md-8">
        <div class="btn-toolbar float-right" role="toolbar"
             aria-label="Toolbar with button groups">
            <div id="dt-custom-buttons-pane" class="mr-2"></div>
            <div class="btn-group mr-2" role="group" aria-label="Second group">
                <button class="btn btn-primary" type="button" data-toggle="collapse"
                        data-target="#collapseExample" aria-expanded="false"
                        aria-controls="collapseExample">
                    <span class="cil-filter"></span>Filter
                </button>
            </div>
            <div class="btn-group" role="group" aria-label="Third group">
                @if(request('trashed'))
                    <a href="{{route('web.admin.question-choices.index')}}"
                       class="btn btn-dark"
                       type="button">Without Trashed</a>
                @else
                    <a href="{{route('web.admin.question-choices.index',['trashed' => true])}}"
                       class="btn btn-dark"
                       type="button">View Trashed</a>
                @endif
                <a href="{{ route('web.admin.question-choices.create') }}"
                   class="btn btn-primary" type="button"><span class="cil-plus"></span>Create</a>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3 collapse" id="collapseExample">
        <div class="card card-body bg-light mb-0">

            <form class="form-inline">
                <div class="form-group col-md-3 mb-0">
                    <select name="question_id" id="question_id" class="form-control filterable" required>
                        <option value="">Select Question</option>
                        @foreach($questions as $question)
                            <option value="{{ $question->id }}"  @if( request('question_id')== $question->id) selected @endif >{{ $question->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3 mb-0">
                    <select name="question_id" id="question_id" class="form-control filterable" required>
                        <option value="">Select Choice</option>
                        @foreach($choices as $choice)
                            <option value="{{ $choice->id }}"  @if( request('choice_id')== $choice->id) selected @endif >{{ $choice->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-3 input-daterange">
                    <input type="text" name="from_date" id="from_date" class="form-control filterable"
                           placeholder="From Date" readonly/>
                </div>
                <div class="form-group col-md-3 input-daterange">
                    <input type="text" name="to_date" id="to_date" class="form-control filterable"
                           placeholder="To Date" readonly/>
                </div>
                <div class="col-md-4 mt-3">
                    <input type="reset" name="refresh" id="refresh" class="btn btn-danger dt-triggerable"/>
                </div>
            </form>
        </div>
    </div>
</div>


