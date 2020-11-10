@if(!empty($trashUrl))
    <a href="{{$showUrl}}" class="btn btn-info"><i class="cil-view-module"></i></a>
    <a href="{{$editUrl}}" class="btn btn-success"><i class="cil-highlighter"></i></a>
    <button data-id="{{ $id }}" data-url="{{$trashUrl}}" class="btn btn-secondary trash-record"><i class="cil-trash"></i></button>
@endif

@if(!empty($restoreUrl))
    <button data-id="{{ $id }}" data-url="{{$restoreUrl}}" class="btn btn-primary restore-record"><i class="cil-window-restore"></i></button>
@endif

<button data-id="{{ $id }}" data-url="{{ $deleteUrl }}" class="btn btn-danger delete-record"><i class="cil-delete"></i></button>
{{--<button class="btn btn-primary float-right" type="button">--}}
{{--    <svg class="c-icon">--}}
{{--        <use xlink:href="core/assets/icons/coreui/free-symbol-defs.svg#cui-eye"></use>--}}
{{--    </svg>--}}
{{--</button>--}}
