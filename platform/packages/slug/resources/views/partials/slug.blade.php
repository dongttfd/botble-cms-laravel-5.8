@if (empty($object))
    <div class="form-group @if ($errors->has('slug')) has-error @endif">
        {!! Form::permalink('slug', old('slug'), 0, $prefix) !!}
        {!! Form::error('slug', $errors) !!}
    </div>
@else
    <div class="form-group @if ($errors->has('slug')) has-error @endif">
        {!! Form::permalink('slug', $object->slug, $object->slug_id, $prefix) !!}
        {!! Form::error('slug', $errors) !!}
    </div>
@endif
<input type="hidden" name="slug-screen" value="{{ $screen }}">