@extends('core/base::layouts.base')

@section ('page')
    <!-- Navbar -->
    <div class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle offcanvas">
                <span class="sr-only">Toggle navigation</span>
                <i class="icon icon-menu"></i>
            </button>
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                <img class="logo">
            </a>
        </div>

    </div>
    <!-- /navbar -->

    <!-- Page container -->
    <div class="page-container col-md-12">
        <!-- Page content -->
        <div class="page-content" style="min-height: calc(100vh - 55px)">
            @yield('content')
        </div>
        <!-- /page content -->
        <div class="clearfix"></div>
    </div>
    <!-- /page container -->
@stop
