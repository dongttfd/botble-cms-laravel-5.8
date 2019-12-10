@if ($showStart)
    {!! Form::open(Arr::except($formOptions, ['template'])) !!}
@endif

@if ($form->getModuleName())
    @php do_action(BASE_ACTION_TOP_FORM_CONTENT_NOTIFICATION, $form->getModuleName(), request(), $form->getModel()) @endphp
@endif

@if ($showFields)
    @foreach ($fields as $field)
        @if (!in_array($field->getName(), $exclude))
            {!! $field->render() !!}
            @if ($field->getName() == 'name' && defined('BASE_FILTER_SLUG_AREA'))
                {!! apply_filters(BASE_FILTER_SLUG_AREA, $form->getModuleName(), $form->getModel()) !!}
            @endif
        @endif
    @endforeach
@endif
<div class="clearfix"></div>

@foreach ($form->getMetaBoxes() as $key => $metaBox)
    {!! $form->getMetaBox($key) !!}
@endforeach

@if ($form->getModuleName())
    @php do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'advanced', $form->getModel()) @endphp
@endif

{!! $form->getActionButtons() !!}

@if ($showEnd)
    {!! Form::close() !!}
@endif

@if ($form->getValidatorClass())
    @if ($form->isUseInlineJs())
        {!! Assets::scriptToHtml('jquery') !!}
        {!! Assets::scriptToHtml('form-validation') !!}
        {!! $form->renderValidatorJs() !!}
    @else
        @push('footer')
            {!! $form->renderValidatorJs() !!}
        @endpush
    @endif
@endif

