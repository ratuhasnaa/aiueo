<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;

use App\Models\RoomVariation;

use App\Models\Booking;

class HomeController extends Controller




{

    public function home() {
        $rooms = Room::all(); // Mengambil semua data ruangan
        $categories = Room::select('room_type')->distinct()->get(); // Mengambil semua tipe ruangan yang unik
        return view('home.index', compact('rooms', 'categories'));
    }

    
    

    public function room_details($id)
    {
        $room = Room::find($id);

        return view('home.room_details',compact('room'));
    }



    public function checkout($room_id, $variation_id)
    {
        $room = Room::with('images')->find($room_id); // Load images with the room
        $variation = RoomVariation::find($variation_id);
    
        if (!$room || !$variation) {
            abort(404, 'Room or Variation not found');
        }
    
        return view('home.checkout', compact('room', 'variation'));
    }
    
    
    


    public function add_booking(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i|after:startTime',
            'booking_date' => 'required|date',
            'room_variation_id' => 'required|exists:room_variations,id',
            'payment_method' => 'required|string',
        ]);
    
        $variation = RoomVariation::findOrFail($request->room_variation_id);
    
        $start = strtotime($request->startTime);
        $end = strtotime($request->endTime);
        $duration = ($end - $start) / 3600;
    
        $total_price = $variation->price_per_hour * $duration;
    
        $booking = Booking::create([
            'room_id' => $id,
            'room_variation_id' => $request->room_variation_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'start_time' => $request->startTime,
            'end_time' => $request->endTime,
            'booking_date' => $request->booking_date,
            'status' => 'pending_payment',
            'total_price' => $total_price,
            'payment_method' => $request->payment_method,
        ]);
    
        return redirect()->route('payment.page', ['booking' => $booking->id]);
    }

    

    
    
    public function check_availability(Request $request, $id)
    {
        $request->validate([
            'startTime' => 'required',
            'endTime' => 'required',
            'booking_date' => 'required',
        ]);
    
        $startTime = $request->startTime;
        $endTime = $request->endTime;
        $booking_date = $request->booking_date;
    
        $isBooked = Booking::where('room_id', $id)
            ->where('booking_date', $booking_date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<', $endTime)
                      ->where('end_time', '>', $startTime);
                });
            })
            ->whereIn('status', ['pending_confirmation', 'approve'])
            ->exists();
    
        if ($isBooked) {
            return response()->json([
                'available' => false,
                'message' => 'Room is already booked or waiting for payment confirmation. Please choose another time.',
            ]);
        }
    
        return response()->json([
            'available' => true,
            'message' => 'Room is available!',
        ]);
    }
    

    public function paymentPage($id)
    {
        $booking = Booking::with('variation')->findOrFail($id);
    
        // Hitung durasi jam
        $start = strtotime($booking->start_time);
        $end = strtotime($booking->end_time);
        $duration = ($end - $start) / 3600;
    
        $total_price = $booking->total_price;
    
        return view('home.payment', compact('booking', 'total_price', 'duration'));
    }
    

public function submitPayment(Request $request, Booking $booking)
{
    $request->validate([
        'payment_receipt' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $path = $request->file('payment_receipt')->store('payment_receipts', 'public');

    $booking->update([
        'payment_receipt' => $path,
        'status' => 'paid',
    ]);

    return redirect()->route('home')->with('message', 'Payment successful! Your booking is confirmed.');
}
 


public function uploadPayment(Request $request, Booking $booking)
{
    $request->validate([
        'proof' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',
    ]);

    if ($request->hasFile('proof')) {
        $file = $request->file('proof');
        $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('payments', $filename, 'public');

        $booking->update([
            'payment_proof' => $filePath,
            'status' => 'pending_confirmation',
        ]);
    }

return redirect()->route('payment.page', $booking->id)
    ->with('success', 'Payment proof uploaded successfully. Your booking is pending admin confirmation.');
}


public function store(Request $request)
{
    $request->validate([
        'room_id' => 'required',
        'booking_date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'user_id' => 'required',
    ]);

    $booking = Booking::create([
        'room_id' => $request->room_id,
        'user_id' => $request->user_id,
        'booking_date' => $request->booking_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'status' => 'pending_payment',
    ]);

    return redirect()->route('booking.payment', $booking->id);
}

public function myBookings()
{
    $userId = auth()->id();

    $bookings = Booking::with(['room.images', 'variation'])
                ->where('email', auth()->user()->email)
                ->latest()
                ->paginate(5);

    return view('home.my_bookings', compact('bookings'));
}



}