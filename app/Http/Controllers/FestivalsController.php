<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Festival;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FestivalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $festivals = Festival::with('location')->orderBy('start_date_time')->get();

        return view('festivals.index', compact('festivals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('festivals.create', [
            'locations' => Location::orderBy('name')->get(),
            'artists' => Artist::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateFestival($request);

        $festival = Festival::create($validated);
        $festival->artists()->sync($validated['artists'] ?? []);

        return redirect()->route('festivals.show', $festival)->with('status', 'Festival created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Festival $festival): View
    {
        $festival->load('location', 'artists');

        return view('festivals.show', compact('festival'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Festival $festival): View
    {
        return view('festivals.edit', [
            'festival' => $festival->load('artists'),
            'locations' => Location::orderBy('name')->get(),
            'artists' => Artist::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Festival $festival): RedirectResponse
    {
        $validated = $this->validateFestival($request);

        $festival->update($validated);
        $festival->artists()->sync($validated['artists'] ?? []);

        return redirect()->route('festivals.show', $festival)->with('status', 'Festival updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Festival $festival): RedirectResponse
    {
        $festival->artists()->detach();
        $festival->delete();

        return redirect()->route('festivals.index')->with('status', 'Festival deleted.');
    }

    /**
     * Validate the festival form input.
     *
     * @return array{title: string, start_date_time: string, end_date_time: string, genre: string, description: string, location_id: int, artists?: array<int, int>}
     */
    private function validateFestival(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'start_date_time' => ['required', 'date'],
            'end_date_time' => ['required', 'date', 'after:start_date_time'],
            'genre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location_id' => ['required', 'exists:locations,id'],
            'artists' => ['nullable', 'array'],
            'artists.*' => ['exists:artists,id'],
        ]);
    }
}
