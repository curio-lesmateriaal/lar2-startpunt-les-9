<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $locations = Location::orderBy('name')->get();

        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $location = Location::create($this->validateLocation($request));

        return redirect()->route('locations.show', $location)->with('status', 'Location created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location): View
    {
        $location->load('festivals');

        return view('locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location): View
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location): RedirectResponse
    {
        $location->update($this->validateLocation($request));

        return redirect()->route('locations.show', $location)->with('status', 'Location updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location): RedirectResponse
    {
        if ($location->festivals()->exists()) {
            return redirect()->route('locations.show', $location)
                ->with('error', 'This location still has festivals. Move or delete them first.');
        }

        $location->delete();

        return redirect()->route('locations.index')->with('status', 'Location deleted.');
    }

    /**
     * Validate the location form input.
     *
     * @return array{name: string, address: string, city: string, description: string}
     */
    private function validateLocation(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);
    }
}
