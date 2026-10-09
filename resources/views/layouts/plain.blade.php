<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sign in') - URL Shortener Assignment</title>
    @include('layouts.style')
</head>
<body class="guest">
    <h1 class="site-title">URL Shortener Assignment</h1>

    <div class="center">
        <div class="center-inner">
            @include('partials.flash')

            @yield('content')
        </div>
    </div>
</body>
</html>
