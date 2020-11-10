
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger form-error">{{ $error }} </div>
    @endforeach
@endif

