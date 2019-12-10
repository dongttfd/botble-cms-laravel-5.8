@extends('core/acl::auth.master')

@section('content')
    <h3 class="form-title font-green">{{ trans('core/acl::auth.forgot_password.title') }}</h3>
        <div class="content-wrapper">
        {!! Form::open(['route' => 'access.password.email', 'class' => 'forget-form']) !!}
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>{{ __('Please complete the form to submit!') }}</span>
        </div>
        <p>{!! trans('core/acl::auth.forgot_password.message') !!}</p>
        <div class="form-group">
            <label class="control-label">{{ trans('core/acl::auth.login.email') }}</label>
            {!! Form::text('email', old('email'), ['class' => 'form-control placeholder-no-fix', 'placeholder' => trans('core/acl::auth.login.placeholder.email')]) !!}
        </div>
        <div class="form-group">
            <button type="submit" class="btn green">{{ trans('core/acl::auth.forgot_password.submit') }}</button>
        </div>
        {!! Form::close() !!}
        <p class="link-bottom"><a href="{{ route('access.login') }}">{{ trans('core/acl::auth.back_to_login') }}</a></p>
    </div>
@stop
