@extends('core/base::layouts.master')
@section('content')
    {!! Form::open(['route' => ['setting.email.template.store']]) !!}
    <div class="max-width-1200">
        <div class="flexbox-annotated-section">
            <div class="flexbox-annotated-section-annotation">
                <div class="annotated-section-title pd-all-20">
                    <h2>{{ trans('core/setting::setting.email.title') }}</h2>
                </div>
                <div class="annotated-section-description pd-all-20 p-none-t">
                    <p class="color-note">
                        {!! trans('core/setting::setting.email.description') !!}
                    </p>
                    <div class="available-variable">
                        @foreach(MailVariable::getVariables('core') as $core_key => $core_variable)
                            <p><code>{{ $core_key }}</code>: {{ $core_variable }}</p>
                        @endforeach
                            @foreach(MailVariable::getVariables($plugin_data['name']) as $module_key => $module_variable)
                                <p><code>{{ $module_key }}</code>: {{ $module_variable }}</p>
                            @endforeach
                    </div>
                </div>
            </div>

            <div class="flexbox-annotated-section-content">
                <div class="wrapper-content pd-all-20 email-template-edit-wrap">
                    @if ($email_subject)
                        <div class="form-group">
                            <label class="text-title-field"
                                   for="email_subject">
                                {{ trans('core/setting::setting.email.subject') }}
                            </label>
                            <input type="hidden" name="email_subject_key"
                                   value="{{ get_setting_email_subject_key($plugin_data['type'], $plugin_data['name'], $plugin_data['template_file']) }}">
                            <input data-counter="300" type="text" class="next-input"
                                   name="email_subject"
                                   id="email_subject"
                                   value="{{ $email_subject }}">
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="hidden" name="template_path" value="{{ get_setting_email_template_path($plugin_data['name'], $plugin_data['template_file']) }}">
                        <label class="text-title-field"
                               for="email_content">{{ trans('core/setting::setting.email.content') }}</label>
                        <textarea id="mail-template-editor" name="email_content" class="form-control" style="overflow-y:scroll; height: 500px;">{{ $email_content }}</textarea>
                    </div>
                </div>
            </div>

        </div>

        <div class="flexbox-annotated-section" style="border: none">
            <div class="flexbox-annotated-section-annotation">
                &nbsp;
            </div>
            <div class="flexbox-annotated-section-content">
                <a href="{{ route('settings.email') }}" class="btn btn-secondary">{{ trans('core/setting::setting.email.back') }}</a>
                <a class="btn btn-warning btn-trigger-reset-to-default" data-target="{{ route('setting.email.template.reset-to-default') }}">{{ trans('core/setting::setting.email.reset_to_default') }}</a>
                <button class="btn btn-info" type="submit" name="submit">{{ trans('core/setting::setting.save_settings') }}</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    {!! Form::modalAction('reset-template-to-default-modal', trans('core/setting::setting.email.confirm_reset'), 'info', trans('core/setting::setting.email.confirm_message'), 'reset-template-to-default-button', trans('core/setting::setting.email.continue')) !!}
@endsection