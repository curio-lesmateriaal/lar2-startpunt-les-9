<?php

use App\Models\Festival;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the location pages render', function () {
    $location = Location::factory()->create();

    $this->get(route('locations.index'))->assertOk()->assertSee($location->name);
    $this->get(route('locations.show', $location))->assertOk()->assertSee($location->city);
    $this->get(route('locations.create'))->assertOk();
    $this->get(route('locations.edit', $location))->assertOk();
});

test('a location can be created', function () {
    $response = $this->post(route('locations.store'), [
        'name' => 'Big Field',
        'address' => 'Fieldstreet 1',
        'city' => 'Breda',
        'description' => 'A very big field.',
    ]);

    $location = Location::firstWhere('name', 'Big Field');

    expect($location)->not->toBeNull();
    $response->assertRedirect(route('locations.show', $location));
});

test('a location requires all fields', function () {
    $this->post(route('locations.store'), [])
        ->assertSessionHasErrors(['name', 'address', 'city', 'description']);
});

test('a location can be updated', function () {
    $location = Location::factory()->create();

    $this->put(route('locations.update', $location), [
        ...$location->only('address', 'description'),
        'name' => 'Renamed Park',
        'city' => 'Tilburg',
    ])->assertRedirect(route('locations.show', $location));

    expect($location->refresh()->city)->toBe('Tilburg');
});

test('a location without festivals can be deleted', function () {
    $location = Location::factory()->create();

    $this->delete(route('locations.destroy', $location))->assertRedirect(route('locations.index'));

    $this->assertModelMissing($location);
});

test('a location with festivals cannot be deleted', function () {
    $festival = Festival::factory()->create();

    $this->delete(route('locations.destroy', $festival->location))
        ->assertRedirect(route('locations.show', $festival->location))
        ->assertSessionHas('error');

    $this->assertModelExists($festival->location);
});
