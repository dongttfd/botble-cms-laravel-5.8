<section data-background="{{ Theme::asset()->url('images/page-intro-02.jpg') }}" class="section page-intro pt-100 pb-100 bg-cover">
    <div style="opacity: 0.7" class="bg-overlay"></div>
    <div class="container">
        <h3 class="page-intro__title">{{ $gallery->name }}</h3>
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
                            <p>
                                {{ $gallery->description }}
                            </p>
                            <div id="list-photo">
                                @foreach (gallery_meta_data($gallery->id, 'gallery') as $image)
                                    @if ($image)
                                        <div class="item" data-src="{{ url(Arr::get($image, 'img')) }}" data-sub-html="{{ Arr::get($image, 'description') }}">
                                            <div class="photo-item">
                                                <div class="thumb">
                                                    <a href="#">
                                                        <img src="{{ url(Arr::get($image, 'img')) }}" alt="{{ Arr::get($image, 'description') }}">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
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