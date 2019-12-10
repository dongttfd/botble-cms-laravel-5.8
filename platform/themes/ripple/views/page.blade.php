<section data-background="{{ Theme::asset()->url('images/page-intro-02.jpg') }}" class="section page-intro pt-100 pb-100 bg-cover">
    <div style="opacity: 0.7" class="bg-overlay"></div>
    <div class="container">
        <h3 class="page-intro__title">{{ $page->name }}</h3>
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
                            @if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries = gallery_meta_data($page->id, PAGE_MODULE_SCREEN_NAME)))
                                {!! render_object_gallery($galleries) !!}
                            @endif
                            {!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, $page->content, $page) !!}
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

