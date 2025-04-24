<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'rent' => 'required|numeric',
        'short_code' => 'required|string|max:10',
        'number_of_rooms' => 'required|integer',
        'room_type' => 'required|string',
        'status' => 'required|string|in:Active,Inactive',
    ]);

    // Baru data bisa ke-save
    Room::create($validated);

    return redirect()->route('admin.addrooms')->with('success', 'Room berhasil ditambahkan.');
}


    // Update status room
    public function updateStatus(Request $request, Room $room)
{
    $validated = $request->validate([
        'status' => 'required|in:Active,Inactive',
    ]);

    $room->update(['status' => $validated['status']]);

    return redirect()->route('admin.addrooms')->with('success', 'Status kamar berhasil diupdate.');
}



}
