<div id="flash-overlay-modal" class="modal fade {{ isset($modalClass) ? $modalClass : '' }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $title }}</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>{!! $body !!} {{ isset($modalClass) ? $modalClass : '' }}</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content-->
    </div>
    <!-- /.modal-dialog-->
</div>



{{--<div id="flash-overlay-modal" class="modal fade {{ isset($modalClass) ? $modalClass : '' }}">--}}
    {{--<div class="modal-dialog">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}

                {{--<h4 class="modal-title">{{ $title }}</h4>--}}
            {{--</div>--}}

            {{--<div class="modal-body">--}}
                {{--<p>{!! $body !!}</p>--}}
            {{--</div>--}}

            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
