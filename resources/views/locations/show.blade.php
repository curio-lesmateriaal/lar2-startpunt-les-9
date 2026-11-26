<x-layout :title="$location->name">
    <div class="header">
        <h1>{{ $location->name }}</h1>
        <div class="actions">
            <a href="{{ route('locations.edit', $location) }}" class="btn">Edit</a>
            <form method="POST" action="{{ route('locations.destroy', $location) }}" onsubmit="return confirm('Delete this location?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <dl class="details">
        <dt>Address</dt>
        <dd>{{ $location->address }}</dd>
        <dt>City</dt>
        <dd>{{ $location->city }}</dd>
        <dt>Description</dt>
        <dd>{{ $location->description }}</dd>
    </dl>

    <h2>Festivals</h2>
    <ul>
        @forelse ($location->festivals as $festival)
            <li><a href="{{ route('festivals.show', $festival) }}">{{ $festival->title }}</a></li>
        @empty
            <li class="muted">No festivals at this location yet.</li>
        @endforelse
    </ul>
</x-layout>
