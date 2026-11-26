<x-layout :title="$artist->name">
    <div class="header">
        <h1>{{ $artist->name }}</h1>
        <div class="actions">
            <a href="{{ route('artists.edit', $artist) }}" class="btn">Edit</a>
            <form method="POST" action="{{ route('artists.destroy', $artist) }}" onsubmit="return confirm('Delete this artist?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <dl class="details">
        <dt>Genre</dt>
        <dd>{{ $artist->genre }}</dd>
        <dt>Spotify</dt>
        <dd><a href="{{ $artist->spotify_url }}" target="_blank" rel="noopener">{{ $artist->spotify_url }}</a></dd>
        <dt>SoundCloud</dt>
        <dd><a href="{{ $artist->soundcloud_url }}" target="_blank" rel="noopener">{{ $artist->soundcloud_url }}</a></dd>
    </dl>

    <h2>Festivals</h2>
    <ul>
        @forelse ($artist->festivals as $festival)
            <li><a href="{{ route('festivals.show', $festival) }}">{{ $festival->title }}</a></li>
        @empty
            <li class="muted">Not playing any festivals yet.</li>
        @endforelse
    </ul>
</x-layout>
