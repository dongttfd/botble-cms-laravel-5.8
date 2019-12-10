<footer data-background="{{ Theme::asset()->url('images/page-intro-01.png') }}" class="page-footer bg-dark pt-50 bg-parallax">
    <div class="bg-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <aside class="widget widget--transparent widget__footer widget__about">
                    <div class="widget__content">
                        <header class="person-info">
                            <div class="person-info__thumbnail"><a href="https://botble.com"><img src="{{ Theme::asset()->url('images/men.jpg') }}" alt="Botble technologies"></a></div>
                            <div class="person-info__content">
                                <h3 class="person-info__title">{{ __('Botble Technologies') }}</h3>
                                <p class="person-info__description">{{ __('A young team in Vietnam') }}</p>
                            </div>
                        </header>
                        <div class="person-detail">
                            <p><i class="ion-home"></i>{{ __('Go Vap District, HCM City, Vietnam') }}</p>
                            <p><i class="ion-earth"></i><a href="https://botble.com">https://botble.com</a></p>
                            <p><i class="ion-email"></i><a href="mailto:{{ setting('email_support') }}">{{ setting('email_support') }}</a></p>
                        </div>
                    </div>
                </aside>
            </div>
            {!! dynamic_sidebar('footer_sidebar') !!}
        </div>
    </div>
    <div class="page-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="page-copyright">
                        <p>{!! __(theme_option('copyright')) !!}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="page-footer__social">
                        <ul class="social social--simple">
                            <li><a href="{{ setting('facebook') }}" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ setting('twitter') }}" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ setting('google_plus') }}" title="Google"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="back2top"><i class="fa fa-angle-up"></i></div>
</div>

<!-- JS Library-->
{!! Theme::footer() !!}

@if (session()->has('success_msg'))
    <script type="text/javascript">
        swal('{{ __('Success') }}', "{{ session('success_msg', '') }}", 'success');
    </script>
@endif

@if (session()->has('error_msg'))
    <script type="text/javascript">
        swal('{{ __('Success') }}', "{{ session('error_msg', '') }}", 'error');
    </script>
@endif

<div id="fb-root"></div>
<script>
    'use strict';
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '1752152358341085',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v3.2'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<div class="fb-customerchat"
     attribution=setup_tool
     page_id="157007981299897"
     theme_color="#0084ff">
</div>

</body>
</html>
