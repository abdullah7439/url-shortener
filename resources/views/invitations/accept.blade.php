@extends('layouts.plain')

@section('title', 'Accept invitation')

@section('content')
    <form method="POST" action="{{ route('invitations.store', $invitation->token) }}" class="box" novalidate>
        @csrf

        <h2>Accept your invitation</h2>

        <p>
            You have been invited as <strong>{{ $invitation->role === 'admin' ? 'Admin' : 'Member' }}</strong>
            @if ($invitation->company) of <strong>{{ $invitation->company->name }}</strong>@endif.
            <br>Your email: <strong>{{ $invitation->email }}</strong>
        </p>
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="name">Name <span class="req">*</span></label>
        <input id="name" name="name" type="text" required value="{{ old('name', $invitation->name) }}">
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="password">Password <span class="req">*</span></label>
        <input id="password" name="password" type="password" required autocomplete="new-password">
        @error('password')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="password_confirmation">Confirm password <span class="req">*</span></label>
        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">

        <p><button type="submit">Create account</button></p>
    </form>
@endsection
