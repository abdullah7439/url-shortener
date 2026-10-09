<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Total Generated URLs</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($members as $member)
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->roleLabel() }}</td>
                <td>{{ $member->short_urls_count }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="muted">No team members yet.</td>
            </tr>
        @endforelse
    </tbody>
</table>
