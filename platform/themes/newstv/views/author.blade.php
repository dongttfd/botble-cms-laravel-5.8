<div id="profile">
    <div class="col-md-3 col-sm-4 col-xs-6 author-img">
        <img src="{{ get_object_image($author->profile_image) }}">
    </div>
    <div class="col-md-9 col-sm-8 col-xs-6 author-detail">
        <h4><i class="fa fa-user-secret"></i> {{ $author->getFullName() }}</h4>
        <p><i class="fa fa-map-marker"></i> {{ !empty($author->address) ? $author->address : __('Unknown') }}</p>
        <p><i class="fa fa-book"></i> {{ !empty($author->about) ? $author->about : __('Nothing to see') }}</p>
        <p><i class="fa fa-envelope-o"></i> {{ $author->email }}</p>
        <p><i class="fa fa-share-alt"></i> {{ __('Social links:') }} </p>
        <ul class="social-links">
            <li><a target="_blank" href="{{ $author->facebook }}"><i class="fa fa-facebook"></i></a></li>
            <li><a target="_blank" href="{{ $author->twitter }}"><i class="fa fa-twitter"></i></a></li>
            <li><a target="_blank" href="{{ $author->google_plus }}"><i class="fa fa-google-plus"></i></a></li>
            <li><a target="_blank" href="{{ $author->github }}"><i class="fa fa-github"></i></a></li>
            <li><a target="_blank" href="{{ $author->youtube }}"><i class="fa fa-youtube"></i></a></li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>
@php $posts = get_posts_by_user($author->id); @endphp
<section class="main-box">
    <div class="main-box-header">
        <h4 class="post-star"><i class="fa fa-star"></i> {{ __('Author posts') }}</h4>
    </div>
    <div class="main-box-content">
        <div class="box-style box-style-3">
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="media-news">
                        <a href="{{ route('public.single', $post->slug) }}" class="media-news-img" title="{{ $post->name }}">
                            <img class="img-full img-bg" src="{{ get_object_image($post->image, 'medium') }}" style="background-image: url('{{ get_object_image($post->image) }}');" alt="{{ $post->name }}">
                        </a>
                        <div class="media-news-body">
                            <p class="common-title">
                                <a href="{{ route('public.single', $post->slug) }}" title="{{ $post->name }}">
                                    {{ $post->name }}
                                </a>
                            </p>
                            <p class="common-date">
                                <time datetime="">{{ date_from_database($post->created_at, 'M d, Y') }}</time>
                            </p>
                            <div class="common-summary">
                                {{ $post->description }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    <p>{{ __('There is no data to display!') }}</p>
                </div>
            @endif
        </div>
    </div>
</section>
@if ($posts->count() > 0)
    <nav class="pagination-wrap">
        {!! $posts->links() !!}
    </nav>
@endif