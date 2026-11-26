<x-layout title="New festival">
    <div class="header">
        <h1>New festival</h1>
    </div>

    <form method="POST" action="{{ route('festivals.store') }}">
        @csrf
        @include('festivals.form', ['festival' => null])

        <div class="actions">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('festivals.index') }}" class="btn">Cancel</a>
        </div>
    </form>
</x-layout>
