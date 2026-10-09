@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <p>
        Signed in as <strong>{{ $user->name }}</strong>
        ({{ $user->roleLabel() }}@if ($user->company), {{ $user->company->name }}@endif)
    </p>

    {{-- SuperAdmin create client --}}
    @if ($user->isSuperAdmin())
        <section>
            <div class="row">
                <h3>Clients</h3>
                <a class="button" href="{{ route('clients.create') }}">Invite</a>
            </div>

            @include('clients.companies-table', ['companies' => $clients])
        </section>
    @endif

    {{-- Code for displaying generated short URLs --}}
    <section>
        <div class="row">
            <h3>Generated Short URLs</h3>

            @can('create', App\Models\ShortUrl::class)
                <a class="button" href="{{ route('short-urls.create') }}">Generate</a>
            @endcan
        </div>

        @include('short-urls.urls-table', ['rows' => $shortUrls])
    </section>

    {{-- Admin or team members of their own company --}}
    @if ($user->isAdmin())
        <section>
            <div class="row">
                <h3>Team Members</h3>
                <a class="button" href="{{ route('team.create') }}">Invite</a>
            </div>

            @include('team.members-table', ['members' => $teamMembers])
        </section>
    @endif
@endsection
