@extends('core/base::layouts.master')
@section('content')
    @if ($showStart)
        {!! Form::open(Arr::except($formOptions, ['template'])) !!}
    @endif

    @if ($form->getModuleName())
        @php do_action(BASE_ACTION_TOP_FORM_CONTENT_NOTIFICATION, $form->getModuleName(), request(), $form->getModel()) @endphp
    @endif
    <div class="row">
        <div class="col-md-9">
            <div class="tabbable-custom">
                <ul class="nav nav-tabs ">
                    <li class="nav-item">
                        <a href="#tab_detail" class="nav-link active" data-toggle="tab">{{ trans('core/base::tabs.detail') }} </a>
                    </li>
                    {!! apply_filters(BASE_FILTER_REGISTER_CONTENT_TABS, null, $form->getModuleName(), $form->getModel()) !!}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_detail">
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
                        <div class="clearfix"></div>
                    </div>
                    {!! apply_filters(BASE_FILTER_REGISTER_CONTENT_TAB_INSIDE, null, $form->getModuleName(), $form->getModel()) !!}
                </div>
            </div>

            @foreach ($form->getMetaBoxes() as $key => $metaBox)
                {!! $form->getMetaBox($key) !!}
            @endforeach

            @if ($form->getModuleName())
                @php do_action(BASE_ACTION_META_BOXES, $form->getModuleName(), 'advanced', $form->getModel()) @endphp
            @endif
        </div>
        <div class="col-md-3 right-sidebar">
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

