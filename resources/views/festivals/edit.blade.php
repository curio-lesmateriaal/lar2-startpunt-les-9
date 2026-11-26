<x-layout title="Edit festival">
    <div class="header">
        <h1>Edit {{ $festival->title }}</h1>
    </div>

    <form method="POST" action="{{ route('festivals.update', $festival) }}">
        @csrf
        @method('PUT')
        @include('festivals.form')

        <div class="actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('festivals.show', $festival) }}" class="btn">Cancel</a>
        </div>
    </form>
</x-layout>
