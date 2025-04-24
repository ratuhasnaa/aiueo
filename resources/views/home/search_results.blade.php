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
	
<body class="header_sticky" style="background-color: #F8FAF6;">
		
		<!-- Preloader -->
		<div class="preloader">
			<div class="clear-loading loading-effect-2">
				<span></span>
			</div>
		</div><!-- /.preloader -->

	@include('home.header')
	@include('home.popup')


    <section class="search-results-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
            <h1 style="font-weight: bold; font-size: 18px; text-align: left; margin-top: 10px;">
                Results For 
                @if(request('search') && request('location'))
                    {{ request('search') }} in {{ request('location') }}
                @elseif(request('search'))
                    {{ request('search') }}
                @elseif(request('location'))
                    Location: {{ request('location') }}
                @else
                    All Results
                @endif
            </h1>               
            </div>
        </div>

        @if(isset($results) && !$results->isEmpty())
        <div class="row">
                @foreach($results as $result)
                    <div class="col-md-3 mb-4"> <!-- Menggunakan col-md-3 untuk 4 kolom -->
                        <div class="imagebox">
                            <div class="box-imagebox">
                                <div class="box-header">
                                    <div class="box-image">
                                        @if($result->images->isNotEmpty())
                                            <img src="{{ asset('room/' . $result->images->first()->image) }}" alt="{{ $result->room_title }}">
                                        @else
                                            <img src="{{ asset('images/default-room.jpg') }}" alt="Default Image">
                                        @endif
                                        <a href="#" title="Preview">Preview</a>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="box-title-rating">
                                        <a href="{{ url('room_details', $result->id) }}" title="">{{ $result->room_title }}</a>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <span class="score">4.5</span>
                                        </div>
                                    </div>
                                    <div class="box-info">
                                        <ul>
                                            <li class="address">{{ $result->location }}</li>
                                            <li class="price">Rp {{ number_format($result->price, 0, ',', '.') }}</li>
                                        </ul>
                                    </div>
                                    <div class="box-buttons">
                                        <a href="{{ url('room_details', $result->id) }}" class="button">Book</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Oh no! No rooms found</h2>
                    <p>Try adjusting your search criteria.</p>
                </div>
            </div>
        @endif
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