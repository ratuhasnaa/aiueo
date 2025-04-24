<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\VenueNew;
use Illuminate\Http\Request;


class VenueController extends Controller
{
    public function create()
    {
        return view('admin.addvenue');  // Ganti dengan nama view yang sesuai
    }

    public function edit($id)
{
    $venue = Venue::findOrFail($id);
    $venues = VenueNew::all();

    return view('admin.editvenue', compact('venue', 'venues'));
}

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'price' => 'required|numeric',
            'capacity' => 'required|integer',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil venue berdasarkan ID
        $venue = Venue::findOrFail($id);

        // Assign data request ke model
        $venue->name = $request->name;
        $venue->address = $request->address;
        $venue->city = $request->city;
        $venue->price = $request->price;
        $venue->capacity = $request->capacity;
        $venue->category = $request->category;
        $venue->description = $request->description;

        // Cek apakah ada gambar yang diupload
        if ($request->hasFile('image')) {
            // Simpan gambar ke storage/public
            $imagePath = $request->file('image')->store('venues', 'public');
            $venue->image = $imagePath;
        }

        // Simpan perubahan
        $venue->save();
        
        return redirect()->route('admin.editvenue', $venue->id)->with('success', 'Venue updated successfully!');
            }
}
