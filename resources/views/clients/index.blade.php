@extends('layouts.main')

@section('title', 'Clients')

@section('content')
    <section>
        <div class="row">
            <h3>Clients</h3>
            <a class="button" href="{{ route('clients.create') }}">Invite</a>
        </div>

        @include('clients.companies-table', ['companies' => $companies])
    </section>
@endsection
