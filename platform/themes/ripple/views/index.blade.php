@if (is_plugin_active('blog'))
    @php
        $featured = get_featured_posts(5);
        $featuredList = [];
        if (!empty($featured)) {
            $featuredList = $featured->pluck('id')->all();
        }
    @endphp

    @if (!empty($featured))
        <section class="section pt-50 pb-50 bg-lightgray">
            <div class="container">
                <div class="post-group post-group--hero">
                    @foreach ($featured as $feature_item)
                        @if ($loop->first)
                            <div class="post-group__left">
                                <article class="post post__inside post__inside--feature">
                                    <div class="post__thumbnail">
                                        <img src="{{ get_object_image($feature_item->image, 'featured') }}" alt="{{ $feature_item->name }}"><a href="{{ route('public.single', $feature_item->slug) }}" class="post__overlay"></a>
                                    </div>
                                    <header class="post__header">
                                        <h3 class="post__title"><a href="{{ route('public.single', $feature_item->slug) }}">{{ $feature_item->name }}</a></h3>
                                        <div class="post__meta"><span class="post-category"><i class="ion-cube"></i>
                                                @if (!$feature_item->categories->isEmpty())<a href="{{ route('public.single', $feature_item->categories->first()->slug) }}">{{ $feature_item->categories->first()->name }}</a>@endif
                                        </span>
                                            <span class="created_at"><i class="ion-clock"></i><a href="#">{{ date_from_database($feature_item->created_at, 'M d Y') }}</a></span>
                                            @if ($feature_item->user->username)
                                                <span class="post-author"><i class="ion-android-person"></i><a href="{{ route('public.author', $feature_item->user->username) }}">{{ $feature_item->user->getFullName() }}</a></span>
                                            @endif
                                        </div>
                                    </header>
                                </article>
                            </div>
                            <div class="post-group__right">
                                @else
                                    <div class="post-group__item">
                                        <article class="post post__inside post__inside--feature post__inside--feature-small">
                                            <div class="post__thumbnail"><img src="{{ get_object_image($feature_item->image, 'medium') }}" alt="{{ $feature_item->name }}"><a href="{{ route('public.single', $feature_item->slug) }}" class="post__overlay"></a></div>
                                            <header class="post__header">
                                                <h3 class="post__title"><a href="{{ route('public.single', $feature_item->slug) }}">{{ $feature_item->name }}</a></h3>
                                            </header>
                                        </article>
                                    </div>
                                    @if ($loop->last)
                            </div>
                        @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <section class="section pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="page-content">
                        <div class="post-group post-group--single">
                            <div class="post-group__header">
                                <h3 class="post-group__title">{{ __("What's new ?") }}</h3>
                            </div>
                            <div class="post-group__content">
                                <div class="row">
                                    @foreach (get_latest_posts(7, $featuredList) as $post)
                                        @if ($loop->first)
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <article class="post post__vertical post__vertical--single">
                                                    <div class="post__thumbnail">
                                                        <img src="{{ get_object_image($post->image, 'medium') }}" alt="{{ $post->name }}"><a href="{{ route('public.single', $post->slug) }}" class="post__overlay"></a>
                                                    </div>
                                                    <div class="post__content-wrap">
                                                        <header class="post__header">
                                                            <h3 class="post__title"><a href="{{ route('public.single', $post->slug) }}">{{ $post->name }}</a></h3>
                                                            <div class="post__meta"><span class="created__month">{{ date_from_database($post->created_at, 'M') }}</span><span class="created__date">{{ date_from_database($post->created_at, 'd') }}</span><span class="created__year">{{ date_from_database($post->created_at, 'Y') }}</span></div>
                                                        </header>
                                                        <div class="post__content">
                                                            <p data-number-line="4">{{ $post->description }}</p>
                                                        </div>
                                                        <div class="post__footer"><a href="{{ route('public.single', $post->slug) }}" class="post__readmore">{{ __('Read more') }}</a></div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                @else
                                                    <article class="post post__horizontal post__horizontal--single mb-20 clearfix">
                                                        <div class="post__thumbnail">
                                                            <img src="{{ get_object_image($post->image, 'medium') }}" alt="{{ $post->name }}"><a href="{{ route('public.single', $post->slug) }}" class="post__overlay"></a>
                                                        </div>
                                                        <div class="post__content-wrap">
                                                            <header class="post__header">
                                                                <h3 class="post__title"><a href="{{ route('public.single', $post->slug) }}">{{ $post->name }}</a></h3>
                                                                <div class="post__meta"><span class="post__created-at"><a href="#">{{ date_from_database($post->created_at, 'M d, Y') }}</a></span></div>
                                                            </header>
                                                        </div>
                                                    </article>
                                                @endif
                                                @if ($loop->last)
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="page-sidebar">
                        {!! dynamic_sidebar('top_sidebar') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section pt-50 pb-50 bg-lightgray">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="page-content">
                        <div class="post-group post-group--single">
                            <div class="post-group__header">
                                <h3 class="post-group__title">{{ __('Best for you') }}</h3>
                            </div>
                            <div class="post-group__content">
                                <div class="row">
                                    @foreach (get_featured_categories(2) as $category)
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            @foreach ($category->posts()->limit(3)->get() as $post)
                                                @if ($loop->first)
                                                    <article class="post post__vertical post__vertical--single post__vertical--simple">
                                                        <div class="post__thumbnail">
                                                            <img src="{{ get_object_image($post->image, 'medium') }}" alt="{{ $post->name }}"><a href="{{ route('public.single', $post->slug) }}" class="post__overlay"></a>
                                                        </div>
                                                        <div class="post__content-wrap">
                                                            <header class="post__header">
                                                                <h3 class="post__title"><a href="{{ route('public.single', $post->slug) }}">{{ $post->name }}</a></h3>
                                                                <div class="post__meta"><span class="created__month">{{ date_from_database($post->created_at, 'M') }}</span><span class="created__date">{{ date_from_database($post->created_at, 'd') }}</span><span class="created__year">{{ date_from_database($post->created_at, 'Y') }}</span></div>
                                                            </header>
                                                            <div class="post__content">
                                                                <p data-number-line="2">{{ $post->description }}</p>
                                                            </div>
                                                        </div>
                                                    </article>
                                                @else
                                                    <article class="post post__horizontal post__horizontal--single mb-20 clearfix">
                                                        <div class="post__thumbnail">
                                                            <img src="{{ get_object_image($post->image, 'medium') }}" alt="{{ $post->name }}"><a href="{{ route('public.single', $post->slug) }}" class="post__overlay"></a>
                                                        </div>
                                                        <div class="post__content-wrap">
                                                            <header class="post__header">
                                                                <h3 class="post__title"><a href="{{ route('public.single', $post->slug) }}">{{ $post->name }}</a></h3>
                                                                <div class="post__meta"><span class="post__created-at"><a href="#">{{ date_from_database($post->created_at, 'M d, Y') }}</a></span></div>
                                                            </header>
                                                        </div>
                                                    </article>
                                                @endif
                                                @if ($loop->last)
                                        </div>
                                        @endif
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    {!! Theme::partial('sidebar') !!}
                </div>
            </div>
        </div>
    </section>
@endif

@if (function_exists('render_galleries'))
    {!! render_galleries(8) !!}
@endif
