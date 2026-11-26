<x-layout title="New location">
    <div class="header">
        <h1>New location</h1>
    </div>

    <form method="POST" action="{{ route('locations.store') }}">
        @csrf
        @include('locations.form', ['location' => null])

        <div class="actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('locations.index') }}" class="btn">Cancel</a>
        </div>
    </form>
</x-layout>
