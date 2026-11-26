@php
    $selectedArtistIds = old('artists', $festival?->artists->pluck('id')->all() ?? []);
@endphp

<div class="field">
    <label for="title">Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $festival?->title) }}">
    @error('title') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="start_date_time">Starts</label>
    <input type="datetime-local" id="start_date_time" name="start_date_time" value="{{ old('start_date_time', $festival?->start_date_time->format('Y-m-d\TH:i')) }}">
    @error('start_date_time') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="end_date_time">Ends</label>
    <input type="datetime-local" id="end_date_time" name="end_date_time" value="{{ old('end_date_time', $festival?->end_date_time->format('Y-m-d\TH:i')) }}">
    @error('end_date_time') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="genre">Genre</label>
    <input type="text" id="genre" name="genre" value="{{ old('genre', $festival?->genre) }}">
    @error('genre') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="location_id">Location</label>
    <select id="location_id" name="location_id">
        <option value="">Choose a location</option>
        @foreach ($locations as $location)
            <option value="{{ $location->id }}" @selected(old('location_id', $festival?->location_id) == $location->id)>{{ $location->name }} ({{ $location->city }})</option>
        @endforeach
    </select>
    @error('location_id') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="4">{{ old('description', $festival?->description) }}</textarea>
    @error('description') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <fieldset>
        <legend>Artists</legend>
        <div class="checkboxes">
            @foreach ($artists as $artist)
                <label>
                    <input type="checkbox" name="artists[]" value="{{ $artist->id }}" @checked(in_array($artist->id, $selectedArtistIds))>
                    {{ $artist->name }}
                </label>
            @endforeach
        </div>
        @error('artists.*') <p class="error">{{ $message }}</p> @enderror
    </fieldset>
</div>
