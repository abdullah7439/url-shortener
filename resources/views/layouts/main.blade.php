<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - URL Shortener Assignment</title>
    @include('layouts.style')
</head>
<body>
    <header>
        <div>
            <strong>URL Shortener</strong>
            &nbsp;<a href="{{ route('dashboard') }}">Dashboard</a>
        </div>
        <div>
            {{ auth()->user()->name }} ({{ auth()->user()->roleLabel() }})
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>

    <main>
        @include('partials.flash')

        @yield('content')
    </main>
</body>
</html>
