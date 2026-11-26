<x-layout title="Edit location">
    <div class="header">
        <h1>Edit {{ $location->name }}</h1>
    </div>

    <form method="POST" action="{{ route('locations.update', $location) }}">
        @csrf
        @method('PUT')
        @include('locations.form')

        <div class="actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('locations.show', $location) }}" class="btn">Cancel</a>
        </div>
    </form>
</x-layout>
