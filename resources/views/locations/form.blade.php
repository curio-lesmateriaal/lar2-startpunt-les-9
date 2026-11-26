<div class="field">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $location?->name) }}">
    @error('name') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="address">Address</label>
    <input type="text" id="address" name="address" value="{{ old('address', $location?->address) }}">
    @error('address') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="city">City</label>
    <input type="text" id="city" name="city" value="{{ old('city', $location?->city) }}">
    @error('city') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="4">{{ old('description', $location?->description) }}</textarea>
    @error('description') <p class="error">{{ $message }}</p> @enderror
</div>
