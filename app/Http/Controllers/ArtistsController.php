<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $artists = Artist::orderBy('name')->get();

        return view('artists.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $artist = Artist::create($this->validateArtist($request));

        return redirect()->route('artists.show', $artist)->with('status', 'Artist created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist): View
    {
        $artist->load('festivals');

        return view('artists.show', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist): View
    {
        return view('artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist): RedirectResponse
    {
        $artist->update($this->validateArtist($request));

        return redirect()->route('artists.show', $artist)->with('status', 'Artist updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist): RedirectResponse
    {
        $artist->festivals()->detach();
        $artist->delete();

        return redirect()->route('artists.index')->with('status', 'Artist deleted.');
    }

    /**
     * Validate the artist form input.
     *
     * @return array{name: string, genre: string, spotify_url: string, soundcloud_url: string}
     */
    private function validateArtist(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'genre' => ['required', 'string', 'max:255'],
            'spotify_url' => ['required', 'url', 'max:255'],
            'soundcloud_url' => ['required', 'url', 'max:255'],
        ]);
    }
}
