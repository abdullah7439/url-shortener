@php($viewer = auth()->user())

<table>
    <thead>
        <tr>
            <th>Short URL</th>
            <th>Long URL</th>
            @if (! $viewer->isMember())
                <th>Created By</th>
            @endif
            @if ($viewer->isSuperAdmin())
                <th>Company</th>
            @endif
            <th>Created On</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($rows as $row)
            <tr>
                <td><a href="{{ $row->short_link }}" target="_blank">{{ $row->short_link }}</a></td>
                <td title="{{ $row->original_url }}">{{ Str::limit($row->original_url, 60) }}</td>
                @if (! $viewer->isMember())
                    <td>{{ $row->user->name ?? '' }}</td>
                @endif
                @if ($viewer->isSuperAdmin())
                    <td>{{ $row->company->name ?? '' }}</td>
                @endif
                <td>{{ $row->created_at->format("d M 'y") }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="muted">No short URLs yet.</td>
            </tr>
        @endforelse
    </tbody>
</table>
