<x-layout title="New artist">
    <div class="header">
        <h1>New artist</h1>
    </div>

    <form method="POST" action="{{ route('artists.store') }}">
        @csrf
        @include('artists.form', ['artist' => null])

        <div class="actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('artists.index') }}" class="btn">Cancel</a>
        </div>
    </form>
</x-layout>
