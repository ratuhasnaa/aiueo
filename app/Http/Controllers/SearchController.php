<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class SearchController extends Controller
{
    // Pastikan method index() ada di sini
    public function index(Request $request)
    {
        // Ambil parameter pencarian
        $search = $request->input('search');
        $location = $request->input('location');
        $room_type = $request->input('room_type');

        // Mulai query pencarian untuk Room
        $query = Room::query();

        // Filter berdasarkan search term (room_title atau description)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('room_title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan location
        if ($location) {
            $query->where('location', 'like', '%' . $location . '%');
        }

        // Filter berdasarkan room_type
        if ($room_type) {
            $query->where('room_type', '=', $room_type);
        }

        // Ambil hasil pencarian
        $results = $query->get();

        return view('home.search_results', compact('results'));
    }
}
