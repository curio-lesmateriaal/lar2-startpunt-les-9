<?php

use App\Models\Artist;
use App\Models\Festival;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the festival pages render', function () {
    $festival = Festival::factory()->hasAttached(Artist::factory()->count(2))->create();

    $this->get(route('festivals.index'))->assertOk()->assertSee($festival->title);
    $this->get(route('festivals.show', $festival))->assertOk()->assertSee($festival->artists->first()->name);
    $this->get(route('festivals.create'))->assertOk();
    $this->get(route('festivals.edit', $festival))->assertOk();
});

test('a festival can be created with artists', function () {
    $location = Location::factory()->create();
    $artists = Artist::factory()->count(2)->create();

    $response = $this->post(route('festivals.store'), [
        'title' => 'Summer Sounds',
        'start_date_time' => '2027-07-01 14:00',
        'end_date_time' => '2027-07-02 23:00',
        'genre' => 'House',
        'description' => 'A sunny festival.',
        'location_id' => $location->id,
        'artists' => $artists->pluck('id')->all(),
    ]);

    $festival = Festival::firstWhere('title', 'Summer Sounds');

    $response->assertRedirect(route('festivals.show', $festival));
    expect($festival->artists)->toHaveCount(2);
});

test('a festival must end after it starts', function () {
    $this->post(route('festivals.store'), [
        'title' => 'Backwards Fest',
        'start_date_time' => '2027-07-02 14:00',
        'end_date_time' => '2027-07-01 14:00',
        'genre' => 'House',
        'description' => 'Time travel.',
        'location_id' => Location::factory()->create()->id,
    ])->assertSessionHasErrors('end_date_time');

    expect(Festival::count())->toBe(0);
});

test('a festival can be updated and its artists synced', function () {
    $festival = Festival::factory()->hasAttached(Artist::factory()->count(3))->create();
    $newArtist = Artist::factory()->create();

    $this->put(route('festivals.update', $festival), [
        ...$festival->only('start_date_time', 'end_date_time', 'genre', 'description', 'location_id'),
        'title' => 'Renamed Fest',
        'artists' => [$newArtist->id],
    ])->assertRedirect(route('festivals.show', $festival));

    $festival->refresh();
    expect($festival->title)->toBe('Renamed Fest')
        ->and($festival->artists->pluck('id')->all())->toBe([$newArtist->id]);
});

test('a festival can be deleted', function () {
    $festival = Festival::factory()->hasAttached(Artist::factory()->count(3))->create();

    $this->delete(route('festivals.destroy', $festival))->assertRedirect(route('festivals.index'));

    $this->assertModelMissing($festival);
    $this->assertDatabaseCount('artist_festival', 0);
    expect(Artist::count())->toBe(3);
});
