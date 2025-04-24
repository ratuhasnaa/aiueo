<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\VenueNew;
use App\Models\Expense;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total venue
        $totalVenues = VenueNew::count();

        // Venue terbaru (3 data)
        $latestVenues = VenueNew::latest()->take(3)->get();

        // Jumlah per kategori
        $categoryCount = VenueNew::select('category')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('category')
            ->get();

        // ✅ Total expenses keseluruhan
        $totalExpenses = Expense::sum('amount');

        // ✅ Grafik pengeluaran per bulan
        $monthlyExpenses = Expense::selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // ✅ Top Spending This Month
        $topSpending = Expense::whereMonth('date', now()->month)
            ->orderByDesc('amount')
            ->first();

        // ✅ Highest Expense Overall
        $highestExpense = Expense::orderByDesc('amount')->first();

        // ✅ Most used supplier
        $mostUsedSupplier = Expense::select('supplier_name', DB::raw('COUNT(*) as total'))
            ->groupBy('supplier_name')
            ->orderByDesc('total')
            ->first();

        // ✅ Total supplier count
        $supplierCount = Supplier::count();

        return view('admin.dashboard', compact(
            'totalVenues',
            'latestVenues',
            'categoryCount',
            'totalExpenses',
            'monthlyExpenses',
            'topSpending',
            'highestExpense',
            'mostUsedSupplier',
            'supplierCount'
        ));
    }
}
=======
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Models\Room;

use App\Models\Booking;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Session;

use App\Mail\ConfirmationMail;

use Illuminate\Support\Facades\Storage;

use App\Models\RoomImage;

use App\Models\RoomVariation;



class AdminController extends Controller
{   
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $usertype = Auth::user()->usertype;

        if ($usertype === 'admin') {
            return view('admin.index');
        } elseif ($usertype === 'user') {
            $room = Room::all();
            return view('home.index', compact('room'));
        }

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Autentikasi pengguna
        if (Auth::attempt($request->only('email', 'password'))) {
            Auth::user()->refresh();
    
            // Jika admin, arahkan ke halaman admin
            if (Auth::user()->usertype === 'admin') {
                return redirect()->route('home')->with('success', 'Welcome, Admin!');
            }
    
            // Jika bukan admin, gunakan redirect_to atau default ke home
            $redirectTo = $request->input('redirect_to', route('home'));
            return redirect($redirectTo)->with('success', 'You are logged in!');
        }
    
        // Gagal login
        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }
    
    

    public function adminIndex()
{
    return view('admin.index'); 
}
    

    public function home()
    {
        $room = Room::all(); // Mengambil semua data room
        $categories = Room::select('room_type')->distinct()->get(); // Mengambil semua tipe kategori unik
        return view('home.index', compact('room', 'categories'));
    }

    
    public function create_room()
    {
        return view('admin.create_room');
    }

    public function add_room(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'wifi' => 'required|string',
            'type' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            // Validasi variations tetap
            'variations' => 'nullable|array',
            'variations.*.name' => 'required|string',
            'variations.*.price_per_hour' => 'required|numeric',
            'variations.*.size' => 'nullable|numeric',
            // Kapasitas variations
            'variations.*.capacity_u_shape' => 'nullable|integer',
            'variations.*.capacity_double_u_shape' => 'nullable|integer',
            'variations.*.capacity_theatre' => 'nullable|integer',
            'variations.*.capacity_classroom' => 'nullable|integer',
            'variations.*.capacity_round_table' => 'nullable|integer',
            'variations.*.capacity_cocktail' => 'nullable|integer',
        ]);
        
    
        try {
            \DB::beginTransaction();
    
            // Simpan data Room ke tabel rooms
            $room = Room::create([
                'room_title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
                'wifi' => $request->wifi,
                'room_type' => $request->type,
            ]);
    
            // Simpan Room Images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('room'), $imageName);
    
                    RoomImage::create([
                        'room_id' => $room->id,
                        'image' => $imageName,
                        'is_primary' => false,
                    ]);
                }
            }
    
            // Simpan Room Variations
            if ($request->has('variations')) {
                foreach ($request->variations as $variation) {
                    RoomVariation::create([
                        'room_id' => $room->id,
                        'name' => $variation['name'],
                        'price_per_hour' => $variation['price_per_hour'],
                        'size' => $variation['size'] ?? null,
                        'capacity_u_shape' => $variation['capacity_u_shape'] ?? null,
                        'capacity_double_u_shape' => $variation['capacity_double_u_shape'] ?? null,
                        'capacity_theatre' => $variation['capacity_theatre'] ?? null,
                        'capacity_classroom' => $variation['capacity_classroom'] ?? null,
                        'capacity_round_table' => $variation['capacity_round_table'] ?? null,
                        'capacity_cocktail' => $variation['capacity_cocktail'] ?? null,
                    ]);
                }
            }
    
            \DB::commit();
            return redirect()->route('admin.view_room')->with('success', 'Room and variations added successfully!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Failed to add room. ' . $e->getMessage());
        }
    }

    public function view_room()
    {
        // Muat semua data Room dengan gambar terkait
        $data = Room::with('variations')->get();
    
        return view('admin.view_room', compact('data'));
    }
    
    

    public function room_delete($id)
    {
        $data = Room :: find($id);
        $data->delete();
        return redirect()-> back();
        
    }

    public function delete_room_image($id)
    {
        // Cari gambar berdasarkan ID
        $image = RoomImage::find($id);
    
        if ($image) {
            // Hapus file fisik jika ada
            $imagePath = public_path('room/' . $image->image);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Hapus file
            }
    
            // Hapus data gambar dari tabel
            $image->delete();
    
            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Image deleted successfully.');
        }
    
        // Jika gambar tidak ditemukan
        return redirect()->back()->with('error', 'Image not found.');
    }
    

    public function room_update($id)
    {
        // Ambil data room beserta variations dan images
        $data = Room::with('variations', 'images')->find($id);
        return view('admin.update_room', compact('data'));
    }
    
    public function edit_room(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'wifi' => 'required|string',
            'type' => 'required|string',
            'variations' => 'nullable|array',
            'variations.*.name' => 'required|string',
            'variations.*.price_per_hour' => 'required|numeric',
            'variations.*.size' => 'nullable|numeric',
            'variations.*.capacity_u_shape' => 'nullable|integer',
            'variations.*.capacity_double_u_shape' => 'nullable|integer',
            'variations.*.capacity_theatre' => 'nullable|integer',
            'variations.*.capacity_classroom' => 'nullable|integer',
            'variations.*.capacity_round_table' => 'nullable|integer',
            'variations.*.capacity_cocktail' => 'nullable|integer',
        ]);
    
        try {
            \DB::beginTransaction();
    
            // Update Room Data
            $room = Room::findOrFail($id);
            $room->update([
                'room_title' => $request->title,
                'description' => $request->description,
                'location' => $request->location,
                'wifi' => $request->wifi,
                'room_type' => $request->type,
            ]);
    
            // Handle Variations
            $existingVariationIds = $room->variations->pluck('id')->toArray();
    
            if ($request->has('variations')) {
                $updatedVariationIds = [];
                foreach ($request->variations as $variation) {
                    if (isset($variation['id']) && in_array($variation['id'], $existingVariationIds)) {
                        // Update existing variation
                        $existingVariation = RoomVariation::find($variation['id']);
                        if ($existingVariation) {
                            $existingVariation->update($variation);
                            $updatedVariationIds[] = $variation['id'];
                        }
                    } else {
                        // Add new variation
                        $newVariation = RoomVariation::create(array_merge($variation, ['room_id' => $room->id]));
                        $updatedVariationIds[] = $newVariation->id;
                    }
                }
    
                // Delete variations not included in the request
                $variationsToDelete = array_diff($existingVariationIds, $updatedVariationIds);
                RoomVariation::whereIn('id', $variationsToDelete)->delete();
            } else {
                // Delete all variations if none provided
                RoomVariation::whereIn('id', $existingVariationIds)->delete();
            }
    
            // Handle Image Upload
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('room'), $imageName);
    
                    RoomImage::create([
                        'room_id' => $room->id,
                        'image' => $imageName,
                        'is_primary' => false,
                    ]);
                }
            }
    
            \DB::commit();
            return redirect()->back()->with('success', 'Room and variations updated successfully!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update room. ' . $e->getMessage());
        }
    }    
    
    
    public function bookings()
    {
        $data = Booking::with('room')->get(); 
        return view('admin.booking', compact('data'));

        $data = Booking::with('room')->get();
        dd($data);
    }
    
    
    public function delete_booking($id)
    {
        $data = Booking::find($id);

        $data->delete();

        return redirect()->back();
    }


    public function approve_book($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approve';
        $booking->save();
    
        return redirect()->back()->with('message', 'Booking approved!');
    }
    
    public function reject_book($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'reject';
        $booking->save();
    
        return redirect()->back()->with('message', 'Booking rejected.');
    }
    
    

    public function send_mail($id)
    {
        $data = Booking::find($id);
        return view('admin.send_mail',compact('data'));
    }

    
    public function mail(Request $request,$id)
    {
        $data = Booking::find($id);

        

        $details = [

            'subject' => $request->subject,
            
            'body' => $request->body,
            
            'action_text' => $request->action_text,

            'action_url' => $request->action_url,

            'endline' => $request->endline,
        ];

        Mail::to($data->email)->send(new ConfirmationMail($details));

        return redirect()->back()->with('success', 'Email sent successfully!');

    }

    public function send_mail_direct($id)
{
    $data = Booking::find($id);

    if (!$data) {
        return redirect()->back()->with('error', 'Booking not found.');
    }

    $details = [
        'subject' => 'Booking Confirmation',
        'greeting' => "Dear {$data->name},",
        'introduction' => "Thank you for booking '{$data->room->room_title}'. We are looking forward to your visit.",
        'booking_details' => [
            'Check In' => $data->start_time,
            'Check Out' => $data->end_time,
            'Room' => $data->room->room_title,
            'Booked By' => $data->name,
            'Total Payment' => '$' . number_format($data->room->price, 2),
        ],
        'closing' => 'Best Regards,',
        'hotel_name' => $data->room->location // Nama hotel/mitra diambil dari lokasi
    ];
    

    try {
        Mail::to($data->email)->send(new ConfirmationMail($details));
        return redirect()->back()->with('success', 'Email sent successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to send email. ' . $e->getMessage());
    }
}


}
>>>>>>> fitur-admin
