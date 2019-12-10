<section data-background="{{ Theme::asset()->url('images/page-intro-02.jpg') }}" class="section page-intro pt-100 pb-100 bg-cover">
    <div style="opacity: 0.7" class="bg-overlay"></div>
    <div class="container">
        <h3 class="page-intro__title">{{ __('Galleries') }}</h3>
        {!! Theme::breadcrumb()->render() !!}
    </div>
</section>
<section class="section pt-50 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="page-content">
                    <article class="post post--single">
                        <div class="post__content">
                            @if (isset($galleries) && !$galleries->isEmpty())
                                <div class="gallery-wrap">
                                    @foreach ($galleries as $gallery)
                                        <div class="gallery-item">
                                            <div class="img-wrap">
                                                <a href="{{ route('public.gallery', $gallery->slug) }}"><img src="{{ get_object_image($gallery->image, 'medium') }}" alt="{{ $gallery->name }}"></a>
                                            </div>
                                            <div class="gallery-detail">
                                                <div class="gallery-title"><a href="{{ route('public.gallery', $gallery->slug) }}">{{ $gallery->name }}</a></div>
                                                <div class="gallery-author">{{ __('By') }} {{ $gallery->user->getFullName() }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </article>
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
