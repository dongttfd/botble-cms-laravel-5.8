@foreach ($posts as $post)
    <div>
        <article>
            <div><a href="{{ route('public.single', $post->slug) }}"></a>
                <img src="{{ get_object_image($post->image, 'medium') }}" alt="{{ $post->name }}">
            </div>
            <header><a href="{{ route('public.single', $post->slug) }}"> {{ $post->name }}</a></header>
        </article>
    </div>
@endforeach

<div class="pagination">
    {!! $posts->links() !!}
</div>