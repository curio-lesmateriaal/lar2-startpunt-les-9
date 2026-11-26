<x-layout :title="$festival->title">
    <div class="header">
        <h1>{{ $festival->title }}</h1>
        <div class="actions">
            <a href="{{ route('festivals.edit', $festival) }}" class="btn">Edit</a>
            <form method="POST" action="{{ route('festivals.destroy', $festival) }}" onsubmit="return confirm('Delete this festival?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <dl class="details">
        <dt>Genre</dt>
        <dd>{{ $festival->genre }}</dd>
        <dt>Starts</dt>
        <dd>{{ $festival->start_date_time->format('d-m-Y H:i') }}</dd>
        <dt>Ends</dt>
        <dd>{{ $festival->end_date_time->format('d-m-Y H:i') }}</dd>
        <dt>Location</dt>
        <dd><a href="{{ route('locations.show', $festival->location) }}">{{ $festival->location->name }}</a>, {{ $festival->location->city }}</dd>
        <dt>Description</dt>
        <dd>{{ $festival->description }}</dd>
    </dl>

    <h2>Artists</h2>
    <ul>
        @forelse ($festival->artists as $artist)
            <li><a href="{{ route('artists.show', $artist) }}">{{ $artist->name }}</a> ({{ $artist->genre }})</li>
        @empty
            <li class="muted">No artists linked yet.</li>
        @endforelse
    </ul>
</x-layout>
