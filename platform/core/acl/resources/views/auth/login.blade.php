@extends('core/acl::auth.master')

@section('content')
    <h3 class="form-title font-green">{{ trans('core/acl::auth.login_title') }}</h3>
    <div class="content-wrapper">
        {!! Form::open(['route' => 'access.login', 'class' => 'login-form']) !!}
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span></span>
            </div>
            <div class="form-group">
                <label class="control-label">{{ trans('core/acl::auth.login.username') }}</label>
                {!! Form::text('username', old('username', app()->environment('demo') ? 'botble' : null), ['class' => 'form-control form-control-solid placeholder-no-fix', 'placeholder' => trans('core/acl::auth.login.username')]) !!}
            </div>

            <div class="form-group">
                <label class="control-label">{{ trans('core/acl::auth.login.password') }}</label>
                {!! Form::input('password', 'password', (app()->environment('demo') ? '159357' : null), ['class' => 'form-control form-control-solid placeholder-no-fix', 'placeholder' => trans('core/acl::auth.login.password')]) !!}
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label>
                            {!! Form::checkbox('remember', 1, null, ['class' => 'styled']) !!} {{ trans('core/acl::auth.login.remember') }}
                        </label>
                    </div>
                    <div class="col-6 text-right">
                        <a class="lost-pass-link" href="{{ route('access.password.request') }}" title="{{ trans('core/acl::auth.forgot_password.title') }}">{{ trans('core/acl::auth.lost_your_password') }}</a>
                    </div>
                </div>
            </div>

            <div class="form-group form-actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> {{ trans('core/acl::auth.login.login') }}</button>
            </div>

            {!! apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, 'core/acl') !!}

        {!! Form::close() !!}
    </div>
@stop
