<div>
    <img src="{{ url($author->profile_image) }}">
</div>
<div>
    <h4>{{ $author->getFullName() }}</h4>
    <p>{{ $author->address }}</p>
    <p>{{ $author->about }}</p>
    <p>{{ $author->email }}</p>
    <p>{{ __('Social links:') }} </p>
    <ul>
        <li><a target="_blank" href="{{ $author->facebook }}">{{ $author->facebook }}</a></li>
        <li><a target="_blank" href="{{ $author->twitter }}">{{ $author->twitter }}</a></li>
        <li><a target="_blank" href="{{ $author->google_plus }}">{{ $author->google_plus }}</a></li>
        <li><a target="_blank" href="{{ $author->github }}">{{ $author->github }}</a></li>
        <li><a target="_blank" href="{{ $author->youtube }}">{{ $author->youtube }}</a></li>
    </ul>
</div>
@php $posts = get_posts_by_user($author->id); @endphp
@if ($posts->count() > 0)
    @foreach ($posts as $post)
        <article>
            <div>
                <a href="{{ route('public.single', $post->slug) }}"><img src="{{ url($post->image) }}" alt="{{ $post->name }}"></a>
            </div>
            <div>
                <header>
                    <h3><a href="{{ route('public.single', $post->slug) }}">{{ $post->name }}</a></h3>
                    <div>
                        <span>
                            <a href="#">{{ date_from_database($post->created_at, 'M d, Y') }}</a></span><span>
                            @if ($post->author->username) <a href="{{ route('public.author', $post->author->username) }}">{{ $post->author->getFullName() }}</a>@else <span>{{ $post->author->getFullName() }}</span> @endif</span>
                            <span>
                            @if ($post->categories->first())
                                <a href="{{ route('public.single', $post->categories->first()->slug) }}">{{ $post->categories->first()->name }}</a>
                            @endif
                        </span>
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
@else
    <div>
        <p>{{ __('There is no data to display!') }}</p>
    </div>
@endif