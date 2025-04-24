<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VenueNew;
use Illuminate\Support\Facades\Storage;

class VenueNewController extends Controller
{
    public function create()
    {
        return view('admin.addvenue');  // Path sesuai dengan letak file di resources/views/admin/addvenue.blade.php
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Handle upload image jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('venues', 'public');
            $validated['image'] = $imagePath;
        }

        VenueNew::create($validated);

        return redirect()->route('venues.create')->with('success', 'Venue successfully added!');
    }
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'capacity' => 'required|numeric|min:1',
        'category' => 'required|string|max:255',
    ]);

    $venue = VenueNew::findOrFail($id);
    $venue->update($validated);

    return redirect()->route('venues.index')->with('success', 'Venue updated successfully');
}

}

