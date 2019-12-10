<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ page_title()->getTitle() }}</title>

    <meta name="robots" content="noindex,follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon shortcut" href="{{ url(config('core.base.general.favicon')) }}">
    <link rel='stylesheet'
          href='//fonts.googleapis.com/css?family=Roboto:100%2C100italic%2C300%2C300italic%2C400%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|Roboto+Slab:100%2C300%2C400%2C700&#038;subset=greek-ext%2Cgreek%2Ccyrillic-ext%2Clatin-ext%2Clatin%2Cvietnamese%2Ccyrillic'
          type='text/css' media='all'/>

    {!! Assets::renderHeader(['core']) !!}

    @yield('head')

    @stack('header')
</head>
<body class="@yield('body-class', 'page-sidebar-closed-hide-logo page-content-white page-container-bg-solid')">

    @yield('page')

    @include('core/base::elements.common')

    {!! Assets::renderFooter() !!}

    @yield('javascript')

    @stack('footer')
</body>
</html>
