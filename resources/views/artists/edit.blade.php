<x-layout title="Edit artist">
    <div class="header">
        <h1>Edit {{ $artist->name }}</h1>
    </div>

    <form method="POST" action="{{ route('artists.update', $artist) }}">
        @csrf
        @method('PUT')
        @include('artists.form')

        <div class="actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('artists.show', $artist) }}" class="btn">Cancel</a>
        </div>
    </form>
</x-layout>
