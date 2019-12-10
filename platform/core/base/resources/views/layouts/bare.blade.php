@extends('core/base::layouts.base')

@section('body-class') full-width page-condensed @stop

@section('page')

    @include('core/base::layouts.partials.top-header')

    @yield('content')

    <!-- Footer -->
    <div class="footer clearfix center-block row">
        <div class="col-xs-12 col-sm-8">{!! trans('core/base::layouts.copyright') !!}</div>

        <div class="d-none d-sm-block col-sm-4 text-right">
            <strong>{{ trans('core/base::layouts.powered_by') }}</strong>
            <a href="http://www.botble.com"><img src="{{ url('/images/logos/logo.png') }}"/></a>
        </div>
    </div>
    <!-- /footer -->
@stop
