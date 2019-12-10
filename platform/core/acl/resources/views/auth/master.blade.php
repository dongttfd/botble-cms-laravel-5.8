@extends('core/base::layouts.base')

@section('body-class')
    login
@stop

@section ('page')
    <div class="content">
        @yield('content')
    </div>
    <div class="copyright">
        <p>
            {!! trans('core/base::layouts.copyright', ['year' => Carbon\Carbon::now()->format('Y'), 'company' => config('core.base.general.base_name'), 'version' => get_cms_version()]) !!}
        </p>
        <p>
            @foreach (Assets::getAdminLocales() as $key => $value)
                <span @if (app()->getLocale() == $key) class="active" @endif>
                    <a href="{{ route('admin.language', $key) }}">
                        {!! language_flag($value['flag'], $value['name']) !!} <span>{{ $value['name'] }}</span>
                    </a>
                </span>
            @endforeach
        </p>
    </div>
@stop
