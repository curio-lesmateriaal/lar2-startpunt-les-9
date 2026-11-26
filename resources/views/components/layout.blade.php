@props(['title' => 'Festivals'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <div>
            <a href="{{ route('festivals.index') }}">Festivals</a>
            <a href="{{ route('artists.index') }}">Artists</a>
            <a href="{{ route('locations.index') }}">Locations</a>
        </div>
    </nav>

    <main>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        {{ $slot }}
    </main>
</body>
</html>
