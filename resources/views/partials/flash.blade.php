@if (session('status'))
    <div class="flash">{{ session('status') }}</div>
@endif

@if (session('invite_link'))
    <div class="flash info">
        Invitation link also written to the mail log:
        <a href="{{ session('invite_link') }}">{{ session('invite_link') }}</a>
    </div>
@endif
