@extends('layouts.main')

@section('title', 'Team Members')

@section('content')
    <section>
        <div class="row">
            <h3>Team Members</h3>
            <a class="button" href="{{ route('team.create') }}">Invite</a>
        </div>

        @include('team.members-table', ['members' => $members])
    </section>

    @if ($pending->isNotEmpty())
        <section>
            <h3>Pending invitations</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Invitation link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pending as $invitation)
                        <tr>
                            <td>{{ $invitation->name }}</td>
                            <td>{{ $invitation->email }}</td>
                            <td>{{ ucfirst($invitation->role) }}</td>
                            <td><a href="{{ $invitation->acceptUrl() }}">{{ $invitation->acceptUrl() }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif
@endsection
