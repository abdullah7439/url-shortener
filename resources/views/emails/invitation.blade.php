<!DOCTYPE html>
<html>
<body>
    <p>Hello,</p>

    <p>
        You have been invited to the URL Shortener as <strong>{{ $roleLabel }}</strong>
        @if ($companyName) of <strong>{{ $companyName }}</strong>@endif.
    </p>

    <p>Open this link to set your password and sign in:</p>

    <p><a href="{{ $link }}">{{ $link }}</a></p>
</body>
</html>
