<section data-background="{{ Theme::asset()->url('images/page-intro-03.jpg') }}" class="section page-intro pt-100 pb-100 bg-cover">
    <div style="opacity: 0.7" class="bg-overlay"></div>
    <div class="container">
        <h3 class="page-intro__title">{{ $tag->name }}</h3>
        {!! Theme::breadcrumb()->render() !!}
    </div>
</section>
<section class="section pt-100 pb-50 bg-lightgray">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="page-content">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <article class="post post__horizontal mb-40 clearfix">
                                <div class="post__thumbnail">
                                    <img src="{{ get_object_image($post->image, 'medium') }}" alt="{{ $post->name }}"><a href="{{ route('public.single', $post->slug) }}" class="post__overlay"></a>
                                </div>
                                <div class="post__content-wrap">
                                    <header class="post__header">
                                        <h3 class="post__title"><a href="{{ route('public.single', $post->slug) }}">{{ $post->name }}</a></h3>
                                        <div class="post__meta"><span class="post__created-at"><i class="ion-clock"></i><a href="#">{{ date_from_database($post->created_at, 'M d, Y') }}</a></span>
                                            @if ($post->user->username)
                                                <span class="post__author"><i class="ion-android-person"></i><a href="{{ route('public.author', $post->user->username) }}">{{ $post->user->getFullName() }}</a></span>
                                            @endif
                                            <span class="post-category"><i class="ion-cube"></i>
                                                @if ($post->categories->first())
                                                    <a href="{{ route('public.single', $post->categories->first()->slug) }}">{{ $post->categories->first()->name }}</a>
                                                @endif
                                            </span>
                                        </div>
                                    </header>
                                    <div class="post__content">
                                        <p data-number-line="4">{{ $post->description }}</p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        <div class="page-pagination text-right">
                            {!! $posts->links() !!}
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <p>{{ __('There is no data to display!') }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-3">
                <div class="page-sidebar">
                    {!! Theme::partial('sidebar') !!}
                </div>
            </div>
        </div>
    </div>
</section>
