@extends('plugins/member::layouts.skeleton')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ trans('plugins/member::dashboard.login-title') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('public.member.login') }}">
              @csrf
              <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ trans('plugins/member::dashboard.email') }}</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>
                  @if ($errors->has('email'))
                    <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ trans('plugins/member::dashboard.password') }}</label>
                <div class="col-md-6">
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                  @if ($errors->has('password'))
                    <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
                </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ trans('plugins/member::dashboard.remember-me') }}
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn default-btn fw6">
                    {{ trans('plugins/member::dashboard.login-cta') }}
                  </button>
                  <a class="btn btn-link" href="{{ route('public.member.password.request') }}">
                    {{ trans('plugins/member::dashboard.forgot-password-cta') }}
                  </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
  {!! JsValidator::formRequest(\Botble\Member\Http\Requests\LoginRequest::class); !!}
@endpush
