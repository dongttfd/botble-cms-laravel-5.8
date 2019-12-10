<h3>{{ __('Hello') }} {{ $user->getFullName() }}</h3>
<p>{{ __('Thank you to be a user in') }} {{ config('app.name') }}.</p>
<p>{{ __('Please click this link to active your account') }}: <a href="{{ route('public.access.activation', ['code' => $activation->getCode(), 'username' => $user->username]) }}">{{ route('public.access.activation', ['code' => $activation->getCode(), 'username' => $user->username]) }}</a></p>
