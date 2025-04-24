<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Saya</title>
    @include('home.css')
    <style>
        .booking-card {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            padding: 20px;
            border: 1px solid #e1e1e1;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .booking-img {
            width: 200px;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
        }
        .booking-info {
            flex-grow: 1;
        }
        .booking-info h5 {
            margin-bottom: 10px;
            font-weight: 700;
            color: #333;
        }
        .booking-detail {
            font-size: 15px;
            margin-bottom: 4px;
        }
        .booking-status {
            font-weight: 600;
            color: #007bff;
        }
        .status-reject {
            color: red;
        }
        .status-approve {
            color: green;
        }
        .pagination {
            justify-content: center;
        }
    </style>
</head>
<body class="header_sticky">

@include('home.header')

<div class="container mt-5">
    <h2 class="mb-4">Pesanan Saya</h2>

    @if ($bookings->isEmpty())
        <p class="text-muted">Belum ada pesanan.</p>
    @else
        @foreach ($bookings as $booking)
            <div class="booking-card">
                <img src="{{ asset('room/' . ($booking->room->images->first()->image ?? 'default.jpg')) }}" class="booking-img" alt="Room Image">
                <div class="booking-info">
                    <h5>{{ $booking->room->room_title ?? '-' }} - {{ $booking->variation->name ?? '' }}</h5>
                    <div class="booking-detail"><strong>Tanggal:</strong> {{ $booking->booking_date }}</div>
                    <div class="booking-detail"><strong>Jam:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</div>
                    <div class="booking-detail"><strong>Total:</strong> Rp {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                    <div class="booking-detail"><strong>Status:</strong> 
                        <span class="booking-status {{ $booking->status == 'approve' ? 'status-approve' : ($booking->status == 'reject' ? 'status-reject' : '') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                    <div class="booking-detail">
                        <strong>Bukti:</strong> 
                        @if ($booking->payment_proof)
                            <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank">Lihat</a>
                        @else
                            Belum Upload
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        <div class="d-flex mt-4">
            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@include('home.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
