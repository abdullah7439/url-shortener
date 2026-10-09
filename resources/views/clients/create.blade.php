@extends('layouts.main')

@section('title', 'Invite New Client')

@section('content')
    <form method="POST" action="{{ route('clients.store') }}" class="box" novalidate>
        @csrf

        <h3>Invite New Client</h3>

        <label for="company_name">Company <span class="req">*</span></label>
        <input id="company_name" name="company_name" type="text" required
               value="{{ old('company_name') }}" placeholder="Company Name....">
        @error('company_name')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="email">Email <span class="req">*</span></label>
        <input id="email" name="email" type="email" required
               value="{{ old('email') }}" placeholder="ex. sample@example.com">
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror

        <p>
            <button type="submit">Send Invitation</button>
            <a href="{{ route('clients.index') }}">Cancel</a>
        </p>
    </form>
@endsection
