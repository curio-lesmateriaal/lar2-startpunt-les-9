<div class="field">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $artist?->name) }}">
    @error('name') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="genre">Genre</label>
    <input type="text" id="genre" name="genre" value="{{ old('genre', $artist?->genre) }}">
    @error('genre') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="spotify_url">Spotify URL</label>
    <input type="url" id="spotify_url" name="spotify_url" value="{{ old('spotify_url', $artist?->spotify_url) }}">
    @error('spotify_url') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="soundcloud_url">SoundCloud URL</label>
    <input type="url" id="soundcloud_url" name="soundcloud_url" value="{{ old('soundcloud_url', $artist?->soundcloud_url) }}">
    @error('soundcloud_url') <p class="error">{{ $message }}</p> @enderror
</div>
