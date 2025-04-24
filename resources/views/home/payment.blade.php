<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AIUEO | Finish Your Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/responsive.css">
    <link rel="shortcut icon" href="images/page/2-removebg-preview.png">
    <base href="/public">
    @include('home.css')

    <style>
        body {
            background-color: #f8faf6 !important;
            margin: 0;
        }
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin: 0px 40px 0px 40px;
            text-align: left;
        }
        .container-fluid {
            display: flex;
            gap: 20px;
            padding: 10px 50px 50px 40px;
        }
        .left-col, .right-col {
            flex: 1;
        }
        .content-box {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        .section-label {
            font-size: 18px;
            font-weight: 700;
            color: #1e1e1e;
            margin-bottom: 20px;
        }

        .booking-summary {
            font-size: 15px;
            color: #333;
            margin-bottom: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-item .label {
            font-weight: 300;
            font-size: 16px;
            color: #1e1e1e;
            margin-left: -10px;
        }


        .summary-item .value {
            font-weight: 600;
            color: #1e1e1e;
        }

        .total-price-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 20px;
            font-weight: 700;
            color: #1e1e1e;
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .payment-method {
            margin-top: 25px;
            font-size: 16px;
            font-weight: 500;
            color: #1e1e1e;
        }

        .upload-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: left;
        }

        .upload-box {
            border: 2px dashed #ccc;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            text-align: left;
        }

        .upload-box label {
            font-weight: 600;
        }

        .upload-box .text-muted {
            text-align: left;
            margin-top: 10px;
        }

        .countdown-label {
            font-weight: 600;
            background-color: #fff4e5;
            border-left: 6px solid #e65c00;
            padding: 15px 20px;
            border-radius: 6px;
            color: #e65c00;
            display: block;
            width: 100%;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .countdown-label .countdown-text {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .countdown-label .countdown-desc {
            font-size: 13px;
            font-style: italic;
            font-weight: normal;
            color: #a94d00;
            line-height: 1.4;
        }

        .submit-btn {
            background-color: #e65c00;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 8px;
            color: #fff;
            font-weight: bold;
            margin-top: 25px;
        }
        /* Styling for the success popup */
.popup-success {
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #d4edda;
    color: #155724;
    padding: 20px 30px;
    border-radius: 10px;
    border: 1px solid #c3e6cb;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    z-index: 9999;
    text-align: center;
    animation: fadeIn 0.5s ease;
}

/* Styling for overlay background */
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Slightly dark background */
    z-index: 9998;
}

/* Fade-in animation for popup */
@keyframes fadeIn {
    from { opacity: 0; transform: translate(-50%, -30%); }
    to { opacity: 1; transform: translate(-50%, -50%); }

}

@keyframes fadeIn {
    from { opacity: 0; transform: translate(-50%, -30%); }
    to { opacity: 1; transform: translate(-50%, -50%); }
}
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>@if (session('success'))
    <div id="success-popup" class="popup-success">
        <h3 style="color: green;">{{ session('success') }}</h3>
        <p>Redirecting you to homepage in <span id="countdown">5</span>...</p>
    </div>

    <div id="popup-overlay" class="popup-overlay"></div>

    <script>
        let count = 5;
        const countdownEl = document.getElementById('countdown');

        const timer = setInterval(() => {
            count--;
            countdownEl.textContent = count;
            if (count === 0) {
                clearInterval(timer);
                window.location.href = "{{ route('home') }}";
            }
        }, 1000);
    </script>
@endif





<body class="header_sticky">
@include('home.payment-header')

<!-- Judul Halaman -->
<div class="page-title">Finish Your Payment</div>

<div class="container-fluid">
    <!-- LEFT COL: Summary -->
    <div class="left-col">
        <div class="content-box">
            <div class="section-label">Booking Summary</div>

            <div class="booking-summary">
                <div class="summary-item">
                    <span class="label">Room</span>
                    <span class="value">{{ $booking->variation->name ?? '-' }}</span>
                </div>
                <div class="summary-item">
                    <span class="label">Booking Date</span>
                    <span class="value">{{ $booking->booking_date }}</span>
                </div>
                <div class="summary-item">
                    <span class="label">Check-in</span>
                    <span class="value">{{ $booking->start_time }}</span>
                </div>
                <div class="summary-item">
                    <span class="label">Check-out</span>
                    <span class="value">{{ $booking->end_time }}</span>
                </div>
            </div>

            <div class="total-price-summary">
                <span>Total to Pay</span>
                <span>Rp {{ number_format($total_price, 0, ',', '.') }}</span>
            </div>

            <div class="payment-method d-flex justify-content-between align-items-center" style="margin-top: 25px;">
    <strong style="min-width: 160px;">Payment Method:</strong>
    <div>
        @php
            $logos = [
                'bca' => 'bca.png',
                'bni' => 'bni.png',
                'bri' => 'bri.png',
                'mandiri' => 'mandiri.png',
                'gopay' => 'gopay.png',
                'ovo' => 'ovo.png',
                'dana' => 'dana.png',
            ];
            $method = strtolower($booking->payment_method);
        @endphp

        @if(array_key_exists($method, $logos))
            <img src="{{ asset('images/payment/' . $logos[$method]) }}" alt="{{ $method }}" style="height: 20px;">
        @else
            <span class="badge bg-info text-dark">{{ strtoupper($booking->payment_method) }}</span>
        @endif
    </div>
</div>

        </div>
    </div>

    <!-- RIGHT COL: Upload -->
    <div class="right-col">
        <div class="content-box">
            <div class="upload-title">Upload Proof of Payment</div>

            <div class="countdown-label">
                <div class="countdown-text">
                    ⏰ Remaining time: <span id="countdown">15:00</span>
                </div>
                <div class="countdown-desc">
                    <strong>Harap selesaikan pembayaran dalam 15 menit.</strong> Jika tidak, pesanan akan otomatis dibatalkan dan tanggal yang Anda booking akan tersedia kembali untuk pelanggan lain.
                </div>
            </div>

            <form action="{{ route('upload.payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="upload-box">
                    <label for="proof" class="form-label">Upload your proof here</label>
                    <input type="file" name="proof" id="proof" class="form-control mt-2" required>
                    <p class="text-muted">Accepted formats: JPG, PNG, PDF. Max size: 2MB.</p>
                </div>
                <button type="submit" class="submit-btn">Submit Payment</button>
            </form>



        </div>
    </div>
</div>

<script>
    let countdownTime = 15 * 60;
    const countdownEl = document.getElementById('countdown');

    function updateCountdown() {
        const minutes = Math.floor(countdownTime / 60);
        const seconds = countdownTime % 60;
        countdownEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

        if (countdownTime > 0) {
            countdownTime--;
        } else {
            clearInterval(timerInterval);
            countdownEl.textContent = "Waktu Habis";
            countdownEl.style.color = 'red';
        }
    }

    const timerInterval = setInterval(updateCountdown, 1000);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
