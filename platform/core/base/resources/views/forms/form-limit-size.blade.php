@extends('core/base::layouts.master')
@section('content')
    <div class="form-content-area">
    @if ($showStart)
        {!! Form::open(Arr::except($formOptions, ['template'])) !!}
    @endif

    @if ($form->getModuleName())
        @php do_action(BASE_ACTION_TOP_FORM_CONTENT_NOTIFICATION, $form->getModuleName(), request(), $form->getModel()) @endphp
    @endif
    <div class="max-width-1200">
        <div class="flexbox-grid no-pd-none">

            <div class="flexbox-content">
                @php do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'main', null) @endphp
                <div class="widget meta-boxes">
                    <div class="widget-title">
                        <h4>
                            <span> {{ trans('core/base::forms.basic_info_title') }}</span>
                        </h4>
                    </div>
                    <div class="widget-body">
                        @if ($showFields)
                            @foreach ($fields as $key => $field)
                                @if ($field->getName() == $form->getBreakFieldPoint())
                                    @break
                                @else
                                    @unset($fields[$key])
                                @endif
                                @if (!in_array($field->getName(), $exclude))
                                    {!! $field->render() !!}
                                    @if ($field->getName() == 'name' && defined('BASE_FILTER_SLUG_AREA'))
                                        {!! apply_filters(BASE_FILTER_SLUG_AREA, $form->getModuleName(), $form->getModel()) !!}
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        </div>
             </div>
                @foreach ($form->getMetaBoxes() as $key => $metaBox)
                    {!! $form->getMetaBox($key) !!}
                @endforeach

                @if ($form->getModuleName())
                    @php do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'advanced', $form->getModel()) @endphp
                @endif
        </div>
        <div class="flexbox-content flexbox-right">
            {!! $form->getActionButtons() !!}
            @if ($form->getModuleName())
                @php do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'top', $form->getModel()) @endphp
            @endif

            @foreach ($fields as $field)
                @if (!in_array($field->getName(), $exclude))
                    <div class="widget meta-boxes">
                        <div class="widget-title">
                            <h4>{!! Form::customLabel($field->getName(), $field->getOption('label'), $field->getOption('label_attr')) !!}</h4>
                        </div>
                        <div class="widget-body">
                            {!! $field->render([], false) !!}
                        </div>
                    </div>
                @endif
            @endforeach

            @if ($form->getModuleName())
                @php do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'side', $form->getModel()) @endphp
            @endif
        </div>
    </div>

    @if ($showEnd)
        {!! Form::close() !!}
    @endif
@stop

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

