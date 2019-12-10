@extends('plugins/member::layouts.skeleton')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ trans('plugins/member::dashboard.register-title') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('public.member.register') }}">
              @csrf
              <div class="form-group row">
                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ trans('plugins/member::dashboard.first_name') }}</label>
                <div class="col-md-6">
                  <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                  @if ($errors->has('first_name'))
                    <span class="invalid-feedback">
                <strong>{{ $errors->first('first_name') }}</strong>
                </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ trans('plugins/member::dashboard.last_name') }}</label>
                <div class="col-md-6">
                  <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
                  @if ($errors->has('last_name'))
                    <span class="invalid-feedback">
                <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('plugins/member::dashboard.email') }}</label>
                <div class="col-md-6">
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
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
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                  @if ($errors->has('password'))
                    <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
                </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ trans('plugins/member::dashboard.password-confirmation') }}</label>
                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
              </div>
              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn default-btn fw6">
                    {{ trans('plugins/member::dashboard.register-cta') }}
                  </button>
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
  <!-- Laravel Javascript Validation -->
  <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
  {!! JsValidator::formRequest(\Botble\Member\Http\Requests\RegisterRequest::class); !!}
@endpush
