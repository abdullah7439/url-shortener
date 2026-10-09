@extends('layouts.main')

@section('title', 'Generated Short URLs')

@section('content')
    <section>
        <div class="row">
            <h3>
                @if (auth()->user()->isSuperAdmin())
                    Generated Short URLs (every company)
                @elseif (auth()->user()->isAdmin())
                    Generated Short URLs of your company
                @else
                    Your Generated Short URLs
                @endif
            </h3>

            @can('create', App\Models\ShortUrl::class)
                <a class="button" href="{{ route('short-urls.create') }}">Generate</a>
            @endcan
        </div>

        @include('short-urls.urls-table', ['rows' => $shortUrls])
    </section>
@endsection
