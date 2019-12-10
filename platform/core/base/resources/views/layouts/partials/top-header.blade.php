<!-- Navbar -->
<div class="page-header-top navbar navbar-inverse" role="navigation" xmlns="http://www.w3.org/1999/html">
    <div class="navbar-header page-logo">

        <a class="navbar-brand" href="{{ route('dashboard.index') }}">
            <img src="{{ url(setting('admin_logo', config('core.base.general.logo'))) }}" alt="logo" class="logo-default" style="max-width: 90px;"/>
        </a>
        <div class="sidebar-toggle menu-toggler responsive-toggler d-block d-sm-none" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </div>
        <div class="sidebar-toggle menu-toggler d-none d-sm-block">
            <span></span>
        </div>
    </div>

    <div class="top-menu">
        <ul class="nav navbar-nav float-right collapse">

            @if (Auth::check() && Auth::user()->isImpersonated())
                <li class="dropdown">
                    <a class="dropdown-toggle dropdown-header-name" style="padding-right: 10px" href="{{ route('users.leave_impersonation') }}"><i class="fas fa-user-ninja"></i> <span class="d-none d-sm-inline">{{ __('Leave impersonation') }}</span> </a>
                </li>
            @endif

            @if (config('core.base.general.admin_dir') != '')
                <li class="dropdown">
                    <a class="dropdown-toggle dropdown-header-name" style="padding-right: 10px" href="{{ url('/') }}" target="_blank"><i class="fa fa-globe"></i> <span class="d-none d-sm-inline">{{ trans('core/base::layouts.view_website') }}</span> </a>
                </li>
            @endif

            @if (Auth::check())
                {!! apply_filters(BASE_FILTER_TOP_HEADER_LAYOUT, null) !!}
            @endif

            @if (isset($themes) && setting('enable_change_admin_theme') != false)
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle dropdown-header-name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span>{{ trans('core/base::layouts.theme') }}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right icons-right">

                        @foreach ($themes as $name => $file)
                            @if ($active_theme === $name)
                                <li class="active"><a href="{{ route('admin.theme', [$name]) }}">{{ studly_case($name) }}</a></li>
                            @else
                                <li><a href="{{ route('admin.theme', [$name]) }}">{{ studly_case($name) }}</a></li>
                            @endif
                        @endforeach

                    </ul>
                </li>
            @endif

            @if (setting('enable_multi_language_in_admin') != false)
                <li class="language dropdown">
                    <a href="javascript:;" class="dropdown-toggle dropdown-header-name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (array_key_exists(app()->getLocale(), $locales))
                            {!! language_flag($locales[app()->getLocale()]['flag'], $locales[app()->getLocale()]['name']) !!}
                            <span class="d-none d-sm-inline">{{ $locales[app()->getLocale()]['name'] }}</span>
                        @endif
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right icons-right">
                        @foreach ($locales as $key => $value)
                            @if (app()->getLocale() == $key)
                                <li class="active">
                                    <a href="{{ route('admin.language', $key) }}">
                                        {!! language_flag($value['flag'], $value['name']) !!} <span>{{ $value['name'] }}</span>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('admin.language', $key) }}">
                                        {!! language_flag($value['flag'], $value['name']) !!} <span>{{ $value['name'] }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif

            @if (Auth::check())
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle dropdown-header-name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img alt="{{ Auth::user()->getFullName() }}" class="rounded-circle" src="{{ Auth::user()->avatar_url }}" />
                        <span class="username username-hide-on-mobile"> {{ Auth::user()->getFullName() }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li><a href="{{ route('user.profile.view', Auth::user()->getKey()) }}"><i class="icon-user"></i> {{ trans('core/base::layouts.profile') }}</a></li>
                        <li><a href="{{ route('access.logout') }}" class="btn-logout"><i class="icon-key"></i> {{ trans('core/base::layouts.logout') }}</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- /navbar -->