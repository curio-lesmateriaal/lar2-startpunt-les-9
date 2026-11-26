<x-layout title="Artists">
    <div class="header">
        <h1>Artists</h1>
        <a href="{{ route('artists.create') }}" class="btn btn-primary">New artist</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Genre</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($artists as $artist)
                <tr>
                    <td><a href="{{ route('artists.show', $artist) }}">{{ $artist->name }}</a></td>
                    <td>{{ $artist->genre }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="muted">No artists yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layout>
