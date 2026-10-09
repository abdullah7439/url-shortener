@extends('layouts.plain')

@section('title', 'Login')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="box" novalidate>
        @csrf

        <h2>Login</h2>

        {{-- Wrong email or password: shown once at the top, not under the email box --}}
        @php($loginFailed = $errors->first('email') === __('auth.failed'))
        @if ($loginFailed)
            <p class="error">{{ $errors->first('email') }}</p>
        @endif

        <label for="email">Email <span class="req">*</span></label>
        <input id="email" name="email" type="email" required autofocus
               value="{{ old('email') }}" placeholder="e.g. sample@example.com">
        @if (! $loginFailed)
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        @endif

        <label for="password">Password <span class="req">*</span></label>
        <input id="password" name="password" type="password" required>
        @error('password')
            <p class="error">{{ $message }}</p>
        @enderror

        <label>
            <input type="checkbox" name="remember" value="1"> Remember me
        </label>

        <p><button type="submit">Login</button></p>
    </form>
@endsection
