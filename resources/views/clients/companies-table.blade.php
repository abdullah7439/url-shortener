<table>
    <thead>
        <tr>
            <th>Company Name</th>
            <th>Users</th>
            <th>Total Generated URLs</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($companies as $company)
            <tr>
                <td>
                    {{ $company->name }}
                    @if ($company->email)
                        <br><span class="muted">{{ $company->email }}</span>
                    @endif
                </td>
                <td>{{ $company->users_count }}</td>
                <td>{{ $company->short_urls_count }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="muted">No clients yet.</td>
            </tr>
        @endforelse
    </tbody>
</table>
