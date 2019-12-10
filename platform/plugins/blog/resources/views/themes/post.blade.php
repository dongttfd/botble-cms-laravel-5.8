<div>
    <h3>{{ $post->name }}</h3>
    {!! Theme::breadcrumb()->render() !!}
</div>
<header>
    <h3>{{ $post->name }}</h3>
    <div>
        @if (!$post->categories->isEmpty())
            <span>
                <a href="{{ route('public.single', $post->categories->first()->slug) }}">{{ $post->categories->first()->name }}</a>
            </span>
        @endif
        <span><a href="#">{{ date_from_database($post->created_at, 'M d, Y') }}</a></span>
        <span><a href="{{ route('public.author', $post->user->username) }}">{{ $post->user->getFullName() }}</a></span>

        @if (!$post->tags->isEmpty())
            <span>
                @foreach ($post->tags as $tag)
                    <a href="{{ route('public.single', $tag->slug) }}">{{ $tag->name }}</a>
                @endforeach
            </span>
        @endif
    </div>
</header>
{!! $post->content !!}
<br />
{!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null) !!}
<footer>
    @foreach (get_related_posts($post->slug, 2) as $related_item)
        <div>
            <article>
                <div><a href="{{ route('public.single', $related_item->slug) }}"></a>
                    <img src="{{ url($related_item->image) }}" alt="{{ $related_item->name }}">
                </div>
                <header><a href="{{ route('public.single', $related_item->slug) }}"> {{ $related_item->name }}</a></header>
            </article>
        </div>
    @endforeach
</footer>