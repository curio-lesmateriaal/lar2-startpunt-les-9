<x-layout title="Locations">
    <div class="header">
        <h1>Locations</h1>
        <a href="{{ route('locations.create') }}" class="btn btn-primary">New location</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($locations as $location)
                <tr>
                    <td><a href="{{ route('locations.show', $location) }}">{{ $location->name }}</a></td>
                    <td>{{ $location->address }}</td>
                    <td>{{ $location->city }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="muted">No locations yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layout>
