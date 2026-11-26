<?php

use App\Models\Artist;
use App\Models\Festival;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the artist pages render', function () {
    $artist = Artist::factory()->create();

    $this->get(route('artists.index'))->assertOk()->assertSee($artist->name);
    $this->get(route('artists.show', $artist))->assertOk()->assertSee($artist->spotify_url);
    $this->get(route('artists.create'))->assertOk();
    $this->get(route('artists.edit', $artist))->assertOk();
});

test('an artist can be created', function () {
    $response = $this->post(route('artists.store'), [
        'name' => 'DJ Test',
        'genre' => 'Techno',
        'spotify_url' => 'https://open.spotify.com/artist/abc',
        'soundcloud_url' => 'https://soundcloud.com/dj-test',
    ]);

    $artist = Artist::firstWhere('name', 'DJ Test');

    expect($artist)->not->toBeNull();
    $response->assertRedirect(route('artists.show', $artist));
});

test('an artist needs valid urls', function () {
    $this->post(route('artists.store'), [
        'name' => 'DJ Test',
        'genre' => 'Techno',
        'spotify_url' => 'not a url',
        'soundcloud_url' => 'also not a url',
    ])->assertSessionHasErrors(['spotify_url', 'soundcloud_url']);
});

test('an artist can be updated', function () {
    $artist = Artist::factory()->create();

    $this->put(route('artists.update', $artist), [
        ...$artist->only('spotify_url', 'soundcloud_url'),
        'name' => 'New Name',
        'genre' => 'Pop',
    ])->assertRedirect(route('artists.show', $artist));

    expect($artist->refresh()->name)->toBe('New Name');
});

test('an artist linked to a festival can be deleted', function () {
    $festival = Festival::factory()->hasAttached(Artist::factory())->create();
    $artist = $festival->artists->first();

    $this->delete(route('artists.destroy', $artist))->assertRedirect(route('artists.index'));

    $this->assertModelMissing($artist);
    $this->assertModelExists($festival);
});
