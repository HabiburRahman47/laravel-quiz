@if(!empty($trashUrl))
    <a href="{{$showUrl}}" class="btn btn-icon btn-secondary" title="View"><span class="material-icons">remove_red_eye</span></a>
    <a href="{{$editUrl}}" class="btn btn-icon btn-secondary" title="Edit"><span class="material-icons">edit</span></a>
    <button data-id="{{ $id }}" data-url="{{$trashUrl}}" class="btn btn-icon btn-secondary trash-record" title="Trash|Delete Temporarily"><span class="material-icons">delete</span></button>
@endif

@if(!empty($restoreUrl))
    <button data-id="{{ $id }}" data-url="{{$restoreUrl}}" class="btn btn-icon btn-primary restore-record"><span class="material-icons" title="Restore">restore</span></button>
@endif

<button data-id="{{ $id }}" data-url="{{ $deleteUrl }}" class="btn btn-icon btn-danger delete-record" title="Delete Permanently"><span class="material-icons">delete_forever</span></button>