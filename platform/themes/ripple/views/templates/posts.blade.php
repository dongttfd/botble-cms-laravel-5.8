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
                            @foreach($post->categories as $category)
                                <a href="{{ route('public.single', $category->slug) }}">{{ $category->name }}</a>
                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </span></div>
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
@endif

<style>
    .section.pt-50.pb-100 {
        background-color: #ecf0f1;
    }
</style>