@extends('layouts.main')

@section('title', 'Invite New Team Member')

@section('content')
    <form method="POST" action="{{ route('team.store') }}" class="box" novalidate>
        @csrf

        <h3>Invite New Team Member</h3>

        <label for="name">Name <span class="req">*</span></label>
        <input id="name" name="name" type="text" required value="{{ old('name') }}" placeholder="User Name">
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="email">Email <span class="req">*</span></label>
        <input id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="ex. sample@example.com">
        @error('email')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="role">Role <span class="req">*</span></label>
        <select id="role" name="role">
            <option value="member" @selected(old('role', 'member') === 'member')>Member</option>
            <option value="admin" @selected(old('role') === 'admin')>Admin</option>
        </select>
        @error('role')
            <p class="error">{{ $message }}</p>
        @enderror

        <p>
            <button type="submit">Send Invitation</button>
            <a href="{{ route('team.index') }}">Cancel</a>
        </p>
    </form>
@endsection
