<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"><!--<![endif]-->
<head>
	<!-- Basic Page Needs -->
	<meta charset="UTF-8">
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<title>AIUEO | Event Organizer</title>

	<meta name="author" content="themsflat.com">

	<!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Boostrap style -->
	<link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">

	<!-- Theme style -->
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">

	<!-- Reponsive -->
	<link rel="stylesheet" type="text/css" href="stylesheets/responsive.css">

	<!-- Favicon -->
    <link href="images/page/2-removebg-preview.png" rel="shortcut icon">

    <base href="/public">
    @include('home.css') 
	<style>
    /* Membuat opsi yang disabled menjadi abu-abu */
    select option:disabled {
        color: #ccc; /* Warna abu-abu */
        background-color: #f8f8f8; /* Latar belakang */
        cursor: not-allowed; /* Menunjukkan tidak bisa diklik */
    }

	.carousel-inner img {
    width: 100%; /* Pastikan gambar memenuhi lebar */
    height: 150px; /* Samakan dengan tinggi container */
    object-fit: cover; /* Pangkas gambar agar proporsional */
}
.carousel-item {
    transition: transform 0.5s ease-in-out;
}
.checkout-content {
    display: flex;
    align-items: stretch;
    gap: 30px; /* biar jarak kiri kanan enak */
}

/* Samakan tinggi kiri dan kanan */

.right-column {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.right-column {
    background: #f9f9f9; /* optional biar kelihatan penuh */
    padding: 27px;
    box-sizing: border-box;
}


</style>


	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="header_sticky">
		
		<!-- Preloader -->
		<div class="preloader">
			<div class="clear-loading loading-effect-2">
				<span></span>
			</div>
		</div><!-- /.preloader -->

	@include('home.header')
	@include('home.popup')
		
	
	<section class="flat-row flat-imagebox background">
		<div class="container">
			<div class="checkout-content">
				<div class="left-column-checkout">
					<!-- Pemesanan Akomodasi Title -->
					<h1 class="pemesanan-title">Pemesanan Akomodasi</h1>
					<p class="pemesanan-subtitle">
						Pastikan kamu mengisi semua informasi di halaman ini benar sebelum melanjutkan ke pembayaran.
					</p>
					
					<!-- Data Pemesan Section -->
					<div class="data-pemesan-box">
						<h2 class="data-pemesan-title">Data Pemesan</h2>

						<div>
							@if(session()->has('message'))

							<div class="alert alert-success">
							
							{{session()->get('message')}}
							</div>


							@endif
						</div>

						@if($errors)

						@foreach($errors->all() as $errors)

						<li style="color:red">
							{{$errors}}
						</li>

						@endforeach

						@endif


						<form action="{{url('add_booking',$room->id)}}" method="Post" class="data-pemesan-form">

						@csrf
							<div class="form-group">
								<label for="nama-lengkap">Nama Lengkap</label>
								<input type="text" id="nama-lengkap" name="name" class="form-input" placeholder="Nama Lengkap"
								@if(Auth::id())
								value="{{ Auth::check() ? Auth::user()->name : '' }}"
								@endif
								>
							</div>
							<div class="form-group-inline">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" id="email" class="form-input" name="email" placeholder="Email"
									@if(Auth::id())
									value="{{ Auth::check() ? Auth::user()->email : '' }}"
									@endif
									>
									
								</div>
								<div class="form-group">
									<label for="nomor-handphone">Nomor Handphone</label>
									<input type="phone" id="nomor-handphone" class="form-input" name="phone" placeholder="Nomor Handphone"
									@if(Auth::id())
									value="{{ Auth::check() ? Auth::user()->phone : '' }}"
									@endif
								>
								</div>	
							</div>
							<div class="form-group">
								<label for="booking-date">Choose Date</label>
								<input type="date" id="booking-date" name="booking_date" class="form-input" 
								@if(Auth::id())
								value="{{ old('booking_date') }}"
								@endif
								required>
								
							</div>

							<div class="checkin-checkout-wrapper form-group-inline" style="display: none;">
    <div class="form-group">
        <label for="startTime">Check In</label>
        <select id="startTime" name="startTime" class="form-input" required>
            <script>
                for (let i = 0; i < 24; i++) {
                    let hour = i < 10 ? '0' + i : i;
                    document.write(`<option value="${hour}:00">${hour}:00</option>`);
                }
            </script>
        </select>
    </div>
    <div class="form-group">
        <label for="endTime">Check Out</label>
        <select id="endTime" name="endTime" class="form-input" required>
            <script>
                for (let i = 0; i < 24; i++) {
                    let hour = i < 10 ? '0' + i : i;
                    document.write(`<option value="${hour}:00">${hour}:00</option>`);
                }
            </script>
        </select>
    </div>
</div>

						
					</div>

                    <!-- Payment Method Section -->
<div class="data-pembayaran-box" style="margin-top: 20px;">
    <h2 class="data-pemesan-title">Metode Pembayaran</h2>
    <div class="form-group">
    <select name="payment_method" id="payment_method" class="form-select" required>
        <option value="">-- Pilih Bank / E-wallet --</option>
        <option value="bca" {{ old('payment_method') == 'bca' ? 'selected' : '' }}>Bank BCA</option>
        <option value="bni" {{ old('payment_method') == 'bni' ? 'selected' : '' }}>Bank BNI</option>
        <option value="bri" {{ old('payment_method') == 'bri' ? 'selected' : '' }}>Bank BRI</option>
        <option value="mandiri" {{ old('payment_method') == 'mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
        <option value="gopay" {{ old('payment_method') == 'gopay' ? 'selected' : '' }}>GoPay</option>
        <option value="ovo" {{ old('payment_method') == 'ovo' ? 'selected' : '' }}>OVO</option>
        <option value="dana" {{ old('payment_method') == 'dana' ? 'selected' : '' }}>DANA</option>
    </select>

    </div>
</div>


					<!-- Setup Ruangan Section -->
                    <input type="hidden" name="room_variation_id" value="{{ $variation->id }}">

					
					<button type="submit" class="lanjut-button">Konfirmasi Pembayaran</button>
				</div>
                    </form>
	
				<div class="right-column">
					<!-- Custom Box -->
                    <div class="custom-content-box" style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                    <h2 class="custom-box-title">{{$room->room_title}}</h2>
						<div class="reviews">
							<img src="images/page/star.png" alt="Google Reviews" class="google-reviews-icon">
							<span class="review-rating">4.5</span>
							<span class="review-text">(Google Reviews)</span>
						</div>
	
						<!-- Bootstrap Carousel -->
						<div id="venueCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($room->images as $index => $image)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('room/' . $image->image) }}" class="d-block w-100" alt="Room Image {{ $index + 1 }}" style="height:150px;">
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#venueCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#venueCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


						<h2 class="custom-box-title1">{{ $variation->name }}</h2>

<div class="booking-details">
<div class="booking-detail">
        <span class="detail-label">Booking Date:</span>
        <span id="summary-booking-date">-</span>
    </div>
    <div class="booking-detail">
        <span class="detail-label">Check In:</span>
        <span id="summary-checkin">-</span>
    </div>
    <div class="booking-detail">
        <span class="detail-label">Check Out:</span>
        <span id="summary-checkout">-</span>
    </div>
</div>

<hr class="divider-line">

<div class="price-info">
    <span class="total-price-label">Total Harga</span>
    <span id="summary-total">Rp 0</span>
</div>
<div class="rent-info">
    <p>Total Durasi Sewa: <span id="summary-duration">-</span></p>
</div>

			</div>
		</div>
	</section>
		
		
		
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="widget widget-categories">
							<h3 class="widget-title">Support</h3>
							<ul class="one-half">
								<li><a href="#" title="">How to Book</a></li>
								<li><a href="#" title="">Contact Us</a></li>
								<li><a href="#" title="">Help Center</a></li>
								<li><a href="#" title="">About Us</a></li>
							</ul>
						</div><!-- /.widget-categories -->
					</div><!-- /.col-md-3 -->
					<div class="col-md-3">
						<div class="widget widget-categories">
							<h3 class="widget-title">AIUEO</h3>
							<ul class="one-half">
								<li><a href="#" title="">Office Space Near You</a></li>
								<li><a href="#" title="">Coworking Near You</a></li>
								<li><a href="#" title="">Virtual Office Near You</a></li>
								<li><a href="#" title="">Meeting Rooms Near You</a></li>
							</ul>
						</div><!-- /.widget-categories -->
					</div><!-- /.col-md-3 -->
				</div><!-- /.col-md-3 -->
				<div class="col-md-4">
					<div class="widget widget-categories">
						<h3 class="widget-title">Location</h3>
						<ul class="one-half">
							<li >Jl. Yasmin Raya No.16 A, RT.01/RW.04, Curugmekar, Kec. Bogor Bar., Kota Bogor, Jawa Barat 16113</li>
						</ul>
					</div><!-- /.widget-categories -->
				</div><!-- /.col-md-3 -->
				</div><!-- /.row -->
			</div><!-- /.container -->
		</footer><!-- /footer -->
			

		<div class="button-go-top">
			<a href="#" title="" class="go-top">
				<i class="fa fa-chevron-up"></i>
			</a><!-- /.go-top -->
		</div><!-- /.button-go-top -->
		
		<!-- Javascript -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		
	    <script type="text/javascript" src="javascript/jquery.min.js"></script>
	    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
	    <script type="text/javascript" src="javascript/easing.js"></script>
	    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
   		<script type="text/javascript" src="javascript/gmap3.min.js"></script>
   		<script type="text/javascript" src="javascript/parallax.js"></script>
	    <script type="text/javascript" src="javascript/owl.carousel.js"></script>
	    <script type="text/javascript" src="javascript/main.js"></script>
		<script type="text/javascript" src="javascript/bayar.js"></script>

		<script>
    $(function () {
        // Sembunyikan hanya bagian check-in dan check-out secara default
        $('.checkin-checkout-wrapper').hide();

        // Fungsi untuk memeriksa apakah tanggal telah dipilih
        function checkDateSelected() {
            return $('#booking-date').val() !== '';
        }

        // Event listener untuk perubahan pada input tanggal
        $('#booking-date').on('change', function () {
            if (checkDateSelected()) {
                // Tampilkan bagian check-in dan check-out jika tanggal dipilih
                $('.checkin-checkout-wrapper').fadeIn();
                $('#date-warning').hide();
            } else {
                // Sembunyikan bagian check-in dan check-out jika tidak ada tanggal
                $('.checkin-checkout-wrapper').fadeOut();
                $('#date-warning').show();
            }
        });

        // Validasi input waktu check-in dan check-out tetap aktif
        $('#startTime, #endTime').on('focus', function () {
            if (!checkDateSelected()) {
                $('#date-warning').show();
                $(this).blur(); // Menghilangkan fokus dari dropdown
            } else {
                $('#date-warning').hide();
            }
        });
    });
</script>
<script>
    $(function () {
        // Fungsi untuk menghitung total harga dan memperbarui ringkasan
        function calculateTotalPrice() {
            const pricePerHour = parseFloat('{{ $variation->price_per_hour }}'); // Harga per jam
            const checkIn = $('#startTime').val();
            const checkOut = $('#endTime').val();

            if (checkIn && checkOut) {
                const checkInHour = parseInt(checkIn.split(':')[0]);
                const checkOutHour = parseInt(checkOut.split(':')[0]);
                const duration = checkOutHour - checkInHour;

                if (duration > 0) {
                    const totalPrice = pricePerHour * duration;
                    $('#summary-total').text(`Rp ${totalPrice.toLocaleString('id-ID')}`);
                } else {
                    $('#summary-total').text('Rp 0');
                }
                $('#summary-duration').text(duration > 0 ? `${duration} jam` : '0 jam');
            } else {
                $('#summary-total').text('Rp 0');
                $('#summary-duration').text('-');
            }
        }

        // Event listener untuk memperbarui tanggal booking di ringkasan
        $('#booking-date').on('change', function () {
            $('#summary-booking-date').text($(this).val() || '-');
        });

        // Event listener untuk memperbarui check-in dan check-out di ringkasan
        $('#startTime, #endTime').on('change', function () {
            $('#summary-checkin').text($('#startTime').val() || '-');
            $('#summary-checkout').text($('#endTime').val() || '-');
            calculateTotalPrice();
        });
    });
</script>



<script>
    $(document).ready(function () {
        $('#check-availability-btn').on('click', function () {
            const roomId = '{{ $room->id }}';
            const startTime = $('#startTime').val();
            const endTime = $('#endTime').val();

            if (!startTime || !endTime) {
                $('#availability-message')
                    .text('Please select both check-in and check-out times.')
                    .css('color', 'red')
                    .show();
                return;
            }

            $.ajax({
                url: `/check-availability/${roomId}`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    startTime: startTime,
                    endTime: endTime,
                },
                success: function (response) {
                    if (response.available) {
                        $('#availability-message')
                            .text(response.message)
                            .css('color', 'green')
                            .show();
                        $('#submit-booking-btn').prop('disabled', false);
                    } else {
                        $('#availability-message')
                            .text(response.message)
                            .css('color', 'red')
                            .show();
                        $('#submit-booking-btn').prop('disabled', true);
                    }
                },
                error: function () {
                    $('#availability-message')
                        .text('An error occurred. Please try again later.')
                        .css('color', 'red')
                        .show();
                },
            });
        });
    });
</script>

<script>
    $(function () {
        // Ambil tanggal hari ini
        var dtToday = new Date();

        var year = dtToday.getFullYear();
        var month = (dtToday.getMonth() + 1).toString().padStart(2, '0'); // Bulan dalam 2 digit
        var day = dtToday.getDate().toString().padStart(2, '0'); // Hari dalam 2 digit

        // Format tanggal untuk input date
        var minDate = year + '-' + month + '-' + day;

        // Set atribut 'min' pada input date
        $('#booking-date').attr('min', minDate);

        // Event listener untuk perubahan pada input tanggal
        $('#booking-date').on('change', function () {
            if ($(this).val() < minDate) {
                alert('Tanggal tidak valid! Pilih tanggal mulai dari hari ini.');
                $(this).val(''); // Reset nilai jika tanggal tidak valid
            }
        });
    });
</script>
<script>
    $(function () {
        // Fungsi untuk mengupdate opsi Check Out berdasarkan Check In
        function updateCheckoutOptions() {
            var startTime = $('#startTime').val(); // Nilai waktu Check In
            if (startTime) {
                var startHours = parseInt(startTime.split(':')[0]); // Ambil jam dari Check In
                var startMinutes = parseInt(startTime.split(':')[1]); // Ambil menit dari Check In

                // Tentukan batas waktu minimum Check Out (satu jam setelah Check In)
                var minHours = startHours + 1;

                // Reset dan perbarui opsi di dropdown Check Out
                $('#endTime option').each(function () {
                    var optionTime = $(this).val();
                    var optionHours = parseInt(optionTime.split(':')[0]); // Ambil jam dari opsi

                    if (optionHours < minHours) {
                        $(this).prop('disabled', true); // Nonaktifkan opsi jika kurang dari satu jam
                    } else {
                        $(this).prop('disabled', false); // Aktifkan opsi lain
                    }
                });

                // Pilih waktu Check Out default (satu jam setelah Check In)
                var defaultEndTime = minHours < 10 ? '0' + minHours + ':00' : minHours + ':00';
                $('#endTime').val(defaultEndTime);
            }
        }

        // Event listener untuk perubahan pada waktu Check In
        $('#startTime').on('change', function () {
            updateCheckoutOptions();
        });

        // Pastikan opsi diperbarui saat halaman dimuat
        updateCheckoutOptions();
    });
</script>
<script>
    $(function () {
        // Fungsi untuk memperbarui opsi Check In
        function updateCheckinOptions() {
            var now = new Date();
            var currentHours = now.getHours();
            var currentMinutes = now.getMinutes();

            $('#startTime option').each(function () {
                var optionTime = $(this).val();
                var optionHours = parseInt(optionTime.split(':')[0]);

                // Nonaktifkan waktu yang sudah lewat pada hari ini
                if (optionHours < currentHours || (optionHours === currentHours && currentMinutes > 0)) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                }
            });
        }

        // Fungsi untuk mengupdate opsi Check Out berdasarkan Check In
        function updateCheckoutOptions() {
            var startTime = $('#startTime').val();
            if (startTime) {
                var startHours = parseInt(startTime.split(':')[0]);

                // Tentukan batas waktu minimum Check Out (satu jam setelah Check In)
                var minHours = startHours + 0;

                $('#endTime option').each(function () {
                    var optionTime = $(this).val();
                    var optionHours = parseInt(optionTime.split(':')[0]);

                    // Nonaktifkan opsi yang kurang dari satu jam setelah Check In
                    if (optionHours < minHours) {
                        $(this).prop('disabled', true);
                    } else {
                        $(this).prop('disabled', false);
                    }
                });

                // Pilih waktu Check Out default
                var defaultEndTime = minHours < 10 ? '0' + minHours + ':00' : minHours + ':00';
                $('#endTime').val(defaultEndTime);
            }
        }

        // Perbarui opsi saat halaman dimuat
        updateCheckinOptions();

        // Event listener untuk perubahan waktu Check In
        $('#startTime').on('change', function () {
            updateCheckoutOptions();
        });

        // Event listener untuk memperbarui opsi waktu Check In setiap kali tanggal berubah
        $('#booking-date').on('change', function () {
            var bookingDate = $('#booking-date').val();
            var today = new Date().toISOString().split('T')[0];

            if (bookingDate === today) {
                updateCheckinOptions();
            } else {
                // Jika bukan hari ini, semua opsi Check In diaktifkan
                $('#startTime option').prop('disabled', false);
            }
        });
    });
</script>



		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
		
	</body>
</html>