@extends('layouts.main')

@section('title', 'Generate Short URL')

@section('content')
    <form method="POST" action="{{ route('short-urls.store') }}" class="box" novalidate>
        @csrf

        <h3>Generate Short URL</h3>

        <label for="original_url">Long URL <span class="req">*</span></label>
        <input id="original_url" name="original_url" type="url" required
               value="{{ old('original_url') }}"
               placeholder="e.g. https://sembark.com/travel-software/features/best-itinerary-builder">
        @error('original_url')
            <p class="error">{{ $message }}</p>
        @enderror

        <p>
            <button type="submit">Generate</button>
            <a href="{{ route('short-urls.index') }}">Cancel</a>
        </p>
    </form>
@endsection
