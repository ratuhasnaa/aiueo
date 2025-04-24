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
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css">

	<!-- Theme style -->
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css">

	<!-- Reponsive -->
	<link rel="stylesheet" type="text/css" href="stylesheets/responsive.css">

	<!-- Favicon -->
    <link href="images/page/2-removebg-preview.png" rel="shortcut icon">

    <base href="/public">
    @include('home.css')    
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



		<section class="flat-row flat-iconbox-gallery style1">
			<div class="container">
			<div class="row">
    <div class="col-md-12">
        <div class="gallery-grid-layout">
            @foreach($room->images as $index => $image)
                <div class="gallery-item 
                    {{ $index === 0 ? 'gallery-item-main' : 'gallery-item-small' }}">
                    <img src="{{ asset('room/' . $image->image) }}" alt="Room Image">
                </div>
            @endforeach
        </div><!-- /.gallery-grid-layout -->
    </div><!-- /.col-md-12 -->
</div><!-- /.row -->


				<div class="row">
					<div class="col-md-8 left-column">
						<div class="flat-row-title-booking">
							<h2>{{$room->room_title}}</h2>
							<p>{{$room->location}}</p>
						</div><!-- /.flat-row-title-booking -->
		
						<div class="capacity-info1">
							<img src="images/page/people.svg" alt="Pax Icon" class="pax-icon">
							<span>50 - 170</span>
						</div><!-- /.capacity-info -->
		
						
						

						
					</div><!-- /.col-md-8 -->
		
				<div class="col-md-4 right-column">
				</div><!-- /.row -->
			</div><!-- /.container -->

			<hr class="separator-line">

		
			<div class="flat-row-title-booking1">
				<h2>About this place</h2>
			</div><!-- /.flat-row-title-booking1 -->

			<div class="room-description2">
				<p>{{$room->description}}</p>
			</div><!-- /.room-description -->

			<hr class="separator-line">

			<div class="flat-row-title-booking1">
				<h2>Facilities</h2>
			</div><!-- /.flat-row-title-booking1 -->
		

			<section class="fasilitas-section">
				<div class="fasilitas-column fasilitas-column-left">
					<ul>
						<li><img src="images/page/waifi.svg" alt="Wi-Fi" class="facility-icon wifi"> Wi-Fi</li>
						<li><img src="images/page/air-conditioner.svg" alt="AC" class="facility-icon ac"> AC</li>
						<li><img src="images/page/projector.svg" alt="Projection screen" class="facility-icon projector"> Projection screen</li>
					</ul>
				</div>
				<div class="fasilitas-column fasilitas-column-right">
					<ul>
						<li><img src="images/page/speaker.svg" alt="Audio equipment" class="facility-icon sound-system"> Audio equipment</li>
						<li><img src="images/page/coffee-table.svg" alt="Seating arrangements" class="facility-icon coffee-table"> Seating arrangements</li>
					</ul>
				</div>
			</section>
			

			<hr class="separator-line">

			<div class="facilities-table-container">
				<table class="facilities-table">
					<tr>
						<td rowspan="2" class="merged-cell">Room type</td>
						<td colspan="6" class="light-blue">Capacity</td>
						<td rowspan="2" class="merged-cell">Price/hour</td>
						<td rowspan="2" class="merged-cell"></td>

						
					</tr>
					<tr>
						<td class="light-blue">U-shape</td>
						<td class="light-blue">Double U-shape</td>
						<td class="light-blue">Theatre style</td>
						<td class="light-blue">Classroom</td>
						<td class="light-blue">Round table</td>
						<td class="light-blue">Cocktail</td>
					</tr>
					@foreach($room->variations as $variation)
					<tr>
						<td class="room-type">
							<span class="room-type-text">{{ $variation->name }}</span><br>
							<span class="room-size">Room size: {{ $variation->size }} sqm</span>
						</td>
						<td class="capacity-data">{{ $variation->capacity_u_shape ?? '-' }}</td>
						<td class="capacity-data">{{ $variation->capacity_double_u_shape ?? '-' }}</td>
						<td class="capacity-data">{{ $variation->capacity_theatre ?? '-' }}</td>
						<td class="capacity-data">{{ $variation->capacity_classroom ?? '-' }}</td>
						<td class="capacity-data">{{ $variation->capacity_round_table ?? '-' }}</td>
						<td class="capacity-data">{{ $variation->capacity_cocktail ?? '-' }}</td>
						<td class="capacity-data">
							Rp {{ number_format($variation->price_per_hour, 0, ',', '.') }}<br>
							<span class="taxes-fees">(includes taxes and fees)</span>
						</td>
						<td class="capacity-data">
							<div class="select-room-wrapper">
								<a href="{{ route('checkout', ['room_id' => $room->id, 'variation_id' => $variation->id]) }}" class="select-room-button">Select</a>
							</div>
						</td>
					</tr>
					@endforeach
				</table>
			</div>

			<hr class="separator-line">
		
						<div class="flat-row-title-booking1">
							<h2>Address</h2>
						</div><!-- /.flat-row-title-booking1 -->
		
						<div class="room-description2">
							<p>Jl. Ranca Bentang 56-58 Ciumbuleuit, Bandung 40142, Indonesia</p>
						</div><!-- /.room-description -->
			<div class="map-container">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.217340930615!2d107.6088927!3d-6.8645378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6c2dab16221%3A0x8571ceecc1d47c7f!2sJl.%20Rancabentang%20No.56%2C%20Ciumbuleuit%2C%20Kec.%20Cidadap%2C%20Kota%20Bandung%2C%20Jawa%20Barat%2040142!5e0!3m2!1sen!2sid!4v1723186110174!5m2!1sen!2sid" width="1250" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div><!-- /.map-container -->

			<hr class="separator-line">

		</section><!-- /.flat-iconbox-gallery style1 -->


		
				
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
	    <script type="text/javascript" src="javascript/jquery.min.js"></script>
	    <script type="text/javascript" src="javascript/bootstrap.min.js"></script>
	    <script type="text/javascript" src="javascript/easing.js"></script>
	    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script>
   		<script type="text/javascript" src="javascript/gmap3.min.js"></script>
   		<script type="text/javascript" src="javascript/parallax.js"></script>
	    <script type="text/javascript" src="javascript/owl.carousel.js"></script>
	    <script type="text/javascript" src="javascript/main.js"></script>
		<script type="text/javascript" src="javascript/custom2.js"></script>
		<script type="text/javascript" src="{{ asset('javascript/login.js') }}"></script>
		</body>
</html>