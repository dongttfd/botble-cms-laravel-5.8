@if ($posts->count() > 0)
    @foreach ($posts as $post)
        <article>
            <div>
                <a href="{{ route('public.single', $post->slug) }}"><img src="{{ url($post->image) }}" alt="{{ $post->name }}"></a>
            </div>
            <div>
                <header>
                    <h3><a href="{{ route('public.single', $post->slug) }}">{{ $post->name }}</a></h3>
                    <div><span><a href="#">{{ date_from_database($post->created_at, 'M d, Y') }}</a></span><a href="{{ route('public.author', $post->user->username) }}">{{ $post->user->getFullName() }}</a> -
                        {{ __('Categories') }}:
                        @foreach($post->categories as $category)
                            <a href="{{ route('public.single', $category->slug) }}">{{ $category->name }}</a>
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </div>
                </header>
                <div>
                    <p>{{ $post->description }}</p>
                </div>
            </div>
        </article>
    @endforeach
    <div>
        {!! $posts->links() !!}
    </div>
@endif