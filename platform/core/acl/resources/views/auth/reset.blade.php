@extends('core/acl::auth.master')

@section('content')

    <h3 class="form-title font-green">{{ trans('core/acl::auth.reset.title') }}</h3>
    <div class="content-wrapper">
        {!! Form::open(['route' => 'access.password.reset.post', 'method' => 'POST']) !!}
            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="control-label">{{ trans('core/acl::auth.reset.email') }}</label>
                {!! Form::text('email', old('email', $email), ['class' => 'form-control placeholder-no-fix', 'placeholder' => trans('core/acl::auth.reset.email')]) !!}
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="control-label">{{ trans('core/acl::auth.reset.new_password') }}</label>
                {!! Form::password('password', ['class' => 'form-control placeholder-no-fix', 'placeholder' => trans('core/acl::auth.reset.new_password')]) !!}
            </div>

            <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label class="control-label">{{ trans('core/acl::auth.repassword') }}</label>
                {!! Form::password('password_confirmation', ['class' => 'form-control placeholder-no-fix', 'placeholder' => trans('core/acl::auth.reset.repassword')]) !!}
            </div>

            <div class="row form-actions">
                <div class="col-12">
                    <input type="hidden" name="token" value="{{ $token }}"/>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-unlock-alt"></i>
                        {{ trans('core/acl::auth.reset.update') }}
                    </button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@stop
