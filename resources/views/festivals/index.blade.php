<x-layout title="Festivals">
    <div class="header">
        <h1>Festivals</h1>
        <a href="{{ route('festivals.create') }}" class="btn btn-primary">New festival</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Starts</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($festivals as $festival)
                <tr>
                    <td><a href="{{ route('festivals.show', $festival) }}">{{ $festival->title }}</a></td>
                    <td>{{ $festival->genre }}</td>
                    <td>{{ $festival->start_date_time->format('d-m-Y H:i') }}</td>
                    <td>{{ $festival->location->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="muted">No festivals yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layout>
